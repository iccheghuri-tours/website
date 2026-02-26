<script setup>
import { Link } from '@inertiajs/vue3';
import AdminLayout from '../AdminLayout.vue';
import { ref, computed } from 'vue';
import { Icon } from '@iconify/vue';

const props = defineProps({ data: Array });

const search = ref('');
const filteredOffers = computed(() => {
  return props.data.filter(offer =>
    offer.name.toLowerCase().includes(search.value.trim().toLowerCase())
  )
});
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
    <div class="mb-4 relative w-full sm:w-80">
    <input
      v-model="search"
      type="text"
      placeholder="Search by name ..."
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
      <span class="flex-1">Offer Name</span>
      <span class="flex-1 text-right">Cost</span>
    </div>

    <div class="space-y-2">
      <Link 
        v-for="offer in filteredOffers" 
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