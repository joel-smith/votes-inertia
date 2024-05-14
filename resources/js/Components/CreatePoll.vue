<script setup>
import {useForm} from "@inertiajs/vue3";
import {ref} from "vue";

const createPollForm = useForm({
  title: '',
  options: [
    {value: '', errors: null},
    {value: '', errors: null},
    {value: '', errors: null},
    {value: '', errors: null},
  ]
});

const maxOptions = 4;
const minOptions = 2;

const showAddOptionButton = ref(true);
const showRemoveOptionButton = ref(false);

const addOption = () => {
  if (createPollForm.options.length < maxOptions) {
    createPollForm.options.push({value: '', errors: null});
  }
  if (createPollForm.options.length === maxOptions) {
    showAddOptionButton.value = false;
  }
  if (createPollForm.options.length >= minOptions) {
    showRemoveOptionButton.value = true;
  }
};

const removeOption = (index) => {
  if (createPollForm.options.length > minOptions) {
    createPollForm.options.splice(index, 1);
  }
  if (createPollForm.options.length === minOptions) {
    showRemoveOptionButton.value = false;
  }
  if (createPollForm.options.length < maxOptions) {
    showAddOptionButton.value = true;
  }
};

const updateOption = (index, value) => {
  createPollForm.options[index].value = value;
};

const createPoll = () => {
  console.log('title is ' + createPollForm.title);
  console.log('options is ' + JSON.stringify(createPollForm.options));
  createPollForm.post(route('polls.store'));
};
</script>

<template>
  <form @submit.prevent="createPoll" class="border flex flex-col space-y-4 p-4 rounded">
    <div class="text-xl">Add a Poll</div>

    <input v-model="createPollForm.title" class="block px-2 py-1.5 bg-gray-100 rounded w-full"
           placeholder="What is your question?" type="text"/>
    <small class="text-red-500 block" v-if="createPollForm.errors.title">{{ createPollForm.errors.title }}</small>

    <div v-for="(option, index) in createPollForm.options" :key="index">
      <div class="flex items-center space-x-2">
        <input v-model="option.value" class="block px-2 py-1.5 bg-gray-100 rounded w-full"
               :placeholder="'Option ' + (index + 1)" type="text"/>

        <!-- Render '+' button for the last input field -->
        <button type="button" @click="addOption" v-if="index === createPollForm.options.length - 1 && index < maxOptions - 1"
                class="px-6 py-1.5 bg-indigo-600 text-white rounded">+
        </button>

        <!-- Render '-' button for all inputs except the first two -->
        <button type="button" @click="removeOption(index)" class="px-6 py-1.5 bg-indigo-600 text-white rounded"
                v-if="index >= 2">-
        </button>

        <div v-for="(error, index) in createPollForm.errors.options" :key="index">
          <small class="text-red-500 block">{{ error }}</small>
        </div>

      </div>
    </div>


    <button type="submit" class="px-6 py-1.5 bg-indigo-600 text-white rounded ml-2"
            :disabled="createPollForm.processing">
      Add Poll
    </button>
  </form>
</template>



<style scoped>

</style>
