<script setup>
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import CreateCardListItem from "./CreateCardListItem.vue";
import { ref } from "vue";
import CardListItem from "./CardListItem.vue";

defineProps({
  list: Object,
});
const listRef = ref();

function cardCreated() {
  listRef.value.scrollTop = listRef.value.scrollHeight;
}
</script>
<template>
  <div class="w-72 bg-gray-200 max-h-full flex flex-col rounded-md">
    <div class="flex items-center justify-between px-3 py-2">
      <h3 class="text-sm font-semibold text-gray-700">{{ list.name }}</h3>

      <Menu as="div" class="relative z-10">
        <MenuButton
          class="hover:bg-gray-300 w-8 h-8 rounded-md grid place-content-center font-bold text-2xl"
        >
          ...
        </MenuButton>

        <transition
          enter-active-class="transition transform duration-100 ease-out"
          enter-from-class="opacity-0 scale-90"
          enter-to-class="opacity-100 scale-100"
          leave-active-class="transition transform duration-100 ease-in"
          leave-from-class="opacity-100 scale-100"
          leave-to-class="opacity-0 scale-90"
        >
          <MenuItems
            class="origin-top-left mt-2 focus:outline-none absolute left-0 bg-white overflow-hidden rounded-md shadow-lg border w-32"
          >
            <MenuItem v-slot="{ active }">
              <a
                href="#"
                :class="{ 'bg-gray-100': active }"
                class="block px-4 py-2 text-sm text-gray-700"
                >Add Cart</a
              >
            </MenuItem>

            <MenuItem v-slot="{ active }">
              <a
                href="#"
                :class="{ 'bg-gray-100': active }"
                class="block px-4 py-2 text-sm text-red-700"
                >Delete</a
              >
            </MenuItem>
          </MenuItems>
        </transition>
      </Menu>
    </div>

    <div class="px-3 pb-3 flex flex-col overflow-hidden">
      <div class="px-3 overflow-y-auto" ref="listRef">
        <ul class="space-y-3">
          <CardListItem v-for="card in list.cards" :key="card.id" :card="card" />
        </ul>
      </div>
      <div class="px-3 mt-2">
        <CreateCardListItem @created="cardCreated()" :list="list" />
      </div>
    </div>
  </div>
</template>
