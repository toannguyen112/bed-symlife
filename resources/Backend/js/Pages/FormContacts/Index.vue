<template layout>
    <Table
        :schema="schema"
        :columns="[
            'id',
            {
                field: 'Email',
                transform: (data) => {
                    return data.data_contact['Email']
                },
            },
            {
                field: 'Name',
                transform: (data) => {
                    return data.data['Name']
                },
            },
            {
                field: 'Phone',
                transform: (data) => {
                    return data.data['Phone']
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
