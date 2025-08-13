<template>
    <section id="tienich" class="bg-blue-gradient text-white md:pt-[120px]">
        <!-- Header -->
        <div class="text-center mb-8">
            <h2 class="yellow-primary uppercase font-medium font-display text-[48px] md:text-[60px] leading-tight">
                Tiện ích cảnh quan
            </h2>
        </div>

        <!-- Swiper -->
        <div class="relative max-w-[1200px] mx-auto">
            <Swiper
                ref="swiperRef"
                :modules="[Autoplay]"
                :slides-per-view="1"
                :loop="true"
                :autoplay="{ delay: 4000, disableOnInteraction: false }"
                @swiper="onSwiperInit"
                @slideChange="onSlideChange"
                class="rounded-lg overflow-hidden"
            >
                <SwiperSlide v-for="(item, index) in slides" :key="index">
                    <div class="relative">
                        <!-- Background image -->
                        <JPicture :src="item" class="w-full md:h-[670px] object-cover" />

                        <!-- Overlay nội dung -->
                        <div class="absolute inset-0 flex flex-col items-center justify-center bg-black/30 px-6">
                            <h3 class="text-[100px] font-bold text-[#F2C94C] leading-none">{{ index + 1 }}</h3>
                            <p class="text-center max-w-[600px] text-lg">{{ item.text }}</p>
                        </div>
                    </div>
                </SwiperSlide>
            </Swiper>

            <div class="transform translate-y-[-20px] z-[99] relative">
                <CustomPagination :total="slides.length" :active="activeIndex" @update:active="goToSlide" />
            </div>
        </div>
    </section>
</template>

<script>
import { ref } from 'vue'
import { Swiper, SwiperSlide } from 'swiper/vue'
import { Autoplay } from 'swiper/modules'
import 'swiper/css'

export default {
    components: { Swiper, SwiperSlide },
    setup() {
        const swiperRef = ref(null)
        const swiperInstance = ref(null)
        const activeIndex = ref(0)

        const slides = [
            '/assets/images/reson/Asset 1 1.png',
            '/assets/images/reson/Asset 1 2.png',
            '/assets/images/reson/Asset 1 3.png',
            '/assets/images/reson/Asset 1 1.png',
            '/assets/images/reson/Asset 1 2.png',
        ]

        const onSwiperInit = (swiper) => {
            swiperInstance.value = swiper
        }

        const onSlideChange = (swiper) => {
            activeIndex.value = swiper.realIndex
        }

        const goToSlide = (index) => {
            if (swiperInstance.value) {
                swiperInstance.value.slideToLoop(index)
            }
        }

        return {
            slides,
            swiperRef,
            onSwiperInit,
            onSlideChange,
            goToSlide,
            activeIndex,
            Autoplay,
        }
    },
}
</script>
