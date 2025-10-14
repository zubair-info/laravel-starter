<script setup>
import { ref, reactive, watch } from 'vue';
import { router, usePage } from '@inertiajs/vue3';
import { useToast } from 'primevue/usetoast';
import AppLayout from '@/Layouts/AppLayout.vue';

import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Button from 'primevue/button';
import Dialog from 'primevue/dialog';
import InputText from 'primevue/inputtext';
import ProgressBar from 'primevue/progressbar';

const toast = useToast();
const page = usePage();

const props = defineProps({
    skills: Array
});

const skills = ref([]);
watch(() => props.skills, (newSkills) => (skills.value = newSkills), { immediate: true });

// Modals
const showAddModal = ref(false);
const showEditModal = ref(false);

// Forms
const addForm = reactive({ name: '', level_percent: 0, icon_path: '' });
const editForm = reactive({ id: null, name: '', level_percent: 0, icon_path: '' });

// Add Skill
function openAddModal() {
    Object.assign(addForm, { name: '', level_percent: 0, icon_path: '' });
    showAddModal.value = true;
}

function addSkill() {
    router.post(route('admin.skills.store'), addForm, {
        onSuccess: () => {
            toast.add({ severity: 'success', summary: 'Added', detail: 'Skill added', life: 3000 });
            showAddModal.value = false;
        },
        onError: (errors) => {
            toast.add({ severity: 'error', summary: 'Error', detail: Object.values(errors).flat().join(', '), life: 5000 });
        }
    });
}

// Edit Skill
function openEditModal(skill) {
    Object.assign(editForm, skill);
    showEditModal.value = true;
}

function updateSkill() {
    router.put(route('admin.skills.update', editForm.id), editForm, {
        onSuccess: () => {
            toast.add({ severity: 'success', summary: 'Updated', detail: 'Skill updated', life: 3000 });
            showEditModal.value = false;
        },
        onError: (errors) => {
            toast.add({ severity: 'error', summary: 'Error', detail: Object.values(errors).flat().join(', '), life: 5000 });
        }
    });
}

// Delete Skill
function deleteSkill(skill) {
    if (!confirm(`Delete skill ${skill.name}?`)) return;
    router.delete(route('admin.skills.destroy', skill.id), {
        onSuccess: () => toast.add({ severity: 'success', summary: 'Deleted', detail: 'Skill deleted', life: 3000 })
    });
}
</script>

<template>
    <AppLayout>
        <div class="mb-4">
            <Button label="Add Skill" icon="pi pi-plus" @click="openAddModal" />
        </div>

        <DataTable :value="skills" paginator :rows="10" :show-gridlines="true" responsiveLayout="scroll">
            <Column field="name" header="Name" sortable></Column>
            <Column header="Level (%)">
                <template #body="slotProps">
                    <ProgressBar :value="slotProps.data.level_percent" :showValue="true" />
                </template>
            </Column>
            <Column header="Icon">
                <template #body="slotProps">
                    <img v-if="slotProps.data.icon_path" :src="slotProps.data.icon_path" class="w-8 h-8 rounded" />
                </template>
            </Column>
            <Column header="Actions">
                <template #body="slotProps">
                    <Button class="mr-2 p-button-sm" @click="openEditModal(slotProps.data)">
                        Edit
                    </Button>
                    <Button class="p-button-danger p-button-sm" @click="deleteSkill(slotProps.data)">
                        Delete
                    </Button>
                </template>
            </Column>
        </DataTable>

        <!-- Add Modal -->
        <Dialog v-model:visible="showAddModal" header="Add Skill" modal>
            <form @submit.prevent="addSkill" class="flex flex-col gap-3">
                <InputText v-model="addForm.name" placeholder="Skill Name" required />
                <InputText v-model="addForm.level_percent" placeholder="Level %" type="number" />
                <InputText v-model="addForm.icon_path" placeholder="Icon URL" />
                <Button type="submit" label="Save" class="mt-2" />
            </form>
        </Dialog>

        <!-- Edit Modal -->
        <Dialog v-model:visible="showEditModal" header="Edit Skill" modal>
            <form @submit.prevent="updateSkill" class="flex flex-col gap-3">
                <InputText v-model="editForm.name" placeholder="Skill Name" required />
                <InputText v-model="editForm.level_percent" placeholder="Level %" type="number" />
                <InputText v-model="editForm.icon_path" placeholder="Icon URL" />
                <Button type="submit" label="Update" class="mt-2" />
            </form>
        </Dialog>
    </AppLayout>
</template>
