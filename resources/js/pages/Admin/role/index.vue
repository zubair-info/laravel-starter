<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

const props = defineProps({ roles: Array });

const breadcrumbs = [
    { title: 'roles', href: route('roles.index') },
];

function confirmDelete(role) {
    if (confirm(`Delete role ${role.name}?`)) {
        $inertia.delete(route('roles.destroy', role.id));
    }
}
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">

        <Head title="roles" />

        <div class="p-4">
            <Link :href="route('roles.create')" class="px-4 py-2 bg-blue-600 text-white rounded mb-4 inline-block">
            add role
            </Link>

            <table class="w-full mt-2 border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-2 border">name</th>
                        <th class="p-2 border">permissions</th>
                        <th class="p-2 border">actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="role in roles" :key="role.id">
                        <td class="p-2 border">{{ role.name }}</td>
                        <td class="p-2 border">
                            <span v-for="p in role.permissions" :key="p.id" class="mr-2">{{ p.name }}</span>
                        </td>
                        <td class="p-2 border">
                            <Link :href="route('roles.edit', role.id)"
                                class="px-2 py-1 bg-yellow-500 text-white rounded">edit</Link>
                            <button @click="confirmDelete(role)"
                                class="px-2 py-1 bg-red-500 text-white rounded ml-2">delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AppLayout>
</template>
