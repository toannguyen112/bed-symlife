<template>
    <main>
        <section>
            <div class="h-[280px] md:h-[400px] xl:h-[480px] relative">
                <img
                    src="/assets/images/products/banner.webp"
                    loading="eager"
                    class="object-fit h-full w-full"
                    :alt="tt('')"
                />

                <div class="absolute inset-x-0 bottom-0 h-fit">
                    <div class="absolute inset-0 bg-gradient-black opacity-60"></div>
                    <div class="container relative z-10 py-[40px] md:py-[56px] xl:py-[82px] text-center">
                        <h1
                            class="text-white display-3 border-b-4 border-primary-500 inline-block"
                            v-html="tt('Products')"
                        ></h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="container">
            <div class="mt-4 lg:mt-6">
                <JamBreadcrumb :items="breadcrumbs" class="pb-[32px]" />
                <div class="pb-4 md:pb-6 xl:pb-8 grid grid-cols-12 relative">
                    <!-- MOBILE -->
                    <div
                        v-if="showMenu"
                        @click="toggleMenu()"
                        class="lg:hidden fixed inset-0 bg-black opacity-40 z-[100]"
                    ></div>
                    <!-- PC - MOBILE -->

                    <div
                        class="sticky h-fit top-0 left-0 lg:flex-shrink-0 menu-filter col-span-3 hide-scrollbar overflow-y-auto lg:pr-2 duration-300 lg:mr-2 xl:mr-[30px] space-y-[12px]"
                        :class="showMenu ? 'max-lg:translate-x-0' : 'max-lg:-translate-x-full'"
                    >
                        <div class="headline-3 text-gray-900 gray-900 border-b-2 border-gray-900 pb-[8px]">Filter</div>
                        <BoxFilterBrands
                            :option="categoriesFilter"
                            @pushToUrl="pushToUrlCategories()"
                            class="border-b pb-[12px]"
                        />
                        <BoxFilterBrands
                            :option="brandsFilter"
                            @pushToUrl="pushToUrlBrands()"
                            class="border-b pb-[12px]"
                        />
                    </div>

                    <div class="col-span-9 max-lg:col-span-12">
                        <!-- SORT -->
                        <div
                            class="relative after:content-[''] after:absolute after:h-[1px] after:w-full after:bg-gray-200 after:md:bg-gray-300 after:bottom-0 mb-2 md:mb-3 lg:mb-4 overflow-x-auto max-w-full flex items-center max-md:justify-between space-x-[8px] md:space-x-[16px] xl:space-x-[24px]"
                        >
                            <BoxFilterTab
                                v-for="(tab, index) in tabs"
                                :key="index"
                                @click="pushToUrlSort(tab.type)"
                                :class="{
                                    active:
                                        router.query.sort === tab.type ||
                                        ((Array.isArray(router.query) || !router.query.sort) && tab.type === 'popular'),
                                }"
                            >
                                {{ tab.title }}
                            </BoxFilterTab>
                        </div>
                        <!-- MOBILE BUTTON TOGGLE -->
                        <div class="flex justify-end mb-2 lg:hidden">
                            <button @click="toggleMenu()" class="flex items-center space-x-1 text-gray-400">
                                <IconSortCategories class="w-6 h-6" />

                                <div class="font-medium">Lọc</div>
                            </button>
                        </div>

                        <!-- PRODUCTS -->
                        <div
                            v-if="productPaginate && productPaginate.length > 0"
                            class="grid grid-cols-2 md:grid-cols-4 gap-[32px]"
                        >
                            <div
                                v-for="(item, index) in productPaginate"
                                :key="index"
                                class="col-span-full md:col-span-1 space-y-[12px]"
                            >
                                <card-product-v2 :item="item" />
                            </div>
                        </div>
                        <!-- START FILTER EMPTY -->
                        <div v-else class="max-w-[600] w-full mx-auto py-4 md:py-6 xl:py-8">
                            <div v-if="isShowTagSelected" class="mt-12">
                                <h3 class="headline_3 text-gray-700 font-semibold text-center mb-3">
                                    {{ tt('Sản phẩm bạn tìm kiếm không tồn tại') }}
                                </h3>
                                <p class="text-center body_1 font-normal text-gray-700">
                                    {{
                                        tt(
                                            'Rất tiếc, chúng tôi không tìm thấy kết quả nào phù hợp với tìm kiếm của bạn.'
                                        )
                                    }}
                                </p>
                            </div>
                            <div v-else class="mt-12">
                                <h3 class="headline_3 text-gray-700 font-semibold text-center mb-3">
                                    {{ tt('Sản phẩm bạn tìm kiếm không tồn tại') }}
                                </h3>
                                <p class="text-center body_1 font-normal text-gray-700">
                                    {{
                                        tt(
                                            'Rất tiếc, chúng tôi không tìm thấy kết quả nào phù hợp với tìm kiếm của bạn.'
                                        )
                                    }}
                                </p>
                            </div>
                        </div>
                        <!-- END FILTER EMPTY -->
                        <div
                            v-if="restProductPaginate > 0"
                            class="flex justify-center mt-4 md:mt-6 xl:mt-8"
                            :class="isLoading ? 'pointer-events-none opacity-80' : ''"
                        >
                            <JamButton
                                as="button"
                                @click="handlePaginateProduct()"
                                class="max-w-[330px] w-full !h-[42px] tertiary"
                                :class="isLoading && 'opacity-80 pointer-events-none'"
                            >
                                <div class="flex items-center justify-center">
                                    <i class="mr-1 gg-spinner" v-if="isLoading"></i>
                                    <span> Xem thêm {{ restProductPaginate }} sản phẩm</span>
                                </div>
                            </JamButton>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>
<script>
import JamBreadcrumb from '@/Components/Jam/Breadcrumb.vue'
import {
    serializeOptions,
    serializeOrigins,
    mappingBrands,
    serializeBrands,
    serializeCategories,
    mappingCategories,
} from '@/lib/filter'
export default {
    props: ['categories', 'brands', 'products'],
    components: { JamBreadcrumb },
    data() {
        return {
            router: this.$attrs.route,
            isLoading: false,
            isShowMore: true,
            showMenu: false,
            optionsFilter: [],
            isHiddenSummary: false,
            listSelect: [],
            originsFilter: {},
            originsInit: {
                title: 'Xuất xứ',
                nodes: this.origins,
            },
            selected: null,
            listSelect: [
                {
                    id: 1,
                    name: 'Bán chạy',
                },
                {
                    id: 2,
                    name: 'Giá từ thấp đến cao',
                },
                {
                    id: 3,
                    name: 'Giá từ cao đến thấp',
                },
            ],
            brandsFilter: {},
            categoriesFilter: {},
            brandsInit: {
                title: 'Brand',
                nodes: this.brands,
            },
            categoriesInit: {
                title: 'Category',
                nodes: this.categories,
            },
            tabs: [
                {
                    title: 'Phổ biến',
                    type: 'popular',
                },
                {
                    title: 'Sản phẩm mới',
                    type: 'new',
                },
                {
                    title: 'Khuyến mãi',
                    type: 'discount',
                },
                {
                    title: 'Giá thấp',
                    type: 'price_asc',
                },
                {
                    title: 'Giá cao',
                    type: 'price_desc',
                },
            ],

            total: this.products.total || 10,
            perPage: this.products.per_page || 1,
            currentPage: this.products.current_page || 1,
            productPaginate: [...this.products.data],
            showBtnCategoryDesc: false,
            showBtnSummary: false,
            isHiddenCategoryDesc: false,
            breadcrumbs: [{ title: this.tt('Our Products'), link: this.route('products.index') }],
        }
    },
    created() {
        this.brandsFilter = mappingBrands(this.brandsInit, this.router.query)
        this.categoriesFilter = mappingCategories(this.categoriesInit, this.router.query)
    },
    mounted() {
        const brandSummary = document.querySelector('.brand-summary')
        const categoryDesc = document.querySelector('.category-desc')

        this.isHiddenSummary = this.checkScrollHeight(brandSummary)
        this.showBtnSummary = this.isHiddenSummary

        this.isHiddenCategoryDesc = this.checkScrollHeight(categoryDesc)
        this.showBtnCategoryDesc = this.isHiddenCategoryDesc
    },
    computed: {
        restProductPaginate() {
            return this.total - this.currentPage * this.perPage || 0
        },
        selectedBrands() {
            return this.brandsFilter.nodes.filter((o) => !!o.active)
        },

        selectedCategories() {
            return this.categoriesFilter.nodes.filter((o) => !!o.active)
        },

        selectedPrices() {
            if (!this.router.query.prices) return null
            const prices = this.router.query.prices.split('-').map(this.formatPriceSelected)
            return prices.join('')
        },
    },
    methods: {
        formatPrice(n) {
            if (!Number(n)) return null
            return n.replace(/\D/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.')
        },
        toggleCategoryDesc() {
            this.isHiddenCategoryDesc = !this.isHiddenCategoryDesc
        },
        checkScrollHeight(el) {
            if (!el) return
            return el.scrollHeight > 90
        },
        async handlePaginateProduct() {
            if (this.isLoading) return
            this.isLoading = true

            const queryURL = Array.isArray(this.router.query) ? {} : this.router.query
            const params = {
                ...queryURL,
                page: this.currentPage + 1,
            }
            const BASE_URL = this.router.url
            const { data } = await axios.get(BASE_URL, {
                params,
            })

            if (data) {
                // TODO: BE Đang trả ra Object -> Sai Structure
                const products = Array.isArray(data.products.data)
                    ? data.products.data
                    : Object.values(data.products.data)
                this.productPaginate = [...this.productPaginate, ...products]

                this.currentPage = data.products.current_page
            }

            this.isLoading = false
        },
        formatPriceSelected(o, index, arr) {
            if (Number(arr[0]) === 0) {
                if (index === 0) {
                    return ''
                } else {
                    return `Dưới ${this.formatPrice(o)}₫`
                }
            } else {
                if (index === 0) {
                    return `${this.formatPrice(o)}₫`
                } else {
                    return ` đến ${this.formatPrice(o)}₫`
                }
            }
        },
        removeOptionPrices() {
            let params = this.router.query
            delete params.prices

            this.pushToUrl(params)
        },

        toggleMenu() {
            this.showMenu = !this.showMenu
        },
        pushToUrlSort(type) {
            let params = this.router.query
            params = {
                ...params,
                sort: type || 'default',
            }
            this.pushToUrl(params)
        },
        removeOptionTagOrigin(tagID) {
            const indexActive = this.originsFilter.nodes.findIndex((o) => o.id === tagID)
            if (indexActive === -1) return
            this.originsFilter.nodes[indexActive].active = false
            this.pushToUrlOrigins()
        },

        removeOptionTagBrand(tagID) {
            const indexActive = this.brandsFilter.nodes.findIndex((o) => o.id === tagID)
            if (indexActive === -1) return
            this.brandsFilter.nodes[indexActive].active = false
            this.pushToUrlBrands()
        },

        removeOptionTag(tagID) {
            for (let i = 0; i < this.optionsFilter.length; i++) {
                for (let j = 0; j < this.optionsFilter[i].nodes.length; j++) {
                    if (this.optionsFilter[i].nodes[j].id === tagID) {
                        this.optionsFilter[i].nodes[j].active = false
                        break
                    }
                }
            }
            this.pushToUrlOption()
        },

        pushToUrlOrigins() {
            let params = this.router.query
            const { origins } = serializeOrigins(this.originsFilter)

            if (origins.trim() !== '') {
                params = {
                    ...params,
                    origins,
                }
            } else {
                delete params.origins
            }

            this.pushToUrl(params)
        },

        pushToUrlBrands() {
            let params = this.router.query
            const { brands } = serializeBrands(this.brandsFilter)

            if (brands.trim() !== '') {
                params = {
                    ...params,
                    brands,
                }
            } else {
                delete params.brands
            }

            this.pushToUrl(params)
        },

        pushToUrlCategories() {
            let params = this.router.query
            const { categories } = serializeCategories(this.categoriesFilter)

            if (categories.trim() !== '') {
                params = {
                    ...params,
                    categories,
                }
            } else {
                delete params.categories
            }

            this.pushToUrl(params)
        },

        pushToUrlOption() {
            let params = this.router.query
            const { options } = serializeOptions(this.optionsFilter)

            if (options.trim() !== '') {
                params = {
                    ...params,
                    options,
                }
            } else {
                delete params.options
            }

            this.pushToUrl(params)
        },
        pushToUrl(params = {}) {
            this.$inertia.visit(this.router.url, {
                preserveScroll: true,
                data: params,
            })
        },
    },
}
</script>
