<script setup>
import { useForm } from "@inertiajs/vue3";
import { computed, nextTick, ref } from "vue";
import { store } from "@/store";

const props = defineProps({
  card: Object,
});

const isShow = computed(() => props.card.id === store.value.editingCardId);

const inputTitleRef = ref();

async function showForm() {
  store.value.editingCardId = props.card.id;

  await nextTick();
  inputTitleRef.value.focus();
}

const form = useForm({
  title: props.card.title,
});

function submit() {
  form.put(route("cards.update", { card: props.card.id }), {
    onSuccess: () => {
      store.value.editingCardId = null;
    },
  });
}
</script>
<template>
  <li>
    <div
      class="group relative bg-white p-2 rounded-md border-b border-gray-300 hover:bg-gray-50"
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
            @click="store.editingCardId = null"
            class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-black rounded-md focus:ring-2 focus:ring-rose-500 focus:outline-none"
          >
            Cancel
          </button>
        </div>
      </form>

      <template v-if="!isShow">
        <a href="#">{{ card.title }}</a>
        <button
          v-if="!isShow"
          @click="showForm()"
          type="button"
          class="hidden absolute top-1 right-1 w-8 h-8 font-bold bg-gray-50 group-hover:grid place-content-center rounded-md text-gray-600 hover:text-black hover:bg-gray-200"
        >
          ✎
        </button>
      </template>
    </div>
  </li>
</template>

<style scoped>
.drag > div {
  transform: rotate(5deg);
}
.ghost {
  background: lightgray;
  border-radius: 6px;
}

.ghost > div {
  visibility: hidden;
}
</style>
