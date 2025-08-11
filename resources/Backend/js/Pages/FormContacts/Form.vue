<template layout>
    <Form v-model="formData">
        <template #default="{ form }">
            <div class="card">
                <div class="card-header">{{ tt('models.setting.general_information') }}</div>
                <div class="card-body">
                    <template v-for="(key, field) in form.data_contact" :key="field">
                        <div v-if="typeof form.data_contact[field] === 'object' && form.data_contact[field] != null">
                            <div v-if="form.data_contact.resource">
                                <div class="pb-3 text-sm font-medium select-none">
                                    Tên Tài Nguyên : {{ form.data_contact[field]['title'] }}
                                </div>
                                <div class="pb-3 text-sm font-medium select-none">
                                    Danh mục : {{ form.data_contact[field]['category'] }}
                                </div>
                                <div class="pb-3 text-sm font-medium select-none">
                                    Giá : {{ formatPriceVND(form.data_contact[field]['price']) }}
                                </div>
                                <div class="pb-3 text-sm font-medium select-none">
                                    Resource Type : {{ form.data_contact[field]['resource_type'] }}
                                </div>
                            </div>
                            <div v-if="form.data_contact.course">
                                <div class="pb-3 text-sm font-medium select-none">
                                    Tên Khóa học : {{ form.data_contact[field]['title'] }}
                                </div>
                                <div class="pb-3 text-sm font-medium select-none">
                                    Giá : {{ formatPriceVND(form.data_contact[field]['price']) }}
                                </div>
                                <div class="pb-3 text-sm font-medium select-none">
                                    Lịch :
                                    <div
                                        class="pl-[20px]"
                                        v-for="(value, key) in form.data_contact[field]['schedule']"
                                        :key="key"
                                    >
                                        {{ key }} : {{ value }}
                                    </div>
                                </div>
                                <div class="pb-3 text-sm font-medium select-none">
                                    Đăng ký :
                                    <div
                                        class="pl-[20px]"
                                        v-for="(value, key) in form.data_contact[field]['groups']"
                                        :key="key"
                                    >
                                        {{ key }} : {{ value }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-else>
                            <Field
                                :key="field"
                                :disabled="true"
                                :modelValue="form.data_contact[field]"
                                :field="{
                                    label: field,
                                }"
                            />
                        </div>
                    </template>
                </div>
            </div>
            <div class="card" v-if="form.images && form.images.length > 0">
                <div class="card-header">Hình ảnh</div>
                <div class="card-body">
                    <div class="flex space-x-3 flex-nowrap">
                        <div v-for="(file, index) in form.images" class="w-[200px] aspect-square" :key="index">
                            <img
                                v-if="file.path"
                                class="object-contain w-full h-full pointer-events-none"
                                :src="staticUrl(file.path)"
                                loading="lazy"
                            />
                        </div>
                    </div>
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
                        v-model="form.formatted_created_at"
                        :disabled="true"
                        :field="{
                            type: 'text',
                            name: 'formatted_created_at',
                            label: 'Ngày gửi',
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
}
</script>
