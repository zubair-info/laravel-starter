<template>
    <header id="sticky-header" class="xl:pl-12 absolute left-0 top-0 w-full z-10">
        <div class="flex pl-4 xl:pl-0">

            <div class="flex-1 flex items-center justify-between border-b border-black-800 border-opacity-40">
                <a :href="route('home')">
                    <img :src="logo" alt="logo" />
                </a>

                <a href="/contact" class="flex items-center py-1 px-3 font-bold text-active hover:text-orange group">
                    Let’s Talk
                    <span class="inline-block ml-3 group-hover:animate-arrow-move-up">
                        <ArrowUpRight />
                    </span>
                </a>
            </div>

            <div id="offcanvas-toggle"
                class="flex-none bg-active flex items-center justify-center py-7 px-9 cursor-pointer">
                <button @click="$emit('toggle-offcanvas')">
                    <Menu class="text-white dark:text-dark" />
                </button>
            </div>

        </div>
    </header>
</template>

<script setup>
import { Menu, ArrowUpRight } from 'lucide-vue-next'
import { route } from 'ziggy-js'

const props = defineProps({
    logo: String,
    hero: Array,
})
</script>
