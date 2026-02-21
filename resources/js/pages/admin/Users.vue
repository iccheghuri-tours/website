<script setup>
import { Link } from '@inertiajs/vue3';
import AdminLayout from '../AdminLayout.vue';

const props = defineProps({ data: Array });
</script>

<template>
  <AdminLayout>
    <h1 class="text-[25px] font-bold text-black">Admin/Users</h1>
    <p class="text-black mb-6">Current Users:</p>
    
    <div class="flex items-center justify-between px-4 mb-2 text-xs font-bold uppercase tracking-wider text-gray-500">
      <span class="flex-1">Name</span>
      <span class="flex-1 px-4">Email Address</span>
      <span class="flex-1 text-right">Phone</span>
    </div>

    <div class="space-y-2">
      <Link 
        v-for="user in data" 
        :key="user.id"
        :href="`/admin/users/${user.id}`"
        :class="[
          'flex items-center justify-between p-4 border border-gray-400 transition-colors duration-200 rounded',
          user.role === 'admin' ? 'bg-red-900 text-white' : 'bg-white text-black hover:bg-blue-50/50'
        ]"
      >
        <span class="flex-1 font-bold tracking-tight">
          {{ user.role === 'admin' ? user.name + " (Admin)" : user.name }} 
        </span>

        <span :class="['flex-1 text-sm truncate px-4', user.role === 'admin' ? 'text-white' : 'text-gray-700']">
          {{ user.email }}
        </span>

        <span :class="['flex-1 text-right font-mono text-xs sm:text-sm', user.role === 'admin' ? 'text-white' : 'text-gray-600']">
          {{ user.phone }}
        </span>
      </Link>
    </div>
  </AdminLayout>
</template>