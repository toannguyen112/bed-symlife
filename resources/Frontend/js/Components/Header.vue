<template>
    <header class="bg-[#0A2552] text-[#B2DDFF] py-2">
        <div class="container">
            <div class="grid grid-cols-5 items-center">
                <!-- Menu trái -->
                <div
                    class="col-span-full md:col-span-2 flex flex-wrap md:flex-nowrap items-center justify-center gap-4 md:gap-6 text-sm md:text-base"
                >
                    <div>Giới thiệu</div>
                    <div>Mặt bằng</div>
                    <div>Tiện ích</div>
                </div>

                <!-- Logo -->
                <div class="col-span-full md:col-span-1 flex items-center justify-center py-2">
                    <JPicture src="/assets/images/logo.png" class="max-h-[40px] md:max-h-[60px]" />
                </div>

                <!-- Menu phải -->
                <div
                    class="col-span-full md:col-span-2 flex flex-wrap md:flex-nowrap items-center justify-center gap-4 md:gap-6 text-sm md:text-base mt-2 md:mt-0"
                >
                    <div>Căn hộ</div>
                    <div>Thư viện</div>
                    <div>Liên hệ</div>

                    <!-- Phone -->
                    <div class="flex items-center gap-2 border border-[#DEA23C] rounded-full px-3 py-1">
                        <svg
                            width="28"
                            height="28"
                            viewBox="0 0 32 33"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                            class="shrink-0"
                        >
                            <rect y="0.96582" width="32" height="32" rx="16" fill="#0A2552" />
                            <g clip-path="url(#clip0)">
                                <path
                                    d="M18.0497 10.9658C19.0264 11.1564 19.924 11.6341 20.6277 12.3378C21.3314 13.0414 21.8091 13.9391 21.9997 14.9158M18.0497 6.96582C20.0789 7.19126 21.9713 8.1 23.4159 9.54283C24.8606 10.9857 25.7717 12.8768 25.9997 14.9058M14.2266 18.8289C13.0251 17.6273 12.0763 16.2687 11.3803 14.819C11.3204 14.6944 11.2905 14.632 11.2675 14.5531C11.1858 14.2728 11.2445 13.9285 11.4145 13.6911C11.4623 13.6243 11.5195 13.5671 11.6338 13.4528C11.9834 13.1032 12.1582 12.9284 12.2725 12.7526C12.7035 12.0897 12.7035 11.2351 12.2725 10.5723C12.1582 10.3965 11.9834 10.2217 11.6338 9.87206L11.4389 9.6772C10.9075 9.14575 10.6417 8.88003 10.3564 8.73569C9.7888 8.44862 9.11854 8.44862 8.55098 8.73569C8.2656 8.88003 7.99987 9.14575 7.46843 9.6772L7.3108 9.83483C6.78117 10.3645 6.51636 10.6293 6.31411 10.9893C6.08969 11.3888 5.92833 12.0093 5.9297 12.4675C5.93092 12.8805 6.01103 13.1627 6.17124 13.7271C7.03221 16.7605 8.65668 19.6229 11.0447 22.0109C13.4326 24.3988 16.295 26.0233 19.3284 26.8843C19.8928 27.0445 20.1751 27.1246 20.588 27.1258C21.0462 27.1272 21.6667 26.9658 22.0662 26.7414C22.4263 26.5392 22.6911 26.2744 23.2207 25.7447L23.3783 25.5871C23.9098 25.0557 24.1755 24.7899 24.3198 24.5046C24.6069 23.937 24.6069 23.2667 24.3198 22.6992C24.1755 22.4138 23.9098 22.1481 23.3783 21.6166L23.1835 21.4218C22.8339 21.0721 22.6591 20.8973 22.4833 20.7831C21.8204 20.3521 20.9658 20.3521 20.3029 20.7831C20.1271 20.8973 19.9523 21.0721 19.6027 21.4218C19.4884 21.5361 19.4313 21.5932 19.3644 21.6411C19.127 21.8111 18.7828 21.8698 18.5024 21.7881C18.4235 21.7651 18.3612 21.7351 18.2365 21.6753C16.7869 20.9793 15.4282 20.0305 14.2266 18.8289Z"
                                    stroke="url(#paint0)"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </g>
                            <defs>
                                <linearGradient
                                    id="paint0"
                                    x1="6.15314"
                                    y1="9.48582"
                                    x2="27.1839"
                                    y2="9.90144"
                                    gradientUnits="userSpaceOnUse"
                                >
                                    <stop stop-color="#DEA23C" />
                                    <stop offset="0.456731" stop-color="#FFE47D" />
                                    <stop offset="0.605769" stop-color="#E9B141" />
                                    <stop offset="1" stop-color="#F4CB30" />
                                </linearGradient>
                                <clipPath id="clip0">
                                    <rect width="24" height="24" fill="white" transform="translate(4 4.96582)" />
                                </clipPath>
                            </defs>
                        </svg>
                        <div class="text-white text-sm md:text-lg font-medium">0987 654 321</div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</template>

<script>
export default {}
</script>
    