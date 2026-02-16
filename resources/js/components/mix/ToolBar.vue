<script setup>
import { Icon } from '@iconify/vue';
import logo from '@/assets/images/logo.png'

defineProps({
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
</script>

<template>
  <header
    class="top-4 w-full z-[100] flex justify-center "
  >
    <nav 
      class="w-full max-w-md flex items-center justify-between
             bg-neutral-900/70 backdrop-blur-md 
             border border-white/10 rounded-2xl
             py-2.5 px-3
             shadow-[0_0_0_1px_rgba(255,255,255,0.05),0_10px_30px_-10px_rgba(0,0,0,0.5)]
             transition-all duration-300 ease-out
             hover:border-white/20 hover:bg-neutral-900/80"
    >
      <div class="flex items-center gap-3">
        <div class="relative flex items-center justify-center p-0.5 rounded-xl bg-gradient-to-br from-white/20 to-transparent">
          <div class="w-9 h-9 overflow-hidden rounded-[10px] bg-neutral-800">
            <img 
              :src="logo" 
              alt="Logo" 
              class="w-full h-full object-cover"
            />
          </div>
        </div>
        
        <div class="flex flex-col">
          <span class="text-white text-sm font-bold tracking-tight leading-none">
            {{ appName }}
          </span>
          <span class="text-[10px] text-white/40 font-medium uppercase tracking-widest mt-1">
            Premium Travel
          </span>
        </div>
      </div>

      <button 
        v-if="isFullScreen" 
        @click="closeFullScreen"
        class="group p-2.5 rounded-xl bg-white/5 border border-white/5 hover:bg-white/10 active:scale-90 transition-all duration-200"
        aria-label="Exit Fullscreen"
      >
        <Icon icon="bi:arrows-angle-contract" class="text-white/70 group-hover:text-white w-5 h-5" />      
      </button>

      <button 
        v-else 
        @click="toggleFullScreen"
        class="group p-2.5 rounded-xl bg-white/5 border border-white/5 hover:bg-white/10 active:scale-90 transition-all duration-200"
        aria-label="Enter Fullscreen"
      >
        <Icon icon="bi:arrows-angle-expand" class="text-white/70 group-hover:text-white w-5 h-5" />      
      </button>
    </nav>
  </header>
</template>
