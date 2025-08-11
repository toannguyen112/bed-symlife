<template>
    <main class="overflow-hidden">
        <section
            class="xl:max-h-[723px] lg:max-h-[650px] max-h-[500px] h-[calc(100vh-89px)]"
            v-if="sliders && sliders.length > 0"
        >
            <Hero :slides="sliders" />
        </section>
        <Banner
            v-if="$page.props.data.banner.banner_course"
            :image="$page.props.data.banner.banner_course.image.url"
            :imageMobile="$page.props.data.banner.banner_course.image_mobile.url"
            :alt="$page.props.data.banner.banner_course.title"
        >
            <div>
                <div class="space-y-3 max-w-[470px] w-full text-white">
                    <h1 class="display-2 uppercase font-display">
                        {{ $page.props.data.banner.banner_course.title }}
                    </h1>
                    <p class="body-1 font-beau">
                        {{ $page.props.data.banner.banner_course.description }}
                    </p>
                </div>
            </div>
        </Banner>

        <section class="md:py-[80px] py-[48px] bg-gray-warm-100 relative">
            <div class="absolute left-0 top-0 max-w-[400px] xl:max-w-[546px] w-full mix-blend-exclusion">
                <img src="/assets/images/shape-courses-top.webp" alt="shape courses top" class="w-full h-full" />
            </div>
            <div
                class="absolute top-1/2 -translate-y-1/2 right-0 max-w-[300px] xl:max-w-[534px] w-full mix-blend-exclusion"
            >
                <img src="/assets/images/shape-courses-bottom.webp" alt="shape courses bottom" class="w-full h-full" />
            </div>
            <div v-if="categories && categories.length" class="relative">
                <div class="container space-y-20">
                    <div v-for="(item, index) in categories" :key="index" class="space-y-8">
                        <p class="display-3 text-[#18191E] font-bold font-display uppercase">{{ item.title }}</p>
                        <div class="relative z-2 md:grid md:grid-cols-2 xl:grid-cols-3 space-y-4 lg:gap-6 xl:gap-8">
                            <div v-for="(item, index) in item.courses" :key="index">
                                <CardCourse :course="item" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>
<script>
export default {
    props: ['categories'],
    data() {
        return {}
    },
}
</script>
<style scoped>
.bg-about {
    border-bottom: 1px solid #dde1e6;
    background: linear-gradient(180deg, #fff 0%, rgba(255, 255, 255, 0) 100%),
        url('/public/assets/images/shap-banner.png') repeat;
}
.shape-top-course {
    display: flex;
    padding: 0px 0.047px 0.058px 0px;
    flex-direction: column;
    align-items: center;
    mix-blend-mode: exclusion;
}
</style>
