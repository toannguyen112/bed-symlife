<template>
    <section class="container grid grid-cols-12 lg:gap-16 gap-y-6 pt-[100px] lg:pb-12 pb-8">
        <div class="lg:col-span-5 col-span-full">
            <div class="relative rounded-3xl overflow-hidden">
                <div class="aspect-w-1 aspect-h-1">
                    <JPicture
                        :src="course.image.url || '/assets/images/cover.jpg'"
                        class="w-full h-full object-cover"
                    />
                </div>
            </div>
        </div>
        <div class="lg:col-span-7 col-span-full py-4 space-y-6 w-full lg:w-auto">
            <p class="uppercase headline-1 font-bold font-display text-blue-fks">{{ course.title }}</p>
            <p class="body-1 font-normal font-beau text-gray-warm-700">{{ course.description }}</p>
            <div class="py-4 px-3 rounded-xl bg-[#F4EFE2] space-y-4">
                <div>
                    <h3 class="label-1 font-beau font-medium text-gray-warm-900 pb-1 border-b border-gray-warm-300">
                        Lịch khải giảng
                    </h3>
                    <div class="mt-3 space-y-4">
                        <div v-for="(option, index) in course.schedule" :key="index" class="space-y-2">
                            <div class="flex items-center gap-x-3">
                                <input type="radio" :id="'option-' + index" :value="index" v-model="selectedSchedule" />
                                <label :for="'option-' + index" class="flex items-center justify-between w-full">
                                    <p>{{ option.day }}</p>
                                    <div class="flex items-center gap-x-1">
                                        <div
                                            v-for="(type, index) in option.types"
                                            :key="index"
                                            :class="getStatusColor(type.id)"
                                            class="body-2 font-normal font-beau h-5 px-[10px] rounded-[40px]"
                                        >
                                            {{ type.title }}
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div v-if="selectedSchedule === index" class="rounded-xl bg-gray-warm-50 p-2 space-y-4">
                                <div class="flex items-center gap-x-6">
                                    <div class="flex items-center gap-x-2">
                                        <div
                                            class="w-[28px] h-[28px] rounded-full p-1 bg-[#F4EFE2] flex items-center justify-center"
                                        >
                                            <img src="/assets/svg/clock.svg" />
                                        </div>
                                        <p class="text-gray-warm-900 label-2 font-medium font-beau">Thời lượng:</p>
                                        <p class="text-gray-warm-700 body-2 font-normal font-beau">
                                            {{ option.duration }}
                                        </p>
                                    </div>
                                    <div class="flex items-center gap-x-2">
                                        <div
                                            class="w-[28px] h-[28px] rounded-full p-1 bg-[#F4EFE2] flex items-center justify-center"
                                        >
                                            <img src="/assets/svg/calendar.svg" />
                                        </div>
                                        <p class="text-gray-warm-900 label-2 font-medium font-beau">Thời gian:</p>
                                        <p class="text-gray-warm-700 body-2 font-normal font-beau">
                                            {{ option.time }}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-x-2">
                                    <div
                                        class="w-[28px] h-[28px] rounded-full p-1 bg-[#F4EFE2] flex items-center justify-center"
                                    >
                                        <img src="/assets/svg/mentor.svg" />
                                    </div>
                                    <p class="text-gray-warm-900 label-2 font-medium font-beau">Mentor</p>
                                    <p class="text-gray-warm-700 body-2 font-normal font-beau">
                                        {{ option.mentor }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="course.groups && course.groups.length > 0">
                    <h3 class="label-1 font-beau font-medium text-gray-warm-900 pb-1 border-b border-gray-warm-300">
                        Đăng ký theo nhóm
                    </h3>
                    <div class="flex flex-wrap items-center gap-3 mt-3">
                        <ButtonOptionSign
                            v-for="(option, index) in course.groups"
                            :key="index"
                            @click="selectOptionSignin(index)"
                            :title="option.title"
                            :isActive="index === selectedGroup"
                        />
                    </div>
                </div>
                <div class="pt-3 flex items-center justify-end">
                    <div class="flex items-end space-x-4">
                        <p class="body-1 font-normal font-beau text-gray-warm-700">Chi phí</p>
                        <p class="headline-1 font-bold font-display text-blue-fks">{{ toNumber(price) }} Đ</p>
                    </div>
                </div>
            </div>
            <div v-if="course" class="flex items-center gap-x-4">
                <Link
                    :href="
                        route('checkout.course.index', {
                            course_id: course.id,
                            schedule_id: selectedSchedule,
                            group_id: selectedGroup,
                            price: price,
                        })
                    "
                >
                    <ButtonAddToCart :title="'đăng ký ngay'" />
                </Link>
                <a v-if="course.link" :href="course.link" target="_blank" rel="noopener noreferrer nofollow">
                    <ButtonFooter @click="addToCart('order')" title="Tìm hiểu thêm" />
                </a>
            </div>
        </div>
    </section>

    <section v-if="course.course_for && course.course_for.length" class="md:py-12 py-6 bg-[#F4EFE2]">
        <div class="container space-y-6 md:space-y-8 xl:space-y-10">
            <div v-if="course.banner" class="aspect-w-2 aspect-h-1">
                <JPicture
                    :src="course.banner.url || '/assets/images/cover.jpg'"
                    :alt="course.banner.alt"
                    class="w-full h-full object-cover"
                />
            </div>
            <div class="grid grid-cols-12 md:gap-x-10 gap-y-10">
                <div class="lg:col-span-5 col-span-full display-3 font-display font-bold text-blue-fks">
                    KHOÁ HỌC NÀY DÀNH CHO
                </div>
                <div class="lg:col-span-7 col-span-full space-y-3">
                    <FAQ :faqItems="course.course_for" :type="false" />
                </div>
            </div>
        </div>
    </section>

    <section v-if="course.knowledge_content && course.knowledge_content.length" class="md:py-12 py-6 bg-[#F4EFE2]">
        <div class="container grid grid-cols-12 space-y-6">
            <div class="col-span-full display-3 font-display font-bold text-blue-fks uppercase">Nội dung kiến thức</div>
            <div
                class="col-span-full grid grid-cols-2 p-6 rounded-3xl bg-white lg:gap-8 gap-4 lg:max-h-[468px] max-h-[550px]"
            >
                <div class="lg:col-span-1 col-span-full h-full overflow-hidden">
                    <div class="h-[calc(100%-44px)] overflow-y-auto">
                        <div v-for="(session, index) in course.knowledge_content" :key="index">
                            <div
                                :class="
                                    activeIndex === index
                                        ? 'bg-blue-fks rounded-xl transition-all duration-300 ease-out text-white'
                                        : ' text-gray-warm-900'
                                "
                                class="flex items-start gap-x-4 p-3"
                                @click="selectSession(index)"
                            >
                                <p class="min-w-[64px] title-2 font-bold font-display">Buổi {{ index + 1 }}</p>
                                <div class="space-y-1">
                                    <p class="title-2 font-bold font-display">{{ session.title }}</p>

                                    <p
                                        :style="{
                                            maxHeight: activeIndex === index ? contentHeights[index] + 'px' : '0',
                                            opacity: activeIndex === index ? '1' : '0',
                                        }"
                                        class="body-1 font-normal font-beau content-knowledge"
                                        :class="['transition-all duration-300 ease-out']"
                                    >
                                        {{ session.content }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex space-x-2">
                        <a
                            v-if="course.link"
                            :href="course.link"
                            target="_blank"
                            class="px-[18px] py-[10px] h-[44px] rounded-xl border border-gray-warm-300 bg-white w-fit flex items-center gap-x-2"
                        >
                            <span class="button-1 font-bold font-display text-gray-warm-700">{{
                                tt('tìm hiểu thêm')
                            }}</span>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="20"
                                height="20"
                                viewBox="0 0 20 20"
                                fill="none"
                            >
                                <path
                                    d="M5 14.1666L9.16667 9.99992L5 5.83325M10.8333 14.1666L15 9.99992L10.8333 5.83325"
                                    stroke="#D34000"
                                    stroke-width="1.66667"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>
                        </a>
                        <a
                            v-if="course.download"
                            :href="course.download"
                            target="_blank"
                            @click.prevent="downloadFile(course.download)"
                            class="px-[18px] py-[10px] h-[44px] rounded-xl border border-gray-warm-300 bg-white w-fit flex items-center gap-x-2"
                        >
                            <span class="button-1 font-bold font-display text-gray-warm-700">{{
                                tt('Download tài liệu')
                            }}</span>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="20"
                                height="20"
                                viewBox="0 0 20 20"
                                fill="none"
                            >
                                <path
                                    d="M5 14.1666L9.16667 9.99992L5 5.83325M10.8333 14.1666L15 9.99992L10.8333 5.83325"
                                    stroke="#D34000"
                                    stroke-width="1.66667"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="lg:col-span-1 col-span-full rounded-3xl overflow-hidden">
                    <JPicture
                        :src="course.knowledge_content[activeIndex]?.image?.static_url ?? '/assets/images/cover.jpg'"
                        class="w-full h-full object-cover"
                    />
                </div>
            </div>
        </div>
    </section>

    <section v-if="course.course_target && course.course_target.length" class="md:py-12 py-6 bg-[#F4EFE2]">
        <div class="container grid grid-cols-12 space-y-6">
            <div class="col-span-full display-3 font-display font-bold text-blue-fks uppercase">Mục tiêu học tập</div>
            <div class="col-span-full grid md:grid-cols-2 lg:grid-cols-3 gap-y-4 md:gap-5 xl:gap-7">
                <div
                    v-for="(item, index) in course.course_target"
                    :key="index"
                    class="rounded-3xl border border-gray-warm-300 overflow-hidden bg-white p-3 space-y-6 lg:hover:-translate-y-5 duration-300 ease-in-out"
                >
                    <div class="w-full rounded-3xl overflow-hidden">
                        <div class="aspect-w-1 aspect-h-1">
                            <JPicture
                                :src="item.image?.static_url || '/assets/images/products/product.png'"
                                class="w-full h-full object-cover"
                            />
                        </div>
                    </div>
                    <p class="title-1 font-bold font-display text-blue-fks h-16 line-clamp-2">
                        {{ item.title }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section v-if="course.products && course.products.length > 0" class="md:py-12 py-6 bg-[#F4EFE2] space-y-6">
        <h2 class="display-2 font-display text-gray-warm-900 font-bold w-full text-center">Sản phẩm học viên</h2>
        <div class="relative z-2 space-y-6 py-8 max-w-[1440px] w-full mx-auto">
            <ClientOnly>
                <UIMarquee
                    :imagesTop="splitArrayProducts(course.products).firstHalf"
                    :imagesBottom="splitArrayProducts(course.products).secondHalf"
                />
            </ClientOnly>
        </div>
        <div class="body-2 text-center text-black-fks">
            Khám phá thêm nhiều câu truyện đằng sau các sản phẩm kiến trúc sáng tạo của học viên nhà Funky tại Funky
            Gallery
        </div>
    </section>

    <section class="md:py-12 py-6 bg-advise flex items-center justify-center">
        <div class="rounded-3xl p-8 bg-green-fks space-y-4 lg:max-w-[572px] w-[95%] mx-auto">
            <p class="display-3 text-center font-bold font-display text-black-fks uppercase">
                tham gia gia đình <br />
                funky bạn nhé !!
            </p>
            <div class="flex lg:flex-row flex-col items-center justify-center lg:gap-x-4 max-lg:space-y-3">
                <ButtonFooter @click="scrollToFooter" title="Nhận tư vấn" />
                <Link
                    :href="
                        route('checkout.course.index', {
                            course_id: course.id,
                            schedule_id: selectedSchedule,
                            group_id: selectedGroup,
                            price: price,
                        })
                    "
                    class="flex items-center justify-center"
                >
                    <ButtonAddToCart @click="addToCart('buyNow')" :title="'đăng ký ngay'" />
                </Link>
            </div>
        </div>
    </section>

    <section class="bg-gray-warm-100 md:py-[80px] py-6">
        <div class="container">
            <div class="grid grid-cols-12 xl:gap-x-[72px] lg:gap-x-6 max-lg:gap-y-9 md:p-6 xl:p-8 rounded-[32px]">
                <div class="lg:col-span-3 col-span-full space-y-6">
                    <div
                        class="py-3 bg-green-fks uppercase headline-1 font-display font-bold text-black-fks text-center rounded-xl"
                    >
                        Các câu hỏi thường gặp ?
                    </div>
                </div>
                <div class="lg:col-span-9 col-span-full space-y-3">
                    <FAQ :faqItems="faqs" :type="true" />
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    props: ['course'],
    watch: {
        activeIndex() {
            this.$nextTick(this.calculateHeights)
        },
        selectedSchedule(newVal) {
            this.handleTotalPrice()
        },
        selectedGroup(newVal) {
            this.handleTotalPrice()
        },
    },
    created() {
        this.handleTotalPrice()
    },
    computed: {
        faqs() {
            return this.$page.props.data.faqs || []
        },
    },
    data() {
        return {
            price: 0,
            selectedSchedule: 0,
            selectedGroup: 0,
            faqItems: [
                {
                    question: 'Học ở FUNKY bạn sẽ nhận được những gì',
                    answer: 'Năng lượng năng động, ngẫu hứng, sáng tạo và bầu không khí ấm cúng gần gũi trong các lớp học là các chất liệu tạo nên Funky mà các mentee luôn yêu thích. Bởi vì Funky không chỉ là nơi dạy học các môn học kỹ năng phần mềm tư duy liên quan Kiến Trúc mà còn là không gian để mọi người cùng quậy, vừa học, vừa chơi, kết nối mọi người lại với nhau. Nếu bạn là người mới, mới biết về Funky hãy xem qua môi trường học tập ở Funky có gì',
                },
                {
                    question: 'FUNKY REVIT CÓ GÌ ',
                    answer: 'Năng lượng năng động, ngẫu hứng, sáng tạo và bầu không khí ấm cúng gần gũi trong các lớp học là các chất liệu tạo nên Funky mà các mentee luôn yêu thích. Bởi vì Funky không chỉ là nơi dạy học các môn học kỹ năng phần mềm tư duy liên quan Kiến Trúc mà còn là không gian để mọi người cùng quậy, vừa học, vừa chơi, kết nối mọi người lại với nhau. Nếu bạn là người mới, mới biết về Funky hãy xem qua môi trường học tập ở Funky có gì',
                },
                {
                    question: 'CUỐI KHÓA THƯỜNG CÓ GÌ VUI?',
                    answer: 'Năng lượng năng động, ngẫu hứng, sáng tạo và bầu không khí ấm cúng gần gũi trong các lớp học là các chất liệu tạo nên Funky mà các mentee luôn yêu thích. Bởi vì Funky không chỉ là nơi dạy học các môn học kỹ năng phần mềm tư duy liên quan Kiến Trúc mà còn là không gian để mọi người cùng quậy, vừa học, vừa chơi, kết nối mọi người lại với nhau. Nếu bạn là người mới, mới biết về Funky hãy xem qua môi trường học tập ở Funky có gì',
                },
                {
                    question: 'CUỐI KHÓA THƯỜNG CÓ GÌ VUI?',
                    answer: 'Năng lượng năng động, ngẫu hứng, sáng tạo và bầu không khí ấm cúng gần gũi trong các lớp học là các chất liệu tạo nên Funky mà các mentee luôn yêu thích. Bởi vì Funky không chỉ là nơi dạy học các môn học kỹ năng phần mềm tư duy liên quan Kiến Trúc mà còn là không gian để mọi người cùng quậy, vừa học, vừa chơi, kết nối mọi người lại với nhau. Nếu bạn là người mới, mới biết về Funky hãy xem qua môi trường học tập ở Funky có gì',
                },
            ],
            activeIndex: 0,
            contentHeights: [],
        }
    },
    mounted() {
        this.calculateHeights()
    },
    methods: {
        scrollToFooter() {
            const footer = document.getElementById('footer-section')
            if (footer) {
                footer.scrollIntoView({ behavior: 'smooth' })
            }
        },
        splitArrayProducts(products) {
            const midIndex = Math.floor(products.length / 2) // Lấy vị trí giữa của mảng
            const firstHalf = products.slice(0, midIndex) // Từ đầu đến giữa
            const secondHalf = products.slice(midIndex) // Từ giữa đến cuối

            return { firstHalf, secondHalf } // Trả về một object chứa hai mảng
        },
        handleTotalPrice() {
            const { schedule, groups } = this.course
            const selectedSchedule = schedule[this.selectedSchedule] || {}
            const selectedGroup = groups[this.selectedGroup] || {}

            const price = Number(selectedSchedule.price ?? 0)
            const discount = Number(selectedGroup.discount ?? 0) / 100

            this.price = price * (1 - discount)
        },

        getStatusColor(status) {
            switch (status) {
                case 'Online':
                    return 'bg-red-fks text-gray-100' // Màu xanh lá
                case 'Offline':
                    return 'bg-blue-fks text-gray-100' // Màu đỏ
                case 'Full':
                    return 'bg-gray-warm-300 px-[18px] text-[#18191E]' // Màu vàng
                case 'Open':
                    return 'bg-green-fks text-[#18191E]' // Màu xanh dương
                default:
                    return 'bg-gray-500' // Mặc định
            }
        },
        selectOptionSignin(index) {
            this.selectedGroup = index
        },
        calculateHeights() {
            this.$nextTick(() => {
                const descriptions = document.querySelectorAll('.content-knowledge')
                this.contentHeights = Array.from(descriptions).map((desc) => desc.scrollHeight)
            })
        },
        selectSession(index) {
            this.activeIndex = this.activeIndex === index ? 0 : index
        },

        downloadFile(url) {
            const link = document.createElement('a')
            link.href = url
            link.setAttribute('download', 'file.pdf') // Thay đổi nếu cần
            document.body.appendChild(link)
            link.click()
            document.body.removeChild(link)
        },
    },
}
</script>
