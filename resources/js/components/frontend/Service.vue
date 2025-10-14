<template>
    <section class="py-[120px]">
        <div class="container">
            <div class="grid grid-cols-12 gap-6 2xl:gap-0 mb-12 items-center" data-aos="fade-up">
                <div class="col-span-12 lg:col-span-6 xl:col-span-6">
                    <div class="font-bold font-Syne leading-none flex flex-wrap flex-col gap-y-2">
                        <span class="text-orange text-xl">Services</span>
                        <h3
                            class="text-black-800 text-4xl lg:text-5xl xl:text-[64px] tracking-[-1.5px] relative before:rounded-full before:bg-primary before:block before:absolute before:top-[2px] before:left-0 before:-z-[1] before:w-[36px] lg:before:w-[48px] xl:before:w-[60px] before:h-[36px] lg:before:h-[48px] xl:before:h-[60px]">
                            {{ specialties.title }}
                        </h3>
                    </div>

                </div>
                <div class="col-span-12 lg:col-span-6 xl:col-span-6">
                    <p class="paragraph">
                        {{ specialties.description }}</p>
                </div>
            </div>

            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 xl:col-span-8">
                    <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">

                        <!-- service Item -->

                        <div v-for="(service, index) in services" :key="index"
                            class="px-6 py-7 bg-black-500 rounded-lg transition-all hover:shadow-2xl hover:bg-white group"
                            data-aos="fade-up" data-aos-delay="500">
                            <!-- Icon -->
                            <div
                                class="w-12 h-12 bg-white rounded-full shadow flex flex-wrap items-center justify-center transition-all group-hover:bg-black-500 mb-8">
                                <img :src="service.service_icons" alt="">
                            </div>

                            <!-- Icon End -->
                            <h4>
                                <a :href="service.link"
                                    class="flex flex-wrap items-end justify-between font-bold text-xl font-Syne text-black-800 group-hover:text-orange transition-all">
                                  {{ service.title }}

                                    <span
                                        class="text-black-text-600 group-hover:text-orange group-hover:animate-arrow-move-up">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path class="transition-all" d="M7 17L17 7" stroke="currentColor"
                                                stroke-opacity="0.6" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path class="transition-all" d="M7 7H17V17" stroke="currentColor"
                                                stroke-opacity="0.6" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>

                                    </span>
                                </a>
                            </h4>
                        </div>

                    </div>
                </div>


                <div class="col-span-12 xl:col-span-4" data-aos="zoom-in" data-aos-delay="1000">
                    <div
                        class="px-6 py-9 bg-black-800 rounded-lg flex flex-wrap flex-col justify-between max-w-[416px] mx-auto h-full group">
                        <div class="flex flex-wrap justify-end relative">
                            <a href="contact.html" class="group-hover:animate-arrow-move-up">
                                <svg width="80" height="80" viewBox="0 0 80 80" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M23.3333 56.6666L56.6667 23.3333" stroke="#FFB646" stroke-width="3.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M23.3333 23.3333H56.6667V56.6666" stroke="#FFB646" stroke-width="3.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </div>

                        <div class="flex flex-col flex-wrap gap-y-2">
                            <span class="text-orange text-lg font-normal leading-none">SAY HELLO!</span>
                            <h4 class="text-white text-2xl xl:text-[32px] font-bold font-Syne leading-none">
                                {{ specialties.email }}
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</template>

<script setup>

import { usePage } from '@inertiajs/vue3'

const { props } = usePage()
const services = props.services
const specialties = props.specialties
</script>
