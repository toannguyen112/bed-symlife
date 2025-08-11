<template>
    <section class="bg-gray-warm-100">
        <div class="container lg:pt-[160px] pt-[100px] pb-10 space-y-6">
            <p class="headline-1 font-display font-bold text-[#2F49D9] uppercase">Form Đăng kí Khóa học</p>
            <div class="grid grid-cols-12 lg:gap-8 gap-y-8">
                <div class="lg:col-span-7 col-span-full p-6 bg-white rounded-3xl space-y-8">
                    <div class="space-y-2">
                        <p class="title-1 font-bold text-gray-warm-900 font-display">
                            CHÀO CÁC BẠN ĐÃ ĐẾN VỚI NHÀ FUNKY!
                        </p>
                        <p class="body-1 font-beau font-normal text-gray-warm-700">
                            Bạn vui lòng điền chính xác để chúng mình liên hệ và hỗ trợ bạn sớm nhất nhé!
                        </p>
                    </div>
                    <div class="">
                        <p
                            class="label-0 font-bold font-beau text-gray-warm-900 pb-1 border-b border-b-gray-warm-300 uppercase"
                        >
                            Thông tin ghi danh
                        </p>
                        <div class="md:my-6 my-3">
                            <p class="text-gray-warm-700 label-2 font-medium mb-[6px]">
                                {{ tt('Họ và tên') }}
                            </p>
                            <div class="grid grid-cols-2 md:gap-x-3">
                                <JamFieldSet
                                    class="col-span-full"
                                    v-model="form.contact.data['name']"
                                    :field="{
                                        rules: rules,
                                        errors: errors,
                                        type: 'text',
                                        placeholder: `${tt('Họ và tên')}`,
                                        name: 'name',
                                        fieldName: 'name',
                                        errorText: tt('Họ và tên chưa hợp lệ'),
                                    }"
                                    :isSubmit="isSubmit"
                                    @setIsSubmit="setIsSubmit"
                                />
                            </div>
                        </div>
                        <div class="md:my-6 my-3">
                            <div class="grid grid-cols-2 max-xl:gap-y-3 gap-x-3">
                                <div class="max-md:col-span-full max-md:mt-2">
                                    <p class="text-gray-warm-700 label-2 font-medium mb-[6px]">
                                        {{ tt('Số điện thoại') }}
                                    </p>
                                    <JamFieldSet
                                        class="col-span-full md:col-span-1 w-full"
                                        v-model="form.contact.data['phone']"
                                        :field="{
                                            rules: rules,
                                            errors: errors,
                                            type: 'number',
                                            placeholder: `${tt('Số điện thoại')}`,
                                            name: 'phone',
                                            fieldName: 'phone',
                                            errorText: tt('Số điện thoại chưa hợp lệ'),
                                        }"
                                        :isSubmit="isSubmit"
                                        @setIsSubmit="setIsSubmit"
                                    />
                                </div>
                                <div class="max-md:col-span-full max-md:mt-2">
                                    <p class="text-gray-warm-700 label-2 font-medium mb-[6px]">
                                        {{ tt('Email (tài khoản website Funky)') }}
                                    </p>
                                    <JamFieldSet
                                        class="col-span-full md:col-span-1 w-full"
                                        v-model="form.contact.data['email']"
                                        :field="{
                                            rules: rules,
                                            errors: errors,
                                            type: 'text',
                                            name: 'email',
                                            fieldName: 'email',
                                            placeholder: 'Email',
                                            errorText: tt('Email chưa hợp lệ'),
                                        }"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="md:my-6 my-3">
                            <p class="text-gray-warm-700 label-2 font-medium mb-[6px]">
                                {{ tt('Link Facebook') }}
                            </p>
                            <div class="grid grid-cols-2 md:gap-x-3">
                                <JamFieldSet
                                    class="col-span-full"
                                    v-model="form.contact.data['link_facebook']"
                                    :field="{
                                        rules: rules,
                                        errors: errors,
                                        type: 'text',
                                        placeholder: `${tt('Link Facebook')}`,
                                        name: 'link_facebook',
                                        fieldName: 'name',
                                        errorText: tt('Link Facebook chưa hợp lệ'),
                                    }"
                                    :isSubmit="isSubmit"
                                    @setIsSubmit="setIsSubmit"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="space-y-6">
                            <div class="grid grid-cols-2 max-xl:gap-y-3 gap-x-3">
                                <div class="max-md:col-span-full max-md:mt-2">
                                    <p class="text-gray-warm-700 label-2 font-medium mb-[6px]">
                                        {{ tt('Bạn đang học trường nào?') }}
                                    </p>
                                    <JamFieldSet
                                        class="col-span-full md:col-span-1 w-full"
                                        v-model="form.contact.data['Bạn đang học trường nào']"
                                        :field="{
                                            rules: rules,
                                            errors: errors,
                                            type: 'text',
                                            placeholder: `${tt('Mình học đại học Kiến trúc Tp.HCM')}`,
                                            name: 'Bạn đang học trường nào',
                                            fieldName: 'Bạn đang học trường nào',
                                        }"
                                        :isSubmit="isSubmit"
                                        @setIsSubmit="setIsSubmit"
                                    />
                                </div>
                                <div class="max-md:col-span-full max-md:mt-2">
                                    <p class="text-gray-warm-700 label-2 font-medium mb-[6px]">
                                        {{ tt('Năm mấy?') }}
                                    </p>
                                    <JamFieldSet
                                        class="col-span-full md:col-span-1 w-full"
                                        v-model="form.contact.data['Năm mấy']"
                                        :field="{
                                            rules: rules,
                                            errors: errors,
                                            type: 'number',
                                            placeholder: 'Năm học',
                                            name: 'Năm mấy',
                                            fieldName: 'Năm mấy',
                                        }"
                                    />
                                </div>
                            </div>
                            <div class="space-y-[6px]">
                                <p class="label-2 font-beau font-medium text-gray-warm-700">
                                    Ngành học hiện tại của bạn?
                                </p>
                                <div class="flex flex-wrap items-center gap-x-4">
                                    <div
                                        class="flex items-center gap-x-2"
                                        v-for="(val, index) in listMajorOptions"
                                        :key="index"
                                    >
                                        <div
                                            :class="
                                                form.majorOptions === val.type
                                                    ? 'border-[#1570EF]'
                                                    : 'border-gray-warm-300'
                                            "
                                            class="w-4 h-4 rounded-full border p-[3px] cursor-pointer"
                                            @click="selectMajorOption(val)"
                                        >
                                            <div
                                                :class="form.majorOptions === val.type ? 'visible' : 'hidden'"
                                                class="w-full h-full rounded-full bg-[#1570EF] duration-300"
                                            ></div>
                                        </div>
                                        <p
                                            @click="selectMajorOption(val)"
                                            class="cursor-pointer body-2 font-beau font-normal text-gray-warm-700"
                                        >
                                            {{ val.name }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-[6px]">
                                <p class="label-2 font-beau font-medium text-gray-warm-700">
                                    Bạn biết đến Funky Style từ đâu?
                                </p>
                                <JamFieldSet
                                    v-model="form.contact.data['Biết funky từ đâu']"
                                    :field="{
                                        rules: rules,
                                        errors: errors,
                                        type: 'text',
                                        placeholder: tt(
                                            'Ai là người giới thiệu cho bạn hoặc từ nền tảng mạng xã hội nào?'
                                        ),
                                        name: 'Biết funky từ đâu',
                                        fieldName: 'Biết funky từ đâu',
                                    }"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <p class="label-2 font-beau font-medium text-gray-warm-700">Bạn có muốn:</p>
                        <div class="space-y-4">
                            <div class="flex items-center gap-x-2">
                                <div
                                    :class="form.waiting === 'pay' ? 'border-[#1570EF]' : 'border-gray-warm-300'"
                                    class="w-4 h-4 rounded-full border p-[3px] cursor-pointer"
                                    @click="selectWaitingOption('pay')"
                                >
                                    <div
                                        :class="form.waiting === 'pay' ? 'visible' : 'hidden'"
                                        class="w-full h-full rounded-full bg-[#1570EF] duration-300"
                                    ></div>
                                </div>
                                <p
                                    @click="selectWaitingOption('pay')"
                                    class="cursor-pointer body-2 font-beau font-normal text-gray-warm-700"
                                >
                                    Đóng học phí trước giữ slot
                                </p>
                            </div>
                            <div class="flex items-center gap-x-2">
                                <div
                                    :class="form.waiting === 'wait' ? 'border-[#1570EF]' : 'border-gray-warm-300'"
                                    class="w-4 h-4 rounded-full border p-[3px] cursor-pointer"
                                    @click="selectWaitingOption('wait')"
                                >
                                    <div
                                        :class="form.waiting === 'wait' ? 'visible' : 'hidden'"
                                        class="w-full h-full rounded-full bg-[#1570EF] duration-300"
                                    ></div>
                                </div>
                                <p
                                    @click="selectWaitingOption('wait')"
                                    class="cursor-pointer body-2 font-beau font-normal text-gray-warm-700"
                                >
                                    Chờ xếp lớp
                                </p>
                            </div>
                            <div class="md:my-6 my-3">
                                <p class="text-gray-warm-700 label-2 font-medium mb-[6px]">
                                    {{ tt('Lời nhắn ') }}
                                </p>
                                <JamFieldSet
                                    v-model="form.contact.data['note']"
                                    :field="{
                                        rules: rules,
                                        errors: errors,
                                        type: 'textarea',
                                        placeholder: tt('Lời nhắn gửi tới Funky'),
                                        name: 'note',
                                        fieldName: 'note',
                                    }"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="space-y-6">
                        <p class="label-0 text-gray-warm-900 font-bold font-beau pb-1 border-b border-b-gray-300">
                            Thông tin thanh toán
                        </p>
                        <div class="md:flex items-start md:gap-x-6 max-md:space-y-6 w-full">
                            <img
                                src="/assets/images/checkout/qrCode.png"
                                class="w-[110px] aspect-square max-md:mx-auto"
                            />
                            <div class="p-2 rounded-xl bg-gray-warm-50 space-y-2 w-full">
                                <div class="flex items-center gap-x-2">
                                    <div class="w-[168px] label-2 font-beau font-medium text-gray-warm-700">
                                        Số tài khoản
                                    </div>
                                    <div class="body-2 font-beau font-normal text-gray-warm-900">19568367</div>
                                </div>
                                <div class="flex items-center gap-x-2">
                                    <div class="w-[168px] label-2 font-beau font-medium text-gray-warm-700">
                                        Chủ tài khoản
                                    </div>
                                    <div class="body-2 font-beau font-normal text-gray-warm-900">Tran Anh Duy</div>
                                </div>
                                <div class="flex items-center gap-x-2">
                                    <div class="w-[168px] label-2 font-beau font-medium text-gray-warm-700">
                                        Ngân hàng
                                    </div>
                                    <div class="body-2 font-beau font-normal text-gray-warm-900">
                                        ACB ( Ngân Hàng Thương Mại Cổ Phần Á Châu)
                                    </div>
                                </div>
                                <div class="flex items-center gap-x-2">
                                    <div class="w-[168px] label-2 font-beau font-medium text-gray-warm-700">
                                        Chi Nhánh
                                    </div>
                                    <div class="body-2 font-beau font-normal text-gray-warm-900">
                                        ACB - PGD THANH DA
                                    </div>
                                </div>
                                <div class="flex items-center gap-x-2">
                                    <div class="w-[168px] label-2 font-beau font-medium text-gray-warm-700">
                                        Nội dung chuyển khoản
                                    </div>
                                    <div class="body-2 font-beau font-normal text-gray-warm-900">Khóa + Tên + SĐT</div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <!-- Image Upload -->
                            <div class="space-y-[20px]">
                                <div
                                    class="file-upload-container"
                                    @dragover.prevent="onDragOver"
                                    @drop.prevent="onDrop"
                                >
                                    <div class="flex items-center justify-center h-full file-upload-drop-zone">
                                        <div>
                                            <div class="w-full flex items-center justify-center">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="48"
                                                    height="49"
                                                    viewBox="0 0 48 49"
                                                    fill="none"
                                                >
                                                    <path
                                                        d="M16 32.5L24 24.5M24 24.5L32 32.5M24 24.5V42.5M40 33.9857C42.443 31.9681 44 28.9159 44 25.5C44 19.4249 39.0751 14.5 33 14.5C32.563 14.5 32.1541 14.272 31.9322 13.8955C29.3241 9.46967 24.5089 6.5 19 6.5C10.7157 6.5 4 13.2157 4 21.5C4 25.6322 5.67089 29.3742 8.3739 32.0871"
                                                        stroke="black"
                                                        stroke-width="2"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                    />
                                                </svg>
                                            </div>
                                            <p v-if="file?.name.length > 0">{{ file?.name }}</p>
                                            <p v-else class="normal">
                                                Drag & drop files here or
                                                <label for="upload-multiple-image">
                                                    <span class="custom cursor-pointer">Browse</span>
                                                    <input
                                                        type="file"
                                                        id="upload-multiple-image"
                                                        name="upload-multiple-image"
                                                        accept="image/png, image/jpeg"
                                                        :multiple="true"
                                                        class="hidden"
                                                        @change="onChangeFiles($event)"
                                                    />
                                                </label>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div v-if="imagesTarget.length > 0">
                                    <div class="flex space-x-[8px]">
                                        <div
                                            v-for="(image, index) in imagesTarget"
                                            :key="index"
                                            class="w-[56px] h-[56px] border border-gray-200 rounded-sm overflow-hidden relative group"
                                        >
                                            <img
                                                :src="image.preview"
                                                class="object-cover w-full h-full"
                                                :alt="image.file.name"
                                            />

                                            <div
                                                class="absolute duration-200 transform scale-0 -translate-x-1/2 -translate-y-1/2 left-1/2 top-1/2 group-hover:scale-100"
                                            >
                                                <div
                                                    @click="removeImagePreview(image.id)"
                                                    class="rounded-full w-[24px] h-[24px] bg-black opacity-30 duration-200 flex items-center justify-center cursor-pointer"
                                                >
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="12"
                                                        height="12"
                                                        viewBox="0 0 12 12"
                                                        fill="none"
                                                    >
                                                        <path
                                                            d="M11 1L1 11M1 1L11 11L1 1Z"
                                                            stroke="white"
                                                            stroke-width="2"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                        />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        v-if="messageShowErrorLimit"
                                        class="absolute bottom-[-4px] transform translate-y-full caption text-red-500"
                                    >
                                        Chỉ thêm tối đa {{ limitUploadImage }} ảnh
                                    </div>
                                </div>
                            </div>
                            <!-- END Image Upload -->
                        </div>
                    </div>
                </div>
                <div v-if="course" class="col-span-full lg:col-span-5 space-y-4">
                    <div class="rounded-3xl bg-white p-6 space-y-4 h-fit">
                        <p class="label-0 font-bold text-gray-warm-700 font-beau pb-1 border-b border-b-gray-300">
                            Thông tin đơn hàng
                        </p>
                        <div class="flex items-start gap-x-3">
                            <div class="rounded-xl overflow-hidden w-[80px]">
                                <JPicture
                                    :src="course.image?.url || '/assets/images/checkout/bg-product.png'"
                                    class="w-full aspect-square"
                                />
                            </div>
                            <div class="space-y-1 w-full">
                                <p class="title-2 font-bold text-gray-warm-900 font-display">
                                    {{ course.title }}
                                </p>
                                <div class="p-2 rounded-xl bg-gray-warm-50 space-y-3 w-full">
                                    <div class="flex items-center gap-x-2">
                                        <p class="label-2 font-bold font-beau text-gray-warm-900">Ngày khải giảng:</p>
                                        <p class="body-2 font-normal font-beau text-gray-warm-700">
                                            {{ course.schedule?.day }}
                                        </p>
                                    </div>
                                    <div class="flex items-center gap-x-2">
                                        <p class="label-2 font-bold font-beau text-gray-warm-900">Thời lượng:</p>
                                        <p class="body-2 font-normal font-beau text-gray-warm-700">
                                            {{ course.schedule?.duration }}
                                        </p>
                                    </div>
                                    <div class="flex items-center gap-x-2">
                                        <p class="label-2 font-bold font-beau text-gray-warm-900">Thời gian:</p>
                                        <p class="body-2 font-normal font-beau text-gray-warm-700">
                                            {{ course.schedule?.time }}
                                        </p>
                                    </div>
                                    <div class="flex items-center gap-x-2">
                                        <p class="label-2 font-bold font-beau text-gray-warm-900">Mentor</p>
                                        <p class="body-2 font-normal font-beau text-gray-warm-700">
                                            {{ course.schedule?.mentor }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-2 rounded-xl bg-[#FFF6D3] space-y-4">
                            <div class="space-y-3">
                                <p
                                    class="label-1 font-medium text-gray-warm-900 font-beau pb-1 border-b border-b-gray-warm-300"
                                >
                                    Đăng ký theo nhóm
                                </p>
                                <div class="flex flex-wrap items-center gap-3">
                                    <div
                                        class="rounded-lg border border-gray-warm-300 button-1 font-bold font-display h-10 py-2 px-[14px] bg-[#2F49D9] text-white"
                                    >
                                        {{ course.groups?.title }}
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <p
                                    class="label-1 font-medium text-gray-warm-900 font-beau pb-1 border-b border-b-gray-warm-300"
                                >
                                    Bạn đã từng học ở Funky
                                </p>
                                <div class="space-y-4">
                                    <div class="flex items-center gap-x-2">
                                        <div
                                            :class="
                                                form.learn === 'first' ? 'border-[#1570EF]' : 'border-gray-warm-300'
                                            "
                                            class="w-4 h-4 rounded-full border p-[3px] cursor-pointer"
                                            @click="selectLearnOption('first')"
                                        >
                                            <div
                                                :class="form.learn === 'first' ? 'visible' : 'hidden'"
                                                class="w-full h-full rounded-full bg-[#1570EF] duration-300"
                                            ></div>
                                        </div>
                                        <p
                                            @click="selectLearnOption('first')"
                                            class="cursor-pointer body-2 font-beau font-normal text-gray-warm-700"
                                        >
                                            Mình mới học lần đầu
                                        </p>
                                    </div>
                                    <div class="flex items-center gap-x-2">
                                        <div
                                            :class="form.learn === 'used' ? 'border-[#1570EF]' : 'border-gray-warm-300'"
                                            class="w-4 h-4 rounded-full border p-[3px] cursor-pointer"
                                            @click="selectLearnOption('used')"
                                        >
                                            <div
                                                :class="form.learn === 'used' ? 'visible' : 'hidden'"
                                                class="w-full h-full rounded-full bg-[#1570EF] duration-300"
                                            ></div>
                                        </div>
                                        <p
                                            @click="selectLearnOption('used')"
                                            class="cursor-pointer body-2 font-beau font-normal text-gray-warm-700"
                                        >
                                            Đúng vậy, mình từng học ở Funky!
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-end">
                                <div class="flex items-end gap-x-4">
                                    <p class="body-2 font-normal font-beau text-gray-warm-700">Chi phí</p>
                                    <p class="title-1 font-bold font-display text-[#2F49D9]">
                                        {{ course.price }}
                                        <span class="ml-2 body-2 font-normal text-gray-warm-700 font-beau">/người</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <button
                            @click="checkout"
                            class="px-[18px] w-full button-1 font-display font-bold text-[#CBFF00] h-[44px] flex items-center justify-center rounded-xl border border-[#D34000] bg-[#D34000] space-x-[12px]"
                        >
                            <div>{{ tt('Đăng ký ghi danh') }}</div>
                            <i class="gg-spinner" v-if="isLoading"></i>
                        </button>
                    </div>
                    <div
                        v-if="course.take_note"
                        class="rounded-3xl bg-white p-6 space-y-4 h-fit"
                        v-html="course.take_note"
                    ></div>
                </div>
            </div>
        </div>
    </section>
    <ModalSuccess
        @close="closePopup"
        :isSuccess="isSuccess"
        :title="tt('Đăng ký thành công')"
        :description="
            tt(
                'Hệ thống đã nhận thông tin yêu cầu của khách hàng. Funky sẽ liên hệ và tư vấn Quý khách trong thời gian sớm nhất.'
            )
        "
    />
</template>
<script>
import axios from 'axios'
import { validateForm } from '@/lib/validator'

const emptyForm = {
    name: '',
    phone: '',
    email: null,
    link_facebook: '',
    note: '',
    course: {},
    'Bạn đang học trường nào': '',
    'Năm mấy': '',
    'Ngành học hiện tại': '',
    'Biết funky từ đâu': '',
    'Bạn có muốn': '',
    'Bạn đã từng học': '',
}

export default {
    data() {
        return {
            isSuccess: false,
            isLoading: false,
            isSubmit: false,
            rules: {
                name: 'required',
                phone: 'required|phone|min:10|max:10',
                email: '',
                link_facebook: '',
            },
            course: {},
            form: {
                contact: {
                    data: {
                        ...emptyForm,
                    },
                    type: 'TYPE_CHECKOUT_COURSE',
                    images: [],
                },
            },
            errors: {},
            file: null,
            imagesTarget: [], // Lưu trữ danh sách ảnh
            limitUploadImage: 5,
            messageShowErrorLimit: false,
            listMajorOptions: [
                {
                    type: 'architecture',
                    name: 'Kiến trúc',
                },
                {
                    type: 'interior',
                    name: 'Nội thất',
                },
                {
                    type: 'landscape',
                    name: 'Cảnh quan',
                },
                {
                    type: 'planning',
                    name: 'Quy hoạch',
                },
                {
                    type: 'urban',
                    name: 'Đô thị',
                },
                {
                    type: 'graphics',
                    name: 'Đồ họa',
                },
                {
                    type: 'other',
                    name: 'Khác',
                },
            ],
            listKnowOptions: [
                {
                    type: 'introduce',
                    name: 'Từ bạn bè, thầy cô, hay đồng nghiệp giới thiệu',
                },
                {
                    type: 'group',
                    name: 'Qua các group cộng đồng của Funky',
                },
                {
                    type: 'social',
                    name: 'Qua các trang MXH (Instagram, Facebook, Threads,....)',
                },
                {
                    type: 'other',
                    name: 'Khác',
                },
            ],
            selectedOptionSignin: 0,
            imagesTarget: [], // Lưu trữ danh sách ảnh
            limitUploadImage: 5,
            messageShowErrorLimit: false,
        }
    },
    created() {
        this.fetchCourse()
    },
    methods: {
        // Xử lý kéo thả file
        onDragOver(event) {
            event.preventDefault()
        },

        onDrop(event) {
            const files = event.dataTransfer.files
            this.handleFiles(Array.from(files))
        },

        // Xử lý danh sách file
        handleFiles(files) {
            if (this.imagesTarget.length >= this.limitUploadImage) {
                this.messageShowErrorLimit = true
                return
            }

            for (const file of files) {
                if (this.isValidFile(file)) {
                    const fileID = Math.floor(Math.random() * 99999)

                    const reader = new FileReader()
                    reader.onload = (e) => {
                        if (this.imagesTarget.length < this.limitUploadImage) {
                            this.imagesTarget.push({
                                id: fileID,
                                file: file,
                                preview: e.target.result,
                            })
                        }
                    }
                    reader.readAsDataURL(file)
                } else {
                    alert('Chỉ chấp nhận các tệp PNG, JPG, JPEG, PDF.')
                }
            }
        },

        // Hàm checkout
        checkout() {
            // Validate form
            this.errors = validateForm(this.form.contact.data, this.rules)

            if (Object.keys(this.errors).length > 0) {
                return false
            }

            // Đưa file ảnh vào form.contact.images
            this.form.contact.images = this.imagesTarget.map((image) => image.file)

            // Tạo FormData và chuyển dữ liệu lồng nhau
            const formData = new FormData()
            this.buildFormData(formData, this.form)

            this.isLoading = true

            // Gửi dữ liệu lên server
            this.$inertia.post('/contacts', formData, {
                preserveScroll: true,
                onSuccess: () => {
                    this.form.contact.data = { ...emptyForm }
                    this.form.contact.images = []
                    this.imagesTarget = []
                    this.isSuccess = true
                    this.isSubmit = true
                    this.isLoading = false
                },
            })
        },

        selectMajorOption(option) {
            this.form.majorOptions = option.type
            this.form.contact.data['Ngành học hiện tại'] = option.name
        },
        selectKnowOption(option) {
            this.form.knowOptions = option.type
            this.form.contact.data['Biết funky từ đâu'] = option.name
        },
        selectWaitingOption(option) {
            this.form.waiting = option
            this.form.contact.data['Bạn có muốn'] = option
        },
        selectLearnOption(option) {
            this.form.learn = option
            this.form.contact.data['Bạn đã từng học'] = option
        },
        selectOptionSignin(index) {
            this.selectedOptionSignin = index
        },
        // Xử lý chọn file
        onChangeFiles(event) {
            if (this.imagesTarget.length >= this.limitUploadImage) {
                this.messageShowErrorLimit = true
                return
            }

            const files = event.target.files
            const imageFiles = Array.from(files)

            for (const file of imageFiles) {
                if (this.isValidFile(file)) {
                    const fileID = Math.floor(Math.random() * 99999)

                    // File Reader để tạo preview
                    const reader = new FileReader()
                    reader.onload = (e) => {
                        if (this.imagesTarget.length < this.limitUploadImage) {
                            this.imagesTarget.push({
                                id: fileID,
                                file: file,
                                preview: e.target.result,
                            })
                        }
                    }
                    reader.readAsDataURL(file)
                } else {
                    alert('Chỉ chấp nhận các tệp PNG, JPG, JPEG, PDF.')
                }
            }
        },

        // Hàm chuyển đổi dữ liệu lồng nhau thành FormData
        buildFormData(formData, data, parentKey = '') {
            if (data && typeof data === 'object' && !(data instanceof File)) {
                Object.keys(data).forEach((key) => {
                    const fullKey = parentKey ? `${parentKey}[${key}]` : key
                    this.buildFormData(formData, data[key], fullKey)
                })
            } else {
                formData.append(parentKey, data)
            }
        },

        // Kiểm tra định dạng file
        isValidFile(file) {
            const validTypes = ['image/png', 'image/jpeg', 'application/pdf', 'image/webp']
            return validTypes.includes(file.type)
        },

        // Xóa ảnh khỏi danh sách
        removeImagePreview(idTarget) {
            this.imagesTarget = this.imagesTarget.filter((image) => image.id !== idTarget)
        },

        selectFile() {
            this.$refs.fileInput.click()
        },

        closePopup() {
            this.isSuccess = false
            document.body.classList.remove('overflow-hidden')
        },
        handleDrop(event) {
            const file = event.dataTransfer.files[0]
            if (file && this.isValidFile(file)) {
                this.file = file
            } else {
                alert('Chỉ chấp nhận các tệp hình ảnh PNG, JPG và PDF.')
            }
        },

        findByIndex(array, index) {
            if (index >= 0 && index < array.length) {
                return array[index]
            }
            return undefined // Trả về undefined nếu chỉ số không hợp lệ
        },

        fetchCourse() {
            const params = new URLSearchParams(window.location.search)
            const course_id = params.get('course_id')
            const group_id = params.get('group_id')
            const price = params.get('price')
            const schedule_id = params.get('schedule_id')

            axios
                .get(`/api/courses/${course_id}`)
                .then((response) => {
                    const { data } = response.data

                    const schedule = this.findByIndex(data.schedule, schedule_id)
                    const groups = this.findByIndex(data.groups, group_id)

                    this.course = {
                        title: data.title,
                        image: data.image,
                        schedule,
                        groups,
                        price: this.toMoney(price),
                        take_note: data.take_note,
                    }

                    this.form.contact.data.course = this.course
                })
                .catch((error) => {
                    console.error(error)
                })
        },
    },
}
</script>
<style scoped>
.file-upload-container {
    min-height: 200px;
    padding: 24px 31px;
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px dashed rgba(56, 78, 183, 0.3);
    background: var(--Primary-50, #eff8ff);
}

.file-upload-drop-zone .normal {
    color: #0f0f0f;
    text-align: center;
    font-size: 16px;
    font-style: normal;
    font-weight: 700;
    line-height: 24px; /* 150% */
}
.file-upload-drop-zone .custom {
    color: #483ea8;
    font-size: 16px;
    font-style: normal;
    font-weight: 700;
    line-height: 24px;
    text-decoration-line: underline;
    text-decoration-style: solid;
    text-decoration-skip-ink: none;
    text-decoration-thickness: auto;
    text-underline-offset: auto;
    text-underline-position: from-font;
}
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
