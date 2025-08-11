<template>
    <section v-if="activity && activity.length" class="overflow-hidden">
        <div class="marquee-resources">
            <div class="marquee-inner flex items-center gap-x-4">
                <div
                    v-for="(item, index) in [...activity, ...activity, ...activity]"
                    :key="index"
                    class="w-[280px] p-3 bg-white border border-black rounded-3xl space-y-3"
                >
                    <CardResources :item="item" />
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
.marquee-resources {
    display: flex;
    flex-wrap: nowrap;
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
