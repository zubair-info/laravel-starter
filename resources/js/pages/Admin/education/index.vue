<script setup>
import { ref, reactive, watch } from 'vue';
import { router, usePage, Head } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { useToast } from 'primevue/usetoast';

import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Dialog from 'primevue/dialog';
import InputText from 'primevue/inputtext';
import DatePicker from 'primevue/datepicker';
import Button from 'primevue/button';

const toast = useToast();
const page = usePage();

const props = defineProps({
    educations: Array
});

const educations = ref([]);
watch(() => props.educations, val => educations.value = val, { immediate: true });

const showAddModal = ref(false);
const showEditModal = ref(false);

const addForm = reactive({
    degree: '',
    institution: '',
    start_date: null,
    end_date: null,
    description: ''
});

const editForm = reactive({
    id: null,
    degree: '',
    institution: '',
    start_date: null,
    end_date: null,
    description: ''
});

function openAddModal() {
    Object.assign(addForm, { degree: '', institution: '', start_date: null, end_date: null, description: '' });
    showAddModal.value = true;
}

function addEducation() {
    router.post(route('admin.educations.store'), addForm, {
        onSuccess: () => {
            toast.add({ severity: 'success', summary: 'Created', detail: 'Education created', life: 3000 });
            showAddModal.value = false;
        },
        onError: (errors) => {
            toast.add({ severity: 'error', summary: 'Error', detail: Object.values(errors).flat().join(', '), life: 5000 });
        }
    });
}

function openEditModal(education) {
    Object.assign(editForm, { ...education });
    showEditModal.value = true;
}

function updateEducation() {
    router.put(route('admin.educations.update', editForm.id), editForm, {
        onSuccess: () => {
            toast.add({ severity: 'success', summary: 'Updated', detail: 'Education updated', life: 3000 });
            showEditModal.value = false;
        },
        onError: (errors) => {
            toast.add({ severity: 'error', summary: 'Error', detail: Object.values(errors).flat().join(', '), life: 5000 });
        }
    });
}

function deleteEducation(education) {
    if (!confirm(`Delete ${education.degree}?`)) return;
    router.delete(route('admin.educations.destroy', education.id), {
        onSuccess: () => {
            toast.add({ severity: 'success', summary: 'Deleted', detail: 'Education deleted', life: 3000 });
        }
    });
}
</script>

<template>
    <AppLayout>

        <Head title="Education" />

        <Button label="Add Education" icon="pi pi-plus" @click="openAddModal" class="mb-3" />

        <DataTable :value="educations" paginator :rows="10">
            <Column field="degree" header="Degree" />
            <Column field="institution" header="Institution" />
            <Column field="start_date" header="Start Date" />
            <Column field="end_date" header="End Date" />
            <Column field="description" header="Description" />
            <Column header="Actions">
                <template #body="slotProps">
                    <Button label="Edit" icon="pi pi-pencil" class="mr-2" @click="openEditModal(slotProps.data)" />
                    <Button label="Delete" icon="pi pi-trash" severity="danger"
                        @click="deleteEducation(slotProps.data)" />
                </template>
            </Column>
        </DataTable>

        <!-- Add Modal -->
        <Dialog v-model:visible="showAddModal" header="Add Education" modal :style="{ width: '500px' }">
            <form @submit.prevent="addEducation" class="flex flex-col gap-3">
                <InputText v-model="addForm.degree" placeholder="Degree" required />
                <InputText v-model="addForm.institution" placeholder="Institution" required />
                <DatePicker v-model="addForm.start_date" placeholder="Start Date" date-format="yy-mm-dd" />
                <DatePicker v-model="addForm.end_date" placeholder="End Date" date-format="yy-mm-dd" />
                <InputText v-model="addForm.description" placeholder="Description" />
                <Button type="submit" label="Save" class="mt-2" />
            </form>
        </Dialog>

        <!-- Edit Modal -->
        <Dialog v-model:visible="showEditModal" header="Edit Education" modal :style="{ width: '500px' }">
            <form @submit.prevent="updateEducation" class="flex flex-col gap-3">
                <InputText v-model="editForm.degree" placeholder="Degree" required />
                <InputText v-model="editForm.institution" placeholder="Institution" required />
                <DatePicker v-model="editForm.start_date" placeholder="Start Date" date-format="yy-mm-dd" />
                <DatePicker v-model="editForm.end_date" placeholder="End Date" date-format="yy-mm-dd" />
                <InputText v-model="editForm.description" placeholder="Description" />
                <Button type="submit" label="Update" class="mt-2" />
            </form>
        </Dialog>
    </AppLayout>
</template>
