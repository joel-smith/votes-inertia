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

    <InertiaLink :href="route('dashboard')" class="inline-block px-4 py-2 text-sm font-semibold leading-none text-blue-500 transition-colors duration-200 bg-transparent border border-blue-500 rounded hover:bg-blue-500 hover:text-white hover:border-transparent hover:shadow-md hover:ring-2 hover:ring-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-blue-200">Return to Dashboard</InertiaLink>  </div>
  </AuthenticatedLayout>
</template>

<style scoped>

</style>

