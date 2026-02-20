<script setup lang="ts">
import { Link } from '@inertiajs/vue3';


</script>

<template>
  <div class="flex min-h-screen bg-gray-50">
    <aside class="w-64 bg-slate-900 text-white p-6 hidden md:block">
      <div class="text-xl font-bold mb-10 px-2">Admin Panel</div>
      <nav class="space-y-2">
        <Link href="/admin" class="block p-3 rounded hover:bg-blue-200 hover:text-black">Dashboard</Link>
        <Link href="/admin/users" class="block p-3 rounded hover:bg-blue-200 hover:text-black">Users</Link>
        <Link href="/admin/partners" class="block p-3 rounded hover:bg-blue-200 hover:text-black">Loyalty Partners</Link>
        <Link href="/admin/offers" class="block p-3 rounded hover:bg-blue-200 hover:text-black">Point Offers</Link>
      </nav>
    </aside>

    <main class="flex-1 p-4">
      <slot />
    </main>
  </div>
</template>