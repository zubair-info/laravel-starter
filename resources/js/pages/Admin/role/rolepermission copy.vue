<script setup>
import { ref, reactive } from 'vue';
import { Head, useForm, router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';

const props = defineProps({
    roles: Array,
    permissions: Array
});

// Breadcrumbs
const breadcrumbs = [
    { title: 'roles & permissions', href: '/admin/roles' }
];

// Modal state
const isRoleModalOpen = ref(false);
const editingRole = ref(null);

// Form
const form = reactive({
    name: '',
    permissions: []
});

// Open create modal
function openCreateModal() {
    editingRole.value = null;
    form.name = '';
    form.permissions = [];
    isRoleModalOpen.value = true;
}

// Open edit modal
function openEditModal(role) {
    editingRole.value = role;
    form.name = role.name;
    form.permissions = role.permissions.map(p => p.name);
    isRoleModalOpen.value = true;
}

// Close modal
function closeModal() {
    isRoleModalOpen.value = false;
    editingRole.value = null;
}

// Save role using router
function saveRole() {
    const url = editingRole.value ? `/admin/roles/${editingRole.value.id}` : `/admin/roles`;
    const method = editingRole.value ? 'put' : 'post';

    router[method](url, { name: form.name, permissions: form.permissions }, {
        onSuccess: () => closeModal()
    });
}

// Delete role
function deleteRole(role) {
    if (confirm(`Delete role ${role.name}?`)) {
        router.delete(`/admin/roles/${role.id}`);
    }
}
</script>

<template>

    <Head title="Roles & Permissions" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <button @click="openCreateModal" class="px-4 py-2 bg-blue-600 text-white rounded mb-4">
                Add Role
            </button>

            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-2 border">Role</th>
                        <th class="p-2 border">Permissions</th>
                        <th class="p-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="role in props.roles" :key="role.id">
                        <td class="p-2 border">{{ role.name }}</td>
                        <td class="p-2 border">
                            <span v-for="p in role.permissions" :key="p.id" class="mr-2">{{ p.name }}</span>
                        </td>
                        <td class="p-2 border">
                            <button @click="openEditModal(role)"
                                class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</button>
                            <button @click="deleteRole(role)"
                                class="px-2 py-1 bg-red-500 text-white rounded ml-2">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Role Modal -->
        <div v-if="isRoleModalOpen" class="fixed inset-0 bg-black/25 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded shadow-md w-full max-w-md">
                <h2 class="text-lg font-bold mb-4">{{ editingRole ? 'Edit Role' : 'Add Role' }}</h2>

                <div class="space-y-3">
                    <input v-model="form.name" type="text" placeholder="Role Name" class="w-full border p-2 rounded" />

                    <div>
                        <span class="font-medium mb-1 block">Permissions</span>
                        <div class="flex flex-wrap gap-2">
                            <label v-for="permission in props.permissions" :key="permission.id"
                                class="flex items-center gap-1">
                                <input type="checkbox" :value="permission.name" v-model="form.permissions" />
                                {{ permission.name }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mt-4 flex justify-end space-x-2">
                    <button @click="closeModal" class="px-4 py-2 bg-gray-200 rounded">Cancel</button>
                    <button @click="saveRole" class="px-4 py-2 bg-blue-600 text-white rounded">
                        {{ editingRole ? 'Update' : 'Save' }}
                    </button>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
