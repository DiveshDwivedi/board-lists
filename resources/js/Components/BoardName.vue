<script setup>
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref, watch } from 'vue';

const props = defineProps({
  board: Object,
});

const form = useForm({
  name: props.board.name,
});
const input = ref();
const isEditing = ref(false);

async function edit() {
  await nextTick();
  isEditing.value = true;
  input.value.select();
}

const submit = () => {
  isEditing.value = false;

  form.put(route('update', {board: props.board.id}, {
    onerror: () => form.reset()
  }));
};

</script>
<template>
  <div class="flex relative flex-col items-start max-w-full">
    <h1 
    @click="edit()"
    class="hover:bg-white/20 whitespace-pre w-full overflow-hidden text-ellipsis cursor-pointer rounded-md border border-transparent px-3 py-1.5 text-xl font-bold text-white"
    :class="isEditing ? 'invisible' : ''"
    >
    {{ form.name ? form.name : " " }}
    </h1>
    <form class="w-full" @submit.prevent="submit()" @focusout="submit()" v-show="isEditing">
      <input 
      ref="input"
      type="text"
       placeholder="Board name"
       class="text-xl absolute inset-0 max-w-full font-bold placeholder:gray-400 px-3 py-1.5 rounded-md focus:ring-2 focus:ring-blue-900"
       v-model="form.name"
       >
    </form>
  </div>
</template>
