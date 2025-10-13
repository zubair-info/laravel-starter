<script setup>
import { ref, reactive, watch } from 'vue';
import { router, usePage } from '@inertiajs/vue3';
import { useToast } from 'primevue/usetoast';
import AppLayout from '@/Layouts/AppLayout.vue';

import Dialog from 'primevue/dialog';
import InputText from 'primevue/inputtext';
import FileUpload from 'primevue/fileupload';
import Button from 'primevue/button';

const toast = useToast();
const page = usePage();

const props = defineProps({ portfolios: Array });

const portfolios = ref([]);
watch(() => props.portfolios, (newPortfolios) => (portfolios.value = newPortfolios), { immediate: true });

// Modals
const showAddModal = ref(false);
const showEditModal = ref(false);

// Forms
const addForm = reactive({ title: '', description: '', link: '', image: null });
const editForm = reactive({ id: null, title: '', description: '', link: '', image: null });

// Open modals
function openAddModal() {
    Object.assign(addForm, { title: '', description: '', link: '', image: null });
    showAddModal.value = true;
}

function openEditModal(portfolio) {
    Object.assign(editForm, { ...portfolio, image: null });
    showEditModal.value = true;
}

// Add Portfolio
function addPortfolio() {
    const formData = new FormData();
    formData.append('title', addForm.title);
    formData.append('description', addForm.description);
    formData.append('link', addForm.link);
    if (addForm.image) formData.append('image', addForm.image);

    router.post(route('admin.portfolios.store'), formData, {
        forceFormData: true,
        onSuccess: () => {
            toast.add({ severity: 'success', summary: 'Added', detail: 'Portfolio added', life: 3000 });
            showAddModal.value = false;
        },
        onError: (errors) => {
            toast.add({ severity: 'error', summary: 'Error', detail: Object.values(errors).flat().join(', '), life: 5000 });
        }
    });
}

// Update Portfolio
function updatePortfolio() {
    const formData = new FormData();
    formData.append('_method', 'PUT');
    formData.append('title', editForm.title);
    formData.append('description', editForm.description);
    formData.append('link', editForm.link);
    if (editForm.image) formData.append('image', editForm.image);

    router.post(route('admin.portfolios.update', editForm.id), formData, {
        forceFormData: true,
        onSuccess: () => {
            toast.add({ severity: 'success', summary: 'Updated', detail: 'Portfolio updated', life: 3000 });
            showEditModal.value = false;
        },
        onError: (errors) => {
            toast.add({ severity: 'error', summary: 'Error', detail: Object.values(errors).flat().join(', '), life: 5000 });
        }
    });
}

// Delete Portfolio
function deletePortfolio(portfolio) {
    if (!confirm(`Delete portfolio ${portfolio.title}?`)) return;
    router.delete(route('admin.portfolios.destroy', portfolio.id), {
        onSuccess: () => toast.add({ severity: 'success', summary: 'Deleted', detail: 'Portfolio deleted', life: 3000 })
    });
}
</script>

<template>
    <AppLayout>
        <div class="mb-4">
            <Button label="Add Portfolio" icon="pi pi-plus" @click="openAddModal" />
        </div>

        <div class="overflow-x-auto">
            <table class="table-auto w-full border">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Link</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="portfolio in portfolios" :key="portfolio.id">
                        <td>{{ portfolio.title }}</td>
                        <td>{{ portfolio.description }}</td>
                        <td>{{ portfolio.link }}</td>
                        <td>
                            <img v-if="portfolio.image_url" :src="portfolio.image_url"
                                class="w-16 h-16 object-cover rounded" />
                        </td>
                        <td>
                            <Button icon="pi pi-pencil" class="mr-2 p-button-sm" @click="openEditModal(portfolio)" />
                            <Button icon="pi pi-trash" class="p-button-danger p-button-sm"
                                @click="deletePortfolio(portfolio)" />
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Add Modal -->
        <Dialog v-model:visible="showAddModal" header="Add Portfolio" modal>
            <form @submit.prevent="addPortfolio" class="flex flex-col gap-3">
                <InputText v-model="addForm.title" placeholder="Title" required />
                <InputText v-model="addForm.description" placeholder="Description" />
                <InputText v-model="addForm.link" placeholder="Link" />
                <input type="file" @change="e => addForm.image = e.target.files[0]" />
                <Button type="submit" label="Save" class="mt-2" />
            </form>
        </Dialog>

        <!-- Edit Modal -->
        <Dialog v-model:visible="showEditModal" header="Edit Portfolio" modal>
            <form @submit.prevent="updatePortfolio" class="flex flex-col gap-3">
                <InputText v-model="editForm.title" placeholder="Title" required />
                <InputText v-model="editForm.description" placeholder="Description" />
                <InputText v-model="editForm.link" placeholder="Link" />
                <input type="file" @change="e => editForm.image = e.target.files[0]" />
                <Button type="submit" label="Update" class="mt-2" />
            </form>
        </Dialog>
    </AppLayout>
</template>
