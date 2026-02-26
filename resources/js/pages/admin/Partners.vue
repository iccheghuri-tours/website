<script setup>
import { Link } from '@inertiajs/vue3';
import AdminLayout from '../AdminLayout.vue';
import { computed, ref } from 'vue';
import { Icon } from '@iconify/vue';
const props = defineProps({ data: Array });

const search = ref('');
const filteredPartners = computed(() => {
  return props.data.filter(partner =>
    partner.name.toLowerCase().includes(search.value.trim().toLowerCase()) ||
    partner.phone.toLowerCase().includes(search.value.trim().toLowerCase())
  )
});
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
    <div class="mb-4 relative w-full sm:w-80">
    <input
      v-model="search"
      type="text"
      placeholder="Search by name or phone..."
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
      <span class="flex-1">Name</span>
      <span class="flex-1 px-4">Discount</span>
      <span class="flex-1 text-right">Phone</span>
    </div>

    <div class="space-y-2">
      <Link 
        v-for="partner in filteredPartners" 
        :key="partner.id" 
        :href="`/admin/partners/${partner.id}`"
        class="flex items-center justify-between p-4 bg-white border border-gray-400 hover:bg-blue-50/50 transition-colors duration-200 rounded"
      >
        <span class="flex-1 font-bold text-black tracking-tight">
          {{ partner.name }}
        </span>

        <span class="flex-1 text-gray-700 text-sm truncate px-4">
          {{ partner.discount_percentage }}%
        </span>

        <span class="flex-1 text-right text-gray-600 font-mono text-xs sm:text-sm">
          {{ partner.phone }}
        </span>
      </Link>
    </div>
  </AdminLayout>
</template>