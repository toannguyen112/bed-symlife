<template>
    <div v-if="item" class="group">
        <Link
            :href="
                route('posts.show', {
                    slug: item.slug ?? '',
                })
            "
        >
            <div class="w-full overflow-hidden aspect-w-1 aspect-h-1 rounded-[24px]">
                <JPicture
                    :src="item.image?.url || '/assets/images/cover.jpg'"
                    :alt="item.image?.alt"
                    class="w-full h-full object-cover lg:group-hover:scale-105 duration-300 ease-in-out"
                />
            </div>
            <div class="pt-4 space-y-2">
                <div class="px-[10px] rounded-[40px] bg-blue-fks title-3 font-bold text-white font-display w-fit">
                    {{ item.category?.title }}
                </div>
                <p class="title-1 font-display font-bold text-black-fks line-clamp-2">
                    {{ item.title }}
                </p>
                <p class="body-1 text-gray-700 font-normal font-beau line-clamp-3">
                    {{ item.description }}
                </p>
            </div>
        </Link>
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
