<template>
    <div
        class="inline-block group duration-300 transition transform-gpu btn btn-download cursor-pointer"
        :aria-label="title"
        tabindex="-1"
    >
        <div class="overflow-hidden w-full h-full">
            <div
                class="relative z-20 px-5 w-full h-full text-sm/none font-semibold xl:text-base/none text-center duration-300 transition-transform group-hover:-translate-y-full group-focus-visible:-translate-y-full"
            >
                <div class="flex items-center justify-center h-full duration-500 opacity-100 transition-opacity group-hover:opacity-0 group-focus-visible:opacity-0 text-green-fks">{{ title }}</div>
                <div class="flex items-center justify-center absolute top-0 left-0 w-full h-full translate-y-full duration-500 opacity-0 transition-opacity group-hover:opacity-100 group-focus-visible:opacity-100 text-black-fks">{{ title }}</div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["title"]
}
</script>
