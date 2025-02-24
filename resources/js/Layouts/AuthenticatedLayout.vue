<script setup>
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";

import { Link } from "@inertiajs/vue3";

</script>

<template>
  <div>
    <div class="flex flex-col h-screen">
  
    <nav class="shrink-0 flex justify-between bg-white px-4 py-3 border-b">
      <a class="text-2xl font-black tracking-tight" :href="route('boards')">Kanban</a>
      <div class="flex items-center">
        <NavLink class="text-sm font-medium px-3 py-2 rounded-md hover:bg-gray-100" href="#"
          >My Board</NavLink
        >
        <Menu as="div" class="ml-3 relative z-10">
          <MenuButton
            class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-400 rounded-full"
          >
            <img class="h-9 w-9 inline rounded-full" src="https://shorturl.at/dKHWn" />
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
              class="origin-top-right mt-2 focus:outline-none absolute right-0 bg-white overflow-hidden rounded-md shadow-lg border w-32"
            >
              <MenuItem v-slot="{ active }">
                <a
                  :href="route('profile.edit')"
                  :class="{ 'bg-gray-100': active }"
                  class="block px-4 py-2 text-sm text-gray-700"
                  >Profile</a
                >
              </MenuItem>

              <MenuItem v-slot="{ active }">
                <Link 
                 type="button"
                  :href="route('logout')" 
                  method="post"
                  :class="{ 'bg-gray-100': active }"
                  class="block px-4 py-2 text-sm text-red-700 w-full text-left"
                  >Logout</Link
                >
              </MenuItem>
            </MenuItems>
          </transition>
        </Menu>
      </div>
    </nav>

      <!-- Page Content -->
      <main class="flex-1 overflow-hidden">
        <slot />
      </main>
    </div>
  </div>
</template>
