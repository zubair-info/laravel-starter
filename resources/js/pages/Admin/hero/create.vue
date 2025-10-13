<template>
    <AppLayout>

        <Head title="Dashboard" />
        <div class="p-6">
            <h1 class="text-xl font-bold mb-4">Add Hero</h1>
            <form @submit.prevent="submit" class="grid grid-cols-6 gap-4">

                <!-- Greeting Text -->
                <div class="col-span-3">
                    <label class="block mb-1 font-medium">Greeting Text</label>
                    <input v-model="form.greeting_text" type="text" class="border p-2 w-full" />
                </div>

                <!-- Title First -->
                <div class="col-span-3">
                    <label class="block mb-1 font-medium">Title First</label>
                    <input v-model="form.title_first" type="text" class="border p-2 w-full" />
                </div>

                <!-- Title Second -->
                <div class="col-span-3">
                    <label class="block mb-1 font-medium">Title Second</label>
                    <input v-model="form.title_second" type="text" class="border p-2 w-full" />
                </div>

                <!-- Subtitle -->
                <div class="col-span-3">
                    <label class="block mb-1 font-medium">Subtitle</label>
                    <input v-model="form.subtitle" type="text" class="border p-2 w-full" />
                </div>

                <!-- Description -->
                <div class="col-span-6">
                    <label class="block mb-1 font-medium">Description</label>
                    <textarea v-model="form.description" class="border p-2 w-full"></textarea>
                </div>

                <!-- Primary Button Text -->
                <div class="col-span-2">
                    <label class="block mb-1 font-medium">Primary Button Text</label>
                    <input v-model="form.primary_button_text" type="text" class="border p-2 w-full" />
                </div>

                <!-- Primary Button URL -->
                <div class="col-span-2">
                    <label class="block mb-1 font-medium">Primary Button URL</label>
                    <input v-model="form.primary_button_url" type="text" class="border p-2 w-full" />
                </div>

                <!-- Secondary Button Text -->
                <div class="col-span-2">
                    <label class="block mb-1 font-medium">Secondary Button Text</label>
                    <input v-model="form.secondary_button_text" type="text" class="border p-2 w-full" />
                </div>

                <!-- Secondary Button URL -->
                <div class="col-span-2">
                    <label class="block mb-1 font-medium">Secondary Button URL</label>
                    <input v-model="form.secondary_button_url" type="text" class="border p-2 w-full" />
                </div>

                <!-- Hero Image -->
                <!-- <div class="col-span-2">
                    <label class="block mb-1 font-medium">Hero Image URL</label>
                    <input v-model="form.hero_image" type="text" class="border p-2 w-full" />
                </div> -->
                <label class="col-span-2">
                    Hero Image:
                    <input type="file" @change="onFileChange" class="border p-2 w-full" />
                    <img v-if="preview" :src="preview" class="w-48 h-24 object-cover rounded mt-2" alt="Preview" />
                </label>


                <!-- Client Count -->
                <div class="col-span-2">
                    <label class="block mb-1 font-medium">Client Count</label>
                    <input v-model="form.client_count" type="text" class="border p-2 w-full" />
                </div>

                <!-- Client Label -->
                <div class="col-span-2">
                    <label class="block mb-1 font-medium">Client Label</label>
                    <input v-model="form.client_label" type="text" class="border p-2 w-full" />
                </div>

                <!-- Status -->
                <div class="col-span-2">
                    <label class="block mb-1 font-medium">Status</label>
                    <select v-model="form.status" class="border p-2 w-full">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="col-span-6">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-4 rounded w-full">
                        Save
                    </button>
                </div>

            </form>

        </div>
    </AppLayout>
</template>

<script setup>
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { useToast } from 'primevue/usetoast'
// import { useForm } from '@inertiajs/vue3'
const toast = useToast()

const preview = ref(null)   // 👈 define the preview ref


const form = reactive({
    greeting_text: '',
    title_first: '',
    title_second: '',
    subtitle: '',
    description: '',
    primary_button_text: '',
    primary_button_url: '',
    secondary_button_text: '',
    secondary_button_url: '',
    hero_image: '',
    client_count: '',
    client_label: '',
    status: 'active'
})
function onFileChange(e) {
    const file = e.target.files[0]
    form.hero_image = file

    // Show preview
    const reader = new FileReader()
    reader.onload = (event) => (preview.value = event.target.result)
    reader.readAsDataURL(file)
}


function submit() {
    const formData = new FormData()
    for (const key in form) {
        formData.append(key, form[key])
    }

    router.post(route('admin.hero.store'), formData, {
        preserveScroll: true,
        headers: { 'Content-Type': 'multipart/form-data' },
        onSuccess: () => {
            toast.add({
                severity: 'success',
                summary: 'Success',
                detail: 'Hero section updated!',
                life: 3000
            })
        },
        onError: () => {
            toast.add({
                severity: 'error',
                summary: 'Error',
                detail: 'Validation failed!',
                life: 3000
            })
        }
    })
}
</script>
