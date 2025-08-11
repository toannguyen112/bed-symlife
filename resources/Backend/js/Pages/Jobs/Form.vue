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
                        v-model="form.published_at"
                        :field="{
                            type: 'date',
                            name: 'published_at',
                            label: 'Ngày đăng',
                        }"
                    />

                    <Field
                        v-model="form.expected_time"
                        :field="{
                            type: 'date',
                            name: 'expected_time',
                            label: 'Hạn nộp hồ sơ',
                        }"
                    />
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <Field
                        v-model="form.working_position"
                        :field="{
                            type: 'text',
                            name: 'working_position',
                        }"
                    />
                    <Field
                        v-model="form.work_address"
                        :field="{
                            type: 'text',
                            name: 'work_address',
                        }"
                    />
                    <Field
                        v-model="form.working_time"
                        :field="{
                            type: 'text',
                            name: 'working_time',
                        }"
                    />
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <Field
                        v-model="form.quantity"
                        :field="{
                            type: 'number',
                            name: 'quantity',
                            label: 'Số lượng',
                        }"
                    />
                    <Field
                        v-model="form.position"
                        :field="{
                            type: 'number',
                            name: 'position',
                            label: 'Thứ tự sắp xếp',
                        }"
                    />
                    <Field
                        v-model="form.related_jobs"
                        :field="{
                            type: 'select_multiple',
                            name: 'related_jobs',
                            labelBy: 'title',
                            source: {
                                model: 'JamstackVietnam\\Job\\Models\\Job',
                                method: 'get',
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
            formData: this.item,
        }
    },
    watch: {
        item() {
            this.formData = this.item
        },
    },
}
</script>
