<script setup>
import { ref } from 'vue';
import { useForm, router } from '@inertiajs/vue3'
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue';
import { route } from 'ziggy-js'
import { useToast } from 'primevue/usetoast'

const toast = useToast()



const props = defineProps({
    services: Array
})

const isModalOpen = ref(false)
const editingService = ref(null)
const preview = ref(null)
const form = ref(null)

function openCreateModal() {
    editingService.value = null
    form.value = useForm({
        title: '',
        description: '',
        service_icons: null, // ✅ file field
        link: ''
    })
    preview.value = null
    isModalOpen.value = true
}

function openEditModal(service) {
    editingService.value = service
    form.value = useForm({
        ...service,
    })
    preview.value = service.service_icons ?? null // if you have image URL in DB
    isModalOpen.value = true
}

function onFileChange(e) {
    const file = e.target.files[0]
    if (!file) return
    form.value.service_icons = file

    const reader = new FileReader()
    reader.onload = (event) => preview.value = event.target.result
    reader.readAsDataURL(file)
}

function saveService() {
    const url = editingService.value
        ? route('admin.services.update', editingService.value.id)
        : route('admin.services.store')

    const method = editingService.value ? 'post' : 'post' // Laravel method spoofing used for PUT

    const formData = new FormData()
    formData.append('_method', editingService.value ? 'PUT' : 'POST') // 🔑 important for PUT requests
    formData.append('title', form.value.title)
    formData.append('description', form.value.description)
    formData.append('link', form.value.link ?? '')
    if (form.value.service_icons) {
        formData.append('service_icons', form.value.service_icons)
    }
    router.post(url, formData, {
        forceFormData: true,
        onSuccess: () => {
            isModalOpen.value = false
            toast.add({
                severity: 'success',
                summary: 'Updated',
                detail: 'successfully' ,
                life: 3000
            })
        },
        onError: (errors) => {
            console.log(errors)
        }
    })
}
function deleteService(service) {
    if (confirm('Are you sure you want to delete this service?')) {
        useForm().delete(route('admin.services.destroy', service.id));
    }
}
</script>

<template>

    <Head title="Services" />

    <AppLayout>
        <div class="">
            <button @click="openCreateModal" class="px-4 py-2 bg-blue-600 text-white rounded">
                Add Service
            </button>

            <table class="w-full mt-4 border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-2 border">Title</th>
                        <th class="p-2 border">Sub Title</th>
                        <th class="p-2 border">Icon</th>
                        <th class="p-2 border">Link</th>
                        <th class="p-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="service in props.services" :key="service.id">
                        <td class="p-2 border">{{ service.title }}</td>
                        <td class="p-2 border">{{ service.description }}</td>
                        <td class="border p-2">
                            <img v-if="service.service_icons" :src="service.service_icons" alt="Hero Image"
                                class="w-32 h-16 object-cover rounded mt-2" />
                            <span v-else class="text-gray-400">No Image</span>
                        </td>
                        <td class="p-2 border">{{ service.link }}</td>
                        <td class="p-2 border">
                            <button @click="openEditModal(service)" class="px-2 py-1 bg-yellow-500 text-white rounded">
                                Edit
                            </button>
                            <button @click="deleteService(service)"
                                class="px-2 py-1 bg-red-500 text-white rounded ml-2">
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Modal -->
        <TransitionRoot :show="isModalOpen" as="div" appear>
            <Dialog as="div" class="relative z-10" @close="closeModal">
                <TransitionChild enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100"
                    leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                    <div class="fixed inset-0 bg-black/25" />
                </TransitionChild>

                <div class="fixed inset-0 overflow-y-auto">
                    <div class="flex min-h-full items-center justify-center p-4 text-center">
                        <TransitionChild enter="ease-out duration-300" enter-from="opacity-0 scale-95"
                            enter-to="opacity-100 scale-100" leave="ease-in duration-200"
                            leave-from="opacity-100 scale-100" leave-to="opacity-0 scale-95">
                            <DialogPanel
                                class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all">
                                <DialogTitle class="text-lg font-medium leading-6 text-gray-900">
                                    {{ editingService ? 'Edit Service' : 'Add Service' }}
                                </DialogTitle>

                                <div v-if="form" class="mt-4 space-y-2">
                                    <input v-model="form.title" type="text" placeholder="Title"
                                        class="w-full border rounded p-2" />
                                    <textarea v-model="form.description" placeholder="Description"
                                        class="w-full border rounded p-2"></textarea>
                                    <!-- <input v-model="form.icon" type="text" placeholder="Icon"
                                        class="w-full border rounded p-2" /> -->
                                    <input type="file" @change="onFileChange" class="border p-2 w-full" />
                                    <img v-if="preview" :src="preview" class="w-48 h-24 object-cover rounded mt-2"
                                        alt="Preview" />
                                    <input v-model="form.link" type="text" placeholder="Link"
                                        class="w-full border rounded p-2" />

                                    <div class="mt-4 flex justify-end space-x-2">
                                        <button @click="closeModal" type="button"
                                            class="px-4 py-2 bg-gray-200 rounded">Cancel</button>
                                        <button @click="saveService" type="button"
                                            class="px-4 py-2 bg-blue-600 text-white rounded">Save</button>
                                    </div>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
    </AppLayout>
</template>
