<template>
    <Banner
        v-if="$page.props.data.banner.banner_resource"
        :image="$page.props.data.banner.banner_resource.image.url"
        :imageMobile="$page.props.data.banner.banner_resource.image_mobile.url"
        :alt="$page.props.data.banner.banner_resource.title"
    >
        <div>
            <div class="space-y-3 max-w-[470px] w-full text-black-fks">
                <h1 class="display-2 uppercase font-display">
                    {{ $page.props.data.banner.banner_resource.title }}
                </h1>
                <p class="body-1 font-beau">
                    {{ $page.props.data.banner.banner_resource.description }}
                </p>
            </div>
        </div>
    </Banner>

    <section class="relative bg-gray-warm-100">
        <div class="absolute top-0 left-0">
            <JPicture
                src="/assets/images/bg-mask-resource.webp"
                alt="background mask resource"
                class="w-full h-full object-contain"
            />
        </div>
        <div class="relative md:py-12 xl:py-20 py-8">
            <div class="container grid grid-cols-12 gap-y-4 md:gap-6 xl:gap-8">
                <div class="xl:col-span-3 col-span-full p-3 md:p-4 xl:p-6 rounded-xl bg-white h-fit space-y-3">
                    <p class="body-1 font-normal font-beau text-black-fks">Filter by</p>
                    <div class="flex flex-wrap gap-3">
                        <div
                            class="w-fit rounded-[40px] px-[10px] h-[26px] cursor-pointer title-2 font-display text-black-fks font-bold"
                            :class="{
                                'bg-green-fks': selectedFilter === 'everything',
                                'bg-gray-warm-100 lg:hover:text-green-fks lg:hover:bg-black-fks duration-300 ease-in-out':
                                    selectedFilter !== 'everything',
                            }"
                            @click="applyFilter('everything')"
                        >
                            Everything
                        </div>

                        <div
                            v-for="(tag, index) in categories"
                            :key="index"
                            class="rounded-[40px] px-[10px] h-[26px] cursor-pointer title-2 font-display text-black-fks font-bold min-w-[56px] text-center flex items-center justify-center"
                            :class="{
                                'bg-green-fks': selectedFilter === tag.slug,
                                'bg-gray-warm-100 lg:hover:text-green-fks lg:hover:bg-black-fks duration-300 ease-in-out':
                                    selectedFilter !== tag.slug,
                            }"
                            @click="applyFilter(tag.slug)"
                        >
                            {{ tag.title }}
                        </div>
                    </div>
                </div>

                <div class="xl:col-span-9 col-span-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                    <div
                        v-for="(resource, index) in paginatedResources"
                        :key="index"
                        class="col-span-1 p-3 rounded-3xl space-y-3"
                    >
                        <CardResources :item="resource" :isBorder="false" @download="handleModalDownload" />
                    </div>

                    <div class="col-span-full">
                        <Pagination
                            :total="filteredResources.length"
                            :perPage="perPage"
                            :currentPage="currentPage"
                            @page-changed="changePage"
                        />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Download Dialog -->
    <div v-if="showDownloadDialog" class="fixed inset-0 z-[1001]">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 transition-opacity bg-black-fks opacity-50" @click="closeModalDownload"></div>

            <!-- Dialog panel -->
            <div
                class="inline-block fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 max-w-[720px] w-full h-[90vh] overflow-y-auto rounded-xl md:rounded-3xl"
            >
                <div
                    class="bg-white px-3 md:px-6 xl:px-8 pt-10 md:pt-8 xl:pt-12 pb-4 xl:pb-6 w-full space-y-2 md:space-y-4 xl:space-y-6 relative overflow-hidden"
                >
                    <button
                        class="absolute top-4 right-4 md:w-10 md:h-10 flex items-center justify-center w-5 h-5"
                        @click="closeModalDownload"
                    >
                        <CloseModal />
                    </button>
                    <div v-show="selectedItem" class="grid md:grid-cols-2 md:gap-x-6 gap-y-3 xl:gap-x-8">
                        <div class="space-y-3 md:space-y-4 xl:space-y-6">
                            <div class="space-y-1">
                                <div
                                    v-if="selectedItem.categories && selectedItem.categories.length > 0"
                                    class="px-[10px] rounded-[40px] bg-[#2F49D9] text-center uppercase title-2 font-bold font-display text-white min-w-[66px] w-max"
                                >
                                    {{ selectedItem.categories[0].title }}
                                </div>
                                <h3 class="headline-3 font-display text-black-fks">{{ selectedItem.title }}</h3>
                            </div>
                            <div class="body-1 whitespace-pre-line" v-html="selectedItem.description"></div>

                            <div>
                                <Link
                                    v-if="selectedItem.resource_type == 'PAY'"
                                    :href="route('checkout.resources.index', { resource_id: selectedItem.id })"
                                    @click="closeModalDownload"
                                >
                                    <ButtonPayment titleFirst="Trả phí" :titleSecond="toMoney(selectedItem.price)" />
                                </Link>
                                <a
                                    v-else
                                    :href="selectedItem.link"
                                    target="_blank"
                                    rel="noopener noreferrer nofollow"
                                    class="block"
                                >
                                    <ButtonDownload title="Tải miễn phí" />
                                </a>
                            </div>
                        </div>
                        <div class="xl:py-6 md:py-4">
                            <div class="relative rounded-3xl overflow-hidden">
                                <div class="md:aspect-w-1 md:aspect-h-1 aspect-w-2 aspect-h-1">
                                    <JPicture
                                        :src="selectedItem.image.url || '/assets/images/cover.jpg'"
                                        :alt="selectedItem.image.alt"
                                        class="w-full h-full object-cover"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="prose prose-resource" v-html="selectedItem.content"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import CloseModal from '@/Components/Icon/CloseModal.vue'
import Pagination from '@/Components/Paginate.vue'

export default {
    components: { Pagination, CloseModal },
    props: ['categories', 'resources'],
    data() {
        return {
            selectedFilter: 'everything',
            currentPage: 1,
            perPage: 12,
            showDownloadDialog: false,
            selectedItem: null,
        }
    },
    computed: {
        filteredResources() {
            if (this.selectedFilter === 'everything') {
                return this.resources
            }
            return this.resources.filter((resource) =>
                resource.categories?.some((category) => category?.slug === this.selectedFilter)
            )
        },
        paginatedResources() {
            const start = (this.currentPage - 1) * this.perPage
            const end = start + this.perPage
            return this.filteredResources.slice(start, end)
        },
        totalPages() {
            return Math.ceil(this.filteredResources.length / this.perPage)
        },
    },
    methods: {
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
        toMoney(amount) {
            return new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND',
            }).format(amount)
        },
        handleModalDownload(item) {
            this.selectedItem = item
            this.showDownloadDialog = true
            document.body.style.overflow = 'hidden'
        },
        closeModalDownload() {
            this.showDownloadDialog = false
            document.body.style.overflow = 'auto'
        },
    },
}
</script>
