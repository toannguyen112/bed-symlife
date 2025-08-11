<template>
    <main class="overflow-hidden">
        <Hero
            v-if="sliders && sliders.length > 0"
            :slides="sliders"
            class="pt-[74px] lg:pt-[90px] xl:pt-[112px] w-full bg-cover bg-center bg-no-repeat"
        />
        <div class="pt-[48px]">
            <div class="container mx-auto text-center space-y-[32px]">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Kỹ Thuật Lạnh Hải Đăng Cam kết</h2>

                <ul class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <li v-for="(item, index) in commitments" :key="index" class="flex flex-col items-center">
                        <JPicture :src="item.image" :alt="item.title" class="w-16 h-16" />
                        <p class="mt-2 text-gray-700 font-medium">{{ item.title }}</p>
                    </li>
                </ul>
            </div>
        </div>
        <section class="md:py-[80px] py-[48px]">
            <div v-if="services && services.length" class="space-y-20">
                <div class="container md:grid grid-cols-2 lg:grid-cols-3 gap-[32px] space-y-[32px]">
                    <p class="col-span-full display-2 font-bold font-display text-[#18191E] text-center">Dịch vụ</p>
                    <CardCourse v-for="(course, index) in services" :key="index" :course="course" :isHome="true" />
                </div>
            </div>
        </section>

        <section class="relative overflow-hidden">
            <div class="grid grid-cols-12 space-y-8 container">
                <div class="lg:col-span-6 lg:col-start-4 col-span-full text-center space-y-6">
                    <p class="display-2 font-bold font-display text-[#18191E]">Sản phẩm</p>
                </div>
                <div v-if="products && products.length" class="col-span-12">
                    <div class="relative z-2 xl:p-8 md:p-6 p-4 rounded-[32px] border-red-fks bg-red-fks space-y-[24px]">
                        <UIMarquee
                            :imagesTop="splitArrayProducts().firstHalf"
                            :imagesBottom="splitArrayProducts().secondHalf"
                        />
                    </div>
                </div>
            </div>
        </section>

        <section v-if="feedback && feedback.length" class="relative">
            <div class="space-y-10 container relative z-1 md:py-[80px] py-[56px]">
                <div class="w-full text-center">
                    <p class="display-2 font-bold font-display text-black-fks uppercase">Feedback Khách hàng</p>
                </div>
                <div class="grid grid-cols-8 col-start-3 gap-8">
                    <div
                        class="xl:col-span-5 col-span-full px-3 py-6 rounded-3xl h-full bg-white min-h-[250px] md:min-h-[480px] order-2 md:order-1 max-md:max-h-[200px] md:max-h-[480px] overflow-y-auto"
                    >
                        <div class="flex items-start gap-x-4 h-full">
                            <div class="w-3 bg-[#D9D9D9] rounded-[80px] h-full"></div>
                            <div class="flex flex-wrap gap-4">
                                <div
                                    v-for="(feedback, index) in feedback"
                                    :key="index"
                                    @click="selectFeedback(feedback)"
                                    :class="feedback.id === selectedFeedback?.id ? 'bg-blue-fks' : 'bg-transparent'"
                                    class="cursor-pointer flex items-center gap-x-2 py-[6px] pl-2 pr-[10px] border border-gray-warm-500 rounded-full group duration-300 lg:hover:bg-blue-fks lg:hover:border-blue-fks"
                                >
                                    <img
                                        :src="feedback.image.url || ''"
                                        :alt="feedback.image.alt || ''"
                                        class="w-7 h-7 rounded-full"
                                    />
                                    <p
                                        :class="feedback.id === selectedFeedback?.id ? 'text-white' : 'text-gray-700'"
                                        class="label-1 text-gray-700 font-medium font-beau group-hover:text-white duration-300"
                                    >
                                        {{ feedback.title }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        v-if="selectedFeedback"
                        class="xl:col-span-3 col-span-full p-3 rounded-3xl bg-white border border-gray-warm-300 space-y-3 order-1 md:order-2"
                    >
                        <div class="flex items-center gap-x-2">
                            <img
                                :src="selectedFeedback.image.url || ''"
                                :alt="selectedFeedback.image.alt || ''"
                                class="w-10 h-10 rounded-full"
                            />
                            <div>
                                <p class="label-1 text-black-fks font-medium font-beau">
                                    {{ selectedFeedback.title }}
                                </p>
                                <p class="body-2 text-black-fks font-medium font-beau">
                                    {{ selectedFeedback.description }}
                                </p>
                            </div>
                        </div>
                        <p class="body-2 props-feedback prose" v-html="selectedFeedback.content"></p>
                    </div>
                </div>
            </div>
        </section>

        <Construction :members="members" />

        <section class="container md:py-[80px] py-[48px] space-y-[32px]">
            <div class="w-full text-center">
                <p class="display-2 font-bold font-display text-black-fks uppercase">Kinh nghiệm sử dụng</p>
            </div>
            <div class="md:grid grid-cols-2 lg:grid-cols-3 md:gap-6 xl:gap-8">
                <CardBlog v-for="(course, index) in posts" :key="index" :item="course" />
            </div>
        </section>
    </main>
</template>
<script>
export default {
    props: ['services', 'sliders', 'products', 'posts', 'feedback', 'members'],
    data() {
        return {
            about: [
                {
                    title: this.tt('sáng tạo'),
                    image: {
                        url: '/assets/images/about/creative.png',
                        alt: 'Sáng tạo',
                    },
                },
                {
                    title: this.tt('tư duy'),
                    image: {
                        url: '/assets/images/about/thinking.png',
                        alt: 'Tư duy',
                    },
                },
                {
                    title: this.tt(' ứng dụng'),
                    image: {
                        url: '/assets/images/about/application.png',
                        alt: 'Ứng dụng',
                    },
                },
            ],

            commitments: [
                {
                    title: 'ĐÚNG HẸN',
                    image: '/assets/images/dung-lich-hen-01.png',
                },
                {
                    title: 'TAY NGHỀ GIỎI',
                    image: '/assets/images/tay-nghe-cao-02.png',
                },
                {
                    title: 'TRUNG THỰC',
                    image: '/assets/images/minh-bach-03.png',
                },
                {
                    title: 'THÂN THIỆN & VUI VẺ',
                    image: '/assets/images/than-thien-04.png',
                },
            ],

            selectedFeedback: this.feedback[0] ?? null,
        }
    },
    computed: {
        faqs() {
            return this.$page.props.data.faqs || []
        },
    },
    methods: {
        splitArrayProducts() {
            const midIndex = Math.floor(this.products.length / 2) // Lấy vị trí giữa của mảng
            const firstHalf = this.products.slice(0, midIndex) // Từ đầu đến giữa
            const secondHalf = this.products.slice(midIndex) // Từ giữa đến cuối

            return { firstHalf, secondHalf } // Trả về một object chứa hai mảng
        },
        selectFeedback(feedback) {
            this.selectedFeedback = feedback
        },

        closePopup() {
            this.isSuccess = false
            document.body.classList.remove('overflow-hidden')
        },
        setIsSubmit(val) {
            this.isSubmit = val
        },
    },
}
</script>
<style lang="scss" scoped>
::v-deep(.props-feedback) {
    p {
        @apply text-gray-warm-800 font-normal font-beau line-clamp-[10];
    }
    img {
        @apply mt-3 rounded-3xl overflow-hidden;
    }
}

.bg-about {
    border-bottom: 1px solid #dde1e6;
    background: url('/public/assets/images/shap-banner.png') repeat;
}

.bg-feedback {
    background: url('/public/assets/images/home/bg-feedback.png') no-repeat;
    background-blend-mode: multiply, normal;
}

.shape-top-course {
    display: flex;
    padding: 0px 0.047px 0.058px 0px;
    flex-direction: column;
    align-items: center;
    mix-blend-mode: exclusion;
}

.card-nudge {
    &:hover {
        .animated-nudge {
            animation: nudge 1s linear;
        }
    }
}

@keyframes nudge {
    0% {
        transform: rotate(-7deg);
    }

    33% {
        transform: rotate(7deg);
    }

    66% {
        transform: rotate(-7deg);
    }
}
</style>
