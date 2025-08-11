<template>
    <div
        class="flex items-center mx-auto space-x-2 py-2 px-4 rounded-2xl border border-gray-warm-300 bg-gray-warm-100 w-fit"
    >
        <button
            :disabled="currentPage === 1"
            @click="changePage(currentPage - 1)"
            class="label-2 font-beau text-gray-warm-700 px-[14px] py-2 border border-gray-warm-300 rounded-lg"
        >
            Previous
        </button>

        <button
            v-for="page in pagesToShow"
            :key="page"
            :class="{
                'bg-[#2F49D9] text-white rounded-[20px]': currentPage === page,
                'bg-transparent text-gray-warm-500': currentPage !== page,
            }"
            class="w-10 h-10 flex items-center justify-center text-[14px] font-medium cursor-pointer"
            @click="changePage(page)"
        >
            {{ page }}
        </button>

        <button
            @click="changePage(currentPage + 1)"
            class="label-2 font-beau text-gray-warm-700 px-[14px] py-2 border border-gray-warm-300 rounded-lg"
        >
            Next
        </button>
    </div>
</template>

<script>
export default {
    props: {
        total: Number,
        perPage: Number,
        currentPage: Number,
    },
    computed: {
        totalPages() {
            return Math.ceil(this.total / this.perPage)
        },
        pagesToShow() {
            const pages = []
            if (this.totalPages > 15) {
                pages.push(1)
                if (this.currentPage > 3) pages.push(this.currentPage - 1)
                pages.push(this.currentPage)
                if (this.currentPage < this.totalPages - 2) pages.push(this.currentPage + 1)

                pages.push(this.totalPages)
            } else {
                for (let i = 1; i <= this.totalPages; i++) {
                    pages.push(i)
                }
            }
            return pages
        },
    },
    methods: {
        changePage(page) {
            this.$emit('page-changed', page)
        },
    },
}
</script>
