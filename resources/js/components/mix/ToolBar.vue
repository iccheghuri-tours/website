<script setup>
import { Icon } from '@iconify/vue';
defineProps({
  appName: {
    type: String,
    default: 'Iccheghuri Tours'
  },
  // Adding a prop for the logo in case you want to swap it later
  logoUrl: {
    type: String,
    default: 'https://picsum.photos/seed/travel/64/64' 
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
  <header class="sticky top-4 w-full z-50 flex justify-center ">
    <nav 
      class="w-full max-w-md px-4 py-2 
             bg-neutral-950/60 backdrop-blur-xl 
             border border-white/10 rounded-full 
             shadow-[0_8px_32px_rgba(0,0,0,0.5)]
             flex items-center justify-between
             transition-all duration-300 hover:border-white/20"
    >
      <div class="flex items-center gap-3">
        <div class="relative w-10 h-10 overflow-hidden rounded-full border border-white/20">
          <img 
            :src="logoUrl" 
            alt="Logo" 
            class="w-full h-full object-cover"
          />
        </div>
        <span class="text-white font-semibold tracking-wide text-md">
          {{ appName }}
        </span>
      </div>

      <button  v-if="isFullScreen" class="p-2 rounded-full bg-white/5 hover:bg-white/10 text-white/70 transition-colors" @click="closeFullScreen">
        <Icon icon="bi:arrows-angle-contract"  />     
    </button>
    <button v-else class="p-2 rounded-full bg-white/5 hover:bg-white/10 text-white/70 transition-colors" @click="toggleFullScreen">
        <Icon icon="bi:arrows-angle-expand"/>     
    </button>
    </nav>
  </header>
</template>

<style scoped>
header {
  perspective: 1000px;
}

nav {
  /* Subtle glow effect */
  box-shadow: 0 0 15px -5px rgba(255, 255, 255, 0.1);
}

/* Smooth entry animation */
header {
  animation: slideDown 0.5s ease-out;
}

@keyframes slideDown {
  from { transform: translateY(-20px); opacity: 0; }
  to { transform: translateY(0); opacity: 1; }
}
</style>