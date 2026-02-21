<script setup>
import { Link } from '@inertiajs/vue3';
import AdminLayout from '../AdminLayout.vue';
const props = defineProps({ data: Array });
</script>

<template>
  <AdminLayout>
    <div class="flex items-start justify-between mb-6">
      <div>
        <h1 class="text-[25px] font-bold text-black">Admin/Offers</h1>
        <p class="text-black">Current Partners:</p>
      </div>

      <Link 
        href="/admin/offers/create" 
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow-sm transition-colors duration-200 font-semibold flex items-center gap-2"
      >
        <span class="text-xl leading-none">+</span>
        <span>Create New</span>
      </Link>
    </div>

    <div class="flex items-center justify-between px-4 mb-2 text-xs font-bold uppercase tracking-wider text-gray-500">
      <span class="flex-1">Offer Name</span>
      <span class="flex-1 text-right">Cost</span>
    </div>

    <div class="space-y-2">
      <Link 
        v-for="offer in data" 
        :key="offer.id" 
        :href="`/admin/offers/${offer.id}`"
        class="flex items-center justify-between p-4 bg-white border border-gray-400 hover:bg-blue-50/50 transition-colors duration-200 rounded"
      >
        <span class="flex-1 font-bold text-black tracking-tight">
          {{ offer.name }}
        </span>

        <span class="flex-1 text-right text-gray-600 font-mono text-xs sm:text-sm">
          {{ offer.points_required }} pts
        </span>
      </Link>
    </div>
  </AdminLayout>
</template>