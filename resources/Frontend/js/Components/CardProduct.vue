<template>
    <div
        v-if="product"
        class="group relative"
        :class="
            isBorder
                ? 'hover:border-primary-500 rounded-lg border-2 border-transparent duration-200 group relative overflow-hidden'
                : ' '
        "
    >
        <!-- :href="
            route('products.show', {
                slug: product.slug,
            })
        " -->
        <JamPicture
            src="/assets/images/badge-image.png"
            class="h-16 w-16 absolute left-0 top-0 z-10 max-md:w-8 max-md:h-8 md:w-10 md:h-10 lg:h-12 lg:w-12"
            :class="product.is_sale ? 'block' : 'hidden'"
        />
        <JamLink
            :href="
                route('products.show', {
                    slug: product.slug,
                })
            "
            class="block overflow-hidden aspect-w-1 aspect-h-1"
        >
            <JamPicture
                :src="product.image?.url || '/assets/images/defaultProduct.png'"
                :alt="product.image?.alt"
                class="object-cover items-center aspect-w-1 aspect-h-1"
            />
        </JamLink>
        <div class="" :class="isBorder ? 'p-3' : ''">
            <JamLink
                :href="
                    route('products.show', {
                        slug: product.slug,
                    })
                "
            >
                <h3
                    class="line-clamp-2 font-medium text-gray-900 label_1 group-hover:text-primary-500 duration-200 text-ellipsis"
                >
                    {{ product.title }}
                </h3>
            </JamLink>
            <!-- DIscount -->
            <div class="flex items-end justify-between mt-2">
                <div>
                    <span class="text-sm text-gray-400 line-through mt-2">
                        {{ toPrice(product.old_price) }}
                    </span>
                    <p class="title_3 text-gray-900 font-semibold">
                        {{ toPrice(product.price) }}
                    </p>
                </div>
                <div
                    class="w-8 h-8 p-2 rounded-full bg-primary-300 group-hover:bg-error-600 duration-200"
                >
                    <JamPicture
                        src="/assets/svg/cart.svg"
                        class="cursor-pointer"
                        @click="addToCart('buyNow')"
                        :class="
                            isLoadingCart && 'pointer-events-none opacity-80'
                        "
                    />
                </div>
            </div>
            <!-- <ButtonBuyNow
                @click="addToCart('buyNow')"
                :condition="currentVariant.condition"
                class="max-lg:col-span-full"
                :class="isLoadingCart && 'pointer-events-none opacity-80'"
            /> -->
        </div>
    </div>
</template>
<script>
import axios from "axios";
import { useAppStore } from "@/stores/index";
export default {
    props: ["product", "isHeader", "isBorder"],
    data() {
        return {
            isLoading: false,
            quantity: 0,
            productCart: null,
        };
    },
    computed: {
        productVariant() {
            return this.product?.variants.find((item) => item.selected);
        },
        currentVariant() {
            return this.product.variants?.find((x) => !!x.selected);
        },
        appStore() {
            return useAppStore();
        },
        cartData() {
            return useAppStore().cart;
        },
    },
    watch: {
        quantity(newVal, oldVal) {
            if (newVal === 0) {
                this.deleteCart();
                return;
            }
            if (
                oldVal === 0 ||
                (this.productCart &&
                    this.quantity === Number(this.productCart.qty))
            ) {
                return;
            }

            if (newVal > oldVal) {
                this.tracking(newVal - oldVal);
            }

            this.changeQuantity();
        },

        cartData: {
            handler() {
                this.setProductCart();
            },
            deep: true,
        },
    },
    created() {
        this.setProductCart();
    },

    methods: {
        setProductCart() {
            const variantID = this.product.variant_id;
            this.productCart = this.cartData.items?.find((item) => {
                return item.product.variant_id === variantID;
            });

            if (this.productCart) {
                const qty = Number(this.productCart.qty);
                if (this.quantity !== qty) {
                    this.quantity = qty;
                }
            } else {
                this.quantity = 0;
            }
        },
        async addToCart() {
            if (this.isLoading) return;
            this.isLoading = true;
            const variantID = this.product.variant_id;
            const { status } = await axios.post(
                this.route("checkout.cart.store"),
                {
                    quantity: 1,
                    product_variant_id: variantID,
                }
            );

            if (status === 200) {
                this.quantity = 1;
                this.$bus.emit("popup-cart-success");
                await this.appStore.fetchCart();
            }

            this.tracking(1);

            this.isLoading = false;
        },

        tracking(number) {
            if (typeof this.$gtm !== "undefined") {
                this.$gtm.trackEvent({
                    event: "add_to_cart",
                    action: "click",
                    value: this.product.price,
                    items: [
                        {
                            id: this.product.variant_id.toString(),
                            google_business_vertical: "retail",
                        },
                    ],
                });
            }
            if (typeof fbq !== "undefined") {
                fbq("track", "AddToCart", {
                    content_ids: [this.product.variant_id.toString()],
                    content_type: "product_group",
                    content_name: this.product.title,
                    value: this.product.price,
                    currency: "VND",
                    num_items: number,
                });
            }
            if (typeof ttq !== "undefined") {
                ttq.track("AddToCart", {
                    content_id: this.product.variant_id.toString(),
                    content_type: "product",
                    content_name: this.product.title,
                    value: this.product.price,
                    currency: "VND",
                });
            }
        },

        async changeQuantity() {
            if (this.isLoading) return;
            this.isLoading = true;
            const { data } = await axios.put(
                this.route("checkout.cart.update", {
                    rowId: this.productCart.rowId,
                    quantity: this.quantity,
                })
            );

            await this.appStore.$patch({
                cart: data,
            });

            this.setProductCart();

            this.isLoading = false;
        },

        async deleteCart() {
            this.isLoading = true;
            const rowId = this.productCart.rowId;
            this.productCart = null;
            const { data } = await axios.put(
                this.route("checkout.cart.destroy", {
                    rowId: rowId,
                })
            );
            await this.appStore.$patch({
                cart: data,
            });
            this.setProductCart();
            this.isLoading = false;
        },
    },
};
</script>
