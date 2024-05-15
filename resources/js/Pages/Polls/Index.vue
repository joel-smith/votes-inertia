<script setup>
import {InertiaLink} from '@inertiajs/inertia-vue3';
import {Head} from '@inertiajs/vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
const props = defineProps({ polls: Object })
</script>

<template>

  <Head title="All Polls" />

  <AuthenticatedLayout>
  <div class="max-w-md mx-auto p-4 bg-white rounded-lg shadow-md">
    <h1 class="text-xl font-semibold mb-4">All Polls</h1>
    <ul>
      <li v-for="poll in polls" :key="poll.id" class="flex items-center mb-2">
        <InertiaLink :href="route('polls.show', poll.id)" class="text-blue-500 hover:text-blue-700">{{ poll.title }}</InertiaLink>
      </li>
    </ul>

    <InertiaLink :href="route('dashboard')" class="px-6 py-1.5 bg-indigo-600 text-white rounded ml-2">Return to Dashboard</InertiaLink>  </div>
  </AuthenticatedLayout>
</template>

<style scoped>

</style>

