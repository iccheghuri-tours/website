<script setup>
import { Link } from '@inertiajs/vue3';
import AdminLayout from '../AdminLayout.vue';
const props = defineProps({ data: Array });
</script>

<template>
  <AdminLayout>
    <div class="flex items-start justify-between mb-6">
      <div>
        <h1 class="text-[25px] font-bold text-black">Admin/Partners</h1>
        <p class="text-black">Current Partners:</p>
      </div>

      <Link 
        href="/admin/partners/create" 
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow-sm transition-colors duration-200 font-semibold flex items-center gap-2"
      >
        <span class="text-xl leading-none">+</span>
        <span>Add Partner</span>
      </Link>
    </div>

    <div class="space-y-2">
      <Link 
        v-for="partner in data" 
        :key="partner.id" 
        :href="`/admin/partners/${partner.id}`"
        class="flex items-center justify-between p-4 bg-white border border-gray-400 hover:bg-blue-50/50 transition-colors duration-200 rounded"
      >
        <span class="flex-1 font-bold text-black tracking-tight">
          {{ partner.name }}
        </span>

        <span class="flex-1 text-gray-700 text-sm truncate px-4">
          {{ partner.discount_percentage }}% Discount
        </span>

        <span class="flex-1 text-right text-gray-600 font-mono text-xs sm:text-sm">
          {{ partner.phone }}
        </span>
      </Link>
    </div>
  </AdminLayout>
</template>

<style scoped>
</style>