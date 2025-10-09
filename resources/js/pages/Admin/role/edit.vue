<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Form } from '@inertiajs/vue3';

// Props: role and permissions
const props = defineProps({ role: Object, permissions: Array });

// Breadcrumbs
const breadcrumbs = [
    { title: 'roles', href: '/admin/roles' },
    { title: 'edit', href: `/admin/roles/${props.role.id}/edit` }
];
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">

        <Head title="edit role" />

        <div class="p-4 max-w-md mx-auto bg-white rounded shadow">
            <h2 class="text-lg font-semibold mb-4">edit role</h2>

            <!-- Form -->
            <Form :action="`/admin/roles/${props.role.id}`" method="post" class="space-y-4">
                <!-- Hidden PUT method -->
                <input type="hidden" name="_method" value="PUT" />

                <!-- Role Name -->
                <input type="text" name="name" :value="props.role.name" placeholder="role name"
                    class="w-full border p-2 rounded" required />

                <!-- Permissions -->
                <div>
                    <span class="font-medium mb-2 block">permissions:</span>
                    <div class="flex flex-wrap gap-2">
                        <label v-for="permission in props.permissions" :key="permission.id"
                            class="flex items-center gap-1">
                            <input type="checkbox" :value="permission.id" name="permissions[]"
                                :checked="(props.role.permissions || []).map(p => p.id).includes(permission.id)" />
                            {{ permission.name }}
                        </label>
                    </div>
                </div>

                <!-- Submit -->
                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        update
                    </button>
                </div>
            </Form>
        </div>
    </AppLayout>
</template>
