<template>
    <div class="flex flex-col space-y-6">
        <!-- Marquee Container -->
        <JamSlider
            :config="{
                draggable: true,
                prevNextButtons: false,
                autoPlay: false,
            }"
            class="relative"
        >
            <CardResources
                class="w-[260px] md:w-[280px] bg-white p-3 rounded-3xl mr-4"
                v-for="(item, index) in items"
                :key="index"
                :item="item"
                @download="handleModalDownload(item)"
            />
            <template #appends="{ navigate }">
                <ButtonSliderResource @click="navigate('prev')" direction="prev" class="rotate-180 left-0" />
                <ButtonSliderResource @click="navigate('next')" direction="next" class="right-0" />
            </template>
        </JamSlider>

        <!-- Modal -->
        <Teleport to="body">
            <div v-if="showDownloadDialog" class="fixed inset-0 z-[1001]">
                <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 sm:block sm:p-0">
                    <!-- Background overlay -->
                    <div
                        class="fixed inset-0 transition-opacity bg-black-fks opacity-50"
                        @click="closeModalDownload"
                    ></div>

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
                            <div v-if="selectedItem" class="grid md:grid-cols-2 md:gap-x-6 gap-y-3 xl:gap-x-8">
                                <div class="space-y-3 md:space-y-4 xl:space-y-6">
                                    <div class="space-y-1">
                                        <div
                                            v-if="selectedItem.categories?.length"
                                            class="px-[10px] rounded-[40px] bg-[#2F49D9] text-center uppercase title-2 font-bold font-display text-white min-w-[66px] w-max"
                                        >
                                            {{ selectedItem.categories[0].title }}
                                        </div>
                                        <h3 class="headline-3 font-display text-black-fks">{{ selectedItem.title }}</h3>
                                    </div>
                                    <div class="body-1 whitespace-pre-line" v-html="selectedItem.description"></div>

                                    <div>
                                        <Link
                                            v-if="selectedItem.resource_type === 'PAY'"
                                            :href="route('checkout.resources.index', { resource_id: selectedItem.id })"
                                        >
                                            <ButtonPayment
                                                titleFirst="Trả phí"
                                                :titleSecond="toMoney(selectedItem.price)"
                                            />
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
                                                :src="selectedItem.image?.url || '/assets/images/cover.jpg'"
                                                :alt="selectedItem.image?.alt"
                                                class="w-full h-full object-cover"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="prose prose-resource" v-html="selectedItem?.content"></div>
                        </div>
                    </div>
                </div>
            </div>
        </Teleport>
    </div>
</template>

<script>
import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'
import CloseModal from './Icon/CloseModal.vue'

gsap.registerPlugin(ScrollTrigger)

export default {
    components: { CloseModal },
    props: {
        items: {
            type: Array,
            required: true,
            default: () => [],
        },
    },

    data() {
        return {
            showDownloadDialog: false,
            selectedItem: null,
        }
    },

    methods: {
        handleModalDownload(item) {
            this.selectedItem = item
            this.showDownloadDialog = true
            document.body.style.overflow = 'hidden'
        },

        closeModalDownload() {
            this.showDownloadDialog = false
            this.selectedItem = null
            document.body.style.overflow = ''
        },

        toMoney(amount) {
            return new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND',
            }).format(amount)
        },
    },
}
</script>
