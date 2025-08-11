<template>
    <main>
        <section class="xl:pb-[58px] md:pb-[42px] pb-7 xl:pt-8 md:pt-[22px] pt-4">
            <div class="container">
                <div class="xl:mb-8 md:mb-[22px] mb-4">
                    <JamBreadcrumb :items="breadcrumbs" class="mb-[12px] md:mb-[16px] xl:mb-[24px]" />
                </div>
                <h1 class="mb-2 text-gray-900 headline-2 max-md:hidden">
                    {{ job.title }}
                </h1>
                <div class="mb-2 text-gray-900 headline-1 md:hidden">{{ job.title }}</div>
                <div class="grid grid-cols-12 xl:gap-x-8 lg:gap-x-[22px] max-lg:gap-[22px] max-md:gap-4">
                    <div class="order-2 lg:col-span-8 col-span-full md:order-1">
                        <div
                            class="xl:pt-4 md:pt-3 xl:px-[13.5px] md:px-[2.5px] xl:pb-12 md:pb-8 pb-4 border-b border-[#D4D4D8] xl:mb-8 md:mb-[22px] mb-4 prose"
                            v-if="job.content && job.content !== null"
                            v-html="job.content"
                        ></div>
                        <div class="flex items-center justify-between">
                            <button
                                class="btn btn-primary xl:!px-[51px] md:!px-[35px] !px-[25px] btn-lg"
                                @click="toggleFormSubmit"
                            >
                                <div class="label-1">{{ tt('Nộp hồ sơ') }}</div>
                            </button>
                            <div>
                                <SocialList :listSocial="['facebook', 'copy-link']" />
                            </div>
                        </div>
                        <FormCv v-show="isShowFormSubmit" :job="job" />
                    </div>
                    <div
                        class="order-1 lg:space-y-2 lg:col-span-4 col-span-full md:order-2 max-lg:grid max-lg:grid-cols-2 max-lg:gap-2 max-md:gap-2"
                    >
                        <div
                            class="border border-gray-200 rounded-xl py-3 xl:px-6 lg:px-[18px] md:px-3 px-2 flex items-center xl:space-x-4 md:space-x-3 space-x-1"
                            v-if="job.published_at"
                        >
                            <Calendar class="flex-shrink-0 max-md:h-8 max-md:w-8" />
                            <div>
                                <div class="mb-1 text-gray-700 body-2">{{ tt('Ngày đăng tuyển') }}</div>
                                <div class="text-gray-900 label-1">{{ getCreatedDate(job.published_at) }}</div>
                            </div>
                        </div>
                        <div
                            class="border border-gray-200 rounded-xl py-3 xl:px-6 lg:px-[18px] md:px-3 px-2 flex items-center xl:space-x-4 md:space-x-3 space-x-1"
                            v-if="job.work_address"
                        >
                            <Location class="flex-shrink-0 max-md:h-8 max-md:w-8" />
                            <div>
                                <div class="mb-1 text-gray-700 body-2">{{ tt('Nơi làm việc') }}</div>
                                <div class="text-gray-900 label-1">{{ job.work_address }}</div>
                            </div>
                        </div>
                        <div
                            class="border border-gray-200 rounded-xl py-3 xl:px-6 lg:px-[18px] md:px-3 px-2 flex items-center xl:space-x-4 md:space-x-3 space-x-1"
                            v-if="job.working_position"
                        >
                            <Office class="flex-shrink-0 max-md:h-8 max-md:w-8" />
                            <div>
                                <div class="mb-1 text-gray-700 body-2">{{ tt('Hình thức làm việc') }}</div>
                                <div class="text-gray-900 label-1">{{ job.working_position }}</div>
                            </div>
                        </div>
                        <div
                            class="border border-gray-200 rounded-xl py-3 xl:px-6 lg:px-[18px] md:px-3 px-2 flex items-center xl:space-x-4 md:space-x-3 space-x-1"
                            v-if="job.working_time"
                        >
                            <Suitcase class="flex-shrink-0 max-md:h-8 max-md:w-8" />
                            <div>
                                <div class="mb-1 text-gray-700 body-2">{{ tt('Vị trí làm việc') }}</div>
                                <div class="text-gray-900 label-1">{{ job.working_time }}</div>
                            </div>
                        </div>
                        <div
                            class="border border-gray-200 rounded-xl py-3 xl:px-6 lg:px-[18px] md:px-3 px-2 flex items-center xl:space-x-4 md:space-x-3 space-x-1"
                            v-if="job.quantity"
                        >
                            <Quantity class="flex-shrink-0 max-md:h-8 max-md:w-8" />
                            <div>
                                <div class="mb-1 text-gray-700 body-2">{{ tt('Số lượng') }}</div>
                                <div class="text-gray-900 label-1">{{ job.quantity }}</div>
                            </div>
                        </div>
                        <div
                            class="border border-gray-200 rounded-xl py-3 xl:px-6 lg:px-[18px] md:px-3 px-2 flex items-center xl:space-x-4 md:space-x-3 space-x-1"
                            v-if="job.expected_time"
                        >
                            <Calendar class="flex-shrink-0 max-md:h-8 max-md:w-8" />
                            <div>
                                <div class="mb-1 text-gray-700 body-2">{{ tt('Hạn nộp hồ sơ') }}</div>
                                <div class="text-gray-900 label-1">{{ getCreatedDate(job.expected_time) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section
            class="relative py-4 bg-blue-dark-25 xl:py-16 lg:py-12 md:py-8"
            v-show="related_jobs && related_jobs.length > 0"
        >
            <div class="absolute top-0 right-0">
                <JPicture :src="tt('/assets/images/job/job-shape.png')" alt="job detail section shape" />
            </div>
            <div class="container relative z-10">
                <h2 class="mb-6 text-center display-3 text-blue-dark-700 xl:mb-12 md:mb-8">
                    {{ tt('Vị trí tuyển dụng khác') }}
                </h2>
                <div class="grid grid-cols-12 xl:gap-x-8 md:gap-x-[22px]">
                    <div class="space-y-2 lg:col-span-10 col-span-full lg:col-start-2 xl:space-y-4 md:space-y-3">
                        <CardJob
                            v-for="(item, index) in related_jobs.slice(0, count_slice)"
                            :key="index"
                            :item="item"
                        />
                    </div>
                </div>
                <div
                    class="flex justify-center w-full xl:mt-8 md:mt-[22px] mt-4"
                    v-if="count_slice < related_jobs.length"
                >
                    <button class="btn btn-primary !px-[70px] btn-lg" @click="loadMore">
                        <div>{{ tt('Xem thêm') }}</div>
                    </button>
                </div>
            </div>
        </section>
    </main>
</template>
<script>
import JamBreadcrumb from '@/Components/Jam/Breadcrumb.vue'
import Quantity from '@/Components/Icons/Quantity.vue'
import Suitcase from '@/Components/Icons/Suitcase.vue'
import Office from '@/Components/Icons/Office.vue'
import Location from '@/Components/Icons/Location.vue'
import Calendar from '@/Components/Icons/Calendar.vue'
import axios from 'axios'
const COUNT_SLICE_INIT = 5
export default {
    props: ['job'],
    components: { JamBreadcrumb, Quantity, Suitcase, Office, Location, Calendar },
    data() {
        return {
            breadcrumbs: [
                {
                    title: this.tt('Tuyển dụng'),
                    link: this.route('jobs.index'),
                },
                {
                    title: this.job.title,
                },
            ],
            related_jobs: [],
            count_slice: COUNT_SLICE_INIT,
            isShowFormSubmit: false,
        }
    },
    mounted() {
        this.getRelatedJobs()
    },
    methods: {
        getCreatedDate(date) {
            if (!date) return null
            const splitItem = date.split('-')
            const year = splitItem[0]
            let month = splitItem[1]
            let day = splitItem[2]
            return `${day}/${month}/${year}`
        },
        parseDate(date) {
            var s = date
            var a = s.split(/[^0-9]/)
            var d = new Date(a[0], a[1] - 1, a[2], a[3], a[4], a[5])
            return d
        },
        loadMore() {
            if (this.count_slice < this.related_jobs.length) {
                this.count_slice = this.count_slice + COUNT_SLICE_INIT
            }
        },
        toggleFormSubmit() {
            this.isShowFormSubmit = !this.isShowFormSubmit
        },
        async getRelatedJobs() {
            const { data } = await axios.get(this.route('jobs.related_jobs', { id: this.job.id }))

            if (data && data.data) {
                this.related_jobs = data.data
            }
        },
    },
}
</script>
