<template>
    <Banner
        :breadcrumbs="breadcrumbs"
        breadCrumbClass="mb-[12px] md:mb-[16px] xl:mb-[24px]"
        customClass="py-[16px] md:py-[24px] xl:py-[32px]"
    >
        <h1 class="mb-2 text-white display-3 xl:mb-3">{{ service.title }}</h1>
        <p class="text-white title-2 max-w-[480px]" v-html="service.description"></p>
    </Banner>

    <section class="bg-white md:bg-gray-50 pt-4 md:pt-6 xl:pt-8 pb-[38px] md:pb-[52px] xl:pb-[76px]">
        <div class="md:container">
            <!-- Tabs -->
            <div v-if="!!service.is_content_by_tab" class="w-full overflow-x-auto pb-4 md:pb-[22px] xl:pb-8">
                <div class="flex items-center space-x-6 w-fit md:space-x-8 xl:space-x-12">
                    <div
                        v-for="(tab, index) in service.content_by_tab"
                        :key="index"
                        @click="setTabSelected(tab)"
                        class="tabs font-tab pl-6 relative after:absolute after:w-2 after:h-2 after:rounded-full after:content-[''] after:left-0 after:top-1/2 after:-translate-y-1/2 after:bg-current cursor-pointer lg:hover:text-blue-dark-700 group lg:duration-200 whitespace-nowrap"
                        :class="
                            tabSelected?.title === tab.title
                                ? 'text-blue-dark-700 font-bold'
                                : 'text-gray-500 font-medium'
                        "
                    >
                        <span
                            class="relative inline-block after:content-[''] after:absolute after:h-[1.5px] after:bg-current after:bottom-[-3px] after:left-0 lg:after:duration-200 lg:group-hover:after:w-full"
                            :class="tabSelected?.title === tab.title ? 'after:w-full' : ' after:w-0'"
                            >{{ tab.title }}</span
                        >
                    </div>
                </div>
            </div>

            <!-- Content PC -->
            <div class="p-4 bg-white shadow-lg md:p-8 xl:p-12">
                <div class="text-gray-900 headline-2 md:mb-[22px] xl:mb-[32px]">
                    {{ tt('Thông tin chi tiết dịch vụ') }}
                </div>

                <Accordion
                    v-if="serviceActive && serviceActive.toc && serviceActive.toc.length > 0"
                    :title="
                        tabSelected && tabSelected.title_content
                            ? tabSelected.title_content
                            : service?.title_content || tt('Nội dung bài viết')
                    "
                    @onCollapse="setCollapseActive"
                    :collapseActive="collapseActive"
                    :isFirst="isShowTOC"
                    class="xl:my-8 md:my-[22px] my-4 bg-gray-100 rounded-lg xl:py-6 md:py-[17px] py-3 xl:px-8 md:px-[22px] px-4"
                    titleClass="title-2"
                >
                    <ul
                        class="space-y-[8px] title-3 font-semibold text-gray-700 border-gray-300 border-t pt-[8px] mt-[8px]"
                    >
                        <li
                            class="duration-300 ease-in-out hover:text-blue-500"
                            v-for="(item, index) in serviceActive.toc"
                            :key="index"
                        >
                            <span @click="tocClick(item.slug)" class="cursor-pointer" v-html="item.content"></span>

                            <ul
                                class="xl:pl-4 md:pl-3 pl-2 xl:mt-1 md:mt-[3px] mt-0.5 xl:space-y-1 md:space-y-[3px] space-y-0.5"
                                v-if="item.children && item.children.length"
                            >
                                <li v-for="(subItem, subIndex) in item.children" :key="subIndex">
                                    <span
                                        @click="tocClick(subItem.slug)"
                                        class="font-normal text-gray-700 duration-200 cursor-pointer body-2 hover:text-blue-500"
                                        v-html="subItem.content"
                                    ></span>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </Accordion>
                <div class="prose" v-html="serviceActive.html"></div>
            </div>
        </div>
    </section>
    <section v-if="service.sliders.length > 0" class="py-[16px] md:py-[22px] xl:py-[32px]">
        <SliderBanner
            :config="{
                total: service.sliders.length,
            }"
            :items="service.sliders"
        >
        </SliderBanner>
    </section>

    <section
        class="bg-gray-50 py-[48px] md:py-[67px] xl:py-[96px] relative"
        v-if="service.benefits && service.benefits.length > 0"
    >
        <img src="/assets/images/service/shape-benefits.png" class="absolute top-0 right-0 z-10 opacity-30" />
        <div class="container">
            <div class="max-w-[1008px] mx-auto">
                <h2 class="display-3 text-primary-dark max-w-[488px]">
                    {{ tt('Chúng tôi đặt lợi ích của khách hàng lên hàng đầu') }}
                </h2>

                <div
                    class="mt-[32px] mt:my-[44px] xl:mt-[64px] grid grid-cols-2 md:gap-x-[22px] xl:gap-x-[32px] gap-y-[24px] md:gap-y-[32px] xl:gap-y-[48px]"
                >
                    <div
                        class="text-gray-700 col-span-full lg:col-span-1"
                        v-for="(benefit, index) in service.benefits"
                        :key="index"
                    >
                        <h3 class="pb-2 mb-2 border-b border-gray-300 md:mb-3 xl:mb-4 title-1">{{ benefit.title }}</h3>
                        <p class="body-1">{{ benefit.content }}</p>
                    </div>
                </div>
            </div>

            <div
                v-if="service.benefit_image?.url"
                class="h-[240px] md:h-[380px] xl:h-[406px] mt-[32px] mt:my-[44px] xl:mt-[64px]"
                :class="{
                    'mt-[32px] md:mt-[44px] xl:mt-[64px]': service.benefits.length === 0,
                }"
            >
                <img
                    :src="service.benefit_image.url"
                    class="object-cover w-full h-full"
                    :alt="service.benefit_image.alt"
                />
            </div>
        </div>
    </section>

    <section class="bg-contact-us h-[500px] md:h-auto xl:h-[320px] relative">
        <img src="/assets/images/service/shape-connect.png" class="absolute top-0 left-0 hidden opacity-30 md:block" />
        <img src="/assets/images/service/shape-connect-mobile.png" class="absolute top-0 left-0 opacity-30 md:hidden" />
        <div class="container py-[48px] xl:py-[70px] relative z-10">
            <h2 class="mb-2 text-white display-3">{{ tt('Kết nối với Funky') }}</h2>
            <p class="text-white max-w-[500px] xl:max-w-[595px] mb-[16px] md:mb-[22px] xl:mb-[32px]">
                {{
                    tt(
                        'Vui lòng điền thông tin dưới đây để nhận tư vấn dịch vụ từ Funky. Chúng tôi sẵn sàng đồng hành cùng dự án của bạn!'
                    )
                }}
            </p>
            <Link :href="route('contact')" class="btn btn-primary btn-lg w-[180px]">
                <span class="font-medium"> {{ tt('Liên hệ ngay') }} </span>
            </Link>
        </div>
    </section>

    <section v-if="services && services.length > 0" class="my-0 bg-gray-100">
        <div class="container py-[32px] md:py-[44px] xl:py-[64px]">
            <h2 class="text-gray-700 headline-2 mb-[16px] md:mb-[22px] xl:mb-[32px]">{{ tt('Các dịch vụ khác') }}</h2>

            <Slider
                v-if="services && services.length"
                :config="{
                    total: services.length,
                }"
                class="w-full lg:h-[372px] md:h-[288px] h-[254px] relative"
            >
                <div
                    v-for="(item, index) in services"
                    :key="index"
                    class="overflow-hidden xl:mr-[32px] md:mr-[24px] mr-[16px] h-full group lg:w-[384px] md:w-[calc(45%-24px)] w-[75%]"
                >
                    <CardService :item="item" />
                </div>
            </Slider>
        </div>
    </section>
</template>
<script>
import CardService from '../../Components/CardService.vue'
import SliderBanner from '@/Components/SliderBanner.vue'
import JamBreadcrumb from '@/Components/Jam/Breadcrumb.vue'
import { useTransformContent } from '@/transformContent'
import ChervonDown from '@/Components/Icon/ChervonDown.vue'
import { scrollToSection } from '@/scroll'
export default {
    props: ['services', 'service'],
    components: { SliderBanner, CardService, JamBreadcrumb, ChervonDown },
    data() {
        return {
            isShowTOC: true,
            tabSelected: null,
            content: useTransformContent(this.service.content, ['h2', 'h3']),
            collapseActive: null,
        }
    },
    computed: {
        serviceActive() {
            if (this.tabSelected) {
                return useTransformContent(this.tabSelected.content, ['h2', 'h3'])
            }
            return useTransformContent(this.service.content, ['h2', 'h3'])
        },
        breadcrumbs() {
            return [
                { title: this.tt('Breacrumb Service Detail'), link: this.route('services.index') },
                { title: this.service.title },
            ]
        },
    },

    created() {
        const { content_by_tab, is_content_by_tab } = this.service
        if (!!is_content_by_tab) {
            this.tabSelected = content_by_tab[0]
        }
    },

    mounted() {
        const isScreenPC = window.matchMedia('(min-width: 768px)').matches
        if (isScreenPC) {
            this.isShowTOC = true
        } else {
            this.isShowTOC = false
        }
    },

    methods: {
        setTabSelected(tab) {
            if (!tab) return
            this.tabSelected = tab
        },
        scrollToSection,
        setCollapseActive(id) {
            this.collapseActive = id
        },

        tocClick(slug) {
            history.pushState({}, '', `#${slug}`)

            scrollToSection(slug, 74, 58)
        },
    },
}
</script>

<style lang="scss" scoped>
.font-tab {
    @apply text-[1.25rem] xl:text-[1.5rem] leading-[150%];
}
:deep(.prose) {
    strong {
        @apply font-semibold;
    }
    div {
        img {
            margin-top: 0px !important;
            margin-bottom: 0px !important;
        }
    }
    p {
        &:empty {
            margin-top: 0px !important;
            margin-bottom: 0px !important;
        }
    }
    .aspect-w-3 {
        padding-bottom: calc(var(--tw-aspect-h) / var(--tw-aspect-w) * 100%) !important;
        margin-top: 16px !important;
        margin-bottom: 16px !important;
        @screen md {
            margin-top: 24px !important;
            margin-bottom: 24px !important;
        }
        @screen xl {
            margin-top: 32px !important;
            margin-bottom: 32px !important;
        }
        img {
            @apply w-full h-full object-cover;
        }
    }
    .flex-1 .aspect-w-3 {
        margin-top: 0px !important;
        margin-bottom: 0px !important;
    }
}
.bg-contact-us {
    background-image: url('/assets/images/service/contact-us-mb.webp');
    background-size: cover;
    background-repeat: no-repeat;

    @screen md {
        background-image: url('/assets/images/service/contact-us.webp');
    }
}
</style>
