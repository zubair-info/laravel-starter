<script setup lang="ts">
import { route } from 'ziggy-js';
import { LayoutGrid, Folder, BookOpen } from 'lucide-vue-next';
import type { NavItem } from '@/types';
import NavMain from '@/components/NavMain.vue';
import NavFooter from '@/components/NavFooter.vue';
import NavUser from '@/components/NavUser.vue';
import { onMounted } from 'vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { Link } from '@inertiajs/vue3';
import AppLogo from './AppLogo.vue';

const mainNavItems: NavItem[] = [
    { title: 'Dashboard', href: route('dashboard'), icon: LayoutGrid },
    { title: 'All Users', href: route('admin.users.index'), icon: LayoutGrid },
    {
        title: 'Roles',
        icon: LayoutGrid,
        children: [
            { title: 'All Roles', href: route('admin.roles.index') },
            { title: 'Assign Roles', href: route('admin.user.role.permission.index') },
        ]
    },
    { title: 'Hero', href: route('admin.hero.index'), icon: LayoutGrid },
    { title: 'Specialties', href: route('admin.specialties.index'), icon: LayoutGrid },
    { title: 'Service', href: route('admin.services.index'), icon: LayoutGrid },
    { title: 'About', href: route('admin.about.index'), icon: LayoutGrid },
    { title: 'Educations', href: route('admin.educations.index'), icon: LayoutGrid },
    { title: 'Skills', href: route('admin.skills.index'), icon: LayoutGrid },
    { title: 'Experiences', href: route('admin.experiences.index'), icon: LayoutGrid },
    { title: 'Pricings', href: route('admin.pricings.index'), icon: LayoutGrid },


];

const footerNavItems: NavItem[] = [
    { title: 'Github Repo', href: 'https://github.com/laravel/vue-starter-kit', icon: Folder },
    { title: 'Documentation', href: 'https://laravel.com/docs/starter-kits#vue', icon: BookOpen },
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="route('dashboard', {})" prefetch>
                        <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
