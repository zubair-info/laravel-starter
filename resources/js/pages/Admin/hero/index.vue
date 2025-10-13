<template>

    <AppLayout >
        <div class="p-6">
            <div class="flex justify-between mb-4">
                <h1 class="text-xl font-bold">Hero Sections</h1>
                <a :href="route('admin.hero.create')" class="bg-blue-500 text-white px-4 py-2 rounded">+ Add New</a>
            </div>

            <table class="min-w-full border">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-2 text-left">Title</th>
                        <th class="p-2 text-left">Subtitle</th>
                        <th class="border p-2">Hero Image</th>
                        <th class="p-2 text-left">Status</th>
                        <th class="p-2 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="hero in heroes" :key="hero.id" class="border-t">
                        <td class="p-2">{{ hero.title_first }} {{ hero.title_second }}</td>
                        <td class="p-2">{{ hero.subtitle }}</td>
                        <td class="border p-2">
                            <img v-if="hero.image_url" :src="hero.image_url" alt="Hero Image"
                                class="w-32 h-16 object-cover rounded mt-2" />
                            <span v-else class="text-gray-400">No Image</span>
                        </td>
                        <td class="p-2">{{ hero.status ? 'Active' : 'Inactive' }}</td>
                        <td class="p-2 text-right space-x-2">
                            <a :href="route('admin.hero.edit', hero.id)"
                                class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</a>
                            <button @click="destroy(hero.id)"
                                class="px-2 py-1 bg-red-500 text-white rounded">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AppLayout>
</template>

<script setup>
import { router } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
import AppLayout from '@/layouts/AppLayout.vue';
import { useToast } from 'primevue/usetoast'
const toast = useToast()

const props = defineProps({
    heroes: Array
})

function destroy(id) {
    if (confirm('Are you sure you want to delete this hero?')) {
        router.delete(route('admin.hero.destroy', id), {
            onSuccess: () => {
                toast.add({
                    severity: 'success',
                    summary: 'Success',
                    detail: 'Hero section delete successfully!',
                    life: 3000
                })
            }
        })
    }
}
</script>
