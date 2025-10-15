<script setup>
import FrontendLayout from '@/layouts/frontend/FrontendLayout.vue';
import { Swiper, SwiperSlide } from 'swiper/vue'
import Testimonial from '@/components/frontend/TestimonialSlider.vue';
import { ref } from 'vue'
import Header from '@/components/frontend/Header.vue'
import OffcanvasMenu from '@/components/frontend/OffcanvasMenu.vue'
import Hero from '@/components/frontend/Hero.vue'
import Service from '@/components/frontend/Service.vue'
import About from '@/components/frontend/About.vue'
import Tabs from '@/components/frontend/Tabs.vue'
import Portfolio from '@/components/frontend/Portfolio.vue'
import Pricing from '@/components/frontend/Pricing.vue'
import Footer from '@/components/frontend/Footer.vue'
import RealtedWork from '@/components/frontend/RealtedWork.vue'
import { formatDate } from '@/lib/dateForamte';
const props = defineProps({
    logo: String,
    offcanvasLogo: String,
    headerMenu: Array,
    socialLinks: Array,
    hero: {
        type: Object,
        required: true
    },
    specialties: Object,
    service: Object,
    about: Object,
    experiences: Object,
    skills: Array,
    educations: Array,
    portfolios: Array,
    project: Array,
})
const showMenu = ref(false)
</script>

<template>
    <FrontendLayout>
        <Header :logo="logo" @toggle-offcanvas="showMenu = !showMenu" />
        <OffcanvasMenu :show="showMenu" :menu="headerMenu" :social-links="socialLinks" :offcanvas-logo="offcanvasLogo"
            @close="showMenu = false" />

            <!-- Hero Section Start -->
            <section class="bg-secondary pt-30">
                <div class="max-w-[1075px] mx-auto px-4 xl:px-0" data-aos="flip-down" data-aos-delay="300">
                    <div class="grid grid-cols-1 lg:grid-cols-2 pb-12">
                        <div class="mb-10">
                            <ul class="flex flex-wrap text-sm font-normal font-Inter leading-tight">
                                <li
                                    class="relative z-[1] before:rounded-full before:bg-black-800 before:block before:absolute before:top-[50%] before:translate-y-[-50%] before:left-[8px] before:-z-[1] before:w-[6px] before:h-[6px] pl-[20px]">
                                    <a class="text-black-text-800" href="#">Web</a>
                                </li>
                                <li
                                    class="relative z-[1] before:rounded-full before:bg-orange before:block before:absolute before:top-[50%] before:translate-y-[-50%] before:left-[8px] before:-z-[1] before:w-[6px] before:h-[6px] pl-[20px] ml-[10px]">
                                    <a class="text-orange" href="#">{{ formatDate(project?.start_date) }}</a>
                                </li>

                            </ul>

                            <h4 class="text-black-800 font-bold font-Syne leading-snug text-[32px] lg:text-[44px]">
                                {{ project?.title }}
                            </h4>
                        </div>
                        <ul class="flex flex-wrap gap-y-6 lg:gap-y-0">
                            <li class="flex flex-wrap flex-col gap-2 w-3/6 sm:w-1/3">
                                <span
                                    class="text-black-text-800 text-sm font-normal font-Inter leading-tight">{{ project?.client }}</span>
                                <h2 class="text-black-800 text-[15px] font-bold font-sans leading-none">Mashorom</h2>
                            </li>
                            <li class="flex flex-wrap flex-col gap-2 w-3/6 sm:w-1/3">
                                <span
                                    class="text-black-text-800 text-sm font-normal font-Inter leading-tight">Category</span>
                                <h4 class="text-black-800 text-[15px] font-bold font-sans leading-none">Web Devlopment
                                </h4>
                            </li>
                            <li class="flex flex-wrap flex-col gap-2 w-3/6 sm:w-1/3">
                                <span
                                    class="text-black-text-800 text-sm font-normal font-Inter leading-tight">Tools</span>
                                <h4 class="text-black-800 text-[15px] font-bold font-sans leading-none">Figma, Webflow
                                </h4>
                            </li>
                            <li class="flex flex-wrap flex-col gap-2 w-3/6 sm:w-1/3">
                                <span class="text-black-text-800 text-sm font-normal font-Inter leading-tight">Start
                                    date</span>
                                <h4 class="text-black-800 text-[15px] font-bold font-sans leading-none">{{ formatDate(project.start_date) }}</h4>
                            </li>
                            <li class="flex flex-wrap flex-col gap-2 w-3/6 sm:w-1/3">
                                <span class="text-black-text-800 text-sm font-normal font-Inter leading-tight">End
                                    date</span>
                                <h4 class="text-black-800 text-[15px] font-bold font-sans leading-none">{{ formatDate(project.end_date) }}</h4>
                            </li>
                        </ul>
                    </div>
                    <div class="grid grid-cols-1 mb-12">
                        <img class="w-full rounded-[20px]" :src="project.image_url" alt="banner">
                    </div>
                </div>
            </section>
            <!-- Hero Section End -->


            <section class="bg-white pb-[120px] mt-[-130px] pt-[130px] md:mt-[-280px] md:pt-[280px]">
                <div class="max-w-[1075px] mx-auto px-4 xl:px-0">
                    <div class="grid grid-cols-1">

                        <h3 class="text-[32px] font-bold font-Syne leading-10 mb-4">Overview</h3>
                        <p class="paragraph mb-12">Minimalism combined with elements of french typography and brutalism
                            helped us to realize the
                            site exactly as we imagined with the client at the beginning: visually restrained, but
                            stylish.
                            Informative and pleasant to use, with an elegant aftertaste of a serious financial
                            institution.
                            Combined with elements of french typography and visually restrained, but stylish.
                            Informative
                            and pleasant to use, with an elegant aftertaste of a serious financial institutional client,
                            and
                            close collaboration.</p>
                        <p class="paragraph mb-12">That is where I come in. A lover of words, a wrangler of copy. Here
                            to
                            create copy that not only
                            reflects who you are and what you stand for, but words that truly land with those that read
                            them, calling your audience in and making them want more.</p>
                        <ul class="text-black-800 text-xl font-bold font-Syne mb-12">
                            <li
                                class="relative z-[1] before:bg-black-800 before:block before:absolute before:top-[50%] before:translate-y-[-50%] before:left-4 before:-z-[1] before:w-[6px] before:h-[6px] pl-10">
                                Advantage</li>
                            <li
                                class="relative z-[1] before:bg-black-800 before:block before:absolute before:top-[50%] before:translate-y-[-50%] before:left-4 before:-z-[1] before:w-[6px] before:h-[6px] pl-10">
                                Accomplished</li>
                            <li
                                class="relative z-[1] before:bg-black-800 before:block before:absolute before:top-[50%] before:translate-y-[-50%] before:left-4 before:-z-[1] before:w-[6px] before:h-[6px] pl-10">
                                Marketplace startups</li>
                            <li
                                class="relative z-[1] before:bg-black-800 before:block before:absolute before:top-[50%] before:translate-y-[-50%] before:left-4 before:-z-[1] before:w-[6px] before:h-[6px] pl-10">
                                SaaS startups</li>
                        </ul>

                        <h3 class="text-[32px] font-bold font-Syne leading-10 mb-4">Typography</h3>
                        <p class="paragraph mb-12">
                            The basic idea was to find a balance between the thin, wispy sans-serif used to indicate a
                            ‘futuristic‘ tone, and a bold, masculine font synonymous with ‘construction‘. We came up
                            with
                            something in the middle, leaning towards lighter-weighted fonts, but still with a hint of
                            that
                            blocky ‘construction’ vibe. We use Chaney for general display and when we want to drive
                            attention to the content, and the technical and geometric Sora font for the body copy and
                            paste
                            overall hierachy.
                        </p>

                    </div>
                    <div class="grid grid-cols-12 gap-6 mb-12">
                        <div class="col-span-12 sm:col-span-5">
                            <img class="w-full h-full rounded-[20px]" src="assets/images/blog-details/post1.png"
                                alt="post image">
                        </div>
                        <div class="col-span-12 sm:col-span-7">
                            <img class="w-full h-full rounded-[20px]" src="assets/images/blog-details/post2.png"
                                alt="post image">
                        </div>
                    </div>

                    <div class="grid grid-cols-1">
                        <h3 class="text-[32px] font-bold font-Syne leading-10 mb-4">Conclusion</h3>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <p class="paragraph">The basic idea was to find a balance between the thin, wispy sans-serif
                            used to indicate a ‘futuristic‘ tone, and a bold, masculine font synonymous with
                            ‘construction‘.
                            We came up with something in the middle, leaning towards lighter-weighted fonts, but still
                            with
                            a hint of that blocky ‘construction’ vibe. We use Chaney for general display and when we
                            want to
                            drive attention to the content, and the technical and geometric Sora font for the body copy
                            and
                            paste overall hierachy.</p>
                        <p class="paragraph">
                            The basic idea was to find a balance between the thin, wispy sans-serif used to indicate a
                            ‘futuristic‘ tone, and a bold, masculine font synonymous with ‘construction‘. We came up
                            with
                            something in the middle, leaning towards lighter-weighted fonts, but still with a hint of
                            that
                            blocky ‘construction’ vibe.
                        </p>
                    </div>
                </div>
            </section>

            <!-- Project Section Start -->
           <RealtedWork :portfolios="portfolios"/>
            <!-- Project Section End -->

        <Footer :about="about" />
    </FrontendLayout>
</template>
