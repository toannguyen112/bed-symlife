<template>
    <div class="box-category bg-gray-50 space-y-3">
        <div class="flex items-start gap-3 border-b-[1px] border-gray-200 p-3">
            <p class="title_2 font-semibold text-gray-900">
                {{ tt("Danh mục sản phẩm") }}
            </p>
        </div>
        <nav class="flex flex-col gap-3 px-3">
            <button
                v-if="isShow"
                @click="isShowMore ? showMore() : showLess()"
                class="flex items-center space-x-2 font-medium text-gray-800 caption justify-between"
            >
                <span>Danh mục</span>
                <IconBoxOptionArrow
                    :class="isShowMore ? 'rotate-180' : 'rotate-0'"
                />
            </button>
            <Link
                v-for="(category, index) in categories.slice(0, quantity)"
                :key="index"
                :href="
                    route('products.show', {
                        slug: category.slug,
                    })
                "
                class="label_1 font-medium text-gray-700 hover:text-primary-600"
                >{{ category.title }}</Link
            >
        </nav>
    </div>
</template>
<script>
export default {
    props: {
        categories: {
            type: Array,
            default: [],
        },
        quantityInit: {
            type: Number,
            default: 0,
        },
    },
    data() {
        return {
            quantity: this.quantityInit,
        };
    },
    computed: {
        isShow() {
            return this.categories.length > this.quantityInit;
        },
        isShowMore() {
            return this.categories.length > this.quantity;
        },
    },
    methods: {
        showMore() {
            const total = this.categories.length;
            this.quantity = total;
        },
        showLess() {
            this.quantity = this.quantityInit;
        },
    },
};
</script>
