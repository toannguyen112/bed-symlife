<template>
    <section>
        <div class="container max-md:pt-[32px]">
            <JamSlider
                v-if="slides && slides.length > 0"
                :config="{
                    draggable: true,
                    prevNextButtons: false,
                    autoPlay: false,
                }"
                class="h-full relative"
            >
                <div v-for="(slide, index) in slides" :key="index" class="relative">
                    <!-- Nếu có link -->
                    <div v-if="slide.link" class="block relative h-full">
                        <template v-if="playingIndex === index">
                            <iframe
                                :src="getYouTubeEmbedUrl(slide.link)"
                                width="100%"
                                height="100%"
                                class="w-full h-full object-cover"
                                frameborder="0"
                                allow="autoplay; encrypted-media; fullscreen"
                                allowfullscreen
                            ></iframe>
                        </template>
                        <template v-else>
                            <div class="relative w-full h-full cursor-pointer" @click="playVideo(index)">
                                <img
                                    :src="slide.image && slide.image.url ? slide.image.url : '/assets/images/cover.jpg'"
                                    class="w-full h-full object-cover"
                                    :alt="slide.image && slide.image.alt ? slide.image.alt : slide.image.title"
                                />
                                <!-- Nút play -->
                                <div
                                    class="absolute inset-0 flex items-center justify-center z-1 bg-black bg-opacity-50"
                                >
                                    <button
                                        class="flex items-center justify-center w-16 h-16 rounded-full bg-white hover:bg-gray-300 shadow-lg"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="currentColor"
                                            viewBox="0 0 24 24"
                                            class="w-8 h-8 text-black"
                                        >
                                            <path d="M8 5v14l11-7z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </template>
                    </div>
                    <!-- Nếu không có link -->
                    <div v-else class="block relative">
                        <img
                            :src="slide.image && slide.image.url ? slide.image.url : '/assets/images/cover.jpg'"
                            class="w-full h-full object-cover"
                            :alt="slide.image && slide.image.alt ? slide.image.alt : slide.image.title"
                        />
                        <div
                            class="absolute inset-0 z-10 flex items-end xl:mb-[100px] lg:mb-[75px] md:mb-[50px] mb-8"
                            v-if="slide.title && slide.description"
                        >
                            <div class="container">
                                <div class="grid grid-cols-12 xl:gap-x-[32px] md:gap-x-[22px]">
                                    <div class="text-white xl:col-span-7 md:col-span-10 col-span-full space-y-[24px]">
                                        <div class="text-white display-3 font-display" v-if="slide.title">
                                            <h3 v-html="slide.title"></h3>
                                        </div>
                                        <p v-if="slide.description" v-html="slide.description" class="body-1"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <template #appends="{ selectedIndex, navigate }">
                    <div class="relative z-1">
                        <div class="flex items-center justify-center py-[14px]">
                            <div
                                class="flex items-center space-x-2 max-md:justify-center py-[6px] px-2 bg-gray-warm-200 backdrop-blur-[20px] rounded-[800px]"
                            >
                                <div
                                    v-for="(_, indexDot) in slides.length"
                                    :key="indexDot"
                                    @click="navigate(indexDot)"
                                    class="h-[8px] w-[80px] rounded-[800px] cursor-pointer"
                                    :class="indexDot === selectedIndex ? 'bg-[#082680]' : ' bg-white'"
                                ></div>
                            </div>
                        </div>
                    </div>
                </template>
            </JamSlider>
        </div>
    </section>
</template>

<script>
export default {
    props: {
        slides: {
            type: Array,
            default: [],
        },
    },
    data() {
        return {
            playingIndex: null, // Lưu trữ index của video đang phát
        }
    },
    methods: {
        playVideo(index) {
            this.playingIndex = index // Cập nhật video được phát
        },
        getYouTubeEmbedUrl(link) {
            const videoId = link.match(
                /(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/
            )
            return videoId ? `https://www.youtube.com/embed/${videoId[1]}?autoplay=1` : ''
        },
    },
    mounted() {
        const flickityViewport = document.querySelector('.flickity-viewport')
        if (flickityViewport) {
            flickityViewport.style.width = '100%'
        }
    },
}
</script>

<style lang="scss" scoped>
:deep(.flickity-viewport) {
    @apply relative max-h-full h-[170px] md:h-[300px] lg:h-[400px] xl:h-[591px] overflow-hidden border border-gray-300 md:rounded-2xl rounded-xl xl:rounded-3xl;
    .flickity-slider {
        @apply aspect-w-2 aspect-h-1;
    }
}

.flickity-button {
    display: none;
}

.flickity-cell {
    height: 100%;
    width: 100%;
}
.bg-hero {
    background: linear-gradient(
        71.07deg,
        rgba(15, 60, 148, 0.8) 12.55%,
        rgba(30, 82, 172, 0.4) 48.95%,
        rgba(65, 125, 228, 0) 79.22%
    );
    mix-blend-mode: multiply;
    filter: blur(20px);
}
</style>
