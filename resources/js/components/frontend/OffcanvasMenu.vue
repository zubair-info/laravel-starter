<template>
    <div
        :class="['offcanvas right-0 top-0 bottom-0 fixed z-50 h-full w-[350px] md:w-[460px] transition-all ease-in-out duration-300 bg-black-800 pl-8 flex flex-col justify-between', show ? 'translate-x-0' : 'translate-x-full']">

        <!-- Close -->
        <div class="flex justify-between items-center border-b mb-20">
            <a :href="route('home')">
                <img :src="offcanvasLogo" alt="logo" />
            </a>
            <button @click="$emit('close')" class="text-white dark:text-dark" >
                <X />
            </button>
        </div>

        <!-- Menu -->
        <nav class="flex-grow">
            <ul>
                <li v-for="(item, index) in menu" :key="index" class="py-4 border-b border-border-white">
                    <a :href="item.url"
                        class="text-white text-xl font-bold flex justify-between items-center hover:text-orange">
                        {{ item.label }}
                        <ArrowUpRight />
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Social Icons -->
        <nav class="pb-10">
            <ul class="flex gap-4">
                <li v-for="(social, index) in socialLinks" :key="index">
                    <a :href="social.url" class="text-white hover:text-orange">
                        <component :is="getLucideIcon(social.icon)" size="24" />
                    </a>
                </li>
            </ul>
        </nav>

    </div>
</template>

<script setup>
import { X, ArrowUpRight, Linkedin, Facebook, Twitter, Github } from 'lucide-vue-next'
import { route } from 'ziggy-js'

const props = defineProps({
    show: Boolean,
    menu: Array,
    socialLinks: Array,
    offcanvasLogo: String
})

function getLucideIcon(name) {
    const icons = {
        linkedin: Linkedin,
        facebook: Facebook,
        twitter: Twitter,
        github: Github,
    }
    return icons[name] || ArrowUpRight
}
</script>
