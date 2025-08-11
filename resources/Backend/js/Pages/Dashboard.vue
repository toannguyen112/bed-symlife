<template>
    <Head title="Tổng quan" />

    <div class="max-w-screen-lg mx-auto my-8 w-full">
        <div class="bg-white rounded-md shadow-xl">
            <div
                class="items-center w-full p-4 font-bold leading-5 text-gray-700 transition duration-150 ease-in-out rounded-md cursor-default focus:outline-none"
            >
                KẾT QUẢ KINH DOANH TRONG NGÀY
            </div>
            <div class="flex border-t divide-x">
                <div class="flex items-center w-1/2 p-4 space-x-1">
                    <div class="p-2 text-yellow-500">
                        <svg width="50" height="50" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="20" cy="20" r="20" fill="currentColor" />
                            <path
                                d="M19.3749 22.7812C20.3783 22.1147 21.1405 21.1428 21.5486 20.0094C21.9568 18.876 21.9892 17.6414 21.6411 16.4881C21.293 15.3349 20.5828 14.3244 19.6157 13.6061C18.6486 12.8878 17.476 12.5 16.2714 12.5C15.0667 12.5 13.8941 12.8878 12.927 13.6061C11.9599 14.3244 11.2498 15.3349 10.9016 16.4881C10.5535 17.6414 10.5859 18.876 10.9941 20.0094C11.4022 21.1428 12.1644 22.1147 13.1678 22.7812C11.4573 23.4122 9.97887 24.5482 8.92858 26.0385C8.84972 26.1506 8.80315 26.2821 8.79393 26.4187C8.78471 26.5554 8.81321 26.692 8.87631 26.8136C8.93941 26.9352 9.03469 27.0371 9.15175 27.1082C9.26882 27.1793 9.40317 27.217 9.54015 27.2169L23.0023 27.2164C23.1392 27.2164 23.2736 27.1788 23.3906 27.1077C23.5077 27.0365 23.603 26.9346 23.6661 26.813C23.7291 26.6914 23.7576 26.5548 23.7484 26.4182C23.7392 26.2815 23.6926 26.15 23.6137 26.038C22.5634 24.5479 21.0852 23.4122 19.3749 22.7812Z"
                                fill="white"
                            />
                            <path
                                d="M31.2348 26.038C30.1845 24.548 28.7062 23.4122 26.9959 22.7813C28.1079 22.041 28.9192 20.9282 29.2839 19.6431C29.6485 18.3579 29.5425 16.9848 28.9849 15.7709C28.4273 14.5569 27.4548 13.5818 26.2423 13.0211C25.0299 12.4603 23.6571 12.3507 22.371 12.7119C22.2542 12.7447 22.1472 12.8055 22.0591 12.8889C21.9711 12.9723 21.9046 13.0759 21.8655 13.1907C21.8264 13.3055 21.8158 13.4281 21.8346 13.5479C21.8534 13.6677 21.9011 13.7812 21.9736 13.8784C22.819 15.0141 23.305 16.3769 23.369 17.7912C23.433 19.2055 23.072 20.6066 22.3326 21.8139C22.235 21.9732 22.2004 22.1632 22.2358 22.3466C22.2712 22.53 22.3739 22.6935 22.5238 22.805C22.8073 23.016 23.0801 23.2411 23.3412 23.4794C23.3547 23.4941 23.3683 23.5087 23.3831 23.5224C24.3813 24.4453 25.1903 25.5536 25.765 26.7855C25.8252 26.9145 25.9209 27.0236 26.041 27.1C26.161 27.1764 26.3004 27.217 26.4427 27.217L30.6234 27.2165C30.7604 27.2165 30.8947 27.1788 31.0117 27.1077C31.1288 27.0365 31.224 26.9346 31.2871 26.813C31.3502 26.6914 31.3787 26.5548 31.3694 26.4182C31.3602 26.2815 31.3136 26.15 31.2348 26.038L31.2348 26.038Z"
                                fill="white"
                            />
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-semibold">Ứng tuyển</span>
                        <span class="text-3xl font-semibold text-yellow-500">
                            {{ todayApply || 0 }}
                        </span>
                    </div>
                </div>
                <div class="flex items-center w-1/2 p-4 space-x-1">
                    <div class="p-2 text-pink-500">
                        <svg width="50" height="50" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="20" cy="20" r="20" fill="currentColor" />
                            <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M19.4578 20.547C24.0767 25.1646 25.1246 19.8225 28.0655 22.7614C30.9007 25.5958 32.5303 26.1637 28.9381 29.7549C28.4881 30.1166 25.6292 34.467 15.5822 24.4228C5.53387 14.3773 9.88183 11.5155 10.2435 11.0656C13.8445 7.46445 14.4026 9.1035 17.2378 11.938C20.1787 14.878 14.8389 15.9293 19.4578 20.547Z"
                                fill="white"
                            />
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-semibold">Liên hệ</span>
                        <span class="text-3xl font-semibold text-pink-500">
                            {{ todayContact || 0 }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <iframe
        :src="analyticsEmbedUrl"
        plausible-embed
        scrolling="no"
        frameborder="0"
        loading="lazy"
        style="width: 1px; min-width: 100%; height: 1600px"
    ></iframe> -->
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3'

export default {
    components: {
        Head,
    },
    data() {
        return {
            domain: 'konoikevina.com?auth=zKdTNM-5ObAqm1HLCjtN5',
        }
    },
    computed: {
        analyticsEmbedUrl() {
            return `https://analytics.jamstackvietnam.com/share/${this.domain}&embed=true&theme=light&background=%23f1f5f9`
        },
        todayContact() {
            return this.$page.props.data.today_contact_count
        },
        todayApply() {
            return this.$page.props.data.today_apply_count
        },
    },

    mounted() {
        this.appendAnalyticsScript()
    },

    methods: {
        appendAnalyticsScript() {
            let script = document.createElement('script')
            script.setAttribute('src', 'https://analytics.jamstackvietnam.com/js/embed.host.js')
            script.async = 1
            document.head.appendChild(script)
        },
    },
}
</script>
<style>
.p-component-overlay-enter {
    animation: none !important;
}
</style>
