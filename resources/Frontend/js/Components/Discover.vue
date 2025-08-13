<template>
    <div id="thuvien" class="bg-banner-blue py-[80px] space-y-[2rem] bg-cover">
        <div class="font-display text-[40px] md:text-[60px] font-medium text-center uppercase gradient-primary">
            Khám phá symlife
        </div>
        <div class="container">
            <!-- Slider chính -->
            <swiper
                class="main-swiper"
                :modules="[Navigation, Thumbs]"
                :navigation="true"
                :thumbs="{ swiper: thumbsSwiper }"
                :space-between="10"
            >
                <swiper-slide v-for="(img, i) in images" :key="i">
                    <img :src="img" class="w-full md:h-[725px] object-cover rounded-lg" />
                </swiper-slide>
            </swiper>

            <!-- Slider thumbnail -->
            <swiper
                class="thumbs-swiper mt-4"
                :modules="[Thumbs]"
                watch-slides-progress
                :slides-per-view="6"
                space-between="10"
                @swiper="setThumbsSwiper"
            >
                <swiper-slide v-for="(img, i) in images" :key="i" class="cursor-pointer">
                    <div class="aspect-w-2 aspect-h-1 md:min-w-[100px] h-[150px] md:min-h-[100px]">
                        <img
                            :src="img"
                            class="w-full object-cover rounded-md border border-transparent hover:border-blue-500"
                        />
                    </div>
                </swiper-slide>
            </swiper>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { Swiper, SwiperSlide } from 'swiper/vue'
import { Navigation, Thumbs } from 'swiper/modules'
import 'swiper/css'
import 'swiper/css/navigation'
import 'swiper/css/thumbs'

const images = [
    '/assets/images/discover/Asset 1 1.png',
    '/assets/images/discover/Asset 1 2.png',
    '/assets/images/discover/Asset 1 3.png',
    '/assets/images/discover/Asset 1 4.png',
    '/assets/images/discover/Asset 1 5.png',
    '/assets/images/discover/Asset 1 6.png',
]

const thumbsSwiper = ref(null)
const setThumbsSwiper = (swiper) => {
    thumbsSwiper.value = swiper
}
</script>

<style scoped>
.gallery-container {
    max-width: 1000px;
    margin: auto;
}
.main-swiper {
    border-radius: 8px;
    overflow: hidden;
}
.thumbs-swiper img {
    transition: border 0.3s ease;
}
</style>
