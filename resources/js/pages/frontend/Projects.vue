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
import { usePage, Link } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
const props = defineProps({
    logo: String,
    offcanvasLogo: String,
    headerMenu: Array,
    socialLinks: Array,
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


        <!-- Portfolio Section Start -->
        <section class="bg-white pt-40 pb-[120px]">
            <div class="container mx-auto">
                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-12" data-aos="flip-down" data-aos-delay="400">
                        <div class="font-bold font-Syne text-center leading-none flex flex-wrap flex-col gap-y-2 mb-10">
                            <span class="text-orange text-xl">Portfolio</span>
                            <h3 class="text-black-800 text-4xl lg:text-5xl xl:text-[64px] tracking-[-1.5px]">
                                My recent <span
                                    class="relative z-[1] before:rounded-full before:bg-primary before:block before:absolute before:top-[4px] before:left-[-6px] before:-z-[1] before:w-[36px] lg:before:w-[48px] xl:before:w-[64px] before:h-[36px] lg:before:h-[48px] xl:before:h-[64px]">w</span>ork
                            </h3>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-6">
                    <div v-for="pot in portfolios" :key="pot.id" class="col-span-12 md:col-span-6 lg:col-span-5"
                        data-aos="flip-down" data-aos-delay="600">
                        <div
                            class="overflow-hidden relative rounded-[20px] group before:absolute before:left-0 before:right-0 before:contents before:bg-black-600 before:w-full before:h-full before:opacity-0 hover:before:opacity-80 before:transition-opacity before:duration-300 h-full">
                            <!-- ✅ Dynamic image -->
                            <img class="w-full h-full object-cover"
                                :src="pot.image_url" :alt="pot.title" />

                            <div
                                class="absolute bottom-[-150px] left-6 right-6 transition-all duration-300 group-hover:bottom-6">
                                <div
                                    class="flex flex-wrap items-center justify-between text-white hover:text-orange group">
                                    <!-- ✅ Dynamic Title -->
                                    <h4
                                        class="font-bold font-Syne text-center leading-10 text-[17px] sm:text-[20px] xl:text-[24px] 2xl:text-[28px] capitalize peer">
                                        <Link :href="route('projects_details', pot.slug)" class="transition-all">
                                        {{ pot.title }}
                                        </Link>
                                    </h4>

                                    <!-- ✅ Dynamic Link -->
                                    <Link :href="route('projects_details', pot.slug)"
                                        class="peer-hover:animate-arrow-move-up">
                                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M30.8839 9.11612C31.372 9.60427 31.372 10.3957 30.8839 10.8839L10.8839 30.8839C10.3957 31.372 9.60427 31.372 9.11612 30.8839C8.62796 30.3957 8.62796 29.6043 9.11612 29.1161L29.1161 9.11612C29.6043 8.62796 30.3957 8.62796 30.8839 9.11612Z"
                                            fill="currentColor" fill-opacity="0.9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12.5 10C12.5 9.30964 13.0596 8.75 13.75 8.75H30C30.6904 8.75 31.25 9.30964 31.25 10V26.25C31.25 26.9404 30.6904 27.5 30 27.5C29.3096 27.5 28.75 26.9404 28.75 26.25V11.25H13.75C13.0596 11.25 12.5 10.6904 12.5 10Z"
                                            fill="currentColor" fill-opacity="0.9" />
                                    </svg>
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Portfolio Section End -->

        <Footer :about="about" />
    </FrontendLayout>
</template>
