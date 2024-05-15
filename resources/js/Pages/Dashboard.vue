<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import {InertiaLink} from "@inertiajs/inertia-vue3";
import CreatePoll from "@/Components/CreatePoll.vue";

defineProps(['userPolls']);
</script>

<template>
  <Head title="Dashboard"/>

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </template>

    <div class="py-6">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


        <div  class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div v-if="userPolls.length === 0" class="flex justify-center items-center h-2 p-6">You have created no polls, create one below now!</div>
          <div v-if="userPolls.length !== 0" class="flex justify-center items-center h-2 p-6">Your created polls</div>
          <div v-for="poll in userPolls" :key="poll.id" class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <InertiaLink :href="route('polls.show', poll.id)" class="p-6 text-blue-500 hover:text-blue-700">{{ poll.title }}</InertiaLink>
          </div>

          <CreatePoll />
        </div>



      </div>
    </div>

    <div class="py-6">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <InertiaLink :href="route('polls.index')" class="p-6 text-blue-500 hover:text-blue-700">See all the polls
          </InertiaLink>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
