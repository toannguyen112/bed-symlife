<template layout>
    <Form v-model="formData">
        <template #default="{ form }">
            <div class="card">
                <div class="card-header">{{ tt('models.setting.general_information') }}</div>
                <div class="card-body">
                    <Field
                        v-model="form.title"
                        :field="{
                            type: 'text',
                            name: 'title',
                            label: 'Tiêu đề',
                        }"
                    />
                    <div class="flex items-center space-x-[8px]">
                        <div class="flex-1 flex items-center space-x-[8px]">
                            <svg
                                width="20"
                                height="20"
                                viewBox="0 0 20 20"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <g clip-path="url(#clip0_11968_2203)">
                                    <path
                                        d="M9.99984 5.00008V10.0001L13.3332 11.6667M18.3332 10.0001C18.3332 14.6025 14.6022 18.3334 9.99984 18.3334C5.39746 18.3334 1.6665 14.6025 1.6665 10.0001C1.6665 5.39771 5.39746 1.66675 9.99984 1.66675C14.6022 1.66675 18.3332 5.39771 18.3332 10.0001Z"
                                        stroke="#44403C"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />
                                </g>
                                <defs>
                                    <clipPath id="clip0_11968_2203">
                                        <rect width="20" height="20" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>

                            <Field
                                class="w-full"
                                v-model="form.number_of_course"
                                :field="{
                                    type: 'text',
                                    name: 'number_of_course',
                                    label: 'Số buổi',
                                }"
                            />
                        </div>
                        <div class="flex-1 flex items-center space-x-[8px]">
                            <svg
                                width="20"
                                height="20"
                                viewBox="0 0 20 20"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M17.5 8.33342H2.5M13.3333 1.66675V5.00008M6.66667 1.66675V5.00008M6.5 18.3334H13.5C14.9001 18.3334 15.6002 18.3334 16.135 18.0609C16.6054 17.8212 16.9878 17.4388 17.2275 16.9684C17.5 16.4336 17.5 15.7335 17.5 14.3334V7.33342C17.5 5.93328 17.5 5.23322 17.2275 4.69844C16.9878 4.22803 16.6054 3.84558 16.135 3.6059C15.6002 3.33341 14.9001 3.33341 13.5 3.33341H6.5C5.09987 3.33341 4.3998 3.33341 3.86502 3.6059C3.39462 3.84558 3.01217 4.22803 2.77248 4.69844C2.5 5.23322 2.5 5.93328 2.5 7.33341V14.3334C2.5 15.7335 2.5 16.4336 2.77248 16.9684C3.01217 17.4388 3.39462 17.8212 3.86502 18.0609C4.3998 18.3334 5.09987 18.3334 6.5 18.3334Z"
                                    stroke="#44403C"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>
                            <Field
                                v-model="form.timetable"
                                class="w-full"
                                :field="{
                                    type: 'text',
                                    name: 'timetable',
                                    label: 'Thời gian học',
                                }"
                            />
                        </div>
                    </div>
                    <Field
                        v-model="form.link"
                        :field="{
                            type: 'text',
                            name: 'link',
                            label: 'Link',
                        }"
                    />
                    <Field
                        v-model="form.download"
                        :field="{
                            type: 'text',
                            name: 'download',
                            label: 'download',
                        }"
                    />
                    <Field
                        v-model="form.description"
                        :field="{
                            type: 'textarea',
                            name: 'description',
                            label: 'Mô tả',
                        }"
                    />
                    <Field
                        v-model="form.take_note"
                        :field="{
                            type: 'richtext',
                            name: 'take_note',
                            label: 'Ghi chú',
                        }"
                    />
                </div>
            </div>
            <div class="card">
                <div class="card-header">Lịch khai giảng</div>
                <div class="card-body">
                    <div class="space-y-4">
                        <div v-for="(item, index) in form.schedule" :key="index">
                            <div class="flex">
                                <div class="ml-auto">
                                    <div
                                        @click="onRemoveSchedule(index)"
                                        class="p-1 ml-auto border rounded cursor-pointer text-gray500 hover:text-gray-700 hover:bg-gray-100"
                                    >
                                        <material-symbols:delete-outline-sharp />
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <Field
                                    v-model="item.day"
                                    :field="{
                                        type: 'text',
                                        name: 'title',
                                        label: 'Ngày khai giảng',
                                    }"
                                />
                                <Field
                                    v-model="item.duration"
                                    :field="{
                                        type: 'text',
                                        name: 'content',
                                        label: 'Nội dung',
                                        label: 'Thời lượng',
                                    }"
                                />
                                <Field
                                    v-model="item.time"
                                    :field="{
                                        type: 'text',
                                        name: 'content',
                                        label: 'Nội dung',
                                        label: 'Thời gian',
                                    }"
                                />
                                <Field
                                    v-model="item.mentor"
                                    :field="{
                                        type: 'text',
                                        name: 'content',
                                        label: 'Mentor',
                                    }"
                                />
                                <Field
                                    v-model="item.price"
                                    :field="{
                                        type: 'decimal',
                                        name: 'price',
                                        label: 'Giá',
                                    }"
                                />
                                <Field
                                    v-model="item.types"
                                    :field="{
                                        type: 'select_multiple',
                                        name: 'type',
                                        labelBy: 'title',
                                        options: [
                                            {
                                                id: 'Online',
                                                title: 'Online',
                                            },
                                            {
                                                id: 'Offline',
                                                title: 'Offline',
                                            },
                                            {
                                                id: 'Open',
                                                title: 'Đang mở',
                                            },
                                            {
                                                id: 'Full',
                                                title: 'Lớp full',
                                            },
                                        ],
                                    }"
                                />
                            </div>
                        </div>
                    </div>
                    <div>
                        <Button
                            label="Thêm"
                            variant="white"
                            @click="
                                this.formData.schedule.push({
                                    price: 0,
                                    day: null,
                                    duration: null,
                                    time: null,
                                    mentor: null,
                                    types: null,
                                })
                            "
                        />
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Đăng ký theo nhóm</div>
                <div class="card-body">
                    <div class="space-y-4">
                        <div v-for="(item, index) in form.groups" :key="index">
                            <div class="flex">
                                <div class="ml-auto">
                                    <div
                                        @click="onRemoveGroup(index)"
                                        class="p-1 ml-auto border rounded cursor-pointer text-gray500 hover:text-gray-700 hover:bg-gray-100"
                                    >
                                        <material-symbols:delete-outline-sharp />
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <Field
                                    v-model="item.title"
                                    :field="{
                                        type: 'text',
                                        name: 'title',
                                        label: 'Tiêu đề',
                                    }"
                                />
                                <Field
                                    v-model="item.discount"
                                    :field="{
                                        type: 'number',
                                        name: 'content',
                                        label: 'Giảm giá (%)',
                                    }"
                                />
                            </div>
                        </div>
                    </div>
                    <div>
                        <Button
                            label="Thêm"
                            variant="white"
                            @click="
                                this.formData.groups.push({
                                    title: null,
                                    content: null,
                                    discount: null,
                                })
                            "
                        />
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Khóa học này giành cho</div>
                <div class="card-body">
                    <div class="space-y-4">
                        <div v-for="(item, index) in form.course_for" :key="index">
                            <div class="flex">
                                <div class="ml-auto">
                                    <div
                                        @click="onRemoveCourseFor(index)"
                                        class="p-1 ml-auto border rounded cursor-pointer text-gray500 hover:text-gray-700 hover:bg-gray-100"
                                    >
                                        <material-symbols:delete-outline-sharp />
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <Field
                                    v-model="item.title"
                                    :field="{
                                        type: 'text',
                                        name: 'title',
                                        label: 'Tiêu đề',
                                    }"
                                />
                                <Field
                                    v-model="item.content"
                                    :field="{
                                        type: 'textarea',
                                        name: 'content',
                                        label: 'Nội dung',
                                    }"
                                />
                            </div>
                        </div>
                    </div>
                    <div>
                        <Button
                            label="Thêm"
                            variant="white"
                            @click="
                                this.formData.course_for.push({
                                    title: null,
                                    content: null,
                                })
                            "
                        />
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Nội dung kiến thức</div>
                <div class="card-body">
                    <div class="space-y-4">
                        <div v-for="(item, index) in form.knowledge_content" :key="index">
                            <div class="flex">
                                <div class="ml-auto">
                                    <div
                                        @click="onRemoveKnowledgeContent(index)"
                                        class="p-1 ml-auto border rounded cursor-pointer text-gray500 hover:text-gray-700 hover:bg-gray-100"
                                    >
                                        <material-symbols:delete-outline-sharp />
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <Field
                                    v-model="item.title"
                                    :field="{
                                        type: 'text',
                                        name: 'title',
                                        label: 'Tiêu đề',
                                    }"
                                />
                                <Field
                                    v-model="item.content"
                                    :field="{
                                        type: 'textarea',
                                        name: 'content',
                                        label: 'Nội dung',
                                    }"
                                />
                                <Field
                                    v-model="item.image"
                                    :field="{
                                        type: 'file_upload',
                                        name: 'image',
                                        multiple: false,
                                    }"
                                />
                            </div>
                        </div>
                    </div>
                    <div>
                        <Button
                            label="Thêm"
                            variant="white"
                            @click="
                                this.formData.knowledge_content.push({
                                    title: null,
                                    content: null,
                                })
                            "
                        />
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Mục tiêu học tập</div>
                <div class="card-body">
                    <div class="space-y-4">
                        <div v-for="(item, index) in form.course_target" :key="index">
                            <div class="flex">
                                <div class="ml-auto">
                                    <div
                                        @click="onRemoveCourseTarget(index)"
                                        class="p-1 ml-auto border rounded cursor-pointer text-gray500 hover:text-gray-700 hover:bg-gray-100"
                                    >
                                        <material-symbols:delete-outline-sharp />
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <Field
                                    v-model="item.title"
                                    :field="{
                                        type: 'text',
                                        name: 'title',
                                        label: 'Tiêu đề',
                                    }"
                                />
                                <Field
                                    v-model="item.content"
                                    :field="{
                                        type: 'textarea',
                                        name: 'content',
                                        label: 'Nội dung',
                                    }"
                                />
                                <Field
                                    v-model="item.image"
                                    :field="{
                                        type: 'file_upload',
                                        name: 'image',
                                        multiple: false,
                                    }"
                                />
                            </div>
                        </div>
                    </div>
                    <div>
                        <Button
                            label="Thêm"
                            variant="white"
                            @click="
                                this.formData.course_target.push({
                                    title: null,
                                    content: null,
                                })
                            "
                        />
                    </div>
                </div>
            </div>
            <SeoFields :modelValue="form" @update:modelValue="form = $event" />
        </template>
        <template #aside="{ form }">
            <div class="card">
                <div class="card-body">
                    <Field
                        v-model="form.status"
                        :field="{
                            type: 'radio_list',
                            name: 'status',
                            label: 'Trạng thái',
                            options: schema.columns.status.list,
                        }"
                    />
                    <Field
                        v-model="form.home_position"
                        :field="{
                            type: 'checkbox',
                            name: 'home_position',
                            label: 'Nổi bật',
                        }"
                    />
                    <Field
                        v-model="form.footer_position"
                        :field="{
                            type: 'number',
                            name: 'footer_position',
                            label: 'Thứ tự Menu Footer',
                        }"
                    />

                    <Field
                        v-model="form.published_at"
                        :field="{
                            type: 'date',
                            name: 'published_at',
                            label: 'Ngày xuất bản',
                        }"
                    />

                    <Field
                        v-model="form.image"
                        :field="{
                            type: 'file_upload',
                            name: 'image',
                            multiple: false,
                        }"
                    />

                    <Field
                        v-model="form.banner"
                        :field="{
                            type: 'file_upload',
                            name: 'banner',
                            multiple: false,
                        }"
                    />
                    <Field
                        v-model="form.icon"
                        :field="{
                            type: 'file_upload',
                            name: 'icon',
                            multiple: false,
                        }"
                    />
                    <Field
                        v-model="form.categories"
                        :field="{
                            type: 'select_multiple',
                            name: 'categories',
                            labelBy: 'title',
                            label: 'Danh mục khóa học',
                            source: {
                                model: 'App\\Models\\Post\\PostCategory',
                                method: 'getCourse',
                                only: ['id', 'title'],
                            },
                        }"
                    />
                    <Field
                        v-model="form.products"
                        :field="{
                            label: 'Sản phẩm',
                            type: 'select_multiple',
                            name: 'products',
                            labelBy: 'title',
                            source: {
                                model: 'App\\Models\\Product\\Product',
                                method: 'getProducts',
                                only: ['id', 'title'],
                            },
                        }"
                    />
                </div>
            </div>
        </template>
    </Form>
</template>
<script>
export default {
    props: ['item', 'schema'],
    data() {
        return {
            formData: {
                ...this.item,
                type: 'COURSE',
                status: this.item.status ?? 'ACTIVE',
                view_count: this.item.view_count ?? 0,
                schedule: this.item.schedule ?? [],
                groups: this.item.groups ?? [],
                course_for: this.item.course_for ?? [],
                knowledge_content: this.item.knowledge_content ?? [],
                course_target: this.item.course_target ?? [],
            },
        }
    },
    watch: {
        item() {
            this.formData = {
                ...this.item,
                type: 'COURSE',
                view_count: this.item.view_count ?? 0,
                schedule: this.item.schedule ?? [],
                groups: this.item.groups ?? [],
                course_for: this.item.course_for ?? [],
                knowledge_content: this.item.knowledge_content ?? [],
                course_target: this.item.course_target ?? [],
            }
        },
    },
    methods: {
        onRemoveSchedule(index) {
            this.formData.schedule.splice(index, 1)
        },
        onRemoveGroup(index) {
            this.formData.groups.splice(index, 1)
        },
        onRemoveCourseFor(index) {
            this.formData.course_for.splice(index, 1)
        },
        onRemoveKnowledgeContent(index) {
            this.formData.knowledge_content.splice(index, 1)
        },
        onRemoveCourseTarget(index) {
            this.formData.course_target.splice(index, 1)
        },
    },
}
</script>
