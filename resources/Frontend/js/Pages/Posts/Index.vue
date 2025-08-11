<template>
    <main class="bg-gray-warm-100 lg:pb-20 pb-10">
        <section class="">
            <div class="h-[280px] md:h-[400px] xl:h-[560px] container">
                <div class="relative">
                    <img
                        src="/assets/images/posts/bannerTop.png"
                        loading="eager"
                        class="object-fit h-full w-full"
                        :alt="tt('')"
                    />
                    <div class="absolute lg:top-[160px] top-[100px] space-y-3 w-full grid grid-cols-12">
                        <div class="col-span-9">
                            <div>
                                <h1 class="display-2 text-[#18191E] font-bold font-display">Blog</h1>
                                <p class="body-1 font-beau font-normal text-[#18191E]">
                                    Nơi chia sẻ các tin tức, thông tin mới nhất
                                </p>
                            </div>
                        </div>
                        <div class="col-span-3"></div>
                    </div>
                </div>
            </div>
        </section>
        <section class="container md:mt-[-13%] mt-[-22%] relative z-2 lg:space-y-8 space-y-6">
            <Link
                :href="
                    route('posts.show', {
                        slug: posts[0].slug ?? '',
                    })
                "
                class="block overflow-hidden"
            >
                <div
                    class="w-full rounded-2xl border border-gray-warm-300 bg-white grid grid-cols-2 p-3 md:gap-8 gap-4 items-center"
                >
                    <div class="md:col-span-1 col-span-full h-full rounded-3xl overflow-hidden">
                        <img
                            :src="posts[0].image?.url || '/assets/images/posts/picture.png'"
                            class="picture-cover w-full lg:group-hover:scale-105 lg:duration-150 line-clamp-2 aspect-square"
                            :alt="posts[0].alt || posts[0].title"
                        />
                    </div>
                    <div class="md:col-span-1 col-span-full pt-4 space-y-4">
                        <div
                            class="px-[10px] rounded-[40px] bg-[#2F49D9] title-3 text-white font-display font-bold w-fit"
                        >
                            {{ posts[0].category?.title }}
                        </div>
                        <div class="headline-1 font-display font-bold text-[#18191E]">{{ posts[0].title }}</div>
                        <div class="body-0 text-gray-warm-700 font-normal font-beau line-clamp-5">
                            {{ posts[0].description }}
                        </div>
                    </div>
                </div>
            </Link>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 grid-cols-1 gap-[28px]">
                <div
                    v-for="(item, index) in posts.slice(1)"
                    :key="index"
                    class="md:col-span-1 col-span-1 rounded-2xl border border-gray-warm-300 bg-white p-3"
                >
                    <CardBlog :item="item" />
                </div>
            </div>
            <div class="lg:space-y-6 space-y-4">
                <div class="py-4 space-y-3 border-b border-b-[#B0B0B4]">
                    <p class="body-1 text-[#18191E] font-bold font-beau">Filter by</p>
                    <div class="flex items-center gap-x-3 flex-wrap">
                        <div
                            class="w-fit rounded-[40px] px-[10px] h-[26px] cursor-pointer title-2 font-display text-[#18191E] font-bold"
                            :class="{
                                'bg-[#CBFF00]': selectedFilter === 'everything',
                                'bg-gray-warm-100': selectedFilter !== 'everything',
                            }"
                            @click="applyFilter('everything')"
                        >
                            Everything
                        </div>
                        <div
                            v-for="(tag, index) in uniqueCategories"
                            :key="index"
                            class="w-fit rounded-[40px] px-[10px] h-[26px] cursor-pointer title-2 font-display text-[#18191E] font-bold"
                            :class="{
                                'bg-[#CBFF00]': selectedFilter === tag.slug,
                                'bg-transparent': selectedFilter !== tag.slug,
                            }"
                            @click="applyFilter(tag.slug)"
                        >
                            {{ tag.title }}
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-12 lg:gap-x-8 gap-y-4">
                    <div class="lg:col-span-8 col-span-full space-y-4">
                        <div
                            v-for="(item, index) in paginatedResources"
                            :key="index"
                            class="w-full rounded-2xl border border-gray-warm-300 bg-white p-3"
                        >
                            <CardBlogRow :item="item" />
                        </div>
                    </div>
                    <div v-if="most_view && most_view.length" class="lg:col-span-4 col-span-full space-y-3">
                        <p class="title-1 font-bold font-display text-[#18191E]">Các khóa học thú vị</p>
                        <div class="space-y-4">
                            <div
                                v-for="(item, index) in most_view"
                                :key="index"
                                class="p-3 rounded-2xl bg-white border border-gray-warm-300 space-y-2"
                            >
                                <Link
                                    :href="
                                        route('posts.show', {
                                            slug: item.slug ?? '',
                                        })
                                    "
                                >
                                    <p class="title-2 font-bold font-display text-[#18191E]">
                                        {{ item.title }}
                                    </p>
                                    <p class="body-1 font-normal font-beau text-[#18191E] line-clamp-3">
                                        {{ item.description }}
                                    </p>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <Pagination
                :total="filteredResources.length"
                :perPage="perPage"
                :currentPage="currentPage"
                @page-changed="changePage"
            />
        </section>
    </main>
</template>
<script>
import JamBreadcrumb from '@/Components/Jam/Breadcrumb.vue'
import Pagination from '@/Components/Paginate.vue'
import axios from 'axios'

export default {
    components: { JamBreadcrumb, Pagination },

    props: ['posts', 'most_view'],

    data() {
        return {
            isLoading: false,
            searchText: this.$attrs.keyword || '',
            instantSearch: [],
            recently_search: this.$page.props.data.recently_search || [],

            currentPage: 1,
            perPage: 3,
            breadcrumbs: [{ title: this.tt('Tin tức') }],
            selectedFilter: 'everything',
        }
    },

    watch: {
        '$attrs.keyword'(newVal) {
            if (this.isShowroomPage) return
            if (!newVal) {
                this.searchText = ''
            } else {
                this.searchText = newVal
            }
        },
        searchText(newVal) {
            if (newVal && (this.recently_search.includes(newVal) || this.keywords.includes(newVal))) {
                return
            }

            this.searchProduct()
        },
        '$page.url': function (newURL) {
            this.instantSearch = []
            if (newURL !== this.route('search', { keyword: this.searchText })) {
                this.searchText = ''
            }
        },
    },

    computed: {
        keywords() {
            return this.$page.props.data.keywords || []
        },
        filteredResources() {
            if (this.selectedFilter === 'everything') {
                return this.posts
            }
            return this.posts.filter((resource) =>
                resource.categories?.some((category) => category?.slug === this.selectedFilter)
            )
        },
        paginatedResources() {
            const start = (this.currentPage - 1) * this.perPage
            const end = start + this.perPage
            return this.filteredResources.slice(start, end)
        },
        uniqueCategories() {
            const allCategories = this.posts.flatMap((post) => post.categories)
            const uniqueCategories = []

            allCategories.forEach((category) => {
                if (!uniqueCategories.some((c) => c.id === category.id)) {
                    uniqueCategories.push(category)
                }
            })

            return uniqueCategories
        },
        totalPages() {
            return Math.ceil(this.filteredResources.length / this.perPage)
        },
    },
    methods: {
        handleSearch() {
            if (this.searchText.trim() === '' || this.isLoading) return
            this.instantSearch = []
            this.isLoading = true

            if (typeof fbq !== 'undefined') {
                fbq('track', 'Search', {
                    search_string: this.searchText,
                })
            }
            if (typeof ttq !== 'undefined') {
                ttq.track('Search', {
                    search_string: this.searchText,
                })
            }
            const BASE_URL = this.route('search')
            this.$inertia.visit(BASE_URL, {
                preserveScroll: true,
                data: {
                    keyword: this.searchText,
                },
                onFinish: () => {
                    this.isLoading = false
                },
            })
        },

        async searchProduct() {
            if (this.isLoading) {
                this.instantSearch = []
                return
            }

            if (this.isLoadingSearch) return
            this.isLoadingSearch = true

            if (this.searchText.trim() === '') {
                this.instantSearch = []
            } else {
                const { data } = await axios.get(this.route('instant_search', { keyword: this.searchText }))
                this.instantSearch = data?.data?.products || []
            }

            this.isLoadingSearch = false
        },

        applyFilter(tag) {
            this.selectedFilter = tag
            this.currentPage = 1
        },
        changePage(page) {
            if (page > this.totalPages) {
                this.currentPage = 1
            } else if (page < 1) {
                this.currentPage = this.totalPages
            } else {
                this.currentPage = page
            }
        },
    },
}
</script>
