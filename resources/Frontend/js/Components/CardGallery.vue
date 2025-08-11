<template>
    <div class="w-full rounded-3xl border-[6px] border-white relative group">
        <div
            class="absolute top-0 left-0 bg-white rounded-br-[20px] flex items-center gap-x-2 pt-3 px-4 pb-[6px] z-100"
        >
            <img :src="item.icon" class="w-[28px] h-[28px] rounded-full" />
            <p class="label-2 text-gray-warm-700 font-medium font-beau">{{ item.name }}</p>
        </div>
        <div class="rounded-3xl overflow-hidden">
            <img :src="item.image.url" class="w-full" />
        </div>
    </div>
</template>
<script>
export default {
    props: ['item'],
}
</script>
