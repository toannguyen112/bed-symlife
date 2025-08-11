<template>
    <main class="bg-gray-100">
        <section class="pt-[84px] md:pt-[100px] lg:pt-[120px] xl:pt-[160px] pb-10 md:pb-14 xl:pb-20">
            <div class="container">
                <div class="grid grid-cols-12 gap-y-4 md:gap-y-6 xl:gap-y-8 md:gap-x-6 xl:gap-x-10">
                    <div
                        class="xl:col-span-8 xl:col-start-3 space-y-3 text-center md:col-span-10 md:col-start-2 col-span-full"
                    >
                        <div
                            class="w-fit px-[10px] rounded-full bg-[#2F49D9] title-3 font-bold text-white font-display mx-auto"
                        >
                            {{ post.category?.title }}
                        </div>
                        <h1 class="display-3 font-bold font-display text-black-fks">
                            {{ post.title }}
                        </h1>
                        <div class="body-1 text-black-fks font-beau">{{ post.description }}</div>
                    </div>
                    <div class="col-span-full grid grid-cols-4 md:gap-[24px] gap-[12px]">
                        <div v-for="(item, index) in post.images" class="col-span-2 md:col-span-1">
                            <div class="aspect-w-2 aspect-h-1 min-h-[252px] cursor-pointer" @click="openModal(index)">
                                <JPicture
                                    :src="item?.url || '/assets/images/cover.webp'"
                                    :alt="item?.alt || item.title"
                                    class="object-cover w-full h-full"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="col-span-full md:col-span-8 lg:col-span-9 xl:col-span-7">
                        <div class="prose" v-html="post.content"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Modal overlay -->
        <transition name="fade">
            <div v-if="showModal" class="fixed inset-0 z-50 flex items-center justify-center" @click.self="closeModal">
                <!-- Black background full screen -->
                <div class="absolute inset-0 bg-black-fks opacity-80 z-0"></div>

                <!-- Modal content -->
                <div class="relative z-10 w-full px-4 animate-scale">
                    <div class="relative rounded-lg overflow-hidden shadow-xl flex items-center justify-center h-full">
                        <div class="flex items-center justify-center">
                            <img
                                :src="currentImage?.url"
                                :alt="currentImage?.alt || 'Image'"
                                class="object-contain w-[1280px] h-[853px]"
                            />
                        </div>

                        <!-- Close button -->
                        <button
                            @click="closeModal"
                            class="absolute top-2 right-2 bg-black-fks text-white w-[40px] h-[40px] bg-black rounded-full p-2 hover:bg-gray-800 z-20 flex items-center justify-center"
                        >
                            <p>✕</p>
                        </button>

                        <!-- Prev button -->
                        <button
                            @click="prevImage"
                            class="absolute top-1/2 left-2 transform -translate-y-1/2 bg-black-fks text-white w-[40px] h-[40px] bg-black rounded-full p-2 hover:bg-gray-800 z-20 flex items-center justify-center"
                        >
                            <p>‹</p>
                        </button>

                        <!-- Next button -->
                        <button
                            @click="nextImage"
                            class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-black-fks text-white w-[40px] h-[40px] bg-black rounded-full p-2 hover:bg-gray-800 z-20 flex items-center justify-center"
                        >
                            <p>›</p>
                        </button>
                    </div>
                </div>
            </div>
        </transition>
    </main>
</template>

<script>
export default {
    props: ['post'],
    data() {
        return {
            showModal: false,
            currentIndex: 0,
        }
    },
    computed: {
        currentImage() {
            return this.post.images[this.currentIndex] || {}
        },
    },
    methods: {
        openModal(index) {
            this.currentIndex = index
            this.showModal = true
            document.addEventListener('keydown', this.handleKeyDown)
        },
        closeModal() {
            this.showModal = false
            document.removeEventListener('keydown', this.handleKeyDown)
        },
        nextImage() {
            this.currentIndex = (this.currentIndex + 1) % this.post.images.length
        },
        prevImage() {
            this.currentIndex = (this.currentIndex - 1 + this.post.images.length) % this.post.images.length
        },
        handleKeyDown(e) {
            if (e.key === 'Escape') {
                this.closeModal()
            } else if (e.key === 'ArrowRight') {
                this.nextImage()
            } else if (e.key === 'ArrowLeft') {
                this.prevImage()
            }
        },
    },
    beforeUnmount() {
        document.removeEventListener('keydown', this.handleKeyDown)
    },
}
</script>
<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

.animate-scale {
    animation: scaleIn 0.3s ease;
}

@keyframes scaleIn {
    0% {
        transform: scale(0.9);
        opacity: 0;
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}
</style>

