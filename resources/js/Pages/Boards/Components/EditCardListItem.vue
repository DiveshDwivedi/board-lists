<script setup>
import { useForm } from "@inertiajs/vue3";
import { nextTick, ref } from "vue";

const props = defineProps({
  title: String,
  isShow: Boolean
});

const isShow = ref(false);
const inputTitleRef = ref();

async function showForm() {
  isShow.value = true;

  await nextTick();
  inputTitleRef.value.focus();
}

const form = useForm({
  title: props.title,
});

function submit() {
  form.post(route("cards.update", { card: card.id }), {
    onSuccess: () => {
      form.reset();
      isShow.value = false;
    },
  });
}
</script>
<template>
  <li
    class="group relative bg-white p-3 rounded-md border-b border-gray-300 hover:bg-gray-50"
  >
    <!-- Edit items -->
    <form @submit.prevent="submit()" v-if="isShow" @keydown.esc="isShow = false">
      <textarea
        v-model="form.title"
        ref="inputTitleRef"
        rows="3"
        class="block w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-400 focus:ring-blue-400"
        placeholder="Enter the card title..."
        @keydown.enter.prevent="submit()"
      >
      </textarea>
      <div class="mt-2 space-x-2">
        <button
          type="submit"
          class="px-4 py-2 text-sm font-medium text-white bg-rose-500 rounded-md shadow-sm focus:ring-2 focus:ring-offset-2 focus:ring-rose-500 focus:outline-none"
        >
          Add Card
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
  </li>
</template>
