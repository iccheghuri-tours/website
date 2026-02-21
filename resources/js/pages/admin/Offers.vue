<script setup>
import { Link } from '@inertiajs/vue3';
import AdminLayout from '../AdminLayout.vue';
  const props = defineProps({data: Array});
  
</script>

<template>
  <AdminLayout>
    
  <h1 class="text-[25px] font-bold text-black">Admin/Offers</h1>
  <p class="text-black">Current Partners: </p>

  
  <Link v-for="offer in data" :key="offer.id" :href="`/admin/offers/${offer.id}`"
     class="flex items-center justify-between p-4 bg-white border border-gray-400 hover:bg-blue-50/50 transition-colors duration-200 mt-2 rounded">
  <span class="flex-1 font-bold text-black tracking-tight">
    {{ offer.name }}
  </span>

 

  <span class="flex-1 text-right text-gray-600 font-mono text-xs sm:text-sm">
    {{ offer.points_required }}
  </span>
  
</Link>
  </AdminLayout>
</template>

<style scoped>
</style>