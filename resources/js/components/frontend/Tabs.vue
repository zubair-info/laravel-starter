<template>
    <section class="featured-properties py-[80px] lg:py-[100px]">
        <div class="container">
            <div class="grid grid-cols-12 lg:gap-[60px] xl:gap-[100px] 2xl:gap-[134px]">

                <!-- Tabs Menu -->
                <div class="col-span-12 lg:col-span-5 2xl:col-span-4" data-aos="fade-up">
                    <div class="font-bold font-Syne leading-none flex flex-wrap flex-col gap-y-2 mb-4">
                        <span class="text-orange text-xl">Resume</span>
                        <h3
                            class="text-black-800 text-4xl lg:text-5xl xl:text-[64px] tracking-[-1.5px] relative before:rounded-full before:bg-primary before:block before:absolute before:top-[2px] before:left-0 before:-z-[1] before:w-[36px] lg:before:w-[48px] xl:before:w-[64px] before:h-[36px] lg:before:h-[48px] xl:before:h-[64px]">
                            All over my details find here...
                        </h3>
                    </div>

                    <!-- Tabs -->
                    <div class="tabs flex flex-wrap lg:flex-col gap-2 my-8 lg:my-0">
                        <button v-for="tab in tabs" :key="tab.id" @click="activeTab = tab.id"
                            :class="['tab-btn justify-between items-center inline-flex group', activeTab === tab.id ? 'active' : '']">
                            {{ tab.label }}
                            <span class="inline-block ml-3 group-hover:animate-arrow-move-up">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7 17L17 7" stroke="currentColor" stroke-opacity="0.9" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M7 7H17V17" stroke="currentColor" stroke-opacity="0.9" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                        </button>
                    </div>
                </div>

                <!-- Tab Content -->
                <div class="col-span-12 lg:col-span-7 2xl:col-span-8" data-aos="fade-up" data-aos-delay="400">

                    <!-- About Me -->
                    <div v-if="activeTab === 'about_me' && about">
                        <h4 class="text-black-800 text-2xl lg:text-[32px] font-bold font-Syne mb-6">About Me</h4>
                        <p class="paragraph mb-7">{{ about.description || 'No description available.' }}</p>
                        <ul class="flex-col gap-3 inline-flex">
                            <li class="gap-10 inline-flex items-center">
                                <span class="w-[110px] text-black-text-800 text-lg font-normal leading-none">Name</span>
                                <span class="text-black-800 text-2xl font-bold font-Syne leading-8">{{ about.name || '-'
                                    }}</span>
                            </li>
                            <li class="gap-10 inline-flex items-center">
                                <span
                                    class="w-[110px] text-black-text-800 text-lg font-normal leading-none">Email</span>
                                <span class="text-black-800 text-2xl font-bold font-Syne leading-8">{{ about.email ||
                                    '-' }}</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Experience -->
                    <div v-if="activeTab === 'experience' && experiences && experiences.length"
                        class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-5">
                        <div v-for="exp in experiences" :key="exp.id"
                            class="pt-[30px] px-7 pb-7 bg-black-500 rounded-2xl transition-all hover:shadow-2xl hover:bg-white flex flex-wrap flex-col gap-8 justify-between">
                            <span class="text-sm font-normal font-Inter leading-tight text-black-text-800">{{
                                exp.start_date }} – {{ exp.end_date }}</span>
                            <div>
                                <p
                                    class="text-lg font-normal font-sans leading-7 text-black-800 relative z-[1] before:rounded-full before:bg-orange before:block before:absolute before:top-[50%] before:translate-y-[-50%] before:left-0 before:-z-[1] before:w-[8px] before:h-[8px] pl-4">
                                    {{ exp.company }}
                                </p>
                                <h4 class="font-bold font-Syne leading-normal text-2xl text-black-800">{{ exp.position
                                    || '-' }}</h4>
                            </div>
                        </div>
                    </div>
                    <p v-else-if="activeTab === 'experience'" class="text-black-800">No experience found.</p>

                    <!-- Education -->
                    <div v-if="activeTab === 'education' && educations && educations.length"
                        class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-5">
                        <div v-for="edu in educations" :key="edu.id"
                            class="pt-[30px] px-7 pb-7 bg-black-500 rounded-2xl transition-all hover:shadow-2xl hover:bg-white flex flex-wrap flex-col gap-8 justify-between">
                            <span class="text-sm font-normal font-Inter leading-tight text-black-text-800">{{
                                edu.start_date }} – {{ edu.end_date }}</span>
                            <div>
                                <p
                                    class="text-lg font-normal font-sans leading-7 text-black-800 relative z-[1] before:rounded-full before:bg-orange before:block before:absolute before:top-[50%] before:translate-y-[-50%] before:left-0 before:-z-[1] before:w-[8px] before:h-[8px] pl-4">
                                    {{ edu.institution }}
                                </p>
                                <h4 class="font-bold font-Syne leading-normal text-2xl text-black-800">{{ edu.degree }}
                                </h4>
                            </div>
                        </div>
                    </div>
                    <p v-else-if="activeTab === 'education'" class="text-black-800">No education found.</p>

                    <!-- Skills -->
                    <div v-if="activeTab === 'skills' && skills && skills.length"
                        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-2 xl:grid-cols-3 gap-5">
                        <div v-for="skill in skills" :key="skill.id"
                            class="pt-[30px] px-7 pb-7 bg-black-500 rounded-2xl transition-all hover:shadow-2xl hover:bg-white flex flex-wrap gap-4 items-start">
                            <img class="items-start" :src="skill.icon_path || ''" alt="icon">
                            <div class="flex flex-wrap gap-1 flex-1 flex-col">
                                <h4 class="font-bold font-Syne leading-normal text-xl text-black-800">{{ skill.name }}
                                </h4>
                                <p class="text-sm font-normal font-Inter leading-none text-black-800">({{
                                    skill.level_percent || '-' }})</p>
                            </div>
                        </div>
                    </div>
                    <p v-else-if="activeTab === 'skills'" class="text-black-800">No skills found.</p>

                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3'

// const { props } = usePage()
// const about = props.about || {}
// const educations = props.educations || []
// const skills = props.skills || []
// const experiences = props.experiences
// console.log(about)
const props = defineProps({
    about: Object,
    experiences: Array,
    skills: Array,
    educations: Array,
})


const activeTab = ref('about_me')

const tabs = [
    { id: 'about_me', label: 'About Me' },
    { id: 'experience', label: 'Experience' },
    { id: 'education', label: 'Education' },
    { id: 'skills', label: 'Skills' },
]
</script>
