<template>
    <section class="overflow-hidden">
        <div class="marquee">
            <div class="marquee-inner flex items-center space-x-[32px]">
                <div v-for="(item, index) in [...activity, ...activity]" :key="index" class="min-w-[640px]">
                    <div class="w-full h-[480px] rounded-[24px] overflow-hidden">
                        <a target="_blank" :href="item.link" class="cursor-pointer"
                            ><img :src="item.image.url" :alt="item.image.alt" class="w-full h-full object-cover"
                        /></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    props: {
        activity: {
            type: Array,
            required: true,
        },
    },
}
</script>

<style scoped>
.marquee {
    overflow: hidden;
    white-space: nowrap;
    position: relative;
}

.marquee-inner {
    display: flex;
    animation: scroll 20s linear infinite;
}

@keyframes scroll {
    from {
        transform: translateX(0);
    }
    to {
        transform: translateX(-100%);
    }
}
</style>
