<template>
    <main class="overflow-hidden">
        <section
            class="xl:max-h-[723px] lg:max-h-[650px] max-h-[500px] h-[calc(100vh-89px)]"
            v-if="sliders && sliders.length > 0"
        >
            <Hero :slides="sliders" />
        </section>

        <Banner
            v-if="$page.props.data.banner.banner_service"
            :image="$page.props.data.banner.banner_service.image.url"
            :imageMobile="$page.props.data.banner.banner_service.image_mobile.url"
            :alt="$page.props.data.banner.banner_service.title"
        >
            <div>
                <div class="space-y-3 max-w-[470px] w-full text-black-fks">
                    <h1 class="display-2 uppercase font-display">
                        {{ $page.props.data.banner.banner_service.title }}
                    </h1>
                    <p class="body-1 font-beau">
                        {{ $page.props.data.banner.banner_service.description }}
                    </p>
                </div>
            </div>
        </Banner>

        <section v-if="services && services.length" class="md:py-[80px] py-[48px] bg-gray-warm-100 relative z-0">
            <div class="container space-y-20">
                <div class="space-y-8">
                    <div class="relative z-2 grid grid-cols-12 gap-8">
                        <div
                            v-for="(item, index) in services"
                            :key="index"
                            class="col-span-full md:col-span-full rounded-[24px] p-3 border border-gray-300 bg-white group grid grid-cols-12 space-x-8"
                        >
                            <div
                                class="overflow-hidden rounded-[24px] xl:col-span-6 lg:col-span-6 md:col-span-6 xs:col-span-full max-xs:col-span-10"
                            >
                                <JPicture
                                    :src="item.image?.url || '/assets/images/cover.jpg'"
                                    :alt="item.image.alt"
                                    class="picture-cover object-cover object-fit w-full h-full group-hover:scale-[1.05] duration-300"
                                />
                            </div>
                            <div class="pt-6 space-y-4 col-span-6 flex flex-col justify-center max-sm:col-span-10">
                                <p class="headline-1 font-display font-bold text-black-fks">
                                    {{ item.title }}
                                </p>
                                <p class="body-1 text-gray-warm-700 font-normal font-beau line-clamp-3">
                                    {{ item.description }}
                                </p>

                                <Link :href="route('services.show', { slug: item.slug })">
                                    <ButtonService title="Xem thêm" class="w-[117px]" />
                                </Link>
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
    components: {},
    props: ['services'],
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
