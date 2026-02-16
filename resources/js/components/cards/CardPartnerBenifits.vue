<script setup>
import {ref } from 'vue';
import Details from '@/pages/Details.vue';

defineProps({
  name: String,
  image: String,
  details: String,
  discount: String,
  location: String,
  facebook: String,
  phone: String,
})

const emit = defineEmits(['view-details']);


const isSheetOpen = ref(false);
const openSheet = ()=>{
    isSheetOpen.value = true;

}
const closeSheet = ()=>{
    isSheetOpen.value = false;

}
</script>


<template>
  <div 
    @click="openSheet()"
    class="group relative flex items-center gap-4 p-3 mb-3 rounded-2xl 
           bg-white dark:bg-zinc-900/50 border border-slate-200 dark:border-white/5 backdrop-blur-sm
           shadow-sm dark:shadow-none
           active:scale-[0.98] active:bg-slate-50 dark:active:bg-zinc-800/80 transition-all duration-200"
  >
    <div class="relative h-12 w-12 flex-shrink-0 overflow-hidden rounded-xl border border-slate-100 dark:border-white/10">
      <img 
        :src="image" 
        :alt="name"
        class="h-full w-full object-cover"
      />
    </div>

    <div class="flex-1 min-w-0">
      <h3 class="text-sm font-semibold text-slate-900 dark:text-white truncate">
        {{ name }}
      </h3>
      <p class="text-xs text-emerald-600 dark:text-green-400 font-medium line-clamp-1">
        {{ discount }}% OFF
      </p>
      <p class="text-[11px] text-slate-500 dark:text-zinc-400 line-clamp-1">
        {{ details }}
      </p>
    </div>

    <button 
      class="text-xs font-medium text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-500 transition-colors underline decoration-blue-600/30 dark:decoration-blue-400/30"
    >
      Details
    </button>

    <Details
      :show="isSheetOpen"
      :name="name"
      :discount-amount="discount"
      :image="image"
      :phone="phone"
      :facebook="facebook"
      :location="location"
      :details="details"
      @close="isSheetOpen = false"
    />
  </div>
</template>