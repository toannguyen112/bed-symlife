<template>
    <div>
        <div class="py-3 pl-2 pr-2 mt-3 bg-gray-100 rounded-lg xl:pl-4 md:pl-3 xl:pr-6 md:pr-3">
            <div class="mb-2 text-gray-900 title-3 xl:mb-4 md:mb-3 max-md:hidden">{{ tt('Ứng tuyển trực tiếp') }}</div>
            <div class="mb-2 text-gray-900 title-2 xl:mb-4 md:mb-3 md:hidden">{{ tt('Ứng tuyển trực tiếp') }}</div>
            <div class="mb-4 space-y-4 xl:mb-6 md:mb-5">
                <JamFieldSet
                    v-model="form.contact.data['Họ và tên']"
                    :field="{
                        rules: rules,
                        errors: errors,
                        type: 'text',
                        placeholder: tt('Nhập họ và tên'),
                        name: 'Họ và tên',
                        fieldName: 'Họ và tên',
                        label: tt('Form job name'),
                        errorText: tt('Form job error name'),
                    }"
                    :isSubmit="isSubmit"
                    @setIsSubmit="setIsSubmit"
                    :isContact="true"
                />
                <div class="grid md:grid-cols-2 grid-cols-1 xl:gap-x-5 md:gap-x-3.5 max-md:gap-y-5">
                    <JamFieldSet
                        v-model="form.contact.data['Phone']"
                        :field="{
                            rules: rules,
                            errors: errors,
                            type: 'number',
                            placeholder: tt('Nhập số điện thoại'),
                            name: 'Phone',
                            fieldName: 'Phone',
                            label: tt('Form job phone'),
                            errorText: tt('Form job error phone'),
                        }"
                        :isSubmit="isSubmit"
                        @setIsSubmit="setIsSubmit"
                        :isContact="true"
                    />
                    <JamFieldSet
                        v-model="form.contact.data['Email']"
                        :field="{
                            rules: rules,
                            errors: errors,
                            type: 'email',
                            placeholder: tt('Nhập email'),
                            name: 'Email',
                            fieldName: 'Email',
                            label: tt('Form job email'),
                            errorText: tt('Form job error email'),
                        }"
                        :isSubmit="isSubmit"
                        @setIsSubmit="setIsSubmit"
                        :isContact="true"
                    />
                </div>
                <div class="col-span-full">
                    <div class="text-gray-700 label-2 lg:mb-1.5 mb-1">
                        {{ tt('Chọn file') }}<span class="text-red-600">*</span>
                    </div>
                    <button
                        @click="onClickInputFileUpload()"
                        class="relative block w-full py-2.5 px-3.5 h-[44px] overflow-hidden border border-gray-300 rounded-lg outline-none ring-0 upload-btn bg-white"
                    >
                        <div class="flex items-center space-x-1 md:space-x-2">
                            <div>
                                <UploadCloud class="w-5 h-5" />
                            </div>
                            <div
                                class="hidden body-1 lg:line-clamp-1 lg:block"
                                :class="fileCV?.name ? 'text-gray-900' : 'text-gray-500'"
                            >
                                {{ fileCV?.name || tt('Bấm vào đây để tải lên Hồ sơ/CV từ máy tính của bạn.') }}
                            </div>
                            <div
                                class="body-1 lg:hidden max-md:line-clamp-1"
                                :class="fileCV?.name ? 'text-gray-900' : 'text-gray-500'"
                            >
                                {{ fileCV?.name || tt('Tải Hồ sơ/CV') }}
                            </div>
                        </div>
                        <input type="file" id="fileUploadCV" @change="onUploadCV" class="hidden opacity-0" />
                    </button>
                    <div class="body-3" :class="isErrorCV ? 'text-red-500' : 'text-gray-500'">
                        {{ tt('File tải lên có định dạng .doc, .docx, .pdf, và dung lượng tối đa 5MB') }}
                    </div>
                </div>
            </div>
            <button class="btn btn-primary !h-[44px] xl:!px-[76.5px] md:!px-[54px] !px-10 label-1" @click="submitForm">
                <div>{{ tt('Gửi') }}</div>
                <i class="gg-spinner" v-if="isLoading"></i>
            </button>
        </div>
        <ModalSuccess
            @close="closePopup"
            :isSuccess="isSuccess"
            :title="tt('Ứng tuyển thành công')"
            :description="
                tt('Chúng tôi đã nhận hồ sơ ứng tuyển. Phòng nhân sự sẽ liên hệ đến bạn trong thời gian sớm nhất.')
            "
        />
    </div>
</template>
<script>
import { validateForm } from '@/validator'
import JamFieldSet from '../Components/Jam/FieldSet.vue'
import UploadCloud from '@/Components/Icons/UploadCloud.vue'
const emptyForm = {
    'Họ và tên': '',
    Phone: '',
    Email: '',
    'File CV': null,
    Job: {
        id: null,
        title: null,
        slug: null,
    },
}
export default {
    props: {
        job: {
            type: Object,
            default: () => {},
        },
    },
    components: { JamFieldSet, UploadCloud },
    data() {
        return {
            form: {
                contact: {
                    data: {
                        ...emptyForm,
                    },
                    type: 'APPLY_FORM',
                },
            },
            rules: {
                'Họ và tên': 'required|min:3|max:25',
                Phone: 'phone|required|min:10|max:11',
                Email: 'email|required',
            },
            errors: {},
            isSuccess: false,
            isLoading: false,
            isSubmit: false,
            fileUploadCV: null,
            fileCV: null,
            isErrorCV: false,
            alert: this.tt('Vui lòng nhập đúng định dạng và kích thước file.'),
        }
    },
    methods: {
        submitForm() {
            this.isLoading = true
            this.form.contact.data.Job.id = this.job.id
            this.form.contact.data.Job.title = this.job.title
            this.form.contact.data.Job.slug = this.job.slug
            this.form.contact.data['File CV'] = this.fileCV
            this.errors = validateForm(this.form.contact.data, this.rules)
            if (Object.keys(this.errors).length > 0 && this.form.contact.data['File CV'] === null) {
                this.isErrorCV = true
                this.isLoading = false
                return false
            }
            if (Object.keys(this.errors).length > 0 && this.form.contact.data['File CV'] !== null) {
                this.isLoading = false
                return false
            }
            if (Object.keys(this.errors).length === 0 && this.form.contact.data['File CV'] === null) {
                this.isErrorCV = true
                this.isLoading = false
                return false
            }
            this.$inertia.post(this.route('contact.store'), this.form, {
                preserveScroll: true,
                onSuccess: () => {
                    this.form.contact.data = { ...emptyForm }
                    this.form.contact.data['File CV'] = null
                    this.isSuccess = true
                    this.isSubmit = true
                    this.isLoading = false
                    document.body.classList.add('overflow-hidden')
                },
            })
        },
        closePopup() {
            this.isSuccess = false
            document.body.classList.remove('overflow-hidden')
        },
        setIsSubmit(val) {
            this.isSubmit = val
        },
        onClickInputFileUpload() {
            document.getElementById('fileUploadCV').click()
        },
        onUploadCV(e) {
            let file = e.target.files[0]
            if (!file) return

            const fileExtension = file.name.split('.').pop()
            const isTypeCorrect = ['doc', 'docx', 'pdf'].includes(fileExtension)

            let i = 0
            let _size = file.size
            let fSExt = new Array('Bytes', 'KB', 'MB', 'GB')
            while (_size > 900) {
                _size /= 1024
                i++
            }
            const sizeCalc = Math.round(_size * 100) / 100

            const exactSize = sizeCalc + ' ' + fSExt[i]

            const isSizeCorrect =
                exactSize.includes('Bytes') || exactSize.includes('KB') || (exactSize.includes('MB') && sizeCalc <= 5)

            if (!isTypeCorrect || !isSizeCorrect) {
                alert(`${this.alert}`)
                return
            }

            this.fileCV = file
            this.isErrorCV = false
        },
    },
}
</script>
<style lang="scss" scoped>
.gg-spinner {
    transform: scale(var(--ggs, 1));
}

.gg-spinner,
.gg-spinner::after,
.gg-spinner::before {
    box-sizing: border-box;
    position: relative;
    display: block;
    width: 1rem;
    height: 1rem;
}

.gg-spinner::after,
.gg-spinner::before {
    content: '';
    position: absolute;
    border-radius: 100px;
}

.gg-spinner::before {
    animation: spinner 1s cubic-bezier(0.6, 0, 0.4, 1) infinite;
    border: 3px solid transparent;
    border-top-color: currentColor;
}

.gg-spinner::after {
    border: 3px solid;
    opacity: 0.2;
}

@keyframes spinner {
    0% {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(359deg);
    }
}
</style>
