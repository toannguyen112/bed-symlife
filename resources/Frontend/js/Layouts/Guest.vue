<template>
    <div>
        <Header :fullPath="$attrs.route.url" :fullRoute="$attrs.route.name" />
        <slot />
        <Footer />
        <SocialFixed />
    </div>
</template>

<script>
import LoadingPage from '@/Components/LoadingPage.vue'

export default {
    components: {
        LoadingPage,
    },
    data() {
        return {
            isLoading: false, // Mặc định là false, chỉ hiển thị khi cần thiết
        }
    },
    watch: {
        '$page.url': function (newUrl, oldUrl) {
            const seo = this.$page.props?.seo
            const global = this.$page.props?.global

            let seo_meta_title = seo?.seo_meta_title ?? global?.seo_meta_title ?? 'Betech'
            let seo_meta_description = seo?.seo_meta_description ?? global?.seo_meta_description ?? 'Betech'
            let seo_meta_robots = seo?.seo_meta_robots ?? global?.seo_meta_robots ?? 'robots.txt'
            let seo_meta_keywords = seo?.seo_meta_keywords ?? global?.seo_meta_keywords ?? 'Betech'
            let seo_image = seo?.seo_image ?? global?.seo_image ?? '/cover.jpg'

            document.querySelector('title').innerHTML = seo_meta_title
            document.querySelector('meta[property="og:title"]')?.setAttribute('content', seo_meta_title)
            document.querySelector('meta[name="twitter:title"]')?.setAttribute('content', seo_meta_title)

            document.querySelector('meta[name="description"]')?.setAttribute('content', seo_meta_description)
            document.querySelector('meta[property="og:description"]')?.setAttribute('content', seo_meta_description)
            document.querySelector('meta[name="twitter:description"]')?.setAttribute('content', seo_meta_description)

            document.querySelector('meta[name="robots"]')?.setAttribute('content', seo_meta_robots)

            document.querySelector('meta[name="keywords"]')?.setAttribute('content', seo_meta_keywords)

            document
                .querySelector('meta[property="og:image"]')
                ?.setAttribute('content', `${window.location.href}${seo_image}`)

            document.querySelector('meta[property="og:url"]')?.setAttribute('content', window.location.href)
            document.querySelector('link[rel="canonical"]')?.setAttribute('href', window.location.href)
        },
    },
}
</script>

<style>
/* Đảm bảo lớp overflow-hidden ngăn cuộn */
body.overflow-hidden {
    overflow: hidden;
}
</style>
