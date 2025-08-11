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
                        <div class="body-1 text-black-fks font-beau prose" v-html="post.description"></div>
                    </div>
                    <div class="col-span-full">
                        <div class="rounded-3xl overflow-hidden">
                            <div class="aspect-w-2 aspect-h-1">
                                <JPicture
                                    :src="post.banner?.url || '/assets/images/cover.webp'"
                                    :alt="post.banner?.alt || post.title"
                                    class="object-cover w-full h-full"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="xl:col-span-3 xl:col-start-2 col-span-full md:col-span-4 lg:col-span-3">
                        <div class="md:sticky md:top-28">
                            <TOC :content="post.content" />
                        </div>
                    </div>
                    <div class="col-span-full md:col-span-8 lg:col-span-9 xl:col-span-7">
                        <div class="prose" v-html="post.content"></div>
                    </div>
                </div>
            </div>
        </section>

        <section v-if="related_posts && related_posts.length > 0">
            <div class="container py-12 grid grid-cols-12 max-md:pt-5 relative">
                <div class="col-span-full flex justify-between">
                    <p class="display-3 text-black-fks font-display font-bold">Các bài viết liên quan</p>
                </div>
                <div class="col-span-full mt-8 max-md:mt-4">
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 grid-cols-1 gap-y-4 md:gap-[28px]">
                        <div
                            v-for="(item, index) in related_posts.slice(0, 3)"
                            :key="index"
                            class="md:col-span-1 col-span-1 rounded-2xl border border-gray-warm-300 bg-white p-3"
                        >
                            <CardBlog :item="item" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>

<script>
export default {
    props: ['related_posts', 'post'],
    components: {},
    data() {
        const homeBreadcrumb = { name: 'Trang chủ', url: '/' }
        let breadcrumbs = [homeBreadcrumb]

        if (this.post?.type === 'POST') {
            breadcrumbs.push(
                {
                    name: this.post.category?.title,
                    url: this.route('posts.categories', {
                        categorySlug: this.post.category?.slug,
                    }),
                },
                { name: this.post.title }
            )
        }

        return { breadcrumbs, activeText: '', collapseActive: false }
    },
    methods: {},

    mounted() {
        window.addEventListener('scroll', this.handleScroll)
    },
}
</script>
<style lang="scss" scoped></style>
