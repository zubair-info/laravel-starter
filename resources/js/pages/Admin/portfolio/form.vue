<script setup>
import { useForm } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { route } from 'ziggy-js';
import { useToast } from 'primevue/usetoast';
import InputText from 'primevue/inputtext';
import Dropdown from 'primevue/dropdown';
import Calendar from 'primevue/calendar';
import Textarea from 'primevue/textarea';
import Button from 'primevue/button';
import Toast from 'primevue/toast';
import FileUpload from 'primevue/fileupload';
import DatePicker from 'primevue/datepicker';
import Select from 'primevue/select';


const props = defineProps({
    portfolio: Object,
    services: Array,
});

const toast = useToast();
const preview = ref(props.portfolio?.main_image || null);
console.log(typeof(props.portfolio?.service_id))

const form = useForm({
    title: props.portfolio?.title ?? '',
    service_id: props.portfolio?.service_id ? Number(props.portfolio.service_id) : null,
    client: props.portfolio?.client ?? '',
    start_date: props.portfolio?.start_date ? new Date(props.portfolio.start_date) : null,
    end_date: props.portfolio?.end_date ? new Date(props.portfolio.end_date) : null,
    main_image: null,
    overview: props.portfolio?.overview ?? '',
    typography: props.portfolio?.typography ?? '',
    conclusion: props.portfolio?.conclusion ?? '',
    status: props.portfolio?.status ?? 'active',
});

const isEdit = computed(() => !!props.portfolio);

// File input preview
function onFileChange(event) {
    const file = event.target.files[0];
    if (!file) return;
    form.main_image = file;

    const reader = new FileReader();
    reader.onload = e => (preview.value = e.target.result);
    reader.readAsDataURL(file);
}

// Submit with toast
function submit() {
    if (isEdit.value) {
        form.put(route('admin.portfolios.update', props.portfolio.id), {
            onSuccess: () => toast.add({ severity: 'success', summary: 'Success', detail: 'Portfolio updated!', life: 3000 }),
            onError: () => toast.add({ severity: 'error', summary: 'Error', detail: 'Check form fields', life: 3000 })
        });
    } else {
        form.post(route('admin.portfolios.store'), {
            onSuccess: () => toast.add({ severity: 'success', summary: 'Success', detail: 'Portfolio created!', life: 3000 }),
            onError: () => toast.add({ severity: 'error', summary: 'Error', detail: 'Check form fields', life: 3000 })
        });
    }
}
</script>

<template>
    <AppLayout>
        <Toast /> <!-- Toast container -->
        <div class="p-6 bg-white rounded shadow">
            <h1 class="text-xl font-bold mb-4">{{ isEdit ? 'Edit Portfolio' : 'Create Portfolio' }}</h1>

            <form @submit.prevent="submit" class="grid grid-cols-6 gap-4">
                <!-- Title -->
                <div class="col-span-3">
                    <label class="block mb-1 font-medium">Title</label>
                    <InputText v-model="form.title" class="w-full" />
                </div>

                <!-- Service -->
                <div class="col-span-3">
                    <label class="block mb-1 font-medium">Service</label>
                    <Select v-model="form.service_id" :options="services" option-value="id" option-label="title"
                        placeholder="Select Service" class="w-full" />
                </div>

                <!-- Client -->
                <div class="col-span-3">
                    <label class="block mb-1 font-medium">Client</label>
                    <InputText v-model="form.client" class="w-full" />
                </div>

                <!-- Start Date -->
                <div class="col-span-3">
                    <label class="block mb-1 font-medium">Start Date</label>
                    <DatePicker v-model="form.start_date" placeholder="Start Date" date-format="yy-mm-dd" />
                    <!-- <Calendar v-model="form.start_date" class="w-full"  dateFormat="yy/mm/dd"   /> -->
                </div>

                <!-- End Date -->
                <div class="col-span-3">
                    <label class="block mb-1 font-medium">End Date</label>
                    <!-- <Calendar v-model="form.end_date" class="w-full" dateFormat="yy/mm/dd" /> -->

                    <DatePicker v-model="form.end_date" placeholder="End Date" date-format="yy-mm-dd" />
                </div>

                <!-- Main Image -->
                <div class="col-span-3">
                    <label class="block mb-1 font-medium">Main Image</label>
                    <input type="file" @change="onFileChange" class="w-full border p-2" />
                    <img v-if="preview" :src="preview" class="w-48 h-24 object-cover mt-2 rounded" />
                </div>

                <!-- Overview -->
                <div class="col-span-6">
                    <label class="block mb-1 font-medium">Overview</label>
                    <Textarea v-model="form.overview" rows="3" class="w-full" />
                </div>

                <!-- Typography -->
                <div class="col-span-6">
                    <label class="block mb-1 font-medium">Typography</label>
                    <Textarea v-model="form.typography" rows="3" class="w-full" />
                </div>

                <!-- Conclusion -->
                <div class="col-span-6">
                    <label class="block mb-1 font-medium">Conclusion</label>
                    <Textarea v-model="form.conclusion" rows="3" class="w-full" />
                </div>

                <!-- Status -->
                <div class="col-span-3">
                    <label class="block mb-1 font-medium">Status</label>
                    <Dropdown v-model="form.status" :options="['Active', 'Inactive']" class="w-full" />
                </div>

                <!-- Submit Button -->
                <div class="col-span-6">
                    <Button label="Save" class="w-full" type="submit" />
                </div>
            </form>
        </div>
    </AppLayout>
</template>
