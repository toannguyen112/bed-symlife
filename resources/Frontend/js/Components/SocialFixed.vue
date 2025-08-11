<template>
    <div class="fixed xl:bottom-10 bottom-5 xl:right-[32px] right-4 z-[100] space-y-3 md:space-y-4">
        <a
            href="https://www.facebook.com/messages/t/626963343839860"
            target="_blank"
            rel="noopener noreferrer nofollow"
            class="w-12 h-12 rounded-full flex items-center justify-center"
        >
            <JPicture src="/assets/images/icon-messenger.webp" alt="icon messenger" class="picture-cover" />
        </a>
        <a
            href="https://zalo.me/0977333965"
            target="_blank"
            rel="noopener noreferrer nofollow"
            class="w-12 h-12 rounded-full flex items-center justify-center"
        >
            <JPicture src="/assets/images/icon-zalo.webp" alt="icon zalo" class="picture-cover" />
        </a>
        <a
            href="tel:0977333965"
            rel="noopener noreferrer nofollow"
            class="w-12 h-12 rounded-full flex items-center justify-center bg-red-fks lg:hover:bg-green-fks duration-300 ease-in-out text-green-fks lg:hover:text-black-fks"
        >
            <Phone class="w-8" />
        </a>
        <button
            class="w-[48px] h-[48px] bg-red-fks rounded-full flex items-center justify-center lg:hover:bg-green-fks duration-300 ease-in-out text-white lg:hover:text-black-fks"
            :class="isShowBtn ? 'translate-y-0 opacity-100' : 'translate-y-4 opacity-0'"
            @click="scrollToTop"
        >
            <IconArrowUp class="-rotate-90" />
        </button>
    </div>
</template>
<script>
import Phone from './Icon/Phone.vue'

export default {
    components: { Phone },
    data() {
        return {
            isShowBtn: false,
        }
    },
    mounted() {
        const self = this
        window.addEventListener('scroll', function () {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 500) {
                self.isShowBtn = true
            } else {
                self.isShowBtn = false
            }
        })
    },
    methods: {
        scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth',
            })
        },
    },
}
</script>
