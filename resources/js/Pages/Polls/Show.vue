<script setup>

import {ref} from "vue";
import axios from "axios";

const props = defineProps({ poll: Object })

const selectedOption = ref(null);
const vote = async () => {
  console.log('voting for selectedOption.value', selectedOption.value);
  console.log('poll.id', props.poll.id);
  await axios.post(route('polls.vote', {poll: props.poll.id, option: selectedOption.value}), {option: selectedOption.value});
};
</script>

<template>
  <div class="max-w-md mx-auto p-4 bg-white rounded-lg shadow-md">
    <h1 class="text-xl font-semibold mb-4">{{ poll.title }}</h1>
    <ul>
      <li v-for="option in poll.options" :key="option.id" class="flex items-center mb-2">
        <label :for="'option_' + option.id" class="cursor-pointer flex items-center">
          <input type="radio" :id="'option_' + option.id" v-model="selectedOption" name="pollOption" :value="option.id" class="mr-2">
          <span class="text-base">{{ option.title }}</span>
        </label>
      </li>
    </ul>
    <button @click="vote" :disabled="!selectedOption" class="block w-full py-2 px-4 mt-4 bg-blue-500 text-white font-semibold rounded-md shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Vote</button>
    <small v-if="!selectedOption" class="block text-red-500 mt-2">Please select an option</small>
  </div>
</template>

<style scoped>

</style>

