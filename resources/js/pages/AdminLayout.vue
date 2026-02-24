<script setup lang="ts">
import { Link } from '@inertiajs/vue3';


</script>

<template>
  <div class="flex flex-col md:flex-row min-h-screen bg-gray-50">
    <aside class="w-full md:w-64 bg-slate-900 text-white p-4 md:p-6 md:block">
      <Link 
        href="/" 
        class="flex items-center justify-center md:justify-start mb-4 md:mb-10 px-2 space-x-3 group transition-colors"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-400 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>
        
        <span class="text-xl font-bold group-hover:text-blue-400 transition-colors">
          Admin Panel
        </span>
      </Link>
      
      <nav class="flex flex-row md:flex-col overflow-x-auto md:overflow-visible space-x-2 md:space-x-0 md:space-y-2 whitespace-nowrap">
        <Link href="/admin" class="flex-1 md:block p-3 rounded hover:bg-blue-200 hover:text-black transition-colors">Dashboard</Link>
        <Link href="/admin/users" class="flex-1 md:block p-3 rounded hover:bg-blue-200 hover:text-black transition-colors">Users</Link>
        <Link href="/admin/partners" class="flex-1 md:block p-3 rounded hover:bg-blue-200 hover:text-black transition-colors">Loyalty Partners</Link>
        <Link href="/admin/offers" class="flex-1 md:block p-3 rounded hover:bg-blue-200 hover:text-black transition-colors">Point Offers</Link>
        <Link href="/admin/mail" class="flex-1 md:block p-3 rounded hover:bg-blue-200 hover:text-black transition-colors">Email</Link>
      </nav>
    </aside>

    <main class="flex-1 p-4">
      <slot />
    </main>
  </div>
</template>