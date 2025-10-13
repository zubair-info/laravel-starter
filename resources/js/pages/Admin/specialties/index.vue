<script setup>
import { ref, reactive, watch } from 'vue';
import { router } from '@inertiajs/vue3';
import { useToast } from 'primevue/usetoast';
import AppLayout from '@/layouts/AppLayout.vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Dialog from 'primevue/dialog';
import InputText from 'primevue/inputtext';
import Textarea from 'primevue/textarea';
import Button from 'primevue/button';

const toast = useToast();

// Props from backend
const props = defineProps({
    specialties: Array
});

// Breadcrumbs
const breadcrumbs = [
    { title: 'Specialties', href: '/admin/specialties' }
];

// Table reactive copy
const specialties = ref([]);
watch(
    () => props.specialties,
    (newData) => {
        specialties.value = newData;
    },
    { immediate: true }
);

// Modal controls
const showAddModal = ref(false);
const showEditModal = ref(false);

// Add form
const addForm = reactive({
    title: '',
    subtitle: '',
    description: '',
    email: '',
    link: ''
});

// Edit form
const editForm = reactive({
    id: null,
    title: '',
    subtitle: '',
    description: '',
    email: '',
    link: ''
});

// Open Add Modal
function openAddModal() {
    addForm.title = '';
    addForm.subtitle = '';
    addForm.description = '';
    addForm.email = '';
    addForm.link = '';
    showAddModal.value = true;
}

// Submit Add Form
function addSpecialty() {
    router.post('/admin/specialties', addForm, {
        onSuccess: () => {
            toast.add({ severity: 'success', summary: 'Specialty Added', detail: `${addForm.title} created`, life: 3000 });
            showAddModal.value = false;
        },
        onError: (errors) => {
            toast.add({ severity: 'error', summary: 'Error', detail: Object.values(errors).flat().join(', '), life: 5000 });
        }
    });
}

// Open Edit Modal
function openEditModal(item) {
    editForm.id = item.id;
    editForm.title = item.title;
    editForm.subtitle = item.subtitle;
    editForm.description = item.description;
    editForm.email = item.email;
    editForm.link = item.link;
    showEditModal.value = true;
}

// Submit Edit Form
function updateSpecialty() {
    router.put(`/admin/specialties/${editForm.id}`, editForm, {
        onSuccess: () => {
            toast.add({ severity: 'success', summary: 'Specialty Updated', detail: `${editForm.title} updated`, life: 3000 });
            showEditModal.value = false;
        },
        onError: (errors) => {
            toast.add({ severity: 'error', summary: 'Error', detail: Object.values(errors).flat().join(', '), life: 5000 });
        }
    });
}

// Delete Specialty
function deleteSpecialty(item) {
    if (!confirm(`Delete ${item.title}?`)) return;
    router.delete(`/admin/specialties/${item.id}`, {
        onSuccess: () => {
            toast.add({ severity: 'success', summary: 'Deleted', detail: `${item.title} deleted`, life: 3000 });
        }
    });
}
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="mt-4">
            <Button label="Add Specialty" icon="pi pi-plus" class="mb-3" @click="openAddModal" />

            <!-- Specialties Table -->
            <DataTable :value="specialties" paginator :rows="10" :responsiveLayout="'scroll'"
                tableStyle="min-width: 60rem">
                <Column field="title" header="Title" />
                <Column field="subtitle" header="Subtitle" />
                <Column field="description" header="Description" />
                <Column field="email" header="Email" />
                <Column field="link" header="Link" />
                <Column header="Actions">
                    <template #body="slotProps">
                        <Button label="Edit" size="small" class="mr-2" @click="openEditModal(slotProps.data)" />
                        <Button label="Delete" size="small" severity="danger"
                            @click="deleteSpecialty(slotProps.data)" />
                    </template>
                </Column>
            </DataTable>
        </div>

        <!-- Add Modal -->
        <Dialog v-model:visible="showAddModal" header="Add Specialty" modal :style="{ width: '80rem' }">
            <form @submit.prevent="addSpecialty" class="flex flex-col gap-3">
                <InputText v-model="addForm.title" placeholder="Title" required />
                <InputText v-model="addForm.subtitle" placeholder="Subtitle" />
                <Textarea v-model="addForm.description" placeholder="Description" rows="3" />
                <InputText v-model="addForm.email" placeholder="Email" type="email" />
                <InputText v-model="addForm.link" placeholder="Link" />
                <div class="flex justify-end gap-2 mt-2">
                    <Button label="Cancel" class="p-button-secondary" @click="showAddModal = false" />
                    <Button type="submit" label="Save" class="p-button-primary" />
                </div>
            </form>
        </Dialog>

        <!-- Edit Modal -->
        <Dialog v-model:visible="showEditModal" header="Edit Specialty" modal :style="{ width: '80rem' }">
            <form @submit.prevent="updateSpecialty" class="flex flex-col gap-3">
                <InputText v-model="editForm.title" placeholder="Title" required />
                <InputText v-model="editForm.subtitle" placeholder="Subtitle" />
                <Textarea v-model="editForm.description" placeholder="Description" rows="3" />
                <InputText v-model="editForm.email" placeholder="Email" type="email" />
                <InputText v-model="editForm.link" placeholder="Link" />
                <div class="flex justify-end gap-2 mt-2">
                    <Button label="Cancel" class="p-button-secondary" @click="showEditModal = false" />
                    <Button type="submit" label="Update" class="p-button-primary" />
                </div>
            </form>
        </Dialog>
    </AppLayout>
</template>
