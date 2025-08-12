<template>
    <div class="bg-blue-900 text-white py-10">
        <!-- Header -->
        <div class="text-center mb-8">
            <h2 class="text-yellow-400 text-2xl font-bold uppercase">Lý Do Sở Hữu</h2>
            <h1 class="text-4xl font-extrabold">SYMLIFE</h1>
        </div>

        <!-- Slider -->
        <div class="container mx-auto px-4">
            <swiper :slides-per-view="1" :space-between="20" :breakpoints="swiperBreakpoints">
                <swiper-slide v-for="(item, index) in items" :key="index">
                    <div class="grid grid-cols-12 gap-4 items-center rounded-lg overflow-hidden p-6">
                        <!-- Image Left -->
                        <div class="col-span-12">
                            <img :src="item" alt="" class="w-full object-cover" />
                        </div>
                    </div>
                </swiper-slide>
            </swiper>
        </div>
    </div>
</template>

<script>
import { Swiper, SwiperSlide } from 'swiper/vue'
import 'swiper/css'

export default {
    components: { Swiper, SwiperSlide },
    data() {
        return {
            items: [
                '/assets/images/reson/Asset 1 1.png',
                '/assets/images/reson/Asset 1 1.png',
                '/assets/images/reson/Asset 1 1.png',
            ],
            swiperBreakpoints: {
                768: {
                    slidesPerView: 1,
                },
                1024: {
                    slidesPerView: 1,
                },
            },
        }
    },
}
</script>

<style scoped>
.container {
    max-width: 1200px;
}
</style>
