<script setup>
import { ref } from 'vue';
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

const isSheetOpen = ref(false);

const openSheet = () => {
  isSheetOpen.value = true;
}
</script>

<template>
  <div 
    @click="openSheet()"
    class="group relative flex items-center gap-4 p-4 mb-3 bg-[#fff9f0] border-2 border-[#f39221] rounded-2xl 
           shadow-sm active:scale-[0.98] transition-all duration-200 cursor-pointer"
  >
    <div class="relative h-14 w-14 flex-shrink-0 overflow-hidden rounded-xl border border-[#f39221]/20 bg-white">
      <img 
        :src="image" 
        :alt="name"
        class="h-full w-full object-cover"
      />
    </div>

    <div class="flex-1 min-w-0">
      <h3 class="text-base font-bold text-[#231f20] font-bengali truncate">
        {{ name }}
      </h3>
      <div class="flex items-center gap-1.5">
        <span class="text-sm font-black text-[#f39221] font-mono">
          {{ discount }}% OFF
        </span>
      </div>
      <p class="text-xs text-[#231f20] opacity-70 line-clamp-1 leading-tight">
        {{ details }}
      </p>
    </div>

    <button 
      class="flex items-center justify-center px-3 py-2 bg-[#f39221] text-white text-xs font-bold rounded-lg 
             shadow-md hover:brightness-105 transition-all"
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

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@700&family=Hind+Siliguri:wght@600;700&display=swap');

.font-bengali {
  font-family: 'Hind Siliguri', sans-serif;
}
.font-mono {
  font-family: 'JetBrains Mono', monospace;
}
</style>