<script setup>
import { Link } from '@inertiajs/vue3';
import AdminLayout from '../AdminLayout.vue';

const props = defineProps({ data: Array });
</script>

<template>
  <AdminLayout>
    <h1 class="text-[25px] font-bold text-black">Admin/Users</h1>
    <p class="text-black">Current Users: </p>
    
    <Link 
      v-for="user in data" 
      :key="user.id"
      :href="`/admin/users/${user.id}`"
      class="flex items-center justify-between p-4 bg-white border border-gray-400 hover:bg-blue-50/50 transition-colors duration-200 mt-2 rounded block"
    >
      <span class="flex-1 font-bold text-black tracking-tight">
        {{ user.name }}
      </span>

      <span class="flex-1 text-gray-700 text-sm truncate px-4">
        {{ user.email }}
      </span>

      <span class="flex-1 text-right text-gray-600 font-mono text-xs sm:text-sm">
        {{ user.phone }}
      </span>
    </Link>
  </AdminLayout>
</template>