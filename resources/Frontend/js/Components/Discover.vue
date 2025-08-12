<template>
    <div class="bg-gradient-to-b from-blue-50 to-white py-10 container">
        <!-- Tiêu đề -->
        <h2 class="text-center text-2xl font-bold text-blue-900 mb-6 uppercase">Khám Phá SYMLIFE</h2>

        <!-- Slider chính -->
        <swiper class="main-swiper mb-4" :space-between="10" :navigation="true" :thumbs="{ swiper: thumbsSwiper }">
            <swiper-slide v-for="(img, index) in images" :key="index">
                <img :src="img" class="w-full h-[752px] object-cover" />
            </swiper-slide>
        </swiper>

        <!-- Slider thumbnails -->
        <swiper
            class="thumbs-swiper"
            :space-between="10"
            :slides-per-view="6"
            watch-slides-progress
            @swiper="setThumbsSwiper"
        >
            <swiper-slide v-for="(img, index) in images" :key="'thumb-' + index" class="cursor-pointer">
                <img
                    :src="img"
                    class="w-full h-24 object-cover border-2 border-transparent hover:border-yellow-400 transition"
                />
            </swiper-slide>
        </swiper>
    </div>
</template>

<script>
import { Swiper, SwiperSlide } from 'swiper/vue'
// import SwiperCore, { Navigation, Thumbs } from 'swiper/core'
import 'swiper/css'
import 'swiper/css/navigation'
import 'swiper/css/thumbs'

// SwiperCore.use([Navigation, Thumbs])

export default {
    components: { Swiper, SwiperSlide },
    data() {
        return {
            thumbsSwiper: null,
            images: [
                '/assets/images/discover/Asset 1 1.png',
                '/assets/images/discover/Asset 1 2.png',
                '/assets/images/discover/Asset 1 3.png',
                '/assets/images/discover/Asset 1 4.png',
                '/assets/images/discover/Asset 1 5.png',
                '/assets/images/discover/Asset 1 6.png',
            ],
        }
    },
    methods: {
        setThumbsSwiper(swiper) {
            this.thumbsSwiper = swiper
        },
    },
}
</script>

<style scoped>
.main-swiper .swiper-button-next,
.main-swiper .swiper-button-prev {
    color: #fbbf24; /* Màu vàng nút điều hướng */
}
</style>
