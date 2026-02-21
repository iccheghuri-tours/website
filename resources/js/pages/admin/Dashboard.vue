<script setup>
import AdminLayout from '../AdminLayout.vue';

const props = defineProps({
  userCount: { type: Number, default: 0 },
  offerCount: { type: Number, default: 0 },
  partnerCount: { type: Number, default: 0 }
});
</script>

<template>
  <AdminLayout>
    <div class="flex flex-col items-start space-y-6">
      <h1 class="text-[25px] font-bold text-black uppercase tracking-tight">Admin/DashBoard</h1>

      <div class="flex flex-wrap gap-4 w-full">
        <div class="bg-white border border-gray-200 p-5 rounded-lg shadow-sm min-w-[180px]">
          <p class="text-sm text-gray-500 font-medium">Total Users</p>
          <p class="text-3xl font-bold text-blue-600">{{ userCount }}</p>
        </div>

        <div class="bg-white border border-gray-200 p-5 rounded-lg shadow-sm min-w-[180px]">
          <p class="text-sm text-gray-500 font-medium">Active Offers</p>
          <p class="text-3xl font-bold text-green-600">{{ offerCount }}</p>
        </div>

        <div class="bg-white border border-gray-200 p-5 rounded-lg shadow-sm min-w-[180px]">
          <p class="text-sm text-gray-500 font-medium">Total Partners</p>
          <p class="text-3xl font-bold text-purple-600">{{ partnerCount }}</p>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<style scoped>
/* Scoped styles kept minimal as Tailwind handles the alignment */
</style>