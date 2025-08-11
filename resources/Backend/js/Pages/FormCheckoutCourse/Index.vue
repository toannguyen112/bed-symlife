<template layout>
    <Table
        :schema="schema"
        :columns="[
            'id',
            {
                field: 'email',
                transform: (data) => {
                    return data.data.email
                },
            },
            {
                field: 'name',
                transform: (data) => {
                    return data.data.name
                },
            },
            {
                field: 'phone',
                transform: (data) => {
                    return data.data.phone
                },
            },
            'status',
            'created_at',
            'updated_at',
        ]"
        :config="{
            canCreate: false,
        }"
    />
</template>
<script>
export default {
    props: ['schema'],
}
</script>
