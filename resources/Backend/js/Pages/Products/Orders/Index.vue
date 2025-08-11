<template layout>
    <Table
        :schema="schema"
        :columns="[
            'id',
            'name',
            'phone',
            'email',
            {
                field: 'status',
                transform: (data) => {
                    switch(data.status) {
                        case 1:
                            return 'Trạng thái mới';
                        case 2:
                            return 'Xác nhận'
                        case 3:
                            return 'Đang xử lý'
                        case 4:
                            return 'Đang giao hàng'
                        case 5:
                            return 'Đã giao hàng'
                        case 6:
                            return 'Hoàn thành'
                        case 7:
                            return 'Hủy'
                        case 8:
                            return 'Chưa xem'
                    }
                },
            },
            'created_at',
            'updated_at',
        ]"
        :config="{
            canCreate: false,
        }"
    >
        <template #filter="{filters}">
            <div class="flex items-center justify-end space-x-2">
                <Field
                    class="w-[250px]"
                    v-model="sort"
                    @change="filters['sort'] = sort"
                    :field="{
                        type: 'dropdown',
                        name: 'sort',
                        label: false,
                        keyBy: 'id',
                        labelBy: 'label',
                        options: [
                            { id: 'all', label: 'Tất cả' },
                            { id: 'to_day', label: 'Hôm nay' },
                            { id: 'last_7', label: '7 ngày gần đây' },
                            { id: 'last_30', label: '30 ngày gần đây' },
                            { id: 'last_90', label: '90 ngày gần đây' },
                        ]
                    }"
                />
                <Field
                    class="w-[250px]"
                    v-model="status"
                    @change="filters['status'] = status"
                    :field="{
                        type: 'dropdown',
                        name: 'status',
                        label: false,
                        keyBy: 'id',
                        labelBy: 'label',
                        options: [
                            {id: 9, label: 'Xem tất cả'},
                            {id: 1, label: 'Trạng thái mới'},
                            {id: 2, label: 'Xác nhận'},
                            {id: 3, label: 'Đang xử lý'},
                            {id: 4, label: 'Đang giao hàng'},
                            {id: 5, label: 'Đã giao hàng'},
                            {id: 6, label: 'Hoàn thành'},
                            {id: 7, label: 'Hủy'},
                            {id: 8, label: 'Chưa xem'},
                        ]
                    }"
                />
            </div>
        </template>
    </Table>
</template>
<script>
export default {
    props: ["schema"],
    data() {
        return {
            status: null,
            sort: 'all'
        };
    }
};
</script>
