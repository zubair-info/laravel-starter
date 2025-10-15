<script setup>
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
import AppLayout from '@/layouts/AppLayout.vue'
import Dialog from 'primevue/dialog'
import InputText from 'primevue/inputtext'
import Button from 'primevue/button'

const props = defineProps({
    links: Array,
    aboutId: Number
})

const showModal = ref(false)
const editMode = ref(false)
const currentId = ref(null)

const form = useForm({
    platform: '',
    icon: '',
    url: '',
    about_id: props.aboutId
})

const openModal = (link = null) => {
    if (link) {
        editMode.value = true
        currentId.value = link.id
        form.platform = link.platform
        form.icon = link.icon
        form.url = link.url
        form.about_id = link.about_id
    } else {
        editMode.value = false
        currentId.value = null
        form.reset()
    }
    showModal.value = true
}

const submit = () => {
    if (editMode.value && currentId.value) {
        form.put(route('admin.social-links.update', currentId.value), {
            onSuccess: () => showModal.value = false
        })
    } else {
        form.post(route('admin.social-links.store'), {
            onSuccess: () => showModal.value = false
        })
    }
}

const deleteLink = (id) => {
    if (confirm('Are you sure you want to delete this social link?')) {
        form.delete(route('admin.social-links.destroy', id))
    }
}
</script>

<template>
    <AppLayout>
        <div class="p-6">
            <h1 class="text-2xl font-bold mb-4">Social Links</h1>
            <Button label="Add New Link" class="mb-4" @click="openModal()" />

            <!-- Modal -->
            <Dialog v-model:visible="showModal" header="Social Link Form" :modal="true" :closable="true">
                <form @submit.prevent="submit" class="space-y-4">
                    <div>
                        <label class="block mb-1">Platform</label>
                        <InputText v-model="form.platform" class="w-full" />
                    </div>

                    <div>
                        <label class="block mb-1">Icon (optional)</label>
                        <InputText v-model="form.icon" class="w-full" />
                    </div>

                    <div>
                        <label class="block mb-1">URL</label>
                        <InputText v-model="form.url" class="w-full" />
                    </div>

                    <div class="flex justify-end mt-4 space-x-2">
                        <Button label="Cancel" type="button" @click="showModal = false" class="p-button-text" />
                        <Button label="Save" type="submit" class="p-button-primary" />
                    </div>
                </form>
            </Dialog>

            <!-- Optional table to show links -->
            <table class="w-full border mt-4">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-2">Platform</th>
                        <th class="p-2">Icon</th>
                        <th class="p-2">URL</th>
                        <th class="p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="link in links" :key="link.id" class="border-t">
                        <td class="p-2">{{ link.platform }}</td>
                        <td class="p-2">{{ link.icon }}</td>
                        <td class="p-2">
                            <a :href="link.url" target="_blank" class="text-blue-600 underline">{{ link.url }}</a>
                        </td>
                        <td class="p-2 space-x-2">
                            <Button label="Edit" class="p-button-warning p-button-sm" @click="openModal(link)" />
                            <Button label="Delete" class="p-button-danger p-button-sm" @click="deleteLink(link.id)" />
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AppLayout>
</template>
