<template>
    <span class="hidden">
        {{ $page.props.route.name }}
    </span>
    <Link
        v-if="can('admin.posts.index')"
        :href="route('admin.posts.index')"
        :class="{ active: isUrl('admin.posts.*') }"
        class="item"
    >
        <ph-newspaper-clipping-light />
        <span>{{ tt('models.table_list.posts') }}</span>
    </Link>
    <Link
        v-if="can('admin.post-categories.index')"
        :href="route('admin.post-categories.index')"
        :class="{ active: isUrl('admin.post-categories.*') }"
        class="item"
    >
        <bx:category />
        <span>{{ tt('models.table_list.post-categories') }}</span>
    </Link>
    <Link
        v-if="can('admin.introduces.index')"
        :href="route('admin.introduces.index')"
        :class="{ active: isUrl('admin.introduces.*') }"
        class="item"
    >
        <bx:category />
        <span>{{ tt('models.table_list.introduces') }}</span>
    </Link>
    <Link
        v-if="can('admin.members.index')"
        :href="route('admin.members.index')"
        :class="{ active: isUrl('admin.members.*') }"
        class="item"
    >
        <bx:category />
        <span> Hình ảnh thi công </span>
    </Link>
    <Link
        v-if="can('admin.feedback.index')"
        :href="route('admin.feedback.index')"
        :class="{ active: isUrl('admin.feedback.*') }"
        class="item"
    >
        <bx:category />
        <span>{{ tt('models.table_list.feedback') }}</span>
    </Link>
    <Link
        v-if="can('admin.products.index')"
        :href="route('admin.products.index')"
        :class="{ active: isUrl('admin.products.*') }"
        class="item"
    >
        <material-symbols:connect-without-contact />
        <span>{{ tt('models.table_list.products') }}</span>
    </Link>
    <Link
        v-if="can('admin.sliders.index')"
        :href="route('admin.sliders.index')"
        :class="{ active: isUrl('admin.sliders.*') }"
        class="item"
    >
        <bi:sliders2 />
        <span>{{ tt('models.table_list.sliders') }}</span>
    </Link>
    <Link
        v-if="can('admin.policies.index')"
        :href="route('admin.policies.index')"
        :class="{ active: isUrl('admin.policies.*') }"
        class="item"
    >
        <material-symbols:policy-outline-sharp />
        <span>{{ tt('models.table_list.policies') }}</span>
    </Link>
</template>

<script>
export default {
    computed: {
        newContact() {
            return this.$page.props.data.new_contact_count
        },
        newContactResource() {
            return this.$page.props.data.new_contact_resource_count
        },
        newContactCourse() {
            return this.$page.props.data.new_contact_course_count
        },
    },
}
</script>
<style scoped>
.badge {
    @apply px-2 py-1 text-xs font-medium rounded;
}
.badge-success {
    @apply text-green-700 bg-green-200;
}
.badge-danger {
    @apply text-red-600 bg-red-200;
}
</style>
