<script setup>
import { ref, reactive, watch } from 'vue';
import { router, usePage, Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { useToast } from 'primevue/usetoast';

import InputText from 'primevue/inputtext';
import InputNumber from 'primevue/inputnumber';
import Button from 'primevue/button';
import Dialog from 'primevue/dialog';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
const toast = useToast();
const page = usePage();

// Breadcrumbs
const breadcrumbs = [
    { title: 'About Us', href: route('admin.about.index') }
];

// Props from backend
const props = defineProps({
    abouts: Array
});

// Reactive list
const abouts = ref([]);
watch(
    () => props.abouts,
    (newAbouts) => abouts.value = newAbouts,
    { immediate: true }
);

// Modal visibility
const showAddModal = ref(false);
const showEditModal = ref(false);

// Image previews
const addPreview = ref(null);
const editPreview = ref(null);

// Add form
const addForm = reactive({
    greeting: '',
    name: '',
    role: '',
    location: '',
    description: '',
    resume_link: '',
    years_experience: 0,
    award_count: 0,
    client_count: 0,
    image: null
});

// Edit form
const editForm = reactive({
    id: null,
    greeting: '',
    name: '',
    role: '',
    location: '',
    description: '',
    resume_link: '',
    years_experience: 0,
    award_count: 0,
    client_count: 0,
    image: null
});

// Open Add Modal
function openAddModal() {
    Object.assign(addForm, {
        greeting: '', name: '', role: '', location: '',
        description: '', resume_link: '', years_experience: 0,
        award_count: 0, client_count: 0, image: null
    });
    addPreview.value = null;
    showAddModal.value = true;
}

// Add About
function addAbout() {
    const formData = new FormData();
    for (const key in addForm) {
        if (key === 'image' && addForm.image) {
            formData.append('image', addForm.image);
        } else {
            formData.append(key, addForm[key]);
        }
    }

    router.post(route('admin.about.store'), formData, {
        forceFormData: true,
        onSuccess: () => {
            toast.add({ severity: 'success', summary: 'Created', detail: 'About section created', life: 3000 });
            showAddModal.value = false;
        },
        onError: (errors) => {
            toast.add({ severity: 'error', summary: 'Error', detail: Object.values(errors).flat().join(', '), life: 5000 });
        }
    });
}

// Open Edit Modal
function openEditModal(about) {
    Object.assign(editForm, {
        id: about.id,
        greeting: about.greeting,
        name: about.name,
        role: about.role,
        location: about.location,
        description: about.description,
        resume_link: about.resume_link,
        years_experience: about.years_experience,
        award_count: about.award_count,
        client_count: about.client_count,
        image: null
    });
    editPreview.value = about.image_url;
    showEditModal.value = true;
}

// Update About
function updateAbout() {
    const formData = new FormData();
    formData.append('_method', 'PUT');
    for (const key in editForm) {
        if (key === 'image' && editForm.image) {
            formData.append('image', editForm.image);
        } else if (key !== 'id') {
            formData.append(key, editForm[key]);
        }
    }

    router.post(route('admin.about.update', editForm.id), formData, {
        forceFormData: true,
        onSuccess: () => {
            toast.add({ severity: 'success', summary: 'Updated', detail: 'About section updated', life: 3000 });
            showEditModal.value = false;
        },
        onError: (errors) => {
            toast.add({ severity: 'error', summary: 'Error', detail: Object.values(errors).flat().join(', '), life: 5000 });
        }
    });
}

// Delete About
function deleteAbout(about) {
    if (!confirm(`Delete About section of ${about.name}?`)) return;
    router.delete(route('admin.about.destroy', about.id), {
        onSuccess: () => {
            toast.add({ severity: 'success', summary: 'Deleted', detail: 'About section deleted', life: 3000 });
        }
    });
}

// File change
function onFileChange(event, formRef, previewRef) {
    const file = event.target.files[0];
    if (!file) return;
    formRef.image = file;

    const reader = new FileReader();
    reader.onload = (e) => previewRef.value = e.target.result;
    reader.readAsDataURL(file);
}
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">

        <Head title="About Us" />

        <div class="mb-4">
            <Button label="Add Section" icon="pi pi-plus" @click="openAddModal" />
        </div>

        <!-- Abouts Table -->
        <DataTable :value="abouts" paginator :rows="10" :responsiveLayout="'scroll'" tableStyle="min-width: 50rem">
            <Column field="name" header="Name" />
            <Column field="role" header="Role" />
            <Column field="location" header="Location" />
            <Column header="Image">
                <template #body="slotProps">
                    <img :src="slotProps.data.image_url" alt="" class="w-20 h-20 object-cover rounded" />
                </template>
            </Column>
            <Column header="Actions">
                <template #body="slotProps">
                    <Button label="Edit" icon="pi pi-pencil" class="mr-2" @click="openEditModal(slotProps.data)" />
                    <Button label="Delete" icon="pi pi-trash" severity="danger" @click="deleteAbout(slotProps.data)" />
                </template>
            </Column>
        </DataTable>

        <!-- Add Modal -->
        <Dialog v-model:visible="showAddModal" header="Add About" modal :style="{ width: '50rem' }">
            <form @submit.prevent="addAbout" class="flex flex-col gap-3">
                <InputText v-model="addForm.greeting" placeholder="Greeting" />
                <InputText v-model="addForm.name" placeholder="Name" required />
                <InputText v-model="addForm.role" placeholder="Role" />
                <InputText v-model="addForm.location" placeholder="Location" />
                <InputText v-model="addForm.description" placeholder="Description" rows="4" />
                <InputText v-model="addForm.resume_link" placeholder="Resume Link" />
                <InputNumber v-model="addForm.years_experience" :min="0" placeholder="Years of Experience" />
                <InputNumber v-model="addForm.award_count" :min="0" placeholder="Award Count" />
                <InputNumber v-model="addForm.client_count" :min="0" placeholder="Client Count" />
                <input type="file" @change="(e) => onFileChange(e, addForm, addPreview)" />
                <img v-if="addPreview" :src="addPreview" class="w-32 h-32 mt-2" />
                <Button type="submit" label="Save" class="mt-2" />
            </form>
        </Dialog>

        <!-- Edit Modal -->
        <Dialog v-model:visible="showEditModal" header="Edit About" modal :style="{ width: '30rem' }">
            <form @submit.prevent="updateAbout" class="flex flex-col gap-3">
                <InputText v-model="editForm.greeting" placeholder="Greeting" />
                <InputText v-model="editForm.name" placeholder="Name" required />
                <InputText v-model="editForm.role" placeholder="Role" />
                <InputText v-model="editForm.location" placeholder="Location" />
                <InputText v-model="editForm.description" placeholder="Description" rows="4" />
                <InputText v-model="editForm.resume_link" placeholder="Resume Link" />
                <InputNumber v-model="editForm.years_experience" :min="0" placeholder="Years of Experience" />
                <InputNumber v-model="editForm.award_count" :min="0" placeholder="Award Count" />
                <InputNumber v-model="editForm.client_count" :min="0" placeholder="Client Count" />
                <input type="file" @change="(e) => onFileChange(e, editForm, editPreview)" />
                <img v-if="editPreview" :src="editPreview" class="w-32 h-32 mt-2" />
                <Button type="submit" label="Update" class="mt-2" />
            </form>
        </Dialog>
    </AppLayout>
</template>
