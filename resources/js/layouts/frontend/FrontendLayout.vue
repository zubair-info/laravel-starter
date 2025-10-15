<script setup>
import { Head } from '@inertiajs/inertia-vue3'
</script>

<template>

    <Head title="My Portfolio">
        <meta name="description" content="test" />
    </Head>

    <Header :logo="logo" @toggle-offcanvas="showMenu = !showMenu" />
    <OffcanvasMenu :show="showMenu" :menu="headerMenu" :social-links="socialLinks" :offcanvas-logo="offcanvasLogo"
        @close="showMenu = false" />
    <div>
        <main class="min-h-screen">
            <slot />
        </main>
    </div>
</template>

<style>
@import '../../../css/custom.css';
</style>
