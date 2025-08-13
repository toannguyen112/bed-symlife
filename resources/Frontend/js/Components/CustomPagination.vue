<template>
    <div class="flex justify-center">
        <div
            class="flex items-center justify-center bg-[#0A3C8A] p-2 rounded-full space-x-2 font-display text-[36px] border border-[#1D70C3]"
        >
            <button
                v-for="(item, idx) in total"
                :key="idx"
                @click="onClick(idx)"
                class="w-[56px] h-[56px] rounded-full font-medium flex items-center justify-center transition-all duration-300 p-[10px]"
                :class="active === idx ? 'text-black bg-[#DEA23C]' : 'bg-[#0B2F70] text-white hover:bg-[#133D8F]'"
            >
                {{ (idx + 1).toString().padStart(2, '0') }}
            </button>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        total: { type: Number, default: 5 },
        active: { type: Number, default: 0 },
    },
    emits: ['update:active'],
    methods: {
        onClick(index) {
            this.$emit('update:active', index)
        },
    },
}
</script>
