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
    class="top-4 w-full z-[100] flex justify-center"
  >
    <nav 
      class="w-full max-w-md flex items-center justify-between
             bg-white/80 dark:bg-neutral-900/70 backdrop-blur-md 
             border border-slate-200 dark:border-white/10 rounded-2xl
             py-2.5 px-3
             shadow-lg dark:shadow-[0_0_0_1px_rgba(255,255,255,0.05),0_10px_30px_-10px_rgba(0,0,0,0.5)]
             transition-all duration-300 ease-out
             hover:border-slate-300 dark:hover:border-white/20 hover:bg-white/90 dark:hover:bg-neutral-900/80"
    >
      <div class="flex items-center gap-3">
        <div class="relative flex items-center justify-center p-0.5 rounded-xl bg-gradient-to-br from-slate-200 to-transparent dark:from-white/20 dark:to-transparent">
          <div class="w-9 h-9 overflow-hidden rounded-[10px] bg-slate-100 dark:bg-neutral-800">
            <img 
              :src="logo" 
              alt="Logo" 
              class="w-full h-full object-cover"
            />
          </div>
        </div>
        
        <div class="flex flex-col">
          <span class="text-slate-900 dark:text-white text-sm font-bold tracking-tight leading-none">
            {{ appName }}
          </span>
          <span class="text-[10px] text-slate-500 dark:text-white/40 font-medium uppercase tracking-widest mt-1">
            Premium Travel
          </span>
        </div>
      </div>

      <button 
        v-if="isFullScreen" 
        @click="closeFullScreen"
        class="group p-2.5 rounded-xl bg-slate-100 dark:bg-white/5 border border-slate-200 dark:border-white/5 hover:bg-slate-200 dark:hover:bg-white/10 active:scale-90 transition-all duration-200"
        aria-label="Exit Fullscreen"
      >
        <Icon icon="bi:arrows-angle-contract" class="text-slate-600 dark:text-white/70 group-hover:text-slate-900 dark:group-hover:text-white w-5 h-5" />      
      </button>

      <button 
        v-else 
        @click="toggleFullScreen"
        class="group p-2.5 rounded-xl bg-slate-100 dark:bg-white/5 border border-slate-200 dark:border-white/5 hover:bg-slate-200 dark:hover:bg-white/10 active:scale-90 transition-all duration-200"
        aria-label="Enter Fullscreen"
      >
        <Icon icon="bi:arrows-angle-expand" class="text-slate-600 dark:text-white/70 group-hover:text-slate-900 dark:group-hover:text-white w-5 h-5" />      
      </button>
    </nav>
  </header>
</template>