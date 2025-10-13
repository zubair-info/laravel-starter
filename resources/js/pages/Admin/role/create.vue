<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Form } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

const props = defineProps({ permissions: Array });

const breadcrumbs = [
  { title: 'roles', href: route('roles.index') },
  { title: 'add', href: route('roles.create') }
];
</script>

<template>
  <AppLayout :breadcrumbs="breadcrumbs">
    <Head title="add role" />

    <div class="p-4 max-w-md mx-auto bg-white rounded shadow">
      <h2 class="text-lg font-semibold mb-4">add role</h2>

      <Form :action="route('roles.store')" method="post" class="space-y-4">
        <!-- Role Name -->
        <input type="text" name="name" placeholder="role name" class="w-full border p-2 rounded" required />

        <!-- Permissions -->
        <div>
          <span class="font-medium mb-2 block">permissions:</span>
          <div class="flex flex-wrap gap-2">
            <label v-for="permission in props.permissions" :key="permission.id" class="flex items-center gap-1">
              <input type="checkbox" :value="permission.id" name="permissions[]" />
              {{ permission.name }}
            </label>
          </div>
        </div>

        <!-- Submit -->
        <div class="flex justify-end">
          <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">save</button>
        </div>
      </Form>
    </div>
  </AppLayout>
</template>
