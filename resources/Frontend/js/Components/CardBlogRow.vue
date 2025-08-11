<template>
    <div v-if="item" class="md:flex items-center max-md:space-y-4 md:space-x-4 group">
        <Link :href="route('posts.show', { slug: item.slug ?? '' })" class="block">
            <div class="aspect-w-1 aspect-h-1 min-w-[280px] rounded-3xl overflow-hidden">
                <img
                    :src="item.image?.url || '/assets/images/cover.jpg'"
                    class="object-cover w-full lg:group-hover:scale-105 lg:duration-150 h-full"
                    :alt="item.alt || item.title"
                />
            </div>
        </Link>
        <div class="space-y-[12px] headline-1 text-primary-100 w-full">
            <div class="px-[10px] rounded-[40px] bg-[#2F49D9] title-3 text-white font-display font-bold w-fit">
                {{ item.category?.title }}
            </div>
            <div class="title-1 font-bold text-[#18191E] font-display line-clamp-2">{{ item.title }}</div>
            <div class="body-1 font-normal text-gray-warm-700 line-clamp-3">
                {{ item.description }}
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        item: {
            type: Object,
            default: () => {},
        },
    },
}
</script>
