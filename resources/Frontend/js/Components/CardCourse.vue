<template>
    <div v-if="course" class="group">
        <div
            class="rounded-3xl p-3 border border-gray-300 bg-white lg:group-hover:-translate-y-5 duration-300 ease-in-out block lg:group-hover:bg-blue-fks"
        >
            <div class="block w-full overflow-hidden rounded-3xl aspect-w-1 aspect-h-1">
                <JPicture
                    :src="course.image?.url || '/assets/images/cover.jpg'"
                    :alt="course.alt || course.title"
                    class="picture-cover w-full h-full group-hover:scale-[1.05] duration-300 object-fit object-cover"
                />
            </div>
            <div class="pt-6 space-y-4">
                <div class="block">
                    <h4
                        class="title-1 font-display font-bold text-blue-fks lg:group-hover:text-white duration-300 ease-in-out"
                    >
                        {{ course.title }}
                    </h4>
                </div>
                <div
                    v-show="!isHome"
                    class="body-1 font-normal font-beau lg:flex justify-start lg:space-y-0 space-y-2 lg:space-x-10 xl:space-x-14 lg:group-hover:text-white duration-300 ease-in-out"
                >
                    <div class="flex space-x-2 items-center">
                        <JPicture src="/assets/svg/clock.svg" alt="time-icon" />
                        <span>{{ course.number_of_course }}</span>
                    </div>
                    <div class="flex space-x-2 items-center">
                        <JPicture src="/assets/svg/calendar.svg" alt="calendar-icon" />
                        <span>{{ course.timetable }}</span>
                    </div>
                </div>
                <div
                    class="body-1 text-gray-700 font-normal font-beau line-clamp-3 md:min-h-[72px] lg:group-hover:text-white duration-300 ease-in-out"
                >
                    {{ course.description }}
                </div>
                <div
                    v-show="!isHome"
                    v-if="course.schedule && course.schedule.length > 0"
                    class="bg-gray-warm-100 p-2 space-y-[12px] whitespace-nowrap overflow-x-auto min-h-[72px] md:max-h-[76px] overflow-y-auto rounded"
                >
                    <div v-for="(element, index) in course.schedule" :key="index">
                        <div class="flex justify-between font-beau">
                            <div class="body-1 text-gray-700 font-normal">
                                {{ element.day }}
                            </div>
                            <div class="flex items-center">
                                <div v-for="(i, index) in element.types" :key="index" class="body-2">
                                    <span class="px-3 body-2 py-[2px] rounded-full mr-1" :class="getStatusColor(i.id)">
                                        {{ i.title }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <Link
                    :href="
                        route('posts.show', {
                            slug: course.slug ?? '',
                        })
                    "
                >
                    <div
                        class="duration-300 transition transform-gpu cursor-pointer w-full px-[18px] py-[10px] bg-white border border-gray-300 rounded-xl button-1 font-display font-bold text-gray-700 uppercase block text-center lg:group-hover:bg-green-fks lg:group-hover:border-green-fks"
                        tabindex="-1"
                    >
                        <div class="overflow-hidden w-full h-full">
                            <div
                                class="relative z-20 w-full h-full text-sm/none font-semibold xl:text-base/none text-center duration-300 transition-transform group-hover:-translate-y-full group-focus-visible:-translate-y-full"
                            >
                                <div
                                    class="flex items-center justify-center h-full duration-500 opacity-100 transition-opacity group-hover:opacity-0 group-focus-visible:opacity-0 text-gray-700"
                                >
                                    Chi tiết
                                </div>
                                <div
                                    class="flex items-center justify-center absolute top-0 left-0 w-full h-full translate-y-full duration-500 opacity-0 transition-opacity group-hover:opacity-100 group-focus-visible:opacity-100 text-gray-700"
                                >
                                    Chi tiết
                                </div>
                            </div>
                        </div>
                    </div>
                </Link>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        course: {
            type: Object,
            default: () => {},
        },
        isHome: {
            type: Boolean,
            default: false,
        },
    },
    methods: {
        getStatusColor(status) {
            switch (status) {
                case 'Online':
                    return 'bg-red-fks text-gray-100' // Màu xanh lá
                case 'Offline':
                    return 'bg-blue-fks text-gray-100' // Màu đỏ
                case 'Full':
                    return 'bg-gray-warm-300 px-[18px]' // Màu vàng
                case 'Open':
                    return 'bg-green-fks' // Màu xanh dương
                default:
                    return 'bg-gray-500' // Mặc định
            }
        },
    },
}
</script>
