<script setup>
import { Link } from '@inertiajs/vue3';
import AdminLayout from '../AdminLayout.vue';

const props = defineProps({ data: Array });

</script>

<template>
  <AdminLayout>
    <div class="flex items-start justify-between mb-6">
      <div>
        <h1 class="text-[25px] font-bold text-black">Admin/Requests</h1>
        <p class="text-black">User Requests:</p>
      </div>
    </div>
    <div class="flex items-center justify-between px-4 mb-2 text-xs font-bold uppercase tracking-wider text-gray-500">
      <span class="flex-1">User</span>
      <span class="flex-1 px-4">Request</span>
      <span class="flex-1 text-right">Status</span>
    </div>
     <div class="space-y-2">
      <Link 
        v-for="request in data" 
        :key="request.id"
        :href="`/admin/custom-requests/${request.id}`"
        :class="[
            'flex items-center justify-between p-4 border border-gray-400 transition-colors duration-200 rounded',
            request.status === 'solved' ? 'bg-green-500 text-white' : 
            request.status === 'rejected' ? 'bg-red-500 text-white' : 'bg-yellow-200 text-black hover:bg-yellow-300'
        ]"
      >
        <span class="flex-1 font-bold tracking-tight">
          {{ request.user.email}} 
        </span>

        <span class="flex-1 text-sm truncate px-4">
          {{ request.request }}
        </span>

        <span class="flex-1 text-right font-mono text-xs sm:text-sm">
          {{ request.status }}
        </span>
      </Link>
    </div>
  </AdminLayout>
</template>

<style scoped>
</style>