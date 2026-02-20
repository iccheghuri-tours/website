<script setup lang="ts">
import { Link } from '@inertiajs/vue3';


</script>

<template>
  <div class="flex flex-col md:flex-row min-h-screen bg-gray-50">
    <aside class="w-full md:w-64 bg-slate-900 text-white p-4 md:p-6 md:block">
      <div class="text-xl font-bold mb-4 md:mb-10 px-2 text-center md:text-left">Admin Panel</div>
      
      <nav class="flex flex-row md:flex-col overflow-x-auto md:overflow-visible space-x-2 md:space-x-0 md:space-y-2 whitespace-nowrap">
        <Link href="/admin" class="flex-1 md:block p-3 rounded hover:bg-blue-200 hover:text-black transition-colors">Dashboard</Link>
        <Link href="/admin/users" class="flex-1 md:block p-3 rounded hover:bg-blue-200 hover:text-black transition-colors">Users</Link>
        <Link href="/admin/partners" class="flex-1 md:block p-3 rounded hover:bg-blue-200 hover:text-black transition-colors">Loyalty Partners</Link>
        <Link href="/admin/offers" class="flex-1 md:block p-3 rounded hover:bg-blue-200 hover:text-black transition-colors">Point Offers</Link>
      </nav>
    </aside>

    <main class="flex-1 p-4">
      <slot />
    </main>
  </div>
</template>