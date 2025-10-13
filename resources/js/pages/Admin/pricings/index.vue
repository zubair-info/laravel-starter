<script setup>
import { ref, reactive, watch } from 'vue';
import { router, usePage } from '@inertiajs/vue3';
import { useToast } from 'primevue/usetoast';
import AppLayout from '@/Layouts/AppLayout.vue';

import Dialog from 'primevue/dialog';
import InputText from 'primevue/inputtext';
import InputNumber from 'primevue/inputnumber';
import Button from 'primevue/button';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';

const toast = useToast();
const page = usePage();

const props = defineProps({
    pricings: Array
});

const pricings = ref([]);
watch(() => props.pricings, (newPricings) => (pricings.value = newPricings), { immediate: true });

// Modal
const showAddModal = ref(false);
const showEditModal = ref(false);

// Forms
const addForm = reactive({ name: '', price: 0, hours: 0, per_week: 0, description: '' });
const editForm = reactive({ id: null, name: '', price: 0, hours: 0, per_week: 0, description: '' });

// Add Pricing
function openAddModal() {
    Object.assign(addForm, { name: '', price: 0, hours: 0, per_week: 0, description: '' });
    showAddModal.value = true;
}

function addPricing() {
    router.post(route('admin.pricings.store'), addForm, {
        onSuccess: () => {
            toast.add({ severity: 'success', summary: 'Added', detail: 'Pricing plan added', life: 3000 });
            showAddModal.value = false;
        },
        onError: (errors) => {
            toast.add({ severity: 'error', summary: 'Error', detail: Object.values(errors).flat().join(', '), life: 5000 });
        }
    });
}

// Edit Pricing
function openEditModal(pricing) {
    Object.assign(editForm, pricing);
    showEditModal.value = true;
}

function updatePricing() {
    router.put(route('admin.pricings.update', editForm.id), editForm, {
        onSuccess: () => {
            toast.add({ severity: 'success', summary: 'Updated', detail: 'Pricing plan updated', life: 3000 });
            showEditModal.value = false;
        },
        onError: (errors) => {
            toast.add({ severity: 'error', summary: 'Error', detail: Object.values(errors).flat().join(', '), life: 5000 });
        }
    });
}

// Delete Pricing
function deletePricing(pricing) {
    if (!confirm(`Delete pricing plan ${pricing.name}?`)) return;
    router.delete(route('admin.pricings.destroy', pricing.id), {
        onSuccess: () => toast.add({ severity: 'success', summary: 'Deleted', detail: 'Pricing plan deleted', life: 3000 })
    });
}
</script>

<template>
    <AppLayout>
        <div class="mb-4">
            <Button label="Add Pricing" icon="pi pi-plus" @click="openAddModal" />
        </div>

        <DataTable :value="pricings" responsiveLayout="scroll" class="p-datatable-gridlines">
            <Column field="name" header="Name" sortable />
            <Column field="price" header="Price ($/h)" sortable />
            <Column field="hours" header="Hours" sortable />
            <Column field="per_week" header="Per Week" sortable />
            <Column field="description" header="Description" />

            <Column header="Actions">
                <template #body="slotProps">
                    <Button icon="pi pi-pencil" class="mr-2 p-button-sm"
                        @click="openEditModal(slotProps.data)">Edit</Button>
                    <Button icon="pi pi-trash" class="p-button-danger p-button-sm"
                        @click="deletePricing(slotProps.data)">Delete</Button>
                </template>
            </Column>
        </DataTable>

        <!-- Add Modal -->
        <Dialog v-model:visible="showAddModal" header="Add Pricing Plan" modal :style="{ width: '30rem' }">
            <form @submit.prevent="addPricing" class="flex flex-col gap-3">
                <InputText v-model="addForm.name" placeholder="Plan Name" required />
                <InputNumber v-model="addForm.price" placeholder="Price per hour" :min="0" />
                <InputNumber v-model="addForm.hours" placeholder="Total Hours" :min="0" />
                <InputNumber v-model="addForm.per_week" placeholder="Hours per week" :min="0" />
                <InputText v-model="addForm.description" placeholder="Description" />
                <Button type="submit" label="Save" class="mt-2" />
            </form>
        </Dialog>

        <!-- Edit Modal -->
        <Dialog v-model:visible="showEditModal" header="Edit Pricing Plan" modal :style="{ width: '30rem' }">
            <form @submit.prevent="updatePricing" class="flex flex-col gap-3">
                <InputText v-model="editForm.name" placeholder="Plan Name" required />
                <InputNumber v-model="editForm.price" placeholder="Price per hour" :min="0" />
                <InputNumber v-model="editForm.hours" placeholder="Total Hours" :min="0" />
                <InputNumber v-model="editForm.per_week" placeholder="Hours per week" :min="0" />
                <InputText v-model="editForm.description" placeholder="Description" />
                <Button type="submit" label="Update" class="mt-2" />
            </form>
        </Dialog>
    </AppLayout>
</template>
