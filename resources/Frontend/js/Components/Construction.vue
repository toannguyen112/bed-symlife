<template>
    <section class="container md:py-[80px] py-[48px] space-y-[32px]">
        <div class="w-full text-center">
            <p class="display-2 font-bold font-display text-black-fks uppercase">Hình ảnh thi công</p>
        </div>
        <div class="grid grid-cols-4 gap-[12px]">
            <Link
                :href="
                    route('members.show', {
                        slugMember: item.slug ?? '',
                    })
                "
                class="col-span-full md:col-span-1 cursor-pointer"
                v-for="(item, index) in members"
                :key="index"
            >
                <div class="aspect-w-2 aspect-h-1 max-h-[252px] min-h-[252px]">
                    <JPicture :src="item.image.url" class="w-full h-full" />
                </div>
            </Link>
        </div>

        <!-- Overlay Slider -->
        <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-80 z-50 flex items-center justify-center">
            <div class="w-full max-w-[700px] relative">
                <button @click="closeSlider" class="absolute top-4 right-4 text-white text-2xl z-10">✕</button>
                <Swiper :slides-per-view="1" navigation pagination>
                    <SwiperSlide v-for="(img, idx) in currentImages" :key="idx">
                        <JPicture :src="img.url" class="w-full h-auto object-contain" />
                    </SwiperSlide>
                </Swiper>
            </div>
        </div>
    </section>
</template>

<script>
import { Swiper, SwiperSlide } from 'swiper/vue'
import 'swiper/css'

export default {
    components: {
        Swiper,
        SwiperSlide,
    },
    props: ['members'],
    data() {
        return {
            showModal: false,
            currentImages: [],
        }
    },
    methods: {
        openSlider(images) {
            this.currentImages = images
            this.showModal = true
        },
        closeSlider() {
            this.showModal = false
            this.currentImages = []
        },
    },
}
</script>

<style scoped>
.swiper {
    --swiper-navigation-color: black;
    --swiper-pagination-color: black;
}
</style>
