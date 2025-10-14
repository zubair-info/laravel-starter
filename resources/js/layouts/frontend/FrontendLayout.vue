<script setup>
import { Head } from '@inertiajs/inertia-vue3'
</script>

<template>

    <Head title="My Portfolio">
        <meta name="description" content="test" />
    </Head>
    <div>
        <main class="min-h-screen">
            <slot />
        </main>
    </div>
</template>

<style>
@import '../../../css/custom.css';
</style>
