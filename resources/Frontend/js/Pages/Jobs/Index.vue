<template>
    <main>
        <JamBanner :image="banner" class="banner-sm">
            <div class="relative flex items-center h-full">
                <JPicture
                    src="/assets/images/contact/banner-shape.png"
                    alt="banner shape"
                    wrapperClass="h-full !z-0 top-0 right-0 banner-shape"
                />
                <div class="container relative z-10">
                    <JamBreadcrumb class="mb-2 is-background xl:mb-4 md:mb-3" :items="breadcrumbs" />
                    <h1 class="text-white display-2">{{ tt('Tuyển dụng') }}</h1>
                </div>
            </div>
        </JamBanner>
        <section class="pt-8 pb-8 xl:pt-16 md:pt-12 xl:pb-14 md:pb-12">
            <div class="container">
                <h2 class="display-3 text-blue-dark-700 lg:tracking-[-0.02em] xl:mb-[34px] md:mb-6 mb-4">
                    {{ tt('Văn hóa doanh nghiệp') }}
                </h2>
                <div
                    class="grid grid-cols-12 xl:gap-x-8 lg:gap-x-[22px] max-lg:gap-y-[22px] max-md:gap-y-4 xl:mb-12 md:mb-8 mb-6"
                >
                    <div class="xl:col-span-9 lg:col-span-8 col-span-full xl:pr-[96px] lg:pr-16">
                        <div
                            class="body-1 text-gray-700 xl:mb-6 md:mb-[18px] mb-3 last:mb-0"
                            v-for="(content, contentIndex) in cultureContent"
                            :key="contentIndex"
                            v-html="content"
                        ></div>
                    </div>
                    <div
                        class="xl:col-span-3 lg:col-span-4 col-span-full xl:space-y-8 md:space-y-[22px] space-y-4 lg:pt-2.5"
                    >
                        <div
                            class="pb-2 text-gray-700 border-b border-gray-300 title-2"
                            v-for="(culture, cultureIndex) in cultureList"
                            :key="cultureIndex"
                            v-html="culture"
                        ></div>
                    </div>
                </div>
                <div>
                    <JPicture
                        :src="tt('/assets/images/job/img-culture.webp')"
                        wrapperClass="picture-cover"
                        alt="hinh anh van hoa cong ty"
                    />
                </div>
            </div>
        </section>
        <section
            class="bg-gradient-blue xl:pt-[96px] lg:pt-16 md:pt-12 pt-6 xl:pb-[93px] lg:pb-16 md:pb-12 pb-6 relative"
        >
            <div class="absolute bottom-0 left-0">
                <JPicture src="/assets/images/job/shape-first.png" alt="environment background first shape" />
            </div>
            <div class="absolute top-0 right-0">
                <JPicture src="/assets/images/job/shape-second.png" alt="environment background second shape" />
            </div>
            <div class="container relative z-10">
                <div class="mb-8 text-center text-white display-3 xl:mb-16 md:mb-12">
                    {{ tt('Môi trường làm việc') }}
                </div>
                <div class="grid grid-cols-12 xl:gap-x-8 lg:gap-x-[22px] max-lg:gap-y-[22px]">
                    <div
                        class="lg:col-span-3 col-span-full xl:space-y-12 lg:space-y-8 max-lg:grid max-lg:grid-cols-2 max-md:grid-cols-1 max-lg:gap-[22px] max-md:gap-4"
                    >
                        <div
                            v-for="(environment, environmentIndex) in environmentList"
                            :key="environmentIndex"
                            :class="environmentIndex >= 2 ? 'lg:hidden' : ''"
                        >
                            <div class="pb-1 mb-2 text-white border-b border-gray-300 title-1 xl:mb-4 md:mb-3">
                                {{ environment.title }}
                            </div>
                            <div class="text-white body-1" v-html="environment.description"></div>
                        </div>
                    </div>
                    <div class="lg:col-span-6 col-span-full xl:px-14 lg:px-10">
                        <JPicture
                            wrapperClass="picture-cover max-lg:h-[400px]"
                            :src="tt('/assets/images/job/img-environment.webp')"
                            alt="hinh anh moi truong lam viec"
                        />
                    </div>
                    <div class="col-span-3 space-y-6 xl:space-y-12 md:space-y-8 max-lg:hidden">
                        <div
                            v-for="(environment, environmentIndex) in environmentList.slice(2, 4)"
                            :key="environmentIndex"
                        >
                            <div class="pb-1 mb-2 text-white border-b border-gray-300 title-1 xl:mb-2 md:mb-3">
                                {{ environment.title }}
                            </div>
                            <div class="text-white body-1" v-html="environment.description"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section
            class="relative py-4 overflow-x-hidden md:py-8 xl:py-16 lg:py-12 bg-blue-dark-25"
            v-if="jobs && jobs.length > 0"
        >
            <div class="absolute top-0 right-0">
                <JPicture :src="tt('/assets/images/job/job-shape.png')" alt="job section shape" />
            </div>
            <div class="container relative z-10">
                <div class="mb-6 text-center display-3 text-blue-dark-700 xl:mb-12 md:mb-8">
                    {{ tt('Gia nhập đội ngũ Funky') }}
                </div>
                <div class="grid grid-cols-12 xl:gap-x-8 md:gap-x-[22px]">
                    <div class="space-y-2 lg:col-span-10 col-span-full lg:col-start-2 xl:space-y-4 md:space-y-3">
                        <CardJob v-for="(item, index) in jobs.slice(0, count_slice)" :key="index" :item="item" />
                    </div>
                </div>
                <div class="flex justify-center w-full xl:mt-8 md:mt-[22px] mt-4" v-if="count_slice < jobs.length">
                    <button class="btn btn-primary !px-[70px] btn-lg" @click="loadMore">
                        <div>{{ tt('Xem thêm') }}</div>
                    </button>
                </div>
            </div>
        </section>
        <section class="py-4 md:py-8 xl:py-16 lg:py-12 bg-gray-50" v-if="posts && posts.length > 0">
            <div class="container" :class="sliders && sliders.length > 0 ? 'mb-4 md:mb-8 xl:mb-16 lg:mb-12' : ''">
                <div class="display-3 text-blue-dark-700 xl:mb-3 md:mb-2 mb-2.5 lg:tracking-[-0.02em]">
                    {{ tt('Hoạt động ngoài giờ tại Funky') }}
                </div>
                <div class="mb-6 text-gray-700 body-1 xl:mb-12 md:mb-8">
                    {{
                        tt(
                            'Chúng tôi đẩy mạnh hoạt động tương tác giúp kết nối và gắn kết các thành viên của Funky với nhau.'
                        )
                    }}
                </div>
                <Slider
                    v-if="posts && posts.length"
                    :config="{
                        total: posts.length,
                    }"
                    class="w-full xl:h-[336px] lg:h-[328px] md:h-[282px] h-[190px] relative"
                >
                    <div
                        v-for="(item, index) in posts"
                        :key="index"
                        class="overflow-hidden xl:mr-[32px] md:mr-[24px] mr-[16px] h-full group lg:w-[384px] md:w-[calc(45%-24px)] w-[75%]"
                    >
                        <JCardBlog :item="item" :language="$page.props.locale.current" />
                    </div>
                </Slider>
            </div>
            <div v-if="sliders && sliders.length > 0">
                <Marquee :marquee="sliders" />
            </div>
        </section>
    </main>
</template>
<script>
const COUNT_SLICE_INIT = 5
import JamBreadcrumb from '@/Components/Jam/Breadcrumb.vue'
export default {
    props: ['jobs', 'posts', 'sliders'],
    components: { JamBreadcrumb },
    data() {
        return {
            breadcrumbs: [
                {
                    title: this.tt('Tuyển dụng'),
                },
            ],
            banner: {
                url: '/assets/images/contact/blue-shape.webp',
                alt: 'banner lien he',
            },
            cultureContent: [
                this.tt(
                    'Trong hơn 140 năm dựng xây và phát triển, chúng tôi luôn cố gắng tạo nên những thành tựu vượt ngoài mong đợi của con người và xã hội để cải thiện lối sống và kiến tạo giá trị mới.'
                ),
                this.tt(
                    'Con người được rèn luyện và trưởng thành với mục tiêu giúp đỡ người khác. Vì chúng ta không tồn tại riêng biệt mà luôn nằm trong mối liên hệ với người khác.'
                ),
                this.tt(
                    'Chúng tôi luôn thử thách bản thân vượt lên những mong cầu xã hội, khát khao cống hiến để tạo nên lối sống tốt đẹp hơn. Kiên trì bứt phá, xóa bỏ giới hạn, phá tan rào cản vốn là những quy luật được cho là hiển nhiên.'
                ),
                this.tt(
                    'Vượt qua bản thân của ngày hôm nay chính là bước đầu tiên để biết mình sẽ là ai trong <br class="hidden lg:hidden md:block"/> ngày mai.'
                ),
            ],
            cultureList: [
                this.tt('An toàn - Chúng ta có trách nhiệm với sinh mệnh'),
                this.tt('Đam mê - Luôn quan tâm đến <br class="hidden xl:hidden lg:block"/> chất lượng'),
                this.tt('Trưởng thành - Tiến xa hơn ngày hôm qua'),
            ],
            environmentList: [
                {
                    title: this.tt('Năng động'),
                    description: this.tt(
                        'Đội ngũ nhân viên tại Funky được khuyến khích chủ động học hỏi đưa ra sáng kiến giải pháp đổi mới hiệu quả trong công việc.'
                    ),
                },
                {
                    title: this.tt('Yêu thương'),
                    description: this.tt(
                        'Funky coi trọng mọi mối quan hệ và xem nhân viên như thành viên trong gia đình, luôn luôn hỗ trợ trong công việc cũng như <br class="hidden xl:hidden lg:block"/> cuộc sống.'
                    ),
                },
                {
                    title: this.tt('Đoàn kết'),
                    description: this.tt(
                        'Mỗi cá nhân gắn kết không chỉ thêm tự tin trong công việc mà còn tạo nên sức mạnh tập thể chinh phục thử thách, gặt hái <br class="hidden lg:hidden md:block"/> thành công.'
                    ),
                },
                {
                    title: this.tt('Hạnh phúc'),
                    description: this.tt(
                        'Chúng tôi tập trung tạo ra môi trường làm việc giúp nhân viên cảm thấy thoải mái nhất, từ đó nuôi dưỡng tinh thần tích cực và lan tỏa đến mọi người.'
                    ),
                },
            ],
            count_slice: COUNT_SLICE_INIT,
        }
    },
    methods: {
        loadMore() {
            if (this.count_slice < this.jobs.length) {
                this.count_slice = this.count_slice + COUNT_SLICE_INIT
            }
        },
    },
}
</script>
