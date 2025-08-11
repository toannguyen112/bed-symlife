<template>
    <section class="overflow-hidden">
        <div class="marquee">
            <div class="marquee-inner flex items-center space-x-[12px]">
                <div v-for="(item, index) in [...activity, ...activity]" :key="index">
                    <div class="w-full lg:h-[200px] h-[150px] rounded-[18px] overflow-hidden">
                        <JPicture
                            :src="item.image.url"
                            :alt="item.image.alt"
                            class="w-full h-full object-cover object-fit"
                        />
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
    animation: scroll 90s linear infinite;
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
