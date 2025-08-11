<template>
    <fieldset>
        <div
            v-if="
                field.type === 'text' ||
                field.type === 'email' ||
                field.type === 'password' ||
                field.type === 'textarea' ||
                field.type === 'number' ||
                field.type === 'select_single' ||
                field.type === 'select_administrative'
            "
        >
            <div class="relative">
                <JamField
                    :field="field"
                    :isFooter="isFooter"
                    :validate="validate"
                    :modelValue="modelValue"
                    :rows="field.rows"
                    :isContact="isContact"
                    :isPopup="isPopup"
                    @action="$emit('action')"
                    @update:modelValue="$emit('update:modelValue', $event)"
                />
                <small
                    v-if="validate !== true && validate !== undefined"
                    class="absolute -bottom-1 text-red-600 translate-y-full leading-[100%]"
                >
                    {{ Array.isArray(error) ? error[0] : `${field.errorText}` }}
                </small>
            </div>
        </div>

        <div v-if="field.type === 'radio' || field.type === 'radio_custom'">
            <JamField :field="field" :modelValue="modelValue" @update:modelValue="$emit('update:modelValue', $event)" />
        </div>

        <div v-if="field.type === 'radio_control'">
            <JamField v-model="model" :field="field" />
        </div>

        <div v-if="field.type === 'media_upload'">
            <JamField :value="value" @changeImages="changeImage" @input="(val) => (model = val)" :field="field" />
            <small
                v-if="validate !== true && validate !== undefined"
                :class="field.type === 'media_upload' || field.type === 'textarea' ? '' : 'mt-[6px]'"
                class="absolute text-red-600 description"
            >
                {{ validate === false ? `${label} ${tt('không hợp lệ.')}` : validate }}
            </small>
        </div>
    </fieldset>
</template>

<script>
import { validateField } from '../../validator'
import JamField from '../Jam/Field.vue'
export default {
    props: [
        'field',
        'classGrid',
        'classCol',
        'modelValue',
        'isSubmit',
        'isFooter',
        'isPopup',
        'isProduct',
        'isContact',
    ],
    components: { JamField },
    emits: ['update:modelValue', 'setIsSubmit', 'input', 'changeImages'],
    data() {
        return {
            model: this.modelValue,
            validate: this.field.validate === false ? this.field.validate : true,
            label: this.field.name ? this.field.name.replace('<br />', '') : '',
        }
    },
    computed: {
        error() {
            return this.field.fieldName ? this.field.errors[this.field.fieldName] : ''
        },
    },
    created() {
        this.checkValidate()
    },
    watch: {
        'field.validate'(newVal) {
            this.validate = newVal
        },
        model(value) {
            if (this.isSubmit) {
                this.$emit('setIsSubmit', false)
                return
            } else {
                this.validate = validateField(this.modelValue, this.field.rules[this.field.fieldName])
                this.$emit('input', this.modelValue)
            }
        },
        error() {
            this.checkValidate()
        },
        modelValue(value) {
            this.model = value
        },
    },
    methods: {
        changeImage(value) {
            this.$emit('changeImages', value)
        },
        checkValidate() {
            this.validate = !this.field.errors.hasOwnProperty(this.field.fieldName)
        },
    },
}
</script>
