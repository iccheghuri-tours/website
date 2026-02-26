<script setup>
import { Link } from '@inertiajs/vue3';
import AdminLayout from '../AdminLayout.vue';
import { Icon } from '@iconify/vue';
import { computed, ref } from 'vue';

const props = defineProps({ data: Array });
const search = ref('');
const filteredRequests = computed(() => {
  return props.data.filter(request =>
    request.status.toLowerCase().includes(search.value.trim().toLowerCase()) ||
    request.user.email.toLowerCase().includes(search.value.trim().toLowerCase())
  )
});
</script>

<template>
  <AdminLayout>
    <div class="flex items-start justify-between mb-6">
      <div>
        <h1 class="text-[25px] font-bold text-black">Admin/Requests</h1>
        <p class="text-black">User Requests:</p>
      </div>
    </div>
    <div class="mb-4 relative w-full sm:w-80">
    <input
      v-model="search"
      type="text"
      placeholder="Search by email or status ..."
      class="w-full border border-gray-400 rounded px-3 py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-blue-500"
    />
    
    <button
      v-if="search"
      @click="search = ''"
      type="button"
      class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-400 hover:text-gray-600 active:scale-90 transition-transform"
    >
      <Icon icon="heroicons:x-mark-20-solid" class="w-5 h-5" />
    </button>
  </div>
    <div class="flex items-center justify-between px-4 mb-2 text-xs font-bold uppercase tracking-wider text-gray-500">
      <span class="flex-1">User</span>
      <span class="flex-1 px-4">Request</span>
      <span class="flex-1 text-right">Status</span>
    </div>
     <div class="space-y-2">
      <Link 
        v-for="request in filteredRequests" 
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