<template>
    <main class="pt-[2rem]">
        <div class="container">
            <JamBreadcrumb :items="breadcrumbs" />
        </div>
        <div class="container grid grid-cols-12 py-[32px] md:py-[24px] md:gap-[64px] max-md:gap-y-[32px]">
            <div class="col-span-full md:col-span-6">
                <div class="lg:top-2 lg:sticky product-thumbnail">
                    <ProductThumbnail class="lg:mb-3" :product="product" />
                </div>
            </div>
            <div class="col-span-full md:col-span-6 space-y-[32px]">
                <div class="text-gray-900">
                    <div class="display-3">{{ product.title }}</div>
                    <hr class="my-[12px] 12px] border-primary-900 border-b-[1.5]" />
                    <div class="label-1" v-html="product.description"></div>
                </div>
                <div class="flex items-center space-x-[1rem]">
                    <hotline />
                    <Link :route="route('contact')" class="btn btn-primary w-[204px]">
                        <span>{{ tt('Contact Us') }}</span>
                    </Link>
                </div>
                <div
                    class="label-1 py-[10px] px-[20px] rounded-[4px] text-gray-700 border border-primary-300 inline-block cursor-pointer hover:bg-primary-700 hover:text-white transition-all"
                >
                    Download catalogue
                </div>
            </div>
        </div>
        <div class="container grid grid-cols-12 py-[32px] md:py-[48px]">
            <div class="md:col-start-2 md:col-span-10 space-y-[2rem] col-span-full">
                <div class="border-gray-300 border-b">
                    <div class="title-2 text-primary-900 pb-[12px] border-primary-900 inline-block border-b-2">
                        Detail
                    </div>
                </div>
                <div v-html="product.content"></div>
            </div>
        </div>
        <section class="bg-primary-200 xl:py-[64px] md:py-[45px] py-[32px]">
            <div class="container">
                <h2 class="headline-2 text-gray-700 xl:mb-[32px] md:mb-[22px] mb-[16px]">
                    {{ tt('Other products') }}
                </h2>
                <div class="grid md:grid-cols-5 grid-cols-4 gap-[32px]">
                    <div v-for="(item, index) in related_products" :key="index" class="col-span-2 md:col-span-1">
                        <card-product-v2 :item="item" />
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>
<script>
import JamBreadcrumb from '@/Components/Jam/Breadcrumb.vue'

export default {
    props: ['product', 'related_products'],
    components: { JamBreadcrumb },
    data() {
        return {
            breadcrumbs: [
                {
                    title: this.tt('Our Products'),
                    link: this.route('products.index'),
                },
                {
                    title: this.tt('DK 5011 One Piece Kaido Blue Dragon Form'),
                    link: this.route('products.index'),
                },
            ],
        }
    },
}
</script>
