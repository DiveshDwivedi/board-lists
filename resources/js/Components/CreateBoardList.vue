<script setup>
import { useForm } from "@inertiajs/vue3";
import { nextTick, ref } from "vue";

defineProps({
  board: Object,
});

const isShow = ref(false);
const inputFocus = ref();

async function onClick() {
    isShow.value = true;

    await nextTick();
    inputFocus.value.focus();
}

const form = useForm({
    name: '',
});

function submit() {
    form.post(route('boardLists', {board: board.id}))
}

</script>

<template>
  <form @submit.prevent="submit()" v-if="isShow" class="p-3 bg-gray-200 rounded-md">
    <input
      v-model="form.name"
      ref="inputFocus"
      class="block w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-400 focus:ring-blue-400"
      type="text"
      placeholder="Enter the list..."
    />
    <div class="mt-2 space-x-2">
      <button
        type="submit"
        class="px-4 py-2 text-sm font-medium text-white bg-rose-500 rounded-md shadow-sm focus:ring-2 focus:ring-offset-2 focus:ring-rose-500 focus:outline-none"
      >
        Add list
      </button>
      <button
        type="button"
        @click="isShow = false"
        class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-black rounded-md focus:ring-2 focus:ring-rose-500 focus:outline-none"
      >
        Cancel
      </button>
    </div>
  </form>
  <button
    v-if="!isShow"
    @click="onClick()"
    type="button"
    class="flex items-center text-sm font-medium bg-white/10 p-1 text-white hover:bg-white/20 rounded-md w-full"
  >
    <span class="font-bold mr-1">+ </span>Add another list
  </button>
</template>
