<template>
    <section class="h-[300px] md:h-[400px] xl:h-[560px] relative">
        <div class="absolute inset-0 w-full h-full md:block hidden">
            <img :src="image" loading="eager" class="object-cover h-full w-full" :alt="alt" />
        </div>
        <div class="absolute inset-0 w-full h-full md:hidden">
            <img :src="imageMobile || image" loading="eager" class="object-cover h-full w-full" :alt="alt" />
        </div>
        <div class="relative flex items-center justify-center h-full">
            <div class="container">
                <slot></slot>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    props: ['image', 'imageMobile', 'alt'],
}
</script>
