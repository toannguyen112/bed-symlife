<template>
    <button
        class="px-[18px] py-[10px] h-[44px] rounded-xl border border-gray-warm-300 bg-white w-fit flex items-center gap-x-2"
    >
        <span class="button-1 font-bold font-display text-gray-warm-700">{{ tt(title) }}</span>
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
            <path
                d="M5 14.1666L9.16667 9.99992L5 5.83325M10.8333 14.1666L15 9.99992L10.8333 5.83325"
                stroke="#D34000"
                stroke-width="1.66667"
                stroke-linecap="round"
                stroke-linejoin="round"
            />
        </svg>
    </button>
</template>
<script>
export default {
    props: ['title'],
}
</script>
