<template layout>
    <Form v-model="formData">
        <template #default="{ form }">
            <div class="card">
                <div class="card-header">{{ tt('models.setting.general_information') }}</div>
                <div class="card-body">
                    <template v-for="(key, field) in form.data_contact" :key="field">
                        <div v-if="typeof form.data_contact[field] === 'object' && form.data_contact[field] != null">
                            <table class="styled-table">
                                <thead>
                                    <tr>
                                        <th>Tên khóa học</th>
                                        <th>Giá</th>
                                        <th>Lịch</th>
                                        <th>Đăng ký</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ form.data_contact[field].title }}</td>
                                        <td>{{ formatPriceVND(form.data_contact[field].price) }}</td>
                                        <td>
                                            <div class="schedule-info">
                                                <p>
                                                    <strong>Ngày:</strong> {{ form.data_contact[field].schedule.day }}
                                                </p>
                                                <p>
                                                    <strong>Thời gian:</strong>
                                                    {{ form.data_contact[field].schedule.time }}
                                                </p>
                                                <p>
                                                    <strong>Giá:</strong>
                                                    {{ formatPriceVND(form.data_contact[field].schedule.price) }}
                                                </p>
                                                <p>
                                                    <strong>Tiêu đề:</strong>
                                                    {{ form.data_contact[field].schedule.title }}
                                                </p>
                                                <p><strong>Hình thức:</strong></p>
                                                <ul>
                                                    <li
                                                        v-for="type in form.data_contact[field].schedule.types"
                                                        :key="type.id"
                                                    >
                                                        {{ type.title }}
                                                    </li>
                                                </ul>
                                                <p>
                                                    <strong>Giảng viên:</strong>
                                                    {{ form.data_contact[field].schedule.mentor }}
                                                </p>
                                                <p>
                                                    <strong>Nội dung:</strong>
                                                    {{ form.data_contact[field].schedule.content }}
                                                </p>
                                                <p>
                                                    <strong>Thời lượng:</strong>
                                                    {{ form.data_contact[field].schedule.duration }}
                                                </p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="registration-info">
                                                <p>
                                                    <strong>Tiêu đề:</strong>
                                                    {{ form.data_contact[field].groups.title }}
                                                </p>
                                                <p>
                                                    <strong>Nội dung:</strong>
                                                    {{ form.data_contact[field].groups.content || 'Không có nội dung' }}
                                                </p>
                                                <p>
                                                    <strong>Giảm giá:</strong>
                                                    {{ form.data_contact[field].groups.discount }}%
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div v-else>
                            <Field
                                :key="field"
                                :disabled="true"
                                :modelValue="form.data_contact[field]"
                                :field="{ label: field }"
                            />
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

<style lang="scss" scoped>
.styled-table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    font-size: 0.9em;
    font-family: 'Arial', sans-serif;
    background-color: #f3f3f3;
    border-radius: 5px 5px 0 0;
    overflow: hidden;

    thead tr {
        background-color: #009879;
        color: #ffffff;
        text-align: left;
        font-weight: bold;
    }

    th,
    td {
        padding: 12px 15px;
        border: 1px solid #dddddd;
    }

    tbody tr {
        border-bottom: 1px solid #dddddd;
    }
}
</style>