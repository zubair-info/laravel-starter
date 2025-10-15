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
})
const showMenu = ref(false)
</script>

<template>
    <FrontendLayout >
        <div class="overflow-x-hidden">
            <!-- Header start -->

            <Header :logo="logo" @toggle-offcanvas="showMenu = !showMenu" />
            <OffcanvasMenu :show="showMenu" :menu="headerMenu" :social-links="socialLinks"
                :offcanvas-logo="offcanvasLogo" @close="showMenu = false" />

            <!-- Header end -->

            <Hero :hero="hero" />

            <!-- Service start -->
            <Service :service="service" :specialties="specialties" />
            <!-- Service end -->

            <!-- About Us Sectin Start -->
            <About :about="about" />
            <!-- About Us Sectin End -->



            <!-- tabs start -->
            <Tabs :experiences="experiences" :educations="educations" :skills="skills" :about="about" />
            <!-- <section class="featured-properties py-[80px] lg:py-[100px]">
                <div class="container">
                    <div class="grid grid-cols-12 lg:gap-[60px] xl:gap-[100px] 2xl:gap-[134px]">

                        <div class="col-span-12 lg:col-span-5 2xl:col-span-4" data-aos="fade-up">

                            <div class="font-bold font-Syne leading-none flex flex-wrap flex-col gap-y-2 mb-4">
                                <span class="text-orange text-xl">Resume</span>
                                <h3
                                    class="text-black-800 text-4xl lg:text-5xl xl:text-[64px] tracking-[-1.5px] relative before:rounded-full before:bg-primary before:block before:absolute before:top-[2px] before:left-0 before:-z-[1] before:w-[36px] lg:before:w-[48px] xl:before:w-[64px] before:h-[36px] lg:before:h-[48px] xl:before:h-[64px]">
                                    All over my details find here...
                                </h3>



                            </div>
                            <div class="tabs flex flex-wrap lg:flex-col gap-2 my-8 lg:my-0">
                                <button data-tab="about_me_tab"
                                    class="tab-btn justify-between items-center inline-flex group active">
                                    About me
                                    <span class="inline-block ml-3 group-hover:animate-arrow-move-up">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7 17L17 7" stroke="currentColor" stroke-opacity="0.9"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                            <path d="M7 7H17V17" stroke="currentColor" stroke-opacity="0.9"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                        </svg>
                                    </span>
                                </button>
                                <button data-tab="experience_tab"
                                    class="tab-btn justify-between items-center inline-flex group">
                                    Experience
                                    <span class="inline-block ml-3 group-hover:animate-arrow-move-up">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7 17L17 7" stroke="currentColor" stroke-opacity="0.9"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                            <path d="M7 7H17V17" stroke="currentColor" stroke-opacity="0.9"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                        </svg>
                                    </span>
                                </button>
                                <button data-tab="education_tab"
                                    class="tab-btn justify-between items-center inline-flex group">
                                    Education
                                    <span class="inline-block ml-3 group-hover:animate-arrow-move-up">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7 17L17 7" stroke="currentColor" stroke-opacity="0.9"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                            <path d="M7 7H17V17" stroke="currentColor" stroke-opacity="0.9"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                        </svg>
                                    </span>
                                </button>
                                <button data-tab="skills_tab"
                                    class="tab-btn justify-between items-center inline-flex group">
                                    Skills
                                    <span class="inline-block ml-3 group-hover:animate-arrow-move-up">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7 17L17 7" stroke="currentColor" stroke-opacity="0.9"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                            <path d="M7 7H17V17" stroke="currentColor" stroke-opacity="0.9"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                        </svg>
                                    </span>
                                </button>
                                <button data-tab="awards_tab"
                                    class="tab-btn justify-between items-center inline-flex group">
                                    Awards
                                    <span class="inline-block ml-3 group-hover:animate-arrow-move-up">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7 17L17 7" stroke="currentColor" stroke-opacity="0.9"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                            <path d="M7 7H17V17" stroke="currentColor" stroke-opacity="0.9"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                        </svg>
                                    </span>
                                </button>
                            </div>
                        </div>

                        <div class="col-span-12 lg:col-span-7 2xl:col-span-8" data-aos="fade-up" data-aos-delay="400">
                            <div id="about_me_tab" class="tab-content  relative">
                                <div class="grid grid-cols-1">
                                    <h4 class="text-black-800 text-2xl lg:text-[32px] font-bold font-Syne mb-6">
                                        Based in
                                        German</h4>
                                    <p class="paragraph mb-7">Mark Henry, <span class="text-black-800">Product
                                            Designer</span>,
                                        based
                                        in
                                        German. That is where I come in. A
                                        lover of words, a wrangler of copy. Here to create copy that not only
                                        reflects
                                        who you
                                        are
                                        and what you stand for,</p>
                                    <p class="paragraph mb-14">but words that truly land with those that read them,
                                        calling your
                                        audience
                                        in and making them want more.</p>

                                    <ul class="flex-col gap-3 inline-flex">
                                        <li class="gap-10 inline-flex items-center">
                                            <span
                                                class="w-[110px] text-black-text-800 text-lg font-normal leading-none">
                                                Name</span>
                                            <span class="text-black-800 text-2xl font-bold font-Syne leading-8">
                                                Mark Henry</span>
                                        </li>
                                        <li class="gap-10 inline-flex items-center">
                                            <span
                                                class="w-[110px] text-black-text-800 text-lg font-normal leading-none">
                                                Nationality</span>
                                            <span class="text-black-800 text-2xl font-bold font-Syne leading-8">
                                                Germany</span>
                                        </li>
                                        <li class="gap-10 inline-flex items-center">
                                            <span
                                                class="w-[110px] text-black-text-800 text-lg font-normal leading-none">
                                                Phone</span>
                                            <span class="text-black-800 text-2xl font-bold font-Syne leading-8">
                                                +(2) 870 174 302</span>
                                        </li>
                                        <li class="gap-10 inline-flex items-center">
                                            <span
                                                class="w-[110px] text-black-text-800 text-lg font-normal leading-none">
                                                Email</span>
                                            <span class="text-black-800 text-2xl font-bold font-Syne leading-8">
                                                hello@henry.com</span>
                                        </li>
                                        <li class="gap-10 inline-flex items-center">
                                            <span
                                                class="w-[110px] text-black-text-800 text-lg font-normal leading-none">
                                                Experience</span>
                                            <span class="text-black-800 text-2xl font-bold font-Syne leading-8">
                                                12+ years</span>
                                        </li>
                                        <li class="gap-10 inline-flex items-center">
                                            <span
                                                class="w-[110px] text-black-text-800 text-lg font-normal leading-none">
                                                Freelance</span>
                                            <span class="text-black-800 text-2xl font-bold font-Syne leading-8">
                                                Available</span>
                                        </li>
                                        <li class="gap-10 inline-flex items-center">
                                            <span
                                                class="w-[110px] text-black-text-800 text-lg font-normal leading-none">
                                                Skype</span>
                                            <span class="text-black-800 text-2xl font-bold font-Syne leading-8">
                                                henry.halk23</span>
                                        </li>
                                        <li class="gap-10 inline-flex items-center">
                                            <span
                                                class="w-[110px] text-black-text-800 text-lg font-normal leading-none">
                                                Language</span>
                                            <span class="text-black-800 text-2xl font-bold font-Syne leading-8">
                                                German, English</span>
                                        </li>
                                    </ul>

                                </div>
                            </div>


                            <div id="experience_tab" class="tab-content active relative">
                                <h4 class="text-black-800 text-2xl lg:text-[32px] font-bold font-Syne mb-6">
                                    Experience
                                </h4>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-5">

                                    <div
                                        class="pt-[30px] px-7 pb-7 bg-black-500 rounded-2xl transition-all hover:shadow-2xl hover:bg-white flex flex-wrap flex-col gap-8 justify-between">
                                        <span
                                            class="text-sm font-normal font-Inter leading-tight text-black-text-800">03/216
                                            –
                                            Running</span>
                                        <div>
                                            <p
                                                class="text-lg font-normal font-sans leading-7 text-black-800 relative z-[1] before:rounded-full before:bg-orange before:block before:absolute before:top-[50%] before:translate-y-[-50%] before:left-0 before:-z-[1] before:w-[8px] before:h-[8px] pl-4">
                                                Axtra</p>
                                            <h4 class="font-bold font-Syne leading-normal text-2xl text-black-800">
                                                Lead
                                                digital
                                                marketer
                                            </h4>
                                        </div>
                                    </div>

                                    <div
                                        class="pt-[30px] px-7 pb-7 bg-black-500 rounded-2xl transition-all hover:shadow-2xl hover:bg-white flex flex-wrap flex-col gap-8 justify-between">
                                        <span
                                            class="text-sm font-normal font-Inter leading-tight text-black-text-800">03/2008
                                            – 07/2011</span>
                                        <div>
                                            <p
                                                class="text-lg font-normal font-sans leading-7 text-black-800 relative z-[1] before:rounded-full before:bg-orange before:block before:absolute before:top-[50%] before:translate-y-[-50%] before:left-0 before:-z-[1] before:w-[8px] before:h-[8px] pl-4">
                                                Axtra</p>
                                            <h4 class="font-bold font-Syne leading-normal text-2xl text-black-800">
                                                JavaScript
                                                developer
                                            </h4>
                                        </div>
                                    </div>

                                    <div
                                        class="pt-[30px] px-7 pb-7 bg-black-500 rounded-2xl transition-all hover:shadow-2xl hover:bg-white flex flex-wrap flex-col gap-8 justify-between">
                                        <span
                                            class="text-sm font-normal font-Inter leading-tight text-black-text-800">03/2008
                                            – 07/2011</span>
                                        <div>
                                            <p
                                                class="text-lg font-normal font-sans leading-7 text-black-800 relative z-[1] before:rounded-full before:bg-orange before:block before:absolute before:top-[50%] before:translate-y-[-50%] before:left-0 before:-z-[1] before:w-[8px] before:h-[8px] pl-4">
                                                Axtra</p>
                                            <h4 class="font-bold font-Syne leading-normal text-2xl text-black-800">
                                                Product designer
                                            </h4>
                                        </div>
                                    </div>

                                    <div
                                        class="pt-[30px] px-7 pb-7 bg-black-500 rounded-2xl transition-all hover:shadow-2xl hover:bg-white flex flex-wrap flex-col gap-8 justify-between">
                                        <span
                                            class="text-sm font-normal font-Inter leading-tight text-black-text-800">03/2008
                                            – 07/2011</span>
                                        <div>
                                            <p
                                                class="text-lg font-normal font-sans leading-7 text-black-800 relative z-[1] before:rounded-full before:bg-orange before:block before:absolute before:top-[50%] before:translate-y-[-50%] before:left-0 before:-z-[1] before:w-[8px] before:h-[8px] pl-4">
                                                Axtra</p>
                                            <h4 class="font-bold font-Syne leading-normal text-2xl text-black-800">
                                                UX
                                                researcher
                                            </h4>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div id="education_tab" class="tab-content">
                                <h4 class="text-black-800 text-2xl lg:text-[32px] font-bold font-Syne mb-6">
                                    Education
                                </h4>

                                <div class="grid grid-cols-1 gap-6">

                                    <div
                                        class="pt-[30px] px-7 pb-7 bg-black-500 rounded-2xl transition-all hover:shadow-2xl hover:bg-white flex flex-wrap gap-[30px] md:gap-[60px] lg:gap-[104px]">
                                        <span
                                            class="text-sm font-normal font-Inter leading-tight text-black-text-800">003/2008
                                            –
                                            07/2011</span>
                                        <div class="flex-1">
                                            <p
                                                class="text-lg font-normal font-sans leading-7 text-black-800 relative z-[1] before:rounded-full before:bg-orange before:block before:absolute before:top-[50%] before:translate-y-[-50%] before:left-0 before:-z-[1] before:w-[8px] before:h-[8px] pl-4">
                                                Axtra</p>
                                            <h4 class="font-bold font-Syne leading-normal text-2xl text-black-800">
                                                BA
                                                Business
                                                Management
                                            </h4>
                                        </div>
                                    </div>

                                    <div
                                        class="pt-[30px] px-7 pb-7 bg-black-500 rounded-2xl transition-all hover:shadow-2xl hover:bg-white flex flex-wrap gap-[30px] md:gap-[60px] lg:gap-[104px]">
                                        <span
                                            class="text-sm font-normal font-Inter leading-tight text-black-text-800">03/2008
                                            – 07/2011</span>
                                        <div class="flex-1">
                                            <p
                                                class="text-lg font-normal font-sans leading-7 text-black-800 relative z-[1] before:rounded-full before:bg-orange before:block before:absolute before:top-[50%] before:translate-y-[-50%] before:left-0 before:-z-[1] before:w-[8px] before:h-[8px] pl-4">
                                                Axtra</p>
                                            <h4 class="font-bold font-Syne leading-normal text-2xl text-black-800">
                                                BA
                                                Business
                                                Management
                                            </h4>
                                        </div>
                                    </div>

                                    <div
                                        class="pt-[30px] px-7 pb-7 bg-black-500 rounded-2xl transition-all hover:shadow-2xl hover:bg-white flex flex-wrap gap-[30px] md:gap-[60px] lg:gap-[104px]">
                                        <span
                                            class="text-sm font-normal font-Inter leading-tight text-black-text-800">03/2008
                                            – 07/2011</span>
                                        <div class="flex-1">
                                            <p
                                                class="text-lg font-normal font-sans leading-7 text-black-800 relative z-[1] before:rounded-full before:bg-orange before:block before:absolute before:top-[50%] before:translate-y-[-50%] before:left-0 before:-z-[1] before:w-[8px] before:h-[8px] pl-4">
                                                Axtra</p>
                                            <h4 class="font-bold font-Syne leading-normal text-2xl text-black-800">
                                                BA
                                                Business
                                                Management
                                            </h4>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div id="skills_tab" class="tab-content">
                                <h4 class="text-black-800 text-2xl lg:text-[32px] font-bold font-Syne mb-6">Skills
                                </h4>

                                <div
                                    class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-2 xl:grid-cols-3 gap-5">

                                    <div
                                        class="pt-[30px] px-7 pb-7 bg-black-500 rounded-2xl transition-all hover:shadow-2xl hover:bg-white flex flex-wrap gap-4 items-start">
                                        <img class="items-start" src="assets/images/skills/vs-code.png" alt="icons">
                                        <div class="flex flex-wrap gap-1 flex-1 flex-col">
                                            <h4 class="font-bold font-Syne leading-normal text-xl text-black-800">
                                                React
                                                JS</h4>
                                            <p class="text-sm font-normal font-Inter leading-none text-black-800">
                                                (90%)
                                            </p>
                                        </div>
                                    </div>


                                    <div
                                        class="pt-[30px] px-7 pb-7 bg-black-500 rounded-2xl transition-all hover:shadow-2xl hover:bg-white flex flex-wrap gap-4 items-start">
                                        <img class="items-start" src="assets/images/skills/figma.png" alt="icons">
                                        <div class="flex flex-wrap gap-1 flex-1 flex-col">
                                            <h4 class="font-bold font-Syne leading-normal text-xl text-black-800">
                                                Figma
                                            </h4>
                                            <p class="text-sm font-normal font-Inter leading-none text-black-800">
                                                (70%)
                                            </p>
                                        </div>
                                    </div>

                                    <div
                                        class="pt-[30px] px-7 pb-7 bg-black-500 rounded-2xl transition-all hover:shadow-2xl hover:bg-white flex flex-wrap gap-4 items-start">
                                        <img class="items-start" src="assets/images/skills/framer.png" alt="icons">
                                        <div class="flex flex-wrap gap-1 flex-1 flex-col">
                                            <h4 class="font-bold font-Syne leading-normal text-xl text-black-800">
                                                Framer
                                            </h4>
                                            <p class="text-sm font-normal font-Inter leading-none text-black-800">
                                                (80%)
                                            </p>
                                        </div>
                                    </div>

                                    <div
                                        class="pt-[30px] px-7 pb-7 bg-black-500 rounded-2xl transition-all hover:shadow-2xl hover:bg-white flex flex-wrap gap-4 items-start">
                                        <img class="items-start" src="assets/images/skills/framer.png" alt="icons">
                                        <div class="flex flex-wrap gap-1 flex-1 flex-col">
                                            <h4 class="font-bold font-Syne leading-normal text-xl text-black-800">
                                                Framer
                                            </h4>
                                            <p class="text-sm font-normal font-Inter leading-none text-black-800">
                                                (80%)
                                            </p>
                                        </div>
                                    </div>

                                    <div
                                        class="pt-[30px] px-7 pb-7 bg-black-500 rounded-2xl transition-all hover:shadow-2xl hover:bg-white flex flex-wrap gap-4 items-start">
                                        <img class="items-start" src="assets/images/skills/framer.png" alt="icons">
                                        <div class="flex flex-wrap gap-1 flex-1 flex-col">
                                            <h4 class="font-bold font-Syne leading-normal text-xl text-black-800">
                                                Framer
                                            </h4>
                                            <p class="text-sm font-normal font-Inter leading-none text-black-800">
                                                (80%)
                                            </p>
                                        </div>
                                    </div>

                                    <div
                                        class="pt-[30px] px-7 pb-7 bg-black-500 rounded-2xl transition-all hover:shadow-2xl hover:bg-white flex flex-wrap gap-4 items-start">
                                        <img class="items-start" src="assets/images/skills/framer.png" alt="icons">
                                        <div class="flex flex-wrap gap-1 flex-1 flex-col">
                                            <h4 class="font-bold font-Syne leading-normal text-xl text-black-800">
                                                Framer
                                            </h4>
                                            <p class="text-sm font-normal font-Inter leading-none text-black-800">
                                                (80%)
                                            </p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div id="awards_tab" class="tab-content">
                                <h4 class="text-black-800 text-2xl lg:text-[32px] font-bold font-Syne mb-6">Awards
                                </h4>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                                    <div
                                        class="p-8 bg-black-500 rounded-2xl transition-all hover:shadow-2xl hover:bg-white group flex flex-wrap flex-col gap-8">

                                        <div class="flex items-start justify-between">
                                            <img src="assets/images/awards/w-dot.png" alt="icons">
                                            <span class="font-normal text-sm font-Inter text-black-text-800">2018</span>
                                        </div>

                                        <div>
                                            <p
                                                class="text-lg font-normal font-sans leading-7 text-black-800 relative z-[1] before:rounded-full before:bg-orange before:block before:absolute before:top-[50%] before:translate-y-[-50%] before:left-0 before:-z-[1] before:w-[8px] before:h-[8px] pl-4">
                                                Winner</p>
                                            <h4 class="font-bold font-Syne leading-normal text-xl text-black-800">
                                                01X
                                                Developer Award
                                            </h4>
                                        </div>
                                    </div>

                                    <div
                                        class="p-8 bg-black-500 rounded-2xl transition-all hover:shadow-2xl hover:bg-white group flex flex-wrap flex-col gap-8">

                                        <div class="flex items-start justify-between">
                                            <img src="assets/images/awards/webby.png" alt="icons">
                                            <span class="font-normal text-sm font-Inter text-black-text-800">2018</span>
                                        </div>

                                        <div>
                                            <p
                                                class="text-lg font-normal font-sans leading-7 text-black-800 relative z-[1] before:rounded-full before:bg-orange before:block before:absolute before:top-[50%] before:translate-y-[-50%] before:left-0 before:-z-[1] before:w-[8px] before:h-[8px] pl-4">
                                                Winner</p>
                                            <h4 class="font-bold font-Syne leading-normal text-xl text-black-800">
                                                01X
                                                Developer Award
                                            </h4>
                                        </div>
                                    </div>

                                    <div
                                        class="p-8 bg-black-500 rounded-2xl transition-all hover:shadow-2xl hover:bg-white group flex flex-wrap flex-col gap-8">

                                        <div class="flex items-start justify-between">
                                            <img src="assets/images/awards/fwa.png" alt="icons">
                                            <span class="font-normal text-sm font-Inter text-black-text-800">2018</span>
                                        </div>

                                        <div>
                                            <p
                                                class="text-lg font-normal font-sans leading-7 text-black-800 relative z-[1] before:rounded-full before:bg-orange before:block before:absolute before:top-[50%] before:translate-y-[-50%] before:left-0 before:-z-[1] before:w-[8px] before:h-[8px] pl-4">
                                                Winner</p>
                                            <h4 class="font-bold font-Syne leading-normal text-xl text-black-800">
                                                01X
                                                Developer Award
                                            </h4>
                                        </div>
                                    </div>

                                    <div
                                        class="p-8 bg-black-500 rounded-2xl transition-all hover:shadow-2xl hover:bg-white group flex flex-wrap flex-col gap-8">

                                        <div class="flex items-start justify-between">
                                            <img src="assets/images/awards/wordpress.png" alt="icons">
                                            <span class="font-normal text-sm font-Inter text-black-text-800">2018</span>
                                        </div>

                                        <div>
                                            <p
                                                class="text-lg font-normal font-sans leading-7 text-black-800 relative z-[1] before:rounded-full before:bg-orange before:block before:absolute before:top-[50%] before:translate-y-[-50%] before:left-0 before:-z-[1] before:w-[8px] before:h-[8px] pl-4">
                                                Winner</p>
                                            <h4 class="font-bold font-Syne leading-normal text-xl text-black-800">
                                                01X
                                                Developer Award
                                            </h4>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <span class="flex justify-end mt-14 -mr-3">
                                <svg width="54" height="54" viewBox="0 0 54 54" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M27.5625 0C27.5625 23.1273 9.1875 28.5455 0 27.8182C16.875 31.0909 25.3125 34.3636 27 54C27 40.3636 34.875 30.5455 54 27.8182C46.125 28.3636 29.8125 24 27.5625 0Z"
                                        fill="#FFB646" />
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
            </section> -->
            <!-- tabs end -->



            <!-- Portfolio Section Start -->
            <portfolio :portfolios="portfolios"/>
            <!-- Portfolio Section End -->




            <!-- Testimonial section Start -->
            <!-- <Testimonial /> -->
            <!-- Testimonial section End -->

            <!-- Brand Section Start-->

            <!-- <div class="bg-white brandCarousel" data-aos="flip-down">
                <div class="container">
                    <div class="swiper py-6 border-t border-b border-black-text-100">

                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img class="mx-auto block" src="assets/images/brand/logo1.svg" alt=" brandlogo">
                            </div>
                            <div class="swiper-slide">
                                <img class="mx-auto block" src="assets/images/brand/logo2.svg" alt=" brandlogo">
                            </div>
                            <div class="swiper-slide">
                                <img class="mx-auto block" src="assets/images/brand/logo3.svg" alt=" brandlogo">
                            </div>
                            <div class="swiper-slide">
                                <img class="mx-auto block" src="assets/images/brand/logo4.svg" alt=" brandlogo">
                            </div>
                            <div class="swiper-slide">
                                <img class="mx-auto block" src="assets/images/brand/logo5.svg" alt=" brandlogo">
                            </div>
                            <div class="swiper-slide">
                                <img class="mx-auto block" src="assets/images/brand/logo6.svg" alt=" brandlogo">
                            </div>
                            <div class="swiper-slide">
                                <img class="mx-auto block" src="assets/images/brand/logo3.svg" alt=" brandlogo">
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <!-- Brand Section End-->



            <!-- Blog Section Start -->
            <!-- <section class="bg-white py-[120px]">
                <div class="container">
                    <div class="grid grid-cols-12">
                        <div class="col-span-12" data-aos="fade-up">
                            <div
                                class="font-bold font-Syne text-center leading-none flex flex-wrap flex-col gap-y-2 mb-10">
                                <span class="text-orange text-xl">Blog</span>
                                <h3 class="text-black-800 text-4xl lg:text-5xl xl:text-[64px] tracking-[-1.5px]">
                                    My blog
                                    <span
                                        class="relative z-[1] before:rounded-full before:bg-primary before:block before:absolute before:top-[8px] before:left-[20px] before:-z-[1] before:w-[36px] lg:before:w-[48px] xl:before:w-[69px] before:h-[36px] lg:before:h-[48px] xl:before:h-[69px]">po</span>st
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        <div data-aos="fade-up">
                            <div class="rounded-[20px] overflow-hidden mb-6">
                                <img class="w-full" src="assets/images/blog/blog1.png" alt="blog image">
                            </div>
                            <div class="flex flex-wrap flex-col gap-3">
                                <ul class="flex flex-wrap text-sm font-normal font-Inter leading-tight">
                                    <li
                                        class="relative z-[1] before:rounded-full before:bg-black-800 before:block before:absolute before:top-[50%] before:translate-y-[-50%] before:left-[15px] before:-z-[1] before:w-[8px] before:h-[8px] pl-[30px]">
                                        <a class="text-black-text-800" href="#">UI Design</a>
                                    </li>
                                    <li
                                        class="relative z-[1] before:rounded-full before:bg-orange before:block before:absolute before:top-[50%] before:translate-y-[-50%] before:left-[15px] before:-z-[1] before:w-[8px] before:h-[8px] pl-[30px]">
                                        <a class="text-orange" href="#">03 May 2019</a>
                                    </li>

                                </ul>
                                <div class="flex justify-between items-end text-black-800 hover:text-orange group">
                                    <h4
                                        class="font-bold font-Syne transition-all leading-8 text-[18px] md:text-[20px] 2xl:text-[22px]">
                                        <a href="blog-details.html">Right-lo-left
                                            behind development in mobile web design</a>
                                    </h4>
                                    <a href="blog-details.html" class="group-hover:animate-arrow-move-up">
                                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M30.8839 9.11612C31.372 9.60427 31.372 10.3957 30.8839 10.8839L10.8839 30.8839C10.3957 31.372 9.60427 31.372 9.11612 30.8839C8.62796 30.3957 8.62796 29.6043 9.11612 29.1161L29.1161 9.11612C29.6043 8.62796 30.3957 8.62796 30.8839 9.11612Z"
                                                fill="currentColor" fill-opacity="0.9" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M12.5 10C12.5 9.30964 13.0596 8.75 13.75 8.75H30C30.6904 8.75 31.25 9.30964 31.25 10V26.25C31.25 26.9404 30.6904 27.5 30 27.5C29.3096 27.5 28.75 26.9404 28.75 26.25V11.25H13.75C13.0596 11.25 12.5 10.6904 12.5 10Z"
                                                fill="currentColor" fill-opacity="0.9" />
                                        </svg>

                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> -->
            <!-- Blog Section End -->


            <!-- Pricing Section Start -->
             <Pricing :pricing="pricing"/>

            <!-- Pricing Section End -->

            <!-- Footer Start -->
            <Footer :about="about"/>
            <!-- Footer End -->
        </div>
    </FrontendLayout>
</template>
