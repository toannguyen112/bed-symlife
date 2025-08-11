<template>
    <div
        v-for="(item, index) in faqItems"
        :key="index"
        class="p-6 rounded-3xl border-gray-warm-300 bg-white overflow-hidden"
    >
        <div v-if="type === true" class="flex items-center justify-between w-full" @click="toggle(index)">
            <p class="title-2 text-gray-warm-900 font-display font-bold cursor-pointer">
                {{ item.question ?? item.title }}
            </p>
            <div class="duration-300 cursor-pointer" :class="{ 'rotate-180': activeIndex === index }">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    class="transition-transform duration-300 ease-in-out"
                >
                    <path
                        d="M6 9L12 15L18 9"
                        stroke="#A8A29D"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>
            </div>
        </div>
        <div v-else class="flex items-start gap-x-6 w-full">
            <div
                @click="toggle(index)"
                class="duration-300 cursor-pointer w-8 h-8 rounded-lg flex items-center justify-center bg-[#CBFF00]"
            >
                <div class="duration-300 cursor-pointer" :class="{ 'rotate-180': activeIndex === index }">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path
                            d="M18 15L12 9L6 15"
                            stroke="#18191E"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                </div>
            </div>
            <div class="space-y-2 w-[calc(100%-32px)]">
                <p class="title-2 text-gray-warm-900 font-display font-bold">{{ item.question ?? item.title }}</p>
                <div
                    class="faq-content"
                    :ref="`faqContent${index}`"
                    :style="{
                        maxHeight: activeIndex === index ? contentHeights[index] + 'px' : '0',
                        opacity: activeIndex === index ? '1' : '0',
                    }"
                    :class="['transition-all duration-300 ease-out']"
                >
                    <p class="body-1 font-beau text-gray-warm-700 font-normal" v-html="item.answer ?? item.content"></p>
                </div>
            </div>
        </div>
        <div
            v-if="type === true"
            class="faq-content pr-6"
            :ref="`faqContent${index}`"
            :style="{
                maxHeight: activeIndex === index ? contentHeights[index] + 'px' : '0',
                opacity: activeIndex === index ? '1' : '0',
            }"
            :class="['transition-all duration-300 ease-out']"
        >
            <p class="body-1 font-beau text-gray-warm-700 font-normal" v-html="item.answer ?? item.content"></p>
        </div>
    </div>
</template>

<script>
export default {
    props: ['faqItems', 'type'],
    data() {
        return {
            activeIndex: 0,
            contentHeights: [],
        }
    },
    methods: {
        toggle(index) {
            if (this.activeIndex === index) {
                this.activeIndex = 0
            } else {
                this.activeIndex = index
            }
        },
        calculateHeights() {
            this.$nextTick(() => {
                const faqContents = Object.keys(this.$refs).map((ref) => this.$refs[ref][0])
                this.contentHeights = faqContents.map((el) => el.scrollHeight)
            })
        },
    },
    mounted() {
        this.calculateHeights()
    },
    watch: {
        faqItems() {
            this.$nextTick(this.calculateHeights)
        },
        activeIndex() {
            this.calculateHeights()
        },
    },
}
</script>
