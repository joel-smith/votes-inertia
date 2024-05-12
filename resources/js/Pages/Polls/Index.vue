<script setup>
import {Link} from '@inertiajs/inertia-vue3';

const props = defineProps({ polls: Object })
</script>

<template>
  <div class="max-w-md mx-auto p-4 bg-white rounded-lg shadow-md">
    <h1 class="text-xl font-semibold mb-4">All Polls</h1>
    <ul>
      <li v-for="poll in polls" :key="poll.id" class="flex items-center mb-2">
        <Link :href="route('polls.show', poll.id)" class="text-blue-500 hover:text-blue-700">{{ poll.title }}</Link>
      </li>
    </ul>
  </div>
</template>

<style scoped>

</style>

