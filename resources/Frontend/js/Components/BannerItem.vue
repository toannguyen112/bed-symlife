<template>
    <div
        class="wp-image-2359 _image-home-bottom glow-float flex flex-col items-center space-y-4 transform absolute md:left-1/2 top-1/4 max-md:left-0"
    >
        <!-- Hình 1 -->
        <img
            fetchpriority="high"
            decoding="async"
            class="w-full h-full md:max-w-[947px] md:h-auto"
            src="https://duansymlife.com/wp-content/uploads/2025/07/title.png"
            alt="title"
        />

        <!-- Hình 2 -->
        <img
            decoding="async"
            class="w-full h-full md:max-w-[947px] md:h-auto transform transition duration-300 hover:scale-105"
            src="https://duansymlife.com/wp-content/uploads/2025/07/gia.png"
            alt="gia"
        />
    </div>
</template>

<script>
export default {
    name: 'HomeBottomImages',
}
</script>

<style scoped>
.glow-float {
    animation: float 4s ease-in-out infinite;
}
@keyframes float {
    0% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-10px);
    }
    100% {
        transform: translateY(0px);
    }
}
</style>
