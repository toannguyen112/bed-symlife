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
                    <small v-if="form.id">
                        <span v-for="(item, locale) in form.url" :key="locale">
                            {{ locale }}: <a :href="item" target="_blank" class="link">{{ decodeURI(item) }}</a
                            ><br />
                        </span>
                    </small>
                    <Field
                        v-model="form.description"
                        :field="{
                            type: 'textarea',
                            name: 'description',
                            label: 'Mô tả',
                        }"
                    />
                    <Field
                        v-model="form.content"
                        :field="{
                            type: 'richtext',
                            name: 'content',
                            label: 'Nội dung',
                        }"
                    />
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
                        v-model="form.type_post"
                        :field="{
                            type: 'radio_list',
                            name: 'status',
                            label: 'TYPE',
                            options: [
                                { id: 'KINHNGHIEMSUDUNG', label: 'Kinh nghiệm sử dụng' },
                                { id: 'GIOITHIEU', label: 'Giới thiệu' },
                                { id: 'DICH_VU_KHAC', label: 'Dịch vụ khác' },
                                { id: 'MAYLANH', label: 'Máy lạnh' },
                                { id: 'DIEN_LANH_CONG_NGHIEP', label: 'Điện lạnh công nghiệp' },
                            ],
                        }"
                    />
                    <Field
                        v-model="form.position"
                        :field="{
                            type: 'number',
                            name: 'position',
                            label: 'Vị trí',
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
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <Field
                        v-model="form.categories"
                        :field="{
                            type: 'select_multiple',
                            name: 'categories',
                            labelBy: 'title',
                            source: {
                                model: 'App\\Models\\Post\\PostCategory',
                                method: 'getPosts',
                                only: ['id', 'title'],
                            },
                        }"
                    />
                    <Field
                        v-model="form.related_posts"
                        :field="{
                            type: 'select_multiple',
                            name: 'related_posts',
                            labelBy: 'title',
                            source: {
                                model: 'App\\Models\\Post\\Post',
                                method: 'getPosts',
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
                type: 'POST',
                type_post: this.item.type_post,
                status: this.item.status ?? 'ACTIVE',
                view_count: this.item.view_count ?? 0,
            },
        }
    },
    watch: {
        item() {
            this.formData = {
                type: 'POST',
                type_post: this.item.type_post,
                status: this.item.status ?? 'ACTIVE',
                ...this.item,
            }
        },
    },
}
</script>
