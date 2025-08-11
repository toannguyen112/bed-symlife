<template>
    <div
        class="quantity-order h-[52px] md:h-[52px] inline-flex items-center border border-gray-300 rounded-lg bg-white shadow-xs"
        :class="{
            'is-sm': size === 'sm',
        }"
    >
        <button
            @click="changeQuantity({ type: 'minus' })"
            :class="
                isDisableZero &&
                quantity === 1 &&
                'pointer-events-none opacity-50'
            "
            class="inline-flex items-center justify-center flex-shrink-0 btn-minus"
        >
            <IconMinus />
        </button>
        <div class="relative flex-1 h-full py-[1px] input-wrap">
            <input
                type="number"
                ref="inputQuantity"
                inputmode="numeric"
                :value="quantity"
                autocomplete="off"
                @blur="onBlur($event.target.value)"
                onkeypress="return event.charCode >= 48 && event.charCode =< 57"
                onkeydown="return event.keyCode !== 69 && event.keyCode !== 190"
                class="px-[6px] w-full font-medium text-center text-gray-700 label_2 border-none shadow-none outline-none input-number focus:outline-none ring-0 focus:ring-0 leading-[100%] h-full"
                :class="[classInput]"
            />
        </div>

        <button
            @click="changeQuantity({ type: 'plus' })"
            class="flex items-center justify-center flex-shrink-0 w-4 h-4 btn-plus"
        >
            <IconPlus />
        </button>
    </div>
</template>

<script>
export default {
    emits: ["update:quantity"],
    props: {
        size: { type: String, default: "" }, //  is-sm | is-lg
        quantity: {
            type: Number,
            default: 1,
        },
        classInput: {
            type: String,
            default: "",
        },
        isDisableZero: { type: Boolean, default: false },
    },

    methods: {
        changeQuantity({ type = "plus" } = {}) {
            let _quantity = Number(this.quantity);

            if (type === "plus") {
                _quantity++;
            } else {
                _quantity--;
                if (_quantity < 0) return;
            }

            this.$emit("update:quantity", _quantity);
        },
        onBlur(value) {
            let _quantity = Number(value);
            if (_quantity === 0 || _quantity < 0) {
                _quantity = 1;
                this.$refs.inputQuantity.value = _quantity;
            }

            this.$emit("update:quantity", _quantity);
        },
        onChange(value) {
            let _quantity = Number(value);
            if (_quantity === 0 || _quantity < 0) {
                _quantity = 1;
            }
            this.$refs.inputQuantity.blur();
            this.$emit("update:quantity", _quantity);
        },
    },
};
</script>

<style lang="scss" scoped>
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Firefox */
input[type="number"] {
    -moz-appearance: textfield;
}

.quantity-order {
    .btn-minus,
    .btn-plus {
        @apply md:w-[36px] w-[32px] h-full;
    }

    &.is-sm {
        .btn-minus,
        .btn-plus {
            @apply scale-95;
        }
    }
    .input-wrap {
        @apply relative;
        // &::before,
        // &::after {
        //     content: "";
        //     display: block;
        //     width: 1px;
        //     height: 100%;
        //     background-color: #ebeef4;
        //     position: absolute;
        //     top: 50%;
        //     transform: translateY(-50%);
        // }
        // &::before {
        //     left: 0;
        // }
        // &::after {
        //     right: 0;
        // }
    }
}
</style>
