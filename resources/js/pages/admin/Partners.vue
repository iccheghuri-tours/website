<script setup>
import { Link } from '@inertiajs/vue3';
import AdminLayout from '../AdminLayout.vue';

  const props = defineProps({data: Array});

</script>

<template>
  <AdminLayout>
  <h1 class="text-[25px] font-bold text-black">Admin/Partners</h1>
  <p class="text-black">Current Partners: </p>
  <Link v-for="partner in data" :key="partner.id" :href="`/admin/partners/${partner.id}`"
     class="flex items-center justify-between p-4 bg-white border border-gray-400 hover:bg-blue-50/50 transition-colors duration-200 mt-2 rounded">
  <span class="flex-1 font-bold text-black tracking-tight">
    {{ partner.name }}
  </span>

  <span class="flex-1 text-gray-700 text-sm truncate px-4">
    {{ partner.discount_percentage }}
  </span>

  <span class="flex-1 text-right text-gray-600 font-mono text-xs sm:text-sm">
    {{ partner.phone }}
  </span>
  
</Link>
  </AdminLayout>
</template>

<style scoped>
</style>