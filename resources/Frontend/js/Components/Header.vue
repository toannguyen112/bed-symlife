<template>
    <header class="fixed top-0 inset-x-0 w-full shadow-md bg-[#082680] text-white z-[2]">
        <div class="relative">
            <div class="container flex justify-between items-center py-3 px-4">
                <!-- Logo -->
                <div class="flex items-center space-x-4">
                    <Link :href="route('home')" class="btnlogo">
                        <img src="/assets/images/logo-white.png" alt="Logo" width="122" height="55" />
                    </Link>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-4">
                    <!-- Giới thiệu -->
                    <div class="relative group pointer-events-auto">
                        <div class="cursor-pointer px-4 hover:text-blue-400">Giới thiệu</div>
                        <div
                            class="absolute left-0 mt-[-2px] top-full bg-white text-black shadow-lg rounded p-3 w-56 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition"
                        >
                            <ul class="space-y-2">
                                <li v-for="(item, index) in $page.props.data.post_about" :key="index">
                                    <Link
                                        :href="route('posts.show', item.slug)"
                                        class="hover:text-blue-600 text-gray-700"
                                    >
                                        {{ item.title }}
                                    </Link>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Máy lạnh -->
                    <div class="relative group pointer-events-auto">
                        <div class="cursor-pointer px-4 hover:text-blue-400">Máy lạnh</div>
                        <div
                            class="absolute left-0 mt-[-2px] top-full bg-white text-black shadow-lg rounded p-3 w-56 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition"
                        >
                            <ul class="space-y-2">
                                <li v-for="(item, index) in $page.props.data.post_maylanh" :key="index">
                                    <Link
                                        :href="route('posts.show', item.slug)"
                                        class="hover:text-blue-600 text-gray-700"
                                    >
                                        {{ item.title }}
                                    </Link>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Điện lạnh công nghiệp -->
                    <div class="relative group pointer-events-auto">
                        <div class="cursor-pointer px-4 hover:text-blue-400">Điện lạnh công nghiệp</div>
                        <div
                            class="absolute left-0 mt-[-2px] top-full bg-white text-black shadow-lg rounded p-3 w-64 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition"
                        >
                            <ul class="space-y-2">
                                <li v-for="(item, index) in $page.props.data.post_dien_lanh_cong_nghiep" :key="index">
                                    <Link
                                        :href="route('posts.show', item.slug)"
                                        class="hover:text-blue-600 text-gray-700"
                                    >
                                        {{ item.title }}
                                    </Link>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Dịch vụ khác -->
                    <div class="relative group pointer-events-auto">
                        <div class="cursor-pointer px-4 hover:text-blue-400">Dịch vụ khác</div>
                        <div
                            v-if="$page.props.data.post_service && $page.props.data.post_service.length"
                            class="absolute left-0 mt-[-2px] top-full bg-white text-black shadow-lg rounded p-3 w-56 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition"
                        >
                            <ul class="space-y-2">
                                <li v-for="(item, index) in $page.props.data.post_service" :key="index">
                                    <Link
                                        :href="route('posts.show', item.slug)"
                                        class="hover:text-blue-600 text-gray-700"
                                    >
                                        {{ item.title }}
                                    </Link>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Kinh nghiệm sử dụng -->
                    <Link :href="route('posts')" class="hover:text-blue-400 transition"> Kinh nghiệm sử dụng </Link>
                    <Link :href="route('members.index')" class="hover:text-blue-400 transition">
                        Nhật ký thi công
                    </Link>
                </div>

                <!-- Mobile Hamburger -->
                <div class="md:hidden">
                    <button @click="isMobileMenuOpen = !isMobileMenuOpen">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                        </svg>
                    </button>
                </div>

                <!-- Contact -->
                <div class="hidden md:flex items-center space-x-2">
                    <i class="icV2-tel text-blue-500"></i>
                    <a href="tel:0977333965" class="hover:text-blue-400">
                        <strong>0977333965</strong>
                        <span class="block text-xs">(8h00 - 21h00)</span>
                    </a>
                </div>
            </div>
            <!-- Mobile Menu -->
            <transition name="slide-fade">
                <div
                    v-if="isMobileMenuOpen"
                    class="container md:hidden fixed inset-x-0 py-2 top-[78px] bottom-0 bg-white text-gray-700 shadow-lg overflow-y-auto z-50"
                >
                    <ul class="space-y-4">
                        <li>
                            <strong>Giới thiệu</strong>
                            <ul class="ml-4 text-sm space-y-2">
                                <li v-for="(item, index) in $page.props.data.post_about" :key="index">
                                    <Link
                                        @click="isMobileMenuOpen = false"
                                        :href="route('posts.show', item.slug)"
                                        class="hover:text-blue-600"
                                        >{{ item.title }}</Link
                                    >
                                </li>
                            </ul>
                        </li>
                        <li>
                            <strong>Máy lạnh</strong>
                            <ul class="ml-4 text-sm space-y-2">
                                <li v-for="(item, index) in $page.props.data.post_maylanh" :key="index">
                                    <Link
                                        @click="isMobileMenuOpen = false"
                                        :href="route('posts.show', item.slug)"
                                        class="hover:text-blue-600"
                                        >{{ item.title }}</Link
                                    >
                                </li>
                            </ul>
                        </li>
                        <li>
                            <strong>Điện lạnh công nghiệp</strong>
                            <ul class="ml-4 text-sm space-y-2">
                                <li v-for="(item, index) in $page.props.data.post_dien_lanh_cong_nghiep" :key="index">
                                    <Link
                                        @click="isMobileMenuOpen = false"
                                        :href="route('posts.show', item.slug)"
                                        class="hover:text-blue-600"
                                        >{{ item.title }}</Link
                                    >
                                </li>
                            </ul>
                        </li>
                        <li>
                            <strong>Dịch vụ khác</strong>
                            <ul
                                v-if="$page.props.data.post_service && $page.props.data.post_service.length"
                                class="ml-4 text-sm space-y-2"
                            >
                                <li v-for="(item, index) in $page.props.data.post_service" :key="index">
                                    <Link
                                        @click="isMobileMenuOpen = false"
                                        :href="route('posts.show', item.slug)"
                                        class="hover:text-blue-600"
                                        >{{ item.title }}</Link
                                    >
                                </li>
                            </ul>
                        </li>
                        <li>
                            <strong>
                                <Link
                                    @click="isMobileMenuOpen = false"
                                    :href="route('posts')"
                                    class="hover:text-blue-600"
                                    >Kinh nghiệm sử dụng</Link
                                >
                            </strong>
                        </li>
                        <li>
                            <strong>
                                <Link
                                    @click="isMobileMenuOpen = false"
                                    :href="route('members.index')"
                                    class="hover:text-blue-600"
                                    >Nhật ký thi công</Link
                                >
                            </strong>
                        </li>
                        <li>
                            <a href="tel:0977333965" class="block text-blue-600 font-bold">Gọi: 0977333965</a>
                        </li>
                    </ul>
                </div>
            </transition>
        </div>
    </header>
</template>

<script >
export default {
    data() {
        return {
            isMobileMenuOpen: false,
        }
    },
    watch: {
        isMobileMenuOpen(isOpen) {
            if (isOpen) {
                document.body.classList.add('overflow-hidden')
            } else {
                document.body.classList.remove('overflow-hidden')
            }
        },
    },
    data() {
        return {
            isMobileMenuOpen: false,
        }
    },
    beforeDestroy() {
        document.body.classList.remove('overflow-hidden')
    },
}
</script>
<style lang="scss" scoped>
.slide-fade-enter-active {
    @apply transition duration-300 ease-out;
}
.slide-fade-leave-active {
    @apply transition duration-200 ease-in;
}
.slide-fade-enter-from {
    opacity: 0;
    transform: translateY(-10px);
}
.slide-fade-enter-to {
    opacity: 1;
    transform: translateY(0);
}
.slide-fade-leave-from {
    opacity: 1;
    transform: translateY(0);
}
.slide-fade-leave-to {
    opacity: 0;
    transform: translateY(-10px);
}

/* Menu link styling (optional, for consistency) */
.menu-link {
    @apply flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-100 transition-colors;
}
</style>
