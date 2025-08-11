<template>
    <section>
        <div v-if="check === true" class="h-[280px] md:h-[400px] xl:h-[560px] relative">
            <img :src="image" loading="eager" class="object-cover h-full w-full" :alt="tt('')" />
            <div class="absolute z-10 w-full top-0 h-full container flex items-center justify-end">
                <div class="flex items-center justify-end">
                    <div class="space-y-6 max-w-[388px]">
                        <h1 :class="['headline-2', 'font-bold', 'font-display', textColorClass]">{{ title }}</h1>
                        <p :class="['body-1', 'font-normal', 'font-beau', textColorClass]">{{ desc }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div v-else class="h-[280px] md:h-[400px] xl:h-[560px] relative">
            <img :src="image" loading="eager" class="object-cover h-full w-full" :alt="tt('')" />
            <div class="absolute z-10 container inset-x-0 top-1/2 -translate-y-1/2 h-fit">
                <div class="space-y-3 max-w-[470px]">
                    <h1 :class="['display-2', 'font-bold', 'font-display', textColorClass]">{{ title }}</h1>
                    <p :class="['body-1', 'font-normal', 'font-beau', textColorClass]">{{ desc }}</p>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    props: ['title', 'desc', 'image', 'color', 'check'],
    computed: {
        textColorClass() {
            return this.color ? `text-[${this.color}]` : 'text-white'
        },
    },
}
</script>
