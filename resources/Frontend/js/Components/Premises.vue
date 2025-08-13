<template>
    <section class="bg-[#102C88] py-[120px]">
        <div class="container grid grid-cols-3 max-md:gap-y-[12px] md:gap-x-[64px]">
            <!-- Tabs bên trái -->
            <div class="col-span-full md:col-span-1">
                <div class="text-[60px] font-display yellow-primary font-medium uppercase mb-8">mặt bằng căn hộ</div>
                <div class="space-y-[1rem]">
                    <div
                        v-for="(tab, index) in tabs"
                        :key="index"
                        @click="setTab(index)"
                        class="flex items-center space-x-[12px] p-[12px] cursor-pointer transition"
                        :class="activeTab === index ? 'bg-[#DEA23C] text-white' : 'bg-[#0A2552] text-[#B2DDFF]'"
                    >
                        <!-- Icon -->
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <rect
                                x="9.89949"
                                y="0.100586"
                                width="14"
                                height="14"
                                transform="rotate(45 9.89949 0.100586)"
                                fill="url(#paint0_linear_11992_62)"
                            />
                            <defs>
                                <linearGradient
                                    id="paint0_linear_11992_62"
                                    x1="10.0554"
                                    y1="1.85059"
                                    x2="24.7255"
                                    y2="2.14181"
                                    gradientUnits="userSpaceOnUse"
                                >
                                    <stop stop-color="#DEA23C" />
                                    <stop offset="0.456731" stop-color="#FFE47D" />
                                    <stop offset="0.605769" stop-color="#E9B141" />
                                    <stop offset="1" stop-color="#F4CB30" />
                                </linearGradient>
                            </defs>
                        </svg>
                        <span>{{ tab.label }}</span>
                    </div>
                </div>
            </div>

            <!-- Ảnh bên phải -->
            <div class="col-span-full md:col-span-2">
                <transition name="fade" mode="out-in">
                    <JPicture :key="activeTab" :src="tabs[activeTab].image" class="w-full h-full" />
                </transition>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            activeTab: 0,
            tabs: [
                {
                    label: 'Căn hộ 1PN',
                    image: '/assets/images/MẶT BẰNG CĂN HỘ ĐIỂN HÌNH 1PN.png',
                },
                {
                    label: 'Căn hộ 2PN',
                    image: '/assets/images/MẶT BẰNG CĂN HỘ ĐIỂN HÌNH 2PN.png',
                },
                {
                    label: 'Căn hộ 2PN PLUS',
                    image: '/assets/images/MẶT BẰNG CĂN HỘ ĐIỂN HÌNH 2PN PLUS.png',
                },
                {
                    label: 'Căn hộ 3PN',
                    image: '/assets/images/MẶT BẰNG CĂN HỘ ĐIỂN HÌNH 3PN.png',
                },
            ],
        }
    },
    methods: {
        setTab(index) {
            console.log(index)

            this.activeTab = index
        },
    },
}
</script>

<style scoped>
/* Hiệu ứng fade khi đổi ảnh */
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s ease;
}
.fade-enter,
.fade-leave-to {
    opacity: 0;
}
</style>
