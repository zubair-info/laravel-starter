<script setup>
import { ref, reactive } from 'vue'
import { router } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'
import MultiSelect from 'primevue/multiselect'
// import { useToast } from 'vue-toastification'
// const toast = useToast()

const props = defineProps({
    users: Array,
    roles: Array,
    permissions: Array
})

// selected data per user
const selectedRoles = reactive({})
const selectedPermissions = reactive({})

// ✅ Pre-fill selected roles and permissions for each user
props.users.forEach(user => {
    selectedRoles[user.id] = user.roles.map(r => r.id)
    selectedPermissions[user.id] = user.permissions.map(p => p.id)
})

// ✅ Assign/Update Roles
function updateUserRoles(user) {
    router.post(route('admin.user.assign.role', user.id), {
        roles: selectedRoles[user.id] || []
    }, {
        onSuccess: () => alert(`✅ Roles updated for ${user.name}`),
        onError: (errors) => alert(Object.values(errors).join(', '))
    })
}

// ✅ Assign/Update Permissions
function updateUserPermissions(user) {
    router.post(route('admin.user.assign.permission', user.id), {
        permissions: selectedPermissions[user.id] || []
    }, {
        onSuccess: () => alert(`✅ Permissions updated for ${user.name}`),
        onError: (errors) => alert(Object.values(errors).join(', '))
    })
}

// ✅ Remove single role
function removeUserRole(user, roleId) {
    if (!confirm(`Remove this role from ${user.name}?`)) return
    router.delete(route('admin.user.remove.role', { user: user.id, role: roleId }), {
        onSuccess: () => {
            user.roles = user.roles.filter(r => r.id !== roleId)
            selectedRoles[user.id] = selectedRoles[user.id].filter(id => id !== roleId)
        }
    })
}

// ✅ Remove single permission
function removeUserPermission(user, permissionId) {
    if (!confirm(`Remove this permission from ${user.name}?`)) return
    router.delete(route('admin.user.remove.permission', { user: user.id, permission: permissionId }), {
        onSuccess: () => {
            user.permissions = user.permissions.filter(p => p.id !== permissionId)
            selectedPermissions[user.id] = selectedPermissions[user.id].filter(id => id !== permissionId)
        }
    })
}

// ✅ Remove All
function removeAllUserAssignments(user) {
    if (!confirm(`Remove all roles and permissions from ${user.name}?`)) return;

    router.delete(route('admin.user.remove.all', user.id), {
        preserveScroll: true,
        onSuccess: () => {
            user.roles.splice(0, user.roles.length);
            user.permissions.splice(0, user.permissions.length);
            selectedRoles[user.id] = [];
            selectedPermissions[user.id] = [];
            toast.success(`All roles and permissions removed from ${user.name}`);
        },
    });
}

</script>

<template>
    <AppLayout>
        <div class="p-6">
            <h1 class="text-2xl font-bold mb-4">Assign Roles & Permissions to Users</h1>

            <table class="w-full border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2 border">User</th>
                        <th class="p-2 border">Roles</th>
                        <th class="p-2 border">Permissions</th>
                        <th class="p-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in props.users" :key="user.id">
                        <td class="p-2 border font-medium">{{ user.name }}</td>

                        <!-- ✅ Roles -->
                        <td class="p-2 border">
                            <div class="flex flex-wrap gap-1 mb-2">
                                <span v-for="role in user.roles" :key="role.id"
                                    class="bg-blue-100 text-blue-800 px-2 py-0.5 rounded text-xs flex items-center gap-1">
                                    {{ role.name }}
                                    <button @click="removeUserRole(user, role.id)"
                                        class="text-red-600 text-xs font-bold">✕</button>
                                </span>
                            </div>

                            <!-- ✅ MultiSelect per user -->
                            <MultiSelect v-model="selectedRoles[user.id]" :options="props.roles" optionLabel="name"
                                optionValue="id" placeholder="Select Roles" class="w-full md:w-80" />
                            <button @click="updateUserRoles(user)"
                                class="mt-1 bg-blue-600 text-white px-2 py-1 rounded text-sm">Save</button>
                        </td>

                        <!-- ✅ Permissions -->
                        <td class="p-2 border">
                            <div class="flex flex-wrap gap-1 mb-2">
                                <span v-for="perm in user.permissions" :key="perm.id"
                                    class="bg-green-100 text-green-800 px-2 py-0.5 rounded text-xs flex items-center gap-1">
                                    {{ perm.name }}
                                    <button @click="removeUserPermission(user, perm.id)"
                                        class="text-red-600 text-xs font-bold">✕</button>
                                </span>
                            </div>

                            <!-- <select v-model="selectedPermissions[user.id]" multiple
                                class="w-full border rounded p-2 h-32 focus:outline-none focus:ring-2 focus:ring-green-500">
                                <option v-for="p in props.permissions" :key="p.id" :value="p.id">{{ p.name }}</option>
                            </select> -->
                            <MultiSelect v-model="selectedPermissions[user.id]" :options="props.permissions"
                                optionLabel="name" optionValue="id" placeholder="Select Permission"
                                class="w-full md:w-80" />
                            <div>
                                <button @click="updateUserPermissions(user)"
                                    class="mt-1 bg-green-600 text-white px-2 py-1 rounded text-sm">Save</button>
                            </div>

                        </td>

                        <!-- ✅ Remove All -->
                        <td class="p-2 border text-center">
                            <button @click="removeAllUserAssignments(user.id)"
                                class="bg-red-600 text-white text-xs px-2 py-1 rounded">Remove All</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AppLayout>
</template>
