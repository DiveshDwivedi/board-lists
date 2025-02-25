<script setup>
import { store } from "@/store";
import { useForm } from "@inertiajs/vue3";
import { computed, nextTick, ref } from "vue";

const emit = defineEmits('created');
const props = defineProps({
  list: Object,
});

const isShow = computed(() => props.list.id === store.value.listCreatingCardId);
const inputTitleRef = ref();

async function showForm() {
  store.value.listCreatingCardId = props.list.id;

  await nextTick();
  inputTitleRef.value.focus();
}

const form = useForm({
  title: "",
  card_list_id: props.list.id,
  board_id: props.list.board_id,
});

function submit() {
  form.post(route("cards.store"), {
    onSuccess: () => {
      form.reset();
      emit('created');
    },
  });
}
</script>

<template>
  <form 
    @submit.prevent="submit()"
    v-if="isShow"
    @keydown.esc="store.listCreatingCardId = null"
    >

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
        @click="store.listCreatingCardId = null"
        class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-black rounded-md focus:ring-2 focus:ring-rose-500 focus:outline-none"
      >
        Cancel
      </button>
    </div>
  </form>

  <button
    v-if="!isShow"
    @click="showForm()"
    type="button"
    class="flex items-center text-sm font-medium text-gray-600 hover:text-black hover:bg-gray-300 p-1 rounded-md w-full"
  >
    <span class="font-bold mr-1">+ </span>Add Cards
  </button>
</template>
