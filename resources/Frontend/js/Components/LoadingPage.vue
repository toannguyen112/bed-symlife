<template>
    <div className="fixed inset-0 bg-blue-fks backdrop-blur-sm z-[9999] flex items-center justify-center">
        <div className="flex flex-col items-center justify-center space-y-10">
            
            <div class="xl:w-[400px] md:w-[350px] w-[300px] flex items-center justify-center">
                <JPicture src="/assets/images/header/logo.png" alt="logo" />
            </div>
            <div class="progress-bar-container">
                <div class="progress-bar"></div>
            </div>
        </div>
    </div>
</template>
<style lang="scss" scoped>
.progress-bar-container {
    @apply w-[300px] h-[12px] bg-red-fks rounded-full overflow-hidden;
}

.progress-bar {
    @apply h-full bg-green-fks rounded-full;
    width: 0%;
    animation: progress 2s linear forwards;
}

@keyframes progress {
    0% {
        width: 0%;
    }
    100% {
        width: 100%;
    }
}
</style>