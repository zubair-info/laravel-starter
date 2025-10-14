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
})
const showMenu = ref(false)
</script>

<template>
    <FrontendLayout>
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
            <section class="bg-secondary py-[120px]">
                <div class="container">
                    <div class="grid grid-cols-12 gap-6">
                        <div class="col-span-12" data-aos="fade-up">
                            <div
                                class="font-bold font-Syne text-center leading-none flex flex-wrap flex-col gap-y-2 mb-10">
                                <span class="text-orange text-xl">Portfolio</span>
                                <h3 class="text-black-800 text-4xl lg:text-5xl xl:text-[64px] tracking-[-1.5px]">
                                    My recent <span
                                        class="relative z-[1] before:rounded-full before:bg-primary before:block before:absolute before:top-[4px] before:left-[-6px] before:-z-[1] before:w-[36px] lg:before:w-[48px] xl:before:w-[64px] before:h-[36px] lg:before:h-[48px] xl:before:h-[64px]">w</span>ork
                                </h3>
                            </div>
                        </div>

                        <div class="col-span-12 md:col-span-6" data-aos="fade-up" data-aos-delay="300">
                            <div class="rounded-[20px] overflow-hidden mb-6">
                                <img src="assets/images/projects/project1.png" alt="project1">
                            </div>
                            <div class="flex flex-wrap flex-col gap-3">
                                <div class="flex flex-wrap gap-2">
                                    <a class="text-xs text-black-text-800 uppercase font-medium font-Inter leading-none py-[6px] px-4 rounded-[40px] border border-black-text-400 transition-all hover:bg-active hover:border-active hover:text-white"
                                        href="projects.html">APP</a>
                                    <a class="text-xs text-black-text-800 uppercase font-medium font-Inter leading-none py-[6px] px-4 rounded-[40px] border border-black-text-400 transition-all hover:bg-active hover:border-active hover:text-white"
                                        href="projects.html">DEVELOPMENT</a>

                                </div>
                                <div
                                    class="flex flex-wrap items-center justify-between text-black-800 hover:text-orange group">
                                    <h4
                                        class="font-bold font-Syne text-center leading-10 text-[20px] lg:text-[24px] xl:text-[32px] capitalize">
                                        <a class="transition-all" href="project-details.html">Basinik Finance
                                            App</a>
                                    </h4>
                                    <a class="group-hover:animate-arrow-move-up" href="project-details.html">
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

                        <div class="col-span-12 md:col-span-6" data-aos="fade-up" data-aos-delay="500">
                            <div class="rounded-[20px] overflow-hidden mb-6">
                                <img src="assets/images/projects/project2.png" alt="project1">
                            </div>
                            <div class="flex flex-wrap flex-col gap-3">
                                <div class="flex flex-wrap gap-2">
                                    <a class="text-xs text-black-text-800 uppercase font-medium font-Inter leading-none py-[6px] px-4 rounded-[40px] border border-black-text-400 transition-all hover:bg-active hover:border-active hover:text-white"
                                        href="projects.html">APP</a>
                                    <a class="text-xs text-black-text-800 uppercase font-medium font-Inter leading-none py-[6px] px-4 rounded-[40px] border border-black-text-400 transition-all hover:bg-active hover:border-active hover:text-white"
                                        href="projects.html">DEVELOPMENT</a>

                                </div>
                                <div
                                    class="flex flex-wrap items-center justify-between text-black-800 hover:text-orange group">
                                    <h4
                                        class="font-bold font-Syne text-center leading-10 text-[20px] lg:text-[24px] xl:text-[32px] capitalize">
                                        <a class="transition-all" href="project-details.html">Oxilex Dashboard
                                            design</a>
                                    </h4>
                                    <a class="group-hover:animate-arrow-move-up" href="project-details.html">
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


                    <div class="col-span-12 mt-12" data-aos="fade-up">
                        <div class="flex group">
                            <a href="projects.html" class="flex items-center justify-center flex-wrap btn-primary grow">
                                View All Project
                                <span class="inline-block ml-3 group-hover:animate-arrow-move-up">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7 17L17 7" stroke="currentColor" stroke-opacity="0.9" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M7 7H17V17" stroke="currentColor" stroke-opacity="0.9" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Portfolio Section End -->




            <!-- Testimonial section Start -->
            <!-- <Testimonial /> -->
            <!-- Testimonial section End -->

            <!-- Brand Section Start-->

            <div class="bg-white brandCarousel" data-aos="flip-down">
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
            </div>

            <!-- Brand Section End-->



            <!-- Blog Section Start -->
            <section class="bg-white py-[120px]">
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

                        <!-- Blog Item Start -->
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
                        <!-- Blog Item End -->

                        <!-- Blog Item Start -->
                        <div class="sm:mt-10" data-aos="fade-up" data-aos-delay="300">
                            <div class="rounded-[20px] overflow-hidden mb-6">
                                <img class="w-full" src="assets/images/blog/blog2.png" alt="blog image">
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
                                        <a href="blog-details.html">Connect
                                            craft: Reading
                                            the smart experience</a>
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
                        <!-- Blog Item End -->

                        <!-- Blog Item Start -->
                        <div data-aos="fade-up" data-aos-delay="500">
                            <div class="rounded-[20px] overflow-hidden mb-6">
                                <img class="w-full" src="assets/images/blog/blog3.png" alt="blog image">
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
                                        <a href="blog-details.html">Ecoglow: Sustainable
                                            skincare a brighter tomorrow</a>
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
                        <!-- Blog Item End -->

                        <!-- Blog Item Start -->
                        <div class="sm:mt-10" data-aos="fade-up" data-aos-delay="700">
                            <div class="rounded-[20px] overflow-hidden mb-6">
                                <img class="w-full" src="assets/images/blog/blog4.png" alt="blog image">
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
                                        <a href="blog-details.html">Right-lo-left behind
                                            development in mobile web design</a>
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
                        <!-- Blog Item End -->

                    </div>

                </div>
            </section>
            <!-- Blog Section End -->


            <!-- Pricing Section Start -->
            <section class="bg-white pb-[120px]">
                <div class="container">
                    <div class="grid grid-cols-12">
                        <div class="col-span-12">
                            <div class="flex flex-col md:flex-row justify-between md:items-end mb-16">
                                <div class="font-bold font-Syne leading-none flex flex-wrap flex-col gap-y-2 max-w-[325px] lg:max-w-[400px] xl:max-w-[527px]"
                                    data-aos="fade-up">
                                    <span class="text-orange text-xl">Pricing</span>
                                    <h3 class="text-black-800 text-4xl lg:text-5xl xl:text-[64px] tracking-[-1.5px]">
                                        Stay chill and pick your <span
                                            class="relative z-[1] before:rounded-full before:bg-primary before:block before:absolute before:top-[13px] before:left-[-4px] before:-z-[1] before:w-[36px] lg:before:w-[48px] xl:before:w-[64px] before:h-[36px] lg:before:h-[48px] xl:before:h-[64px]">pl</span>an
                                    </h3>
                                </div>

                                <div class="flex mt-8 md:mt-0" data-aos="fade-up" data-aos-delay="200">
                                    <a href="contact.html" class="flex items-center flex-wrap btn-primary group">
                                        Contact for Custom Project
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
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

                        <!-- Pricing Item Start -->

                        <div class="p-6 lg:p-8 bg-black-500 rounded-2xl transition-all hover:shadow-2xl hover:bg-white group flex flex-wrap flex-col gap-10 lg:gap-12 group"
                            data-aos="fade-up" data-aos-delay="300">

                            <div class="flex items-center justify-between">
                                <span
                                    class="text-lg font-normal font-sans leading-none text-black-text-600">Basic</span>
                                <span class="font-bold text-xl font-Syne text-orange">$48/h</span>
                            </div>

                            <div class="flex flex-wrap justify-between items-end">
                                <div>
                                    <h4 class="font-bold font-Syne leading-10 text-[32px] text-black-800 mb-1">20
                                        hrs
                                    </h4>
                                    <p class="text-lg font-normal font-sans leading-none text-black-text-600">10
                                        hours
                                        per
                                        week</p>
                                </div>

                                <a href="#"
                                    class="text-black-text-600 group-hover:text-orange group-hover:animate-arrow-move-up">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path class="transition-all" d="M7 17L17 7" stroke="currentColor"
                                            stroke-opacity="0.6" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path class="transition-all" d="M7 7H17V17" stroke="currentColor"
                                            stroke-opacity="0.6" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>

                        <!-- Pricing Item End -->
                        <!-- Pricing Item Start -->

                        <div class="p-6 lg:p-8 bg-black-500 rounded-2xl transition-all hover:shadow-2xl hover:bg-white group flex flex-wrap flex-col gap-10 lg:gap-12 group"
                            data-aos="fade-up" data-aos-delay="500">

                            <div class="flex items-center justify-between">
                                <span
                                    class="text-lg font-normal font-sans leading-none text-black-text-600">Premium</span>
                                <span class="font-bold text-xl font-Syne text-orange">$60/h</span>
                            </div>

                            <div class="flex flex-wrap justify-between items-end">
                                <div>
                                    <h4 class="font-bold font-Syne leading-10 text-[32px] text-black-800 mb-1">30
                                        hrs
                                    </h4>
                                    <p class="text-lg font-normal font-sans leading-none text-black-text-600">15
                                        hours
                                        per
                                        week</p>
                                </div>

                                <a href="#"
                                    class="text-black-text-600 group-hover:text-orange group-hover:animate-arrow-move-up">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path class="transition-all" d="M7 17L17 7" stroke="currentColor"
                                            stroke-opacity="0.6" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path class="transition-all" d="M7 7H17V17" stroke="currentColor"
                                            stroke-opacity="0.6" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>

                        <!-- Pricing Item End -->
                        <!-- Pricing Item Start -->

                        <div class="p-6 lg:p-8 bg-black-500 rounded-2xl transition-all hover:shadow-2xl hover:bg-white group flex flex-wrap flex-col gap-10 lg:gap-12 group"
                            data-aos="fade-up" data-aos-delay="700">

                            <div class="flex items-center justify-between">
                                <span
                                    class="text-lg font-normal font-sans leading-none text-black-text-600">Platinum</span>
                                <span class="font-bold text-xl font-Syne text-orange">$60/h</span>
                            </div>

                            <div class="flex flex-wrap justify-between items-end">
                                <div>
                                    <h4 class="font-bold font-Syne leading-10 text-[32px] text-black-800 mb-1">20
                                        hrs
                                    </h4>
                                    <p class="text-lg font-normal font-sans leading-none text-black-text-600">80
                                        hours
                                        per
                                        week</p>
                                </div>

                                <a href="#"
                                    class="text-black-text-600 group-hover:text-orange group-hover:animate-arrow-move-up">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path class="transition-all" d="M7 17L17 7" stroke="currentColor"
                                            stroke-opacity="0.6" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path class="transition-all" d="M7 7H17V17" stroke="currentColor"
                                            stroke-opacity="0.6" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>

                        <!-- Pricing Item End -->

                    </div>
                </div>
            </section>
            <!-- Pricing Section End -->

            <!-- Footer Start -->
            <footer class="footer bg-black-800 pt-[80px] lg:pt-[100px] xl:pt-[120px] pb-[60px]">
                <div class="container">
                    <div class="overflow-x-hidden" data-aos="flip-down">
                        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5 lg:gap-6">
                            <div class="pt-12">
                                <h3
                                    class="text-white font-Syne font-bold text-4xl lg:text-5xl xl:text-[64px] tracking-[-1.5px]">
                                    <span
                                        class="relative z-[1] before:rounded-full before:bg-primary before:block before:absolute before:top-[8px] before:left-[0] before:-z-[1] before:w-[36px] lg:before:w-[48px] xl:before:w-[60px] before:h-[36px] lg:before:h-[48px] xl:before:h-[60px]">Le</span>
                                    t’s work together
                                </h3>
                                <div class="flex flex-wrap items-center mt-10">
                                    <span class="text-xl font-bold font-Syne text-white">Based in Germany |</span>
                                    <div class="ml-5 md:ml-[5px] lg:ml-0 xl:ml-[16px] 2xl:ml-5">
                                        <ul class="flex flex-wrap gap-x-4 items-center">
                                            <li><a href="#" class="text-white hover:text-orange">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M7.443 5.3501C8.082 5.3501 8.673 5.4001 9.213 5.5481C9.754 5.6471 10.197 5.8451 10.59 6.0921C10.984 6.3401 11.279 6.6861 11.475 7.1311C11.672 7.5761 11.771 8.1211 11.771 8.7141C11.771 9.4071 11.623 10.0001 11.279 10.4451C10.984 10.8911 10.492 11.2861 9.902 11.5831C10.738 11.8311 11.377 12.2761 11.771 12.8701C12.164 13.4631 12.41 14.2051 12.41 15.0461C12.41 15.7391 12.262 16.3321 12.016 16.8271C11.771 17.3221 11.377 17.7671 10.934 18.0641C10.4528 18.3824 9.92083 18.6164 9.361 18.7561C8.771 18.9051 8.181 19.0041 7.591 19.0041H1V5.3501H7.443ZM7.049 10.8901C7.59 10.8901 8.033 10.7421 8.377 10.4951C8.721 10.2481 8.869 9.8021 8.869 9.2581C8.869 8.9611 8.819 8.6651 8.721 8.4671C8.623 8.2691 8.475 8.1201 8.279 7.9721C8.082 7.8731 7.885 7.7741 7.639 7.7251C7.393 7.6751 7.148 7.6751 6.852 7.6751H4V10.8911H7.05L7.049 10.8901ZM7.197 16.7281C7.492 16.7281 7.787 16.6781 8.033 16.6291C8.279 16.5791 8.525 16.4811 8.721 16.3321C8.92138 16.1873 9.08903 16.002 9.213 15.7881C9.311 15.5411 9.41 15.2441 9.41 14.8981C9.41 14.2051 9.213 13.7111 8.82 13.3641C8.426 13.0671 7.885 12.9191 7.246 12.9191H4V16.7291L7.197 16.7281ZM16.689 16.6781C17.082 17.0741 17.672 17.2721 18.459 17.2721C19 17.2721 19.492 17.1241 19.885 16.8771C20.279 16.5801 20.525 16.2831 20.623 15.9871H23.033C22.639 17.1731 22.049 18.0141 21.263 18.5591C20.475 19.0531 19.541 19.3501 18.41 19.3501C17.6864 19.3523 16.9688 19.218 16.295 18.9541C15.6887 18.7267 15.148 18.353 14.721 17.8661C14.2643 17.4107 13.9267 16.8498 13.738 16.2331C13.492 15.5901 13.393 14.8981 13.393 14.1061C13.393 13.3641 13.492 12.6721 13.738 12.0281C13.9749 11.4085 14.3252 10.8384 14.771 10.3471C15.2201 9.88594 15.7543 9.51613 16.344 9.2581C17.0007 8.99416 17.7022 8.85969 18.41 8.8621C19.246 8.8621 19.984 9.0111 20.623 9.3571C21.263 9.7031 21.754 10.0991 22.147 10.6931C22.541 11.2371 22.837 11.8801 23.033 12.5731C23.131 13.2651 23.18 13.9581 23.131 14.7491H16C16 15.5411 16.295 16.2831 16.689 16.6791V16.6781ZM19.787 11.4841C19.443 11.1381 18.902 10.9401 18.262 10.9401C17.82 10.9401 17.475 11.0401 17.18 11.1881C16.885 11.3361 16.689 11.5341 16.492 11.7321C16.311 11.9234 16.1912 12.1643 16.148 12.4241C16.098 12.6721 16.049 12.8701 16.049 13.0671H20.475C20.377 12.3251 20.131 11.8311 19.787 11.4841ZM15.459 6.2901H20.967V7.6261H15.46V6.2901H15.459Z"
                                                            fill="currentColor" fill-opacity="0.9"></path>
                                                    </svg>

                                                </a></li>
                                            <li><a href="#" class="text-white hover:text-orange"><svg width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M6.94043 5.00002C6.94017 5.53046 6.7292 6.03906 6.35394 6.41394C5.97868 6.78883 5.46986 6.99929 4.93943 6.99902C4.409 6.99876 3.90039 6.78779 3.52551 6.41253C3.15062 6.03727 2.94016 5.52846 2.94043 4.99802C2.9407 4.46759 3.15166 3.95899 3.52692 3.5841C3.90218 3.20922 4.411 2.99876 4.94143 2.99902C5.47186 2.99929 5.98047 3.21026 6.35535 3.58552C6.73024 3.96078 6.9407 4.46959 6.94043 5.00002ZM7.00043 8.48002H3.00043V21H7.00043V8.48002ZM13.3204 8.48002H9.34043V21H13.2804V14.43C13.2804 10.77 18.0504 10.43 18.0504 14.43V21H22.0004V13.07C22.0004 6.90002 14.9404 7.13002 13.2804 10.16L13.3204 8.48002Z"
                                                            fill="currentColor" fill-opacity="0.9"></path>
                                                    </svg>
                                                </a></li>
                                            <li><a href="#" class="text-white hover:text-orange"><svg width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M19.989 11.572C19.907 9.99792 19.3596 8.4836 18.416 7.221C18.1285 7.53061 17.8212 7.82123 17.496 8.091C16.4969 8.92086 15.3805 9.5982 14.183 10.101C14.35 10.451 14.503 10.79 14.638 11.11V11.113C14.665 11.174 14.688 11.231 14.732 11.342L14.749 11.382C16.262 11.212 17.858 11.275 19.405 11.485C19.611 11.512 19.805 11.541 19.989 11.572ZM10.604 4.122C11.5786 5.49516 12.4772 6.92062 13.296 8.392C14.519 7.91 15.53 7.302 16.344 6.625C16.674 6.351 16.938 6.093 17.14 5.87C15.701 4.65972 13.8803 3.99733 12 4C11.524 4 11.058 4.042 10.604 4.121V4.122ZM4.253 9.997C4.93423 9.97981 5.61464 9.93878 6.293 9.874C7.93264 9.72734 9.55828 9.4525 11.155 9.052C10.3205 7.60221 9.41956 6.19171 8.455 4.825C7.42472 5.3354 6.51626 6.06141 5.79124 6.95379C5.06623 7.84617 4.54162 8.88404 4.253 9.997ZM5.783 17.035C6.25195 16.3575 6.77894 15.7221 7.358 15.136C8.812 13.646 10.528 12.486 12.514 11.846L12.576 11.828C12.411 11.464 12.256 11.139 12.1 10.833C10.264 11.368 8.33 11.702 6.403 11.875C5.463 11.96 4.62 11.997 4 12.003C3.99815 13.8356 4.62722 15.6128 5.783 17.035ZM15.004 19.415C14.6184 17.4703 14.0725 15.5607 13.372 13.706C11.372 14.433 9.776 15.496 8.543 16.764C8.0454 17.2664 7.60382 17.8213 7.226 18.419C8.60481 19.4478 10.2797 20.0025 12 20C13.0299 20.0015 14.0504 19.8035 15.005 19.417L15.004 19.415ZM16.878 18.34C18.4393 17.1398 19.5028 15.4057 19.865 13.47C19.525 13.385 19.094 13.3 18.62 13.234C17.5661 13.0823 16.4968 13.0712 15.44 13.201C16.035 14.8799 16.5154 16.5961 16.878 18.34ZM12 22C6.477 22 2 17.523 2 12C2 6.477 6.477 2 12 2C17.523 2 22 6.477 22 12C22 17.523 17.523 22 12 22Z"
                                                            fill="currentColor" fill-opacity="0.9"></path>
                                                    </svg>
                                                </a></li>
                                            <li><a href="#" class="text-white hover:text-orange"><svg width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.001 2C6.47598 2 2.00098 6.475 2.00098 12C1.99977 14.0992 2.65958 16.1454 3.88679 17.8484C5.114 19.5515 6.84631 20.8249 8.83798 21.488C9.33798 21.575 9.52598 21.275 9.52598 21.012C9.52598 20.775 9.51298 19.988 9.51298 19.15C7.00098 19.613 6.35098 18.538 6.15098 17.975C6.03798 17.687 5.55098 16.8 5.12598 16.562C4.77598 16.375 4.27598 15.912 5.11298 15.9C5.90098 15.887 6.46298 16.625 6.65098 16.925C7.55098 18.437 8.98798 18.012 9.56298 17.75C9.65098 17.1 9.91298 16.663 10.201 16.413C7.97598 16.163 5.65098 15.3 5.65098 11.475C5.65098 10.387 6.03798 9.488 6.67598 8.788C6.57598 8.538 6.22598 7.513 6.77598 6.138C6.77598 6.138 7.61298 5.875 9.52598 7.162C10.3401 6.9364 11.1812 6.82302 12.026 6.825C12.876 6.825 13.726 6.937 14.526 7.162C16.439 5.862 17.276 6.138 17.276 6.138C17.826 7.513 17.476 8.538 17.376 8.788C18.013 9.488 18.401 10.375 18.401 11.475C18.401 15.313 16.064 16.163 13.839 16.413C14.201 16.725 14.514 17.325 14.514 18.263C14.514 19.6 14.501 20.675 14.501 21.013C14.501 21.275 14.689 21.587 15.189 21.487C17.1738 20.8166 18.8985 19.5408 20.1203 17.8389C21.3421 16.1371 21.9995 14.095 22 12C22 6.475 17.525 2 12 2H12.001Z"
                                                            fill="currentColor" fill-opacity="0.9"></path>
                                                    </svg>
                                                </a></li>

                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="py-9 px-7 border-border-white border rounded-2xl flex flex-col justify-between group">
                                <h3 class="text-xl font-bold font-Syne text-white">Looking for a hectic designer?
                                </h3>
                                <div class="flex justify-between items-center">
                                    <p class="text-2xl font-bold font-Syne leading-none text-orange ">
                                        hello@henry.com
                                    </p>
                                    <a href="#"
                                        class="text-white group-hover:animate-arrow-move-up group-hover:text-orange">
                                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.6667 28.3334L28.3334 11.6667" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M11.6667 11.6667H28.3334V28.3334" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>

                                    </a>
                                </div>
                            </div>

                            <div
                                class="py-9 px-7 border-border-white border rounded-2xl flex flex-col justify-between group">
                                <h3 class="text-xl font-bold font-Syne text-white">Want a more in-depth look at my
                                    history?</h3>
                                <div class="flex justify-between items-center">
                                    <p class="text-2xl font-bold font-Syne leading-none text-orange">+598 6879 9874
                                    </p>
                                    <a href="#"
                                        class="text-white group-hover:animate-arrow-move-up group-hover:text-orange">
                                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.6667 28.3334L28.3334 11.6667" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M11.6667 11.6667H28.3334V28.3334" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>

                                    </a>
                                </div>
                            </div>

                        </div>

                        <div class="grid grid-cols-1 gap-6">
                            <div class="py-[72px]">
                                <svg class="w-full" width="1281" height="77" viewBox="0 0 1281 77" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M95.28 67.88H77.28L142.8 0.199951H172.8V77H142.8V24.68L151.8 28.4L104.4 77H68.4L20.88 28.52L30 24.8V77H0V0.199951H30L95.28 67.88Z"
                                        fill="#FFE9D9" />
                                    <path
                                        d="M199.289 65.36V47.36H281.369V65.36H199.289ZM172.409 77L223.889 0.199951H257.249L309.209 77H276.209L231.689 8.23995H249.569L205.409 77H172.409Z"
                                        fill="#FFE9D9" />
                                    <path
                                        d="M308.828 77V0.199951H401.588C408.868 0.199951 415.388 1.03995 421.148 2.71995C426.988 4.31995 431.588 7.03995 434.948 10.88C438.388 14.72 440.108 19.96 440.108 26.6C440.108 31 439.308 34.64 437.708 37.52C436.108 40.4 433.908 42.64 431.108 44.24C428.308 45.84 425.108 47 421.508 47.72C417.908 48.44 414.148 48.88 410.228 49.04L401.468 47.36C410.988 47.44 418.308 47.84 423.428 48.56C428.628 49.28 432.228 50.6 434.228 52.52C436.308 54.36 437.348 57.04 437.348 60.56V77H407.348V64.16C407.348 61.76 406.868 59.96 405.908 58.76C405.028 57.48 403.028 56.6 399.908 56.12C396.868 55.64 392.148 55.4 385.748 55.4H338.828V77H308.828ZM338.828 35.36H401.588C403.988 35.36 405.988 34.96 407.588 34.16C409.268 33.36 410.108 31.84 410.108 29.6C410.108 27.52 409.268 26.12 407.588 25.4C405.988 24.6 403.988 24.2 401.588 24.2H338.828V35.36Z"
                                        fill="#FFE9D9" />
                                    <path
                                        d="M510.679 39.2V32.48L579.919 77H535.279L476.479 36.2L530.719 0.199951H573.439L510.679 39.2ZM446.719 0.199951H476.719V77H446.719V0.199951Z"
                                        fill="#FFE9D9" />
                                    <path
                                        d="M635.328 26.72H719.808V49.52H635.328V26.72ZM716.448 0.199951H746.448V77H716.448V0.199951ZM609.648 0.199951H639.648V77H609.648V0.199951Z"
                                        fill="#FFE9D9" />
                                    <path
                                        d="M783.281 44.6V54.2H874.481V77H753.281V0.199951H874.241V23H783.281V32.6H857.681V44.6H783.281Z"
                                        fill="#FFE9D9" />
                                    <path
                                        d="M1000.4 53.48L989.239 59.84V0.199951H1019.24V77H989.239L898.879 24.68L910.039 18.2V77H880.039V0.199951H910.039L1000.4 53.48Z"
                                        fill="#FFE9D9" />
                                    <path
                                        d="M1026.02 77V0.199951H1118.78C1126.06 0.199951 1132.58 1.03995 1138.34 2.71995C1144.18 4.31995 1148.78 7.03995 1152.14 10.88C1155.58 14.72 1157.3 19.96 1157.3 26.6C1157.3 31 1156.5 34.64 1154.9 37.52C1153.3 40.4 1151.1 42.64 1148.3 44.24C1145.5 45.84 1142.3 47 1138.7 47.72C1135.1 48.44 1131.34 48.88 1127.42 49.04L1118.66 47.36C1128.18 47.44 1135.5 47.84 1140.62 48.56C1145.82 49.28 1149.42 50.6 1151.42 52.52C1153.5 54.36 1154.54 57.04 1154.54 60.56V77H1124.54V64.16C1124.54 61.76 1124.06 59.96 1123.1 58.76C1122.22 57.48 1120.22 56.6 1117.1 56.12C1114.06 55.64 1109.34 55.4 1102.94 55.4H1056.02V77H1026.02ZM1056.02 35.36H1118.78C1121.18 35.36 1123.18 34.96 1124.78 34.16C1126.46 33.36 1127.3 31.84 1127.3 29.6C1127.3 27.52 1126.46 26.12 1124.78 25.4C1123.18 24.6 1121.18 24.2 1118.78 24.2H1056.02V35.36Z"
                                        fill="#FFE9D9" />
                                    <path
                                        d="M1280.96 0.199951L1232.36 57.44V77H1202.36V57.44L1153.76 0.199951H1189.16L1228.64 50H1206.44L1245.56 0.199951H1280.96Z"
                                        fill="#FFE9D9" />
                                </svg>
                            </div>

                        </div>


                        <div class="border-t border-border-white pt-6 ">
                            <div class="grid grid-cols-12">

                                <div class="col-span-12 sm:col-span-8 order-last sm:order-first">
                                    <p class="text-white text-lg font-normal font-sans leading-7">©2023 Mark Henry,
                                        All
                                        Rights Reserved
                                    </p>
                                </div>
                                <div class="col-span-12 sm:col-span-4 order-first sm:order-last">
                                    <div class="flex justify-end mb-2 sm:mb-0">
                                        <a id="scrollUp" class="flex flex-wrap items-center gap-2 group" href="#"
                                            aria-label="scroll up">
                                            <span
                                                class="text-white text-lg font-normal font-sans leading-7 transition-all group-hover:text-orange">Back
                                                to
                                                Top</span>
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 19V5" stroke="#FFB646" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M19 12L12 5L5 12" stroke="#FFB646" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>

                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </footer>
            <!-- Footer End -->
        </div>
    </FrontendLayout>
</template>
