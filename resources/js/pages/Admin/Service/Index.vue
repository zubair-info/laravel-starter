<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
// import { route } from 'ziggy-js';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Service',
        href: route('service.index'),
    },
];

</script>

<template>

    <Head title="Service" />

    <AppLayout>
        <h1>dsfdssfd</h1>
    </AppLayout>
</template>
