<script setup>

import {computed} from 'vue';
import {InertiaLink} from "@inertiajs/inertia-vue3";
import {Head} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps({ poll: Object })

const totalVotes = computed(() => {
  return props.poll.options.reduce((total, option) => total + option.votes, 0);
});

const optionVotesPercentage = (option) => {
  return totalVotes.value > 0 ? (option.votes / totalVotes.value) * 100 : 0;
};

</script>

<template>
  <Head title="Results" />

  <AuthenticatedLayout>
  <div class="max-w-md mx-auto p-4 bg-white rounded-lg shadow-md">
    <h1 class="text-xl font-semibold mb-4">{{ poll.title }}</h1>
    <ul>
      <li v-for="option in poll.options" :key="option.id" class="flex flex-col mb-2">
        <div class="flex items-center mb-1">
          <span class="mr-2">{{ option.value }}</span>
          <span class="text-gray-500 ml-auto">{{ option.votes }} votes</span>
        </div>
        <div class="bg-gray-200 w-full">
          <template v-if="optionVotesPercentage(option) > 0">
            <div class="bg-blue-500 text-xs leading-none py-1 text-center text-black" :style="{ width: optionVotesPercentage(option) + '%' }">
              {{ option.votes }} votes ({{ optionVotesPercentage(option).toFixed(1) }}%)
            </div>
          </template>
          <template v-else>
            <div class="bg-gray-100 text-xs leading-none py-1 text-center text-black">
              {{ option.votes }} votes ({{ optionVotesPercentage(option).toFixed(1) }}%)
            </div>
          </template>
        </div>

      </li>
    </ul>
    <InertiaLink :href="route('polls.index')" class="text-blue-500 hover:text-blue-700 block mb-4">Back to all polls</InertiaLink>
    <InertiaLink :href="route('dashboard')" class="text-blue-500 hover:text-blue-700 block mb-4">Back to Dashboard</InertiaLink>
  </div>
  </AuthenticatedLayout>
</template>

<style scoped>

</style>