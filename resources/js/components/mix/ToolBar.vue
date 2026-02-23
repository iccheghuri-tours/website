<script setup lang="ts">
import { Icon } from '@iconify/vue';
import logo from '@/assets/images/logo.png'
import { router } from '@inertiajs/vue3';
const props = defineProps({
  appName: {
    type: String,
    default: 'Iccheghuri Tours'
  },
  isFullScreen: {
    type: Boolean,
    default: false
  },
  toggleFullScreen: {
    type: Function,
    required: true
  },
  closeFullScreen: {
    type: Function,
    required: true
  }
});

function goToProfile() {
  props.closeFullScreen();
  router.get('/settings/profile');
}
</script>

<template>
  <header
    class="top-4 w-full z-[100] flex justify-center"
  >
    <nav 
      class="w-full max-w-md flex items-center justify-between
             bg-white/90 backdrop-blur-md 
             border border-[#f39221]/20 rounded-2xl
             py-2.5 px-3
             shadow-lg
             transition-all duration-300 ease-out
             hover:border-[#f39221]/40"
    >
      <div class="flex items-center gap-3">
        <div class="relative flex items-center justify-center p-0.5 rounded-xl bg-gradient-to-br from-[#f39221]/20 to-transparent">
           <div class="w-9 h-9 overflow-hidden rounded-[10px] bg-[#fff9f0] flex items-center justify-center " @click="goToProfile">
            <Icon icon="mdi:account-circle" class="w-6 h-6 text-gray-700" />
          </div>
        </div>
        
        <div class="flex flex-col">
          <span class="text-[#231f20] text-sm font-bold tracking-tight leading-none">
            Travel Club Card
          </span>
          <span class="text-[10px] text-[#f39221] font-bold uppercase tracking-widest mt-1">
            by Iccheghuri Tours & Travels
          </span>
        </div>
      </div>

      <button 
        v-if="isFullScreen" 
        @click="closeFullScreen"
        class="group p-2.5 rounded-xl bg-[#fff9f0] border border-[#f39221]/10 hover:bg-[#f39221] active:scale-90 transition-all duration-200"
        aria-label="Exit Fullscreen"
      >
        <Icon icon="bi:arrows-angle-contract" class="text-[#231f20] group-hover:text-white w-5 h-5" />      
      </button>

      <button 
        v-else 
        @click="toggleFullScreen"
        class="group p-2.5 rounded-xl bg-[#fff9f0] border border-[#f39221]/10 hover:bg-[#f39221] active:scale-90 transition-all duration-200"
        aria-label="Enter Fullscreen"
      >
        <Icon icon="bi:arrows-angle-expand" class="text-[#231f20] group-hover:text-white w-5 h-5" />      
      </button>
    </nav>
  </header>
</template>