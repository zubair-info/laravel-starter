<script setup>
import { ref, reactive } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';

const props = defineProps({ roles: Array, permissions: Array });
const breadcrumbs = [{ title: 'Roles & Permissions', href: '/admin/roles' }];

const isRoleModalOpen = ref(false);
const isPermissionModalOpen = ref(false);
const editingRole = ref(null);

const roleForm = reactive({ name: '', permissions: [] });
const permissionForm = reactive({ name: '' });

function openCreateRoleModal() { editingRole.value = null; roleForm.name = ''; roleForm.permissions = []; isRoleModalOpen.value = true; }
function openEditRoleModal(role) { editingRole.value = role; roleForm.name = role.name; roleForm.permissions = role.permissions.map(p => p.id); isRoleModalOpen.value = true; }
function saveRole() { const url = editingRole.value ? `/admin/roles/${editingRole.value.id}` : '/admin/roles'; const method = editingRole.value ? 'put' : 'post'; router[method](url, { name: roleForm.name, permissions: roleForm.permissions }, { onSuccess: () => isRoleModalOpen.value = false }); }
function deleteRole(role) { if (confirm(`Delete role ${role.name}?`)) { router.delete(`/admin/roles/${role.id}`); } }

function openCreatePermissionModal() { permissionForm.name = ''; isPermissionModalOpen.value = true; }
function savePermission() { router.post('/admin/permissions', { name: permissionForm.name }, { onSuccess: () => isPermissionModalOpen.value = false }); }
function deletePermission(permission) { if (confirm(`Delete permission ${permission.name}?`)) { router.delete(`/admin/permissions/${permission.id}`); } }
</script>

<template>

    <Head title="Roles & Permissions" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4 space-y-6">
            <!-- Roles Section -->
            <div>
                <h2 class="font-bold mb-2">Roles</h2>
                <button @click="openCreateRoleModal" class="px-4 py-2 bg-blue-600 text-white rounded mb-2">Add
                    Role</button>
                <table class="w-full border border-gray-300">
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
                                <button @click="openEditRoleModal(role)"
                                    class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</button>
                                <button @click="deleteRole(role)"
                                    class="px-2 py-1 bg-red-500 text-white rounded ml-2">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Permissions Section -->
            <div>
                <h2 class="font-bold mb-2">Permissions</h2>
                <button @click="openCreatePermissionModal" class="px-4 py-2 bg-green-600 text-white rounded mb-2">Add
                    Permission</button>
                <table class="w-full border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="p-2 border">Permission</th>
                            <th class="p-2 border">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="perm in props.permissions" :key="perm.id">
                            <td class="p-2 border">{{ perm.name }}</td>
                            <td class="p-2 border">
                                <button @click="deletePermission(perm)"
                                    class="px-2 py-1 bg-red-500 text-white rounded">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Role Modal -->
        <div v-if="isRoleModalOpen" class="fixed inset-0 bg-black/25 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded shadow-md w-full max-w-md">
                <h2 class="text-lg font-bold mb-4">{{ editingRole ? 'Edit Role' : 'Add Role' }}</h2>
                <div class="space-y-3">
                    <input v-model="roleForm.name" type="text" placeholder="Role Name"
                        class="w-full border p-2 rounded" />
                    <div>
                        <span class="font-medium mb-1 block">Permissions</span>
                        <div class="flex flex-wrap gap-2">
                            <label v-for="permission in props.permissions" :key="permission.id"
                                class="flex items-center gap-1">
                                <input type="checkbox" :value="permission.id" v-model="roleForm.permissions" /> {{
                                    permission.name }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="mt-4 flex justify-end space-x-2">
                    <button @click="isRoleModalOpen = false" class="px-4 py-2 bg-gray-200 rounded">Cancel</button>
                    <button @click="saveRole" class="px-4 py-2 bg-blue-600 text-white rounded">{{
                        editingRole ? 'Update' : 'Save' }}</button>
                </div>
            </div>
        </div>

        <!-- Permission Modal -->
        <div v-if="isPermissionModalOpen" class="fixed inset-0 bg-black/25 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded shadow-md w-full max-w-md">
                <h2 class="text-lg font-bold mb-4">Add Permission</h2>
                <input v-model="permissionForm.name" type="text" placeholder="Permission Name"
                    class="w-full border p-2 rounded mb-4" />
                <div class="flex justify-end space-x-2">
                    <button @click="isPermissionModalOpen = false" class="px-4 py-2 bg-gray-200 rounded">Cancel</button>
                    <button @click="savePermission" class="px-4 py-2 bg-green-600 text-white rounded">Save</button>
                </div>
            </div>
        </div>

    </AppLayout>
</template>
