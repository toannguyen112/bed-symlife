<template layout>
    <Form v-model="formData">
        <template #default="{ form }">
            <div class="card">
                <div class="card-header">{{ tt('models.setting.general_information') }}</div>
                <div class="card-body">
                    <template v-for="(key, field) in form.data_contact" :key="field">
                        <div v-if="typeof form.data_contact[field] === 'object' && form.data_contact[field] != null">
                            <div class="pb-3 text-sm font-medium select-none">
                                {{ form.data_contact[field]['title'] }}
                            </div>
                        </div>
                        <div v-else>
                            <div v-if="field != 'Service'">
                                <Field
                                    :key="field"
                                    :disabled="true"
                                    :modelValue="form.data_contact[field]"
                                    :field="{
                                        label: field,
                                    }"
                                />
                            </div>
                        </div>
                    </template>
                </div>
            </div>
            <div class="card" v-if="form.images && form.images.length > 0">
                <div class="card-header">Hình ảnh</div>
                <div class="card-body">
                    <div class="flex space-x-3 flex-nowrap">
                        <div v-for="(file, index) in form.images" :key="index" class="w-[200px] aspect-square">
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
