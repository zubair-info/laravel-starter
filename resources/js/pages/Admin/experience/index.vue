<script setup>
import { ref, reactive } from 'vue';
import { router, usePage } from '@inertiajs/vue3';
import { useToast } from 'primevue/usetoast';
import AppLayout from '@/layouts/AppLayout.vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Dialog from 'primevue/dialog';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import DatePicker from 'primevue/datepicker';

const toast = useToast();
const page = usePage();

const experiences = ref(page.props.experiences || []);

// Modal states
const showAddModal = ref(false);
const showEditModal = ref(false);

// Form data
const addForm = reactive({
    title: '',
    company: '',
    start_date: null,
    end_date: null,
    description: ''
});

const editForm = reactive({
    id: null,
    title: '',
    company: '',
    start_date: null,
    end_date: null,
    description: ''
});

// Open add modal
function openAddModal() {
    Object.assign(addForm, {
        title: '',
        company: '',
        start_date: null,
        end_date: null,
        description: ''
    });
    showAddModal.value = true;
}

// Open edit modal
function openEditModal(exp) {
    Object.assign(editForm, {
        id: exp.id,
        title: exp.title,
        company: exp.company,
        start_date: new Date(exp.start_date),
        end_date: exp.end_date ? new Date(exp.end_date) : null,
        description: exp.description
    });
    showEditModal.value = true;
}

// Submit add
function addExperience() {
    const payload = {
        ...addForm,
        start_date: addForm.start_date ? addForm.start_date.toISOString().slice(0, 10) : null,
        end_date: addForm.end_date ? addForm.end_date.toISOString().slice(0, 10) : null,
    };
    router.post(route('admin.experiences.store'), payload, {
        onSuccess: () => {
            toast.add({ severity: 'success', summary: 'Created', detail: 'Experience added', life: 3000 });
            showAddModal.value = false;
        }
    });
}

// Submit edit
function updateExperience() {
    const payload = {
        _method: 'PUT',
        ...editForm,
        start_date: editForm.start_date ? editForm.start_date.toISOString().slice(0, 10) : null,
        end_date: editForm.end_date ? editForm.end_date.toISOString().slice(0, 10) : null,
    };
    router.post(route('admin.experiences.update', editForm.id), payload, {
        onSuccess: () => {
            toast.add({ severity: 'success', summary: 'Updated', detail: 'Experience updated', life: 3000 });
            showEditModal.value = false;
        }
    });
}

// Delete experience
function deleteExperience(exp) {
    if (!confirm(`Delete experience "${exp.title}"?`)) return;
    router.delete(route('admin.experiences.destroy', exp.id), {
        onSuccess: () => toast.add({ severity: 'success', summary: 'Deleted', detail: 'Experience deleted', life: 3000 })
    });
}
</script>

<template>
    <AppLayout>
        <div class="mb-4">
            <Button label="Add Experience" icon="pi pi-plus" @click="openAddModal" />
        </div>

        <DataTable :value="experiences" paginator :rows="10" tableStyle="min-width: 20rem">
            <Column field="title" header="Title" />
            <Column field="company" header="Company" />
            <Column field="start_date" header="Start Date" />
            <Column field="end_date" header="End Date" />
            <Column header="Actions">
                <template #body="slotProps">
                    <Button label="Edit" icon="pi pi-pencil" class="mr-2" @click="openEditModal(slotProps.data)" />
                    <Button label="Delete" icon="pi pi-trash" severity="danger"
                        @click="deleteExperience(slotProps.data)" />
                </template>
            </Column>
        </DataTable>

        <!-- Add Modal -->
        <Dialog v-model:visible="showAddModal" header="Add Experience" modal :style="{ width: '500px' }"
    :breakpoints="{ '960px': '75vw', '640px': '90vw' }">
            <form @submit.prevent="addExperience" class="flex flex-col gap-3">
                <InputText v-model="addForm.title" placeholder="Title" required />
                <InputText v-model="addForm.company" placeholder="Company" required />
                <DatePicker v-model="addForm.start_date" placeholder="Start Date" date-format="yy-mm-dd" />
                <DatePicker v-model="addForm.end_date" placeholder="End Date" date-format="yy-mm-dd" />
                <InputText v-model="addForm.description" placeholder="Description" />
                <Button type="submit" label="Save" class="mt-2" />
            </form>
        </Dialog>

        <!-- Edit Modal -->
        <Dialog v-model:visible="showEditModal" header="Edit Experience" modal :style="{ width: '500px' }"
    :breakpoints="{ '960px': '75vw', '640px': '90vw' }">
            <form @submit.prevent="updateExperience" class="flex flex-col gap-3">
                <InputText v-model="editForm.title" placeholder="Title" required />
                <InputText v-model="editForm.company" placeholder="Company" required />
                <DatePicker v-model="editForm.start_date" placeholder="Start Date" date-format="yy-mm-dd" />
                <DatePicker v-model="editForm.end_date" placeholder="End Date" date-format="yy-mm-dd" />
                <InputText v-model="editForm.description" placeholder="Description" />
                <Button type="submit" label="Update" class="mt-2" />
            </form>
        </Dialog>
    </AppLayout>
</template>
