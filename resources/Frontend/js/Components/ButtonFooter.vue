<template>
    <div
        class="inline-block group duration-300 transition transform-gpu btn btn-footer cursor-pointer !h-11"
        :aria-label="title"
        tabindex="-1"
    >
        <div class="overflow-hidden w-full h-full flex items-center space-x-1">
            <div
                class="relative z-20 w-full h-full text-center duration-300 transition-transform group-hover:-translate-y-full group-focus-visible:-translate-y-full"
            >
                <div
                    class="flex items-center justify-center h-full duration-500 opacity-100 transition-opacity group-hover:opacity-0 group-focus-visible:opacity-0 text-gray-warm-700"
                >
                    {{ title }}
                </div>
                <div
                    class="flex items-center justify-center absolute top-0 left-0 w-full h-full translate-y-full duration-500 opacity-0 transition-opacity group-hover:opacity-100 group-focus-visible:opacity-100 text-gray-warm-700"
                >
                    {{ title }}
                </div>
            </div>
            <i class="gg-spinner" v-if="isLoading"></i>
            <IconDoubleArrow v-else class="w-7 h-7 text-red-fks"/>
        </div>
    </div>
</template>

<script>
export default {
    props: ['title', 'isLoading'],
}
</script>
