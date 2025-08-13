<template>
    <div class="bg-blue-900 text-white py-10">
        <!-- Header -->
        <div class="text-center mb-8">
            <h2 class="text-yellow-400 font-medium uppercase font-display text-[60px] leading-[125%]">Lý Do Sở Hữu</h2>
            <h1 class="text-[60px] font-medium font-display">SYMLIFE</h1>
        </div>

        <div class="container">
            <div class="relative">
                <swiper
                    ref="swiperRef"
                    :slides-per-view="4"
                    :space-between="32"
                    :loop="true"
                    :autoplay="{ delay: 1000, disableOnInteraction: false }"
                    :breakpoints="breakpoints"
                    @swiper="onSwiperInit"
                >
                    <swiper-slide v-for="(item, index) in slides" :key="index">
                        <div class="rounded-xl overflow-hidden shadow- bg-white relative md:h-[480px]">
                            <JPicture class="w-full h-full object-cover" :src="item" alt="House Image" />
                        </div>
                    </swiper-slide>
                </swiper>
            </div>

            <!-- Custom Navigation Buttons -->
            <button class="swiper-button-prev" @click="onPrevClick">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M21.6001 12H1.8001M1.8001 12L10.2001 5M1.8001 12L10.2001 19"
                        stroke="currentColor"
                        stroke-width="3.6"
                        stroke-linecap="square"
                        stroke-linejoin="bevel"
                    />
                </svg>
            </button>
            <button class="swiper-button-next" @click="onNextClick">
                <svg width="24" height="20" viewBox="0 0 24 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M2.3999 10H22.1999M22.1999 10L13.7999 3M22.1999 10L13.7999 17"
                        stroke="currentColor"
                        stroke-width="3.6"
                        stroke-linecap="square"
                        stroke-linejoin="bevel"
                    />
                </svg>
            </button>
        </div>
    </div>
</template>

<script>
import { ref } from 'vue'
import { Swiper, SwiperSlide } from 'swiper/vue'
import 'swiper/css'

export default {
    components: { Swiper, SwiperSlide },
    props: {
        slides: {
            type: Array,
            default: () => [],
        },
        breakpoints: {
            type: Object,
            default: () => ({
                320: { slidesPerView: 1.2, spaceBetween: 10 },
                768: { slidesPerView: 1.2, spaceBetween: 20 },
                1024: { slidesPerView: 1.5, spaceBetween: 30 },
            }),
        },
    },
    components: {
        Swiper,
        SwiperSlide,
    },
    setup(props) {
        const swiperRef = ref(null) // Tạo ref cho Swiper
        const swiperInstance = ref(null) // Tạo ref để lưu instance Swiper

        // Lấy instance Swiper từ sự kiện
        const onSwiperInit = (swiper) => {
            swiperInstance.value = swiper
        }

        // Xử lý sự kiện nút Previous
        const onPrevClick = () => {
            if (swiperInstance.value) {
                swiperInstance.value.slidePrev()
            } else {
                console.error('Swiper instance not initialized yet.')
            }
        }

        // Xử lý sự kiện nút Next
        const onNextClick = () => {
            if (swiperInstance.value) {
                swiperInstance.value.slideNext()
            } else {
                console.error('Swiper instance not initialized yet.')
            }
        }

        return {
            swiperRef,
            onPrevClick,
            onNextClick,
            onSwiperInit,
        }
    },
}
</script>

<style lang="scss" scoped>
.container {
    position: relative;
}

button {
    position: absolute;
    top: 50%;
    z-index: 10;
    background-color: rgba(255, 255, 255, 0.7);
    color: #323e52;
    border: none;
    padding: 16px 10px;
    cursor: pointer;
    font-size: 24px;
    transform: translateY(-50%);
}

button.swiper-button-prev {
    left: 40px;
    @media (max-width: '767px') {
        left: 0;
    }
}

button.swiper-button-next {
    right: 40px;
    @media (max-width: '767px') {
        right: 0;
    }
}

button:hover {
    background: black;
    color: white;
}
</style>
