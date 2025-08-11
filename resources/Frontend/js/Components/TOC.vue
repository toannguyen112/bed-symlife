<template>
    <div v-show="toc && toc.length > 0" class="toc space-y-3 collapsible border-l-[1px] border-[#D7D3D0]">
        <div class="w-full collapsible-content space-y-3">
            <a
                v-for="(item, index) in toc"
                :key="index"
                class="block px-2 py-[2px] label-1 font-medium font-beau cursor-pointer"
                :class="item.text === activeText ? 'text-black-fks border-l-2 border-blue-fks' : 'text-[#18191E]'"
                :style="{ marginLeft: item.margin }"
                @click="scrollToSection(item.text)"
            >
                {{ item.text }}
            </a>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        content: {
            type: String,
            required: true,
        },
    },
    components: {},
    data() {
        return { activeText: '', collapseActive: false }
    },
    methods: {
        scrollToSection(searchText) {
            this.activeText = searchText
            const allHeadings = document.querySelectorAll('h2, h3, h4, h5, h6')
            const matchingHeadings = Array.from(allHeadings).find(
                (heading) => heading.textContent.trim() === searchText
            )

            if (matchingHeadings) {
                window.scrollTo({
                    top: matchingHeadings.offsetTop - 100,
                    behavior: 'smooth',
                })
            } else {
                console.log('No matching headings found.')
            }
        },
        toggleCollapse() {
            this.collapseActive = !this.collapseActive
        },
    },
    computed: {
        toc() {
            const container = document.createElement('div')
            container.innerHTML = this.content
            const headings = Array.from(container.querySelectorAll('h1, h2, h3, h4, h5, h6'))
            console.log('headings', headings)
            if (headings && headings.length) {
                this.activeText = headings[0].textContent
                const marginMap = {
                    H2: '20px',
                    H3: '30px',
                    H4: '40px',
                    H5: '50px',
                    H6: '60px',
                }

                headings.forEach((heading) => {
                    const margin = marginMap[heading.tagName]
                    if (margin) {
                        heading.style.marginLeft = margin
                    }
                })

                return headings.map((heading, index) => {
                    const id = `heading-${index}`
                    heading.id = id
                    return {
                        id,
                        text: heading.textContent,
                    }
                })
            }
            return []
        },
    },
    mounted() {
        const text = document.querySelectorAll('.collapsible .collapsible-content').forEach(function (el) {
            el.style.maxHeight = el.scrollHeight + 'px'
        })
        console.log('text', text)
        window.addEventListener('scroll', this.handleScroll)
    },
    beforeDestroy() {
        window.removeEventListener('scroll', this.handleScroll)
    },
}
</script>
<style lang="scss" scoped>
.collapsible-content div {
    line-height: normal;
}
</style>
