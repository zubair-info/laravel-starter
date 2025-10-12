<script setup lang="ts">
import {
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { Link, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
import { type NavItem } from '@/types';
import { urlIsActive } from '@/lib/utils';

const props = defineProps<{
    items: NavItem[];
}>();

const page = usePage();

// shared state for open dropdowns
const openDropdowns = ref(new Set<string>());

function toggleDropdown(title: string) {
    if (openDropdowns.value.has(title)) openDropdowns.value.delete(title);
    else openDropdowns.value.add(title);
}

function isOpen(title: string) {
    return openDropdowns.value.has(title);
}
</script>

<template>
    <SidebarMenu>
        <template v-for="item in props.items">
            <!-- Single link -->
            <SidebarMenuItem v-if="!item.children" :key="item.title">
                <SidebarMenuButton
                    as-child
                    :is-active="urlIsActive(item.href, page.url)"
                    :tooltip="item.title"
                >
                    <Link :href="item.href" class="flex items-center gap-2">
                        <component :is="item.icon" v-if="item.icon" class="w-5 h-5"/>
                        <span>{{ item.title }}</span>
                    </Link>
                </SidebarMenuButton>
            </SidebarMenuItem>

            <!-- Dropdown -->
            <SidebarMenuItem v-else :key="item.title">
                <SidebarMenuButton
                    class="flex justify-between items-center gap-2"
                    @click="toggleDropdown(item.title)"
                >
                    <span class="flex items-center gap-2">
                        <component :is="item.icon" v-if="item.icon" class="w-5 h-5"/>
                        {{ item.title }}
                    </span>
                    <svg :class="{ 'rotate-90': isOpen(item.title) }" class="w-3 h-3 transition-transform"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 5l7 7-7 7" />
                    </svg>
                </SidebarMenuButton>

                <SidebarMenu v-if="isOpen(item.title)" class="ml-4">
                    <NavMain :items="item.children" />
                </SidebarMenu>
            </SidebarMenuItem>
        </template>
    </SidebarMenu>
</template>

<style scoped>
.rotate-90 {
    transform: rotate(90deg);
}
</style>
