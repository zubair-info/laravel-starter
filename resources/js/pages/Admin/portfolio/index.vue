<script setup>
import { Inertia } from '@inertiajs/inertia'
import { ref } from 'vue'
import AppLayout from '@/layouts/AppLayout.vue'
import { route } from 'ziggy-js'

const props = defineProps({ portfolios: Array })

// reactive list for instant removal
const portfolioList = ref([...props.portfolios])

function deletePortfolio(id) {
    if (!confirm('Are you sure?')) return;

    Inertia.delete(route('admin.portfolios.destroy', id), {
        onSuccess: () => {
            // Remove deleted item locally
            portfolioList.value = portfolioList.value.filter(p => p.id !== id)
        },
        onError: (errors) => {
            console.error(errors)
        }
    })
}
</script>

<template>
    <AppLayout>
        <Toast /> <!-- PrimeVue Toast container -->

        <div class="p-6">
            <div class="flex justify-between mb-4">
                <h1 class="text-2xl font-bold">Portfolios</h1>
                <a :href="route('admin.portfolios.create')" class="bg-blue-500 text-white px-4 py-2 rounded">
                    + Add New
                </a>
            </div>

            <table class="w-full border">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-2 border">Title</th>
                        <th class="p-2 border">Service</th>
                        <th class="p-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="p in portfolioList" :key="p.id">
                        <td class="border p-2">{{ p?.title }}</td>
                        <td class="border p-2">{{ p?.service?.title }}</td>
                        <td class="border p-2">
                            <a :href="route('admin.portfolios.edit', p.id)"
                                class="bg-blue-500 text-white px-4 py-2 rounded">Edit</a>
                            <button @click="deletePortfolio(p.id)"
                                class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AppLayout>
</template>
