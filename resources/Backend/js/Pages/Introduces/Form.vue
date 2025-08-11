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

                    <Field
                        v-model="form.link"
                        :field="{
                            type: 'text',
                            name: 'link',
                            label: 'link',
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
                        v-model="form.image"
                        :field="{
                            type: 'file_upload',
                            name: 'image',
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
                                method: 'getIntroduces',
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
                type: 'INTRODUCE',
                status: this.item.status ?? 'ACTIVE',
                view_count: this.item.view_count ?? 0,
                price: this.item.price ?? 0,
                ...this.item,
            },
        }
    },
    watch: {
        item() {
            this.formData = {
                type: 'INTRODUCE',
                status: this.item.status ?? 'ACTIVE',
                view_count: this.item.view_count ?? 0,
                price: this.item.price ?? 0,
                ...this.item,
            }
        },
    },
}
</script>
