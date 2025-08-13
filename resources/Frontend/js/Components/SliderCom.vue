<template>
    <section class="bg-blue-gradient">
        <div class="slider-wrapper container py-[120px]">
            <!-- Tabs -->
            <div class="tabs">
                <div
                    v-for="tab in tabs"
                    :key="tab"
                    class="tab text-[2rem] font-bold font-display"
                    :class="{ active: activeTab === tab }"
                    @click="activeTab = tab"
                >
                    {{ tab }}
                </div>
            </div>

            <!-- Swiper -->
            <Swiper
                ref="swiperRef"
                :modules="[Autoplay]"
                :autoplay="{ delay: 3000, disableOnInteraction: false }"
                :loop="true"
                @swiper="onSwiperInit"
                @slideChange="onSlideChange"
                class="apartment-swiper"
            >
                <SwiperSlide v-for="(slide, index) in filteredSlides" :key="index">
                    <JPicture :src="slide" alt="slide" class="w-full h-full" />
                </SwiperSlide>
            </Swiper>

            <!-- Navigation -->
            <div class="nav-btns">
                <button class="btn-prev" @click="goToSlide(activeIndex - 1)">&#10094;</button>
                <button class="btn-next" @click="goToSlide(activeIndex + 1)">&#10095;</button>
            </div>
        </div>
    </section>
</template>

<script>
import { ref, computed } from 'vue'
import { Swiper, SwiperSlide } from 'swiper/vue'
import { Autoplay } from 'swiper/modules'
import 'swiper/css'

export default {
    components: { Swiper, SwiperSlide },
    setup() {
        const tabs = ['CĂN HỘ 2PN', 'CĂN HỘ 3PN']
        const activeTab = ref(tabs[0])

        const slides2PN = [
            'assets/images/MẶT BẰNG CĂN HỘ ĐIỂN HÌNH 2PN PLUS.png',
            'assets/images/MẶT BẰNG CĂN HỘ ĐIỂN HÌNH 2PN PLUS.png',
            'assets/images/MẶT BẰNG CĂN HỘ ĐIỂN HÌNH 2PN PLUS.png',
        ]
        const slides3PN = [
            'assets/images/MẶT BẰNG CĂN HỘ ĐIỂN HÌNH 2PN PLUS.png',
            'assets/images/MẶT BẰNG CĂN HỘ ĐIỂN HÌNH 2PN PLUS.png',
            'assets/images/MẶT BẰNG CĂN HỘ ĐIỂN HÌNH 2PN PLUS.png',
        ]

        const filteredSlides = computed(() => (activeTab.value === 'CĂN HỘ 2PN' ? slides2PN : slides3PN))

        const swiperRef = ref(null)
        const swiperInstance = ref(null)
        const activeIndex = ref(0)

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
            tabs,
            activeTab,
            filteredSlides,
            swiperRef,
            swiperInstance,
            activeIndex,
            onSwiperInit,
            onSlideChange,
            goToSlide,
            Autoplay,
        }
    },
}
</script>

<style scoped>
.slider-wrapper {
    position: relative;
    margin: auto;
}

.tabs {
    display: flex;
    justify-content: center;
    gap: 30px;
    margin-bottom: 15px;
}

.tab {
    font-weight: bold;
    cursor: pointer;
    color: #ccc;
}

.tab.active {
    color: #ffd200;
}

.slide-img {
    width: 100%;
    border-radius: 10px;
}

.nav-btns {
    position: absolute;
    bottom: 50px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 10px;
}

.btn-prev,
.btn-next {
    background: #ffd200;
    border: none;
    padding: 8px 12px;
    cursor: pointer;
}
</style>
