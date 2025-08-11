<template>
    <div
        @mouseenter="handleMouseEnter"
        @mouseleave="handleMouseLeave"
        class="relative overflow-hidden space-y-5"
        ref="marqueeContainer"
    >
        <div class="box box01 left" ref="marqueeBoxTop">
            <div
                v-for="(itemTop, indexTop) in [...imagesTop, ...imagesTop]"
                :key="`first-${indexTop}`"
                class="item item_child group"
                ref="items"
            >
                <Link
                    :href="
                        route('products.show', {
                            slug: itemTop.slug ?? '',
                        })
                    "
                >
                    <img
                        :src="itemTop.image.url"
                        :alt="itemTop.image.alt"
                        class="object-cover w-full h-full pointer-events-none"
                        draggable="false"
                    />
                </Link>
            </div>
        </div>
    </div>
</template>

<script>
import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'

gsap.registerPlugin(ScrollTrigger)

export default {
    props: {
        imagesTop: {
            type: Array,
            required: true,
            default: () => [],
        },
        imagesBottom: {
            type: Array,
            required: true,
            default: () => [],
        },
    },

    data() {
        return {
            marqueeAnimationTop: null,
            marqueeAnimationBottom: null,
        }
    },

    methods: {
        calculateTotalWidth(ref) {
            if (!this.$refs[ref]) return 0

            const totalWidth = Array.from(this.$refs[ref].children).reduce((acc, item) => {
                const style = window.getComputedStyle(item)
                const marginRight = parseFloat(style.marginRight)
                return acc + item.offsetWidth + marginRight
            }, 0)

            return totalWidth / 2
        },

        initMarquee() {
            this.$nextTick(() => {
                if (this.marqueeAnimationTop) this.marqueeAnimationTop.kill()
                if (this.marqueeAnimationBottom) this.marqueeAnimationBottom.kill()

                const moveWidthTop = this.calculateTotalWidth('marqueeBoxTop')
                const moveWidthBottom = this.calculateTotalWidth('marqueeBoxBottom')

                // Tính toán thời gian dựa trên chiều rộng tổng thể
                const baseSpeed = 50 // pixels per second
                const durationTop = moveWidthTop / baseSpeed
                const durationBottom = moveWidthBottom / baseSpeed

                this.marqueeAnimationTop = gsap.to(this.$refs.marqueeBoxTop, {
                    x: -moveWidthTop,
                    duration: durationTop,
                    ease: 'none',
                    repeat: -1,
                    modifiers: {
                        x: gsap.utils.unitize((x) => parseFloat(x) % moveWidthTop),
                    },
                })

                this.marqueeAnimationBottom = gsap.to(this.$refs.marqueeBoxBottom, {
                    x: -moveWidthBottom,
                    duration: durationBottom,
                    ease: 'none',
                    repeat: -1,
                    modifiers: {
                        x: gsap.utils.unitize((x) => parseFloat(x) % moveWidthBottom),
                    },
                })

                ScrollTrigger.create({
                    trigger: this.$refs.marqueeContainer,
                    start: 'top bottom',
                    end: 'bottom top',
                    onUpdate: (self) => {
                        const scrollVelocity = Math.abs(self.getVelocity() / 1000)
                        const speed = gsap.utils.clamp(0.5, 2, 1 + scrollVelocity)
                        this.marqueeAnimationTop.timeScale(speed)
                        this.marqueeAnimationBottom.timeScale(speed)
                    },
                })
            })
        },

        handleMouseEnter() {
            if (this.marqueeAnimationTop) {
                gsap.to(this.marqueeAnimationTop, { timeScale: 0.3, duration: 0.4, ease: 'power2.out' })
            }
            if (this.marqueeAnimationBottom) {
                gsap.to(this.marqueeAnimationBottom, { timeScale: 0.3, duration: 0.4, ease: 'power2.out' })
            }
        },

        handleMouseLeave() {
            if (this.marqueeAnimationTop) {
                gsap.to(this.marqueeAnimationTop, { timeScale: 1, duration: 0.4, ease: 'power2.in' })
            }
            if (this.marqueeAnimationBottom) {
                gsap.to(this.marqueeAnimationBottom, { timeScale: 1, duration: 0.4, ease: 'power2.in' })
            }
        },

        handleResize() {
            gsap.delayedCall(0.1, this.initMarquee)
        },
    },

    mounted() {
        this.$nextTick(() => {
            this.initMarquee()
            window.addEventListener('resize', this.handleResize)
        })
    },

    beforeDestroy() {
        if (this.marqueeAnimationTop) this.marqueeAnimationTop.kill()
        if (this.marqueeAnimationBottom) this.marqueeAnimationBottom.kill()
        window.removeEventListener('resize', this.handleResize)
    },
}
</script>

<style lang="scss" scoped>
.item {
    @apply flex-shrink-0 w-auto min-w-[276px] h-[276px] relative overflow-hidden rounded-[18px] flex items-center justify-center;
}

.box {
    @apply relative flex items-center space-x-3 lg:space-x-[18px];
    transform: translateZ(0);
}

.box01.left {
    will-change: transform;
    backface-visibility: hidden;
    -webkit-backface-visibility: hidden;
    transform-style: preserve-3d;
}
</style>
