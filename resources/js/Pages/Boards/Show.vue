<script setup>
import BoardName from "@/Pages/Boards/Components/BoardName.vue";
import CreateBoardList from "@/Pages/Boards/Components/CreateCardList.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ViewCardList from "./Components/ViewCardList.vue";

const props = defineProps({
  board: Object,
});
</script>
<template>
  <Head title="Board" />
  <AuthenticatedLayout>
  
    <div class="flex flex-col h-full bg-blue-600">
      <div class="shrink-0 flex flex-wrap justify-between items-center p-4">
        <BoardName :board="props.board"/>
        
        <div>
          <button
            class="bg-white/10 hover:bg-white/20 px-3 py-2 font-medium text-white text-sm rounded-md"
            type="button"
          >
            Settings
          </button>
        </div>
      </div>

      <!-- Scroll Menu Bar -->
      <div class="flex overflow-x-auto">
        <div class="inline-flex space-x-3 h-full items-start px-4 pb-4">
          <ViewCardList
            v-for="list in board.lists"
            :key="list.id"
            :list="list"
            class="w-72 bg-gray-200 max-h-full flex flex-col rounded-md"
          >
          </ViewCardList>
        </div>
        <div class="w-72">
          <CreateBoardList :board="board"/>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
