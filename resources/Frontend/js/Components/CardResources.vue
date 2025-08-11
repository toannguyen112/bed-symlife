<template>
    <div class="group">
        <!-- Card Content -->
        <div
            v-if="item"
            class="bg-white rounded-3xl p-3 space-y-3 duration-300 ease-in-out block lg:group-hover:bg-gray-300 lg:group-hover:-translate-y-5"
        >
            <div class="space-y-1 w-full">
                <div v-if="item.resource_type == 'PAY'" class="flex items-center gap-x-2">
                    <div
                        class="px-[10px] rounded-[40px] bg-[#2F49D9] text-center uppercase title-2 font-bold font-display text-white"
                    >
                        {{ item.category && item.category.title }}
                    </div>
                    <div class="w-6 h-6 flex items-center justify-center rounded-full bg-[#CBFF00]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path
                                d="M14.8622 5.55536C14.8156 5.53191 14.7628 5.52365 14.7113 5.53172C14.6597 5.53979 14.612 5.56379 14.5747 5.60036L11.5547 8.57286L8.21724 2.78036C8.19283 2.74529 8.1603 2.71664 8.12243 2.69686C8.08456 2.67708 8.04247 2.66675 7.99974 2.66675C7.95701 2.66675 7.91492 2.67708 7.87705 2.69686C7.83918 2.71664 7.80665 2.74529 7.78224 2.78036L4.44474 8.57286L1.42474 5.60036C1.38756 5.56258 1.33933 5.53761 1.28702 5.52903C1.23471 5.52046 1.18103 5.52874 1.13373 5.55266C1.08643 5.57659 1.04796 5.61493 1.02388 5.66215C0.999794 5.70937 0.991341 5.76302 0.999741 5.81536L1.99974 12.5154C2.00878 12.575 2.03906 12.6293 2.085 12.6684C2.13094 12.7074 2.18945 12.7285 2.24974 12.7279H13.7497C13.81 12.7285 13.8685 12.7074 13.9145 12.6684C13.9604 12.6293 13.9907 12.575 13.9997 12.5154L14.9997 5.81536C15.0072 5.76305 14.998 5.70971 14.9733 5.663C14.9486 5.61629 14.9097 5.5786 14.8622 5.55536Z"
                                fill="black"
                            />
                        </svg>
                    </div>
                </div>
                <div
                    v-else
                    class="px-[10px] inline-block rounded-[40px] bg-[#2F49D9] text-center uppercase title-2 font-bold font-display text-white"
                >
                    {{ item.category && item.category.title }}
                </div>
                <div
                    class="title-1 font-bold font-display text-[#18191E] whitespace-normal h-[97px] line-clamp-3 w-full"
                >
                    {{ item.title }}
                </div>
            </div>

            <!-- Pay Button -->

            <ButtonPayment
                v-if="item.resource_type == 'PAY'"
                titleFirst="Trả phí"
                :titleSecond="toMoney(item.price)"
                @click="handleDownload"
            />

            <!-- Free Download Button -->
            <ButtonDownload v-else title="Tải miễn phí" @click="handleDownload" />

            <div class="relative rounded-3xl overflow-hidden">
                <div class="aspect-w-1 aspect-h-1">
                    <JPicture
                        :src="item.image.url || '/assets/images/cover.jpg'"
                        :alt="item.image.alt"
                        class="w-full h-full object-cover"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import CloseModal from './Icon/CloseModal.vue'
import ButtonDownload from './ButtonDownload.vue'

export default {
    props: {
        item: {
            type: Object,
            required: true,
        },
    },
    components: {
        CloseModal,
        ButtonDownload,
    },
    data() {
        return {
            showPrice: false,
        }
    },
    methods: {
        toMoney(amount) {
            return new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND',
            }).format(amount)
        },
        handleDownload() {
            // Emit event với data của item hiện tại
            this.$emit('download', this.item)
        },
    },
}
</script>

<style lang="scss" scoped>
.link-hover {
    position: relative;
    overflow: hidden;

    .link-text {
        transition: transform 0.3s ease, opacity 0.3s ease;
    }

    .link-price {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0.8);
        opacity: 0;
        color: #ffffff;
        font-size: 14px;
        font-weight: bold;
        transition: transform 0.3s ease, opacity 0.3s ease;
    }
}

::v-deep(.prose-resource) {
    h2,
    p {
        @apply text-gray-700;
    }

    h2 {
        @apply md:text-[18px] md:leading-[145%]  text-[16px] leading-[24px] font-display my-3 first:mt-0;
    }
    p {
        @apply my-5 first:mt-0;
    }
}
</style>
