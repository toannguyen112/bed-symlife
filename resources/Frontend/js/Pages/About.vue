<template>
    <section class="pb-[30px]">
        <Banner
            v-if="$page.props.data.banner.banner_about_1"
            :image="$page.props.data.banner.banner_about_1.image.url"
            :imageMobile="$page.props.data.banner.banner_about_1.image_mobile.url"
            :alt="$page.props.data.banner.banner_about_1.title"
        >
            <div>
                <div class="space-y-3 max-w-[470px] w-full text-white">
                    <h1 class="display-2 font-display uppercase">
                        {{ $page.props.data.banner.banner_about_1.title }}
                    </h1>
                    <p class="body-1 font-beau">
                        {{ $page.props.data.banner.banner_about_1.description }}
                    </p>
                </div>
            </div>
        </Banner>

        <div class="about-page">
            <!-- Nội dung chính -->
            <div class="max-w-5xl mx-auto px-4 py-10 text-gray-800">
                <h1 class="text-3xl md:text-4xl font-bold text-blue-800 mb-6">Giới Thiệu Kỹ Thuật Lạnh</h1>

                <div class="space-y-5 text-base md:text-lg leading-relaxed">
                    <p>
                        Kỹ Thuật Lạnh tự hào là hệ thống siêu thị điện máy uy tín hàng đầu, cung cấp đa dạng sản phẩm
                        như Tivi, Tủ lạnh, Máy giặt, Máy lạnh, Gia dụng, Thiết bị nhà bếp và nhiều hơn nữa từ các thương
                        hiệu lớn như Samsung, Sony, LG, Toshiba, Panasonic, Sharp...
                    </p>

                    <p>
                        Với phương châm <strong class="text-blue-600">“Khách hàng là trọng tâm”</strong>, chúng tôi
                        không ngừng nâng cao chất lượng dịch vụ, mang lại trải nghiệm mua sắm tốt nhất với giá cả cạnh
                        tranh, nhiều ưu đãi hấp dẫn và chính sách bảo hành rõ ràng.
                    </p>

                    <p>
                        Đội ngũ nhân viên nhiệt tình, chuyên nghiệp cùng hệ thống giao hàng toàn quốc giúp khách hàng
                        hoàn toàn yên tâm khi lựa chọn Kỹ Thuật Lạnh là nơi mua sắm thiết bị điện tử, điện lạnh và gia
                        dụng.
                    </p>

                    <!-- Tầm nhìn & Sứ mệnh -->
                    <h2 class="text-2xl font-semibold text-blue-700 mt-8">Tầm Nhìn & Sứ Mệnh</h2>
                    <ul class="list-disc pl-5 space-y-2">
                        <li>Trở thành hệ thống điện máy uy tín, thân thiện và tiện lợi nhất Việt Nam.</li>
                        <li>Luôn đặt quyền lợi khách hàng lên hàng đầu.</li>
                        <li>Không ngừng cải tiến, ứng dụng công nghệ để nâng cao chất lượng phục vụ.</li>
                    </ul>

                    <!-- Thông tin liên hệ -->
                    <h2 class="text-2xl font-semibold text-blue-700 mt-8">Thông Tin Liên Hệ</h2>
                    <p><span class="font-medium">Hotline:</span> 0977333965</p>
                    <p>
                        <span class="font-medium">Website:</span>
                        <a href="https://kythuatlanh.com/" class="text-blue-500 hover:underline" target="_blank"
                            >kythuatlanh.com</a
                        >
                    </p>
                    <p>
                        <span class="font-medium">Địa chỉ:</span> 142 Mai Hắc Đế, P. Tân Thành, Tp. Buôn Ma Thuột, Tỉnh
                        Đắk Lắk
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import JamBreadcrumb from '@/Components/Jam/Breadcrumb.vue'
import CardBlog from '@/Components/CardBlog.vue'
import Banner from '@/Components/Banner.vue'

export default {
    props: ['posts', 'sliders'],
    components: {
        JamBreadcrumb,
        CardBlog,
    },
    computed: {
        members() {
            return this.$page.props.data.members || []
        },
    },
    data() {
        return {
            about: [
                {
                    title: this.tt('Sáng tạo bản sắc riêng'),
                    desc: 'Phong cách sáng tạo là không giới hạn, kết hợp xu hướng hiện đại và tôn trọng cá tính riêng,  khơi dậy tư duy độc lập và định hình bản sắc sáng tạo cá nhân',
                    image: {
                        url: '/assets/images/about/creative.png',
                        alt: 'Whether you have a team of 2 or 200, our shared team inboxes keep everyone on the same page and in the loop.',
                    },
                },
                {
                    title: this.tt('Tư duy đổi mới'),
                    desc: 'Xây dựng tư duy đổi mới qua các phương pháp, kết hợp lý thuyết học thuật và thực hành,  giúp học viên mở rộng tầm nhìn và nâng cao kỹ năng giải quyết vấn đề bền vững.',
                    image: {
                        url: '/assets/images/about/thinking.png',
                        alt: 'english flag',
                    },
                },
                {
                    title: this.tt('Ứng dụng thực tiễn'),
                    desc: 'Đón đầu công nghệ kỹ thuật tiên tiến, mở rộng tiềm năng ứng dụng trong kiến trúc và liên ngành, hỗ trợ phát triển nghề nghiệp hiệu quả và bền vững.',
                    image: {
                        url: '/assets/images/about/application.png',
                        alt: 'english flag',
                    },
                },
            ],
        }
    },
}
</script>
