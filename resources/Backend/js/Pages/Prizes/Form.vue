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
                        v-model="form.link"
                        :field="{
                            type: 'text',
                            name: 'link',
                            label: 'Link',
                        }"
                    />
                </div>
            </div>
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
                        v-model="form.image"
                        :field="{
                            type: 'file_upload',
                            name: 'image',
                            multiple: false,
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
                type: 'PRIZE',
                status: this.item.status ?? 'ACTIVE',
                view_count: this.item.view_count ?? 0,
                price: this.item.price ?? 0,
            },
        }
    },
    watch: {
        item() {
            this.formData = {
                type: 'PRIZE',
                status: this.item.status ?? 'ACTIVE',
                price: this.item.price ?? 0,
                ...this.item,
            }
        },
    },
}
</script>
