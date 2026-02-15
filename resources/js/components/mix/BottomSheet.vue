<template>
  <Teleport to="body">
    <Transition name="alert-zoom">
      <div 
        v-if="show && !isSheetVisible" 
        class="fixed inset-0 z-[70] flex items-center justify-center p-6"
      >
        <div class="absolute inset-0 bg-black/80 backdrop-blur-md"></div>
        
        <div class="relative flex flex-col items-center text-center">
          <div class="relative mb-6">
            <div class="absolute inset-0 bg-amber-500/20 blur-3xl rounded-full animate-pulse"></div>
            <div class="relative w-24 h-24 bg-gradient-to-tr from-zinc-800 to-zinc-700 border border-zinc-600 rounded-full flex items-center justify-center shadow-2xl">
              <span class="text-5xl drop-shadow-lg">✨</span>
            </div>
          </div>
          
          <h2 class="text-zinc-500 text-sm font-black uppercase tracking-[0.3em] mb-2 animate-in fade-in slide-in-from-bottom-2">
            Congratulations!  
          </h2>
          <h1 class="text-white text-4xl font-black tracking-tight drop-shadow-sm">
            {{name}}
          </h1>
          <div class="mt-4 h-1 w-12 bg-amber-500 rounded-full"></div>
        </div>
      </div>
    </Transition>

    <Transition name="sheet-fade">
      <div v-if="show && isSheetVisible" class="fixed inset-0 z-50 flex items-end justify-center sm:p-4">
        <div 
          class="absolute inset-0 bg-black/40 backdrop-blur-[2px]"
          @click="handleClose"
        ></div>

        <Transition name="sheet-slide" appear>
          <div 
            class="relative w-full max-w-lg bg-zinc-900 border border-zinc-800 rounded-t-[2.5rem] sm:rounded-[3rem] shadow-2xl overflow-hidden"
          >
            <div class="flex justify-center pt-5">
              <div class="w-10 h-1.5 bg-zinc-800 rounded-full"></div>
            </div>

            <div class="px-8 pb-10 pt-4 overflow-y-auto max-h-[85vh]">
              <div class="mb-8">
                <slot></slot>
              </div>
              
              <button 
                class="w-full py-4 bg-white hover:bg-zinc-200 text-black font-bold rounded-[1.5rem] transition-all active:scale-[0.97] shadow-lg shadow-white/5"
                @click="handleClose"
              >
                Understand
              </button>
            </div>
          </div>
        </Transition>
      </div>
    </Transition>
  </Teleport>
</template>

<script setup>
import { ref, watch } from 'vue';

const props = defineProps({
  name: String,
  show: { type: Boolean, required: true }
});

const emit = defineEmits(['close']);

const isSheetVisible = ref(false);

watch(() => props.show, (newVal) => {
  if (newVal) {
    // Show Alert first, then wait to show sheet
    isSheetVisible.value = false;
    
    setTimeout(() => {
      isSheetVisible.value = true;
    }, 2000); // Duration of the alert before sheet appears
  } else {
    isSheetVisible.value = false;
  }
});

const handleClose = () => {
  isSheetVisible.value = false;
  emit('close');
};
</script>

<style scoped>
/* Alert Animation (Zoom & Fade) */
.alert-zoom-enter-active {
  transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
.alert-zoom-leave-active {
  transition: all 0.4s cubic-bezier(0.4, 0, 1, 1);
}
.alert-zoom-enter-from {
  opacity: 0;
  transform: scale(0.5);
}
.alert-zoom-leave-to {
  opacity: 0;
  transform: scale(1.1);
  filter: blur(10px);
}

/* Original Sheet Transitions */
.sheet-fade-enter-active,
.sheet-fade-leave-active {
  transition: opacity 0.4s ease;
}
.sheet-fade-enter-from,
.sheet-fade-leave-to {
  opacity: 0;
}

.sheet-slide-enter-active {
  transition: all 0.6s cubic-bezier(0.32, 0.72, 0, 1);
}
.sheet-slide-leave-active {
  transition: all 0.3s ease;
}
.sheet-slide-enter-from,
.sheet-slide-leave-to {
  transform: translateY(100%);
}
</style>