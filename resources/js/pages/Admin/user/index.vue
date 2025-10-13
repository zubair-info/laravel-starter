<script setup>
import { ref, reactive,watch } from 'vue';
import { router, usePage, Head } from '@inertiajs/vue3';
import { useToast } from 'primevue/usetoast';
import AppLayout from '@/layouts/AppLayout.vue'

import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Dialog from 'primevue/dialog';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import MultiSelect from 'primevue/multiselect';
import ToggleSwitch from 'primevue/toggleswitch';


const toast = useToast();
const page = usePage();

const breadcrumbs = [
    { title: 'Users', href: route('admin.users.index') }
];

// Props from backend
const props = defineProps({
    users: Array,
    roles: Array,
    permissions: Array
});
const users = ref([])
// const users = ref(props.users.map(user => ({
//   ...user,
//   is_active: Boolean(user.is_active)
// })));
watch(
    () => props.users,
    (newUsers) => {
        users.value = newUsers.map(user => ({
            ...user,
            is_active: Boolean(user.is_active)
        }))
    },
    { immediate: true } // প্রথমে একবারও চালাবে
)

// Modal visibility
const showAddModal = ref(false);
const showEditModal = ref(false);

// Add form
const addForm = reactive({
    name: '',
    email: '',
    password: '',
    roles: []
});

// Edit form
const editForm = reactive({
    id: null,
    name: '',
    email: '',
    password: '',
    roles: []
});

// Open Add Modal
function openAddModal() {
    addForm.name = '';
    addForm.email = '';
    addForm.password = '';
    addForm.roles = [];
    showAddModal.value = true;
}

// Submit Add Form
function addUser() {
    router.post(route('admin.users.store'), addForm, {
        onSuccess: () => {
            toast.add({ severity: 'success', summary: 'User Added', detail: `${addForm.name} created`, life: 3000 });
            showAddModal.value = false;
        },
        onError: (errors) => {
            toast.add({ severity: 'error', summary: 'Error', detail: Object.values(errors).flat().join(', '), life: 5000 });
        }
    });
}

// Open Edit Modal
function openEditModal(user) {
    editForm.id = user.id;
    editForm.name = user.name;
    editForm.email = user.email;
    editForm.password = '';
    editForm.roles = user.roles.map(r => r.id);
    showEditModal.value = true;
}

// Submit Edit Form
function updateUser() {
    router.put(route('admin.users.update', editForm.id), editForm, {
        onSuccess: () => {
            toast.add({ severity: 'success', summary: 'User Updated', detail: `${editForm.name} updated`, life: 3000 });
            showEditModal.value = false;
        },
        onError: (errors) => {
            toast.add({ severity: 'error', summary: 'Error', detail: Object.values(errors).flat().join(', '), life: 5000 });
        }
    });
}

// Delete user
function deleteUser(user) {
    if (!confirm(`Delete ${user.name}?`)) return;

    router.delete(route('admin.users.destroy', user.id), {
        onSuccess: () => {
            toast.add({ severity: 'success', summary: 'Deleted', detail: `${user.name} deleted`, life: 3000 });
        }
    });
}
function toggleActive(user) {
    router.post(route('admin.users.toggleActive', user.id), {}, {
        preserveScroll: true,
        onSuccess: () => {
            //   user.is_active = !user.is_active;
            toast.add({
                severity: 'success',
                summary: 'Status Updated',
                detail: `${user.name} is now ${user.is_active ? 'Active' : 'Inactive'}`,
                life: 3000
            });
        },
        onError: () => {
            toast.add({ severity: 'error', summary: 'Error', detail: 'Unable to update status', life: 3000 });
        }
    });
}

</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">

        <Head title="Users" />

        <!-- Add User Modal -->
        <Dialog v-model:visible="showAddModal" header="Add User" modal :style="{ width: '30rem' }">
            <form @submit.prevent="addUser" class="flex flex-col gap-4">
                <!-- Username -->
                <div class="flex flex-col">
                    <label for="username" class="font-semibold mb-1">Username</label>
                    <InputText id="username" v-model="addForm.name" placeholder="Enter username" required />
                </div>

                <!-- Email -->
                <div class="flex flex-col">
                    <label for="email" class="font-semibold mb-1">Email</label>
                    <InputText id="email" v-model="addForm.email" type="email" placeholder="Enter email" required />
                </div>

                <!-- Password -->
                <div class="flex flex-col">
                    <label for="password" class="font-semibold mb-1">Password</label>
                    <InputText id="password" v-model="addForm.password" type="password" placeholder="Enter password"
                        required />
                </div>

                <!-- Roles -->
                <div class="flex flex-col">
                    <label for="roles" class="font-semibold mb-1">Roles</label>
                    <MultiSelect id="roles" v-model="addForm.roles" :options="roles" optionLabel="name" optionValue="id"
                        placeholder="Select Roles" />
                </div>


                <!-- Submit Button -->
                <Button type="submit" label="Add User" class="mt-2" />
            </form>
        </Dialog>


        <!-- Edit User Modal -->
        <Dialog paginator :rows="10" v-model:visible="showEditModal" header="Edit User" modal
            :style="{ width: '30rem' }">
            <form @submit.prevent="updateUser" class="flex flex-col gap-4">
                <!-- Username -->
                <div class="flex flex-col">
                    <label for="edit-username" class="font-semibold mb-1">Name</label>
                    <InputText id="edit-username" v-model="editForm.name" placeholder="Enter username" required />
                </div>

                <!-- Email -->
                <div class="flex flex-col">
                    <label for="edit-email" class="font-semibold mb-1">Email</label>
                    <InputText id="edit-email" v-model="editForm.email" type="email" placeholder="Enter email"
                        required />
                </div>

                <!-- Password -->
                <div class="flex flex-col">
                    <label for="edit-password" class="font-semibold mb-1">Password</label>
                    <InputText id="edit-password" v-model="editForm.password" type="password"
                        placeholder="Leave blank to keep current password" />
                </div>

                <!-- Roles -->
                <div class="flex flex-col">
                    <label for="edit-roles" class="font-semibold mb-1">Roles</label>
                    <MultiSelect id="edit-roles" v-model="editForm.roles" :options="roles" optionLabel="name"
                        optionValue="id" placeholder="Select Roles" />
                </div>

                <!-- Submit Button -->
                <Button type="submit" label="Update User" class="mt-2" />
            </form>
        </Dialog>


        <!-- Users Table -->
        <div class="mt-4">
            <Button label="Add User" size="small" class="mb-2" @click="openAddModal" />
            <DataTable :value="users" paginator :rows="10" :responsiveLayout="'scroll'" tableStyle="min-width: 50rem">
                <Column field="name" header="Name" />
                <Column field="email" header="Email" />
                <Column header="Roles">
                    <template #body="slotProps">
                        {{slotProps.data.roles.map(r => r.name).join(', ')}}
                    </template>
                </Column>
                <Column field="is_active" header="Status">
                    <template #body="slotProps">

                        <ToggleSwitch v-model="slotProps.data.is_active" @change="() => toggleActive(slotProps.data)" />


                    </template>
                </Column>
                <Column header="Actions">
                    <template #body="slotProps">
                        <Button label="Edit" size="small" class="mr-1" @click="openEditModal(slotProps.data)" />
                        <Button label="Delete" size="small" severity="danger" @click="deleteUser(slotProps.data)" />
                    </template>
                </Column>
            </DataTable>
        </div>
    </AppLayout>
</template>
