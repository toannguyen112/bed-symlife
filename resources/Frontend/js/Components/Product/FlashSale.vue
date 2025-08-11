<template>
    <div
        class="relative flex items-center justify-between px-4 py-2 overflow-hidden rounded-lg product-flash-sale"
    >
        <div class="absolute inset-y-0 right-0">
            <JamPicture src="/assets/images/product/shape-flash-sale.png" />
        </div>

        <div
            class="flex items-center space-x-[4px] xl:space-x-[8px] relative z-10"
        >
            <div
                class="text-white text-[20px] md:text-[24px] leading-[150%] font-bold"
            >
                {{ toPrice(product.price) }}
            </div>

            <div
                v-if="product.old_price && Number(product.old_price)"
                class="text-white line-through caption"
            >
                {{ toPrice(product.old_price) }}
            </div>
            <Tag
                v-if="product.percent && Number(product.percent)"
                class="bg-[#FBD616] text-white font-bold description"
                >-{{ product.percent }}%</Tag
            >
        </div>

        <div class="relative z-10 flex-shrink-0">
            <CountDownProduct
                :endDate="last_sale"
                @end-flash-sales="resetProductsFlashSales()"
                type="product-details"
                :noDay="true"
            />
        </div>
    </div>
</template>
<script>
import axios from "axios";
export default {
    props: ["product", "last_sale", "product_id"],
    data() {
        return {
            lastSale: {},
        };
    },

    methods: {
        async resetProductsFlashSales() {
            const { data } = await axios.get(
                this.route("api.flash_sale", { product_id: this.product_id })
            );
            this.$emit("update-flash-sale", data?.data);
        },
    },
};
</script>
<style lang="scss" scoped>
.product-flash-sale {
    background: linear-gradient(271.38deg, #d01212 5.05%, #ff5e48 100.25%);
}
</style>
