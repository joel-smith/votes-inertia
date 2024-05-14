<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import {InertiaLink} from "@inertiajs/inertia-vue3";
import CreatePoll from "@/Components/CreatePoll.vue";
</script>

<template>
  <Head title="Dashboard"/>

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </template>

    <div class="py-6">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <CreatePoll/>
        </div>
      </div>
    </div>

    <div class="py-6">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <InertiaLink :href="route('polls.index')" class="p-6 text-blue-500 hover:text-blue-700">See the polls
          </InertiaLink>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
