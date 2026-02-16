<script setup>
defineProps({
  user: {
    type: Object, // Corrected to Object as you access user.slug and user.id
    required: true
  }
});

// Using a public API for the QR code generation
const qrCodeSrc = (url) => `https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=${encodeURIComponent(url)}`;
</script>

<template>
  <div class=" w-full mx-auto">
    <div class="relative h-56 overflow-hidden bg-slate-50 dark:bg-gradient-to-tr dark:from-slate-800 dark:to-slate-900 rounded-3xl p-8 shadow-xl dark:shadow-2xl border border-slate-200 dark:border-white/10 flex items-center justify-between">
      
      <div class="absolute top-8 left-0 w-full h-12 bg-slate-800/90 dark:bg-black/40 backdrop-blur-md"></div>

      <div class="relative z-10 flex-1 flex flex-col justify-center border-r border-slate-200 dark:border-white/5 pr-6">
        <div class="flex items-center gap-3">
          <div class="h-8 w-8 bg-slate-200 dark:bg-white/10 rounded-full flex items-center justify-center border border-slate-300 dark:border-white/20">
            <div class="h-4 w-4 bg-emerald-500 dark:bg-emerald-400 rounded-full animate-pulse"></div>
          </div>
          <h1 class="text-2xl font-black italic tracking-tighter text-slate-900 dark:text-white">
            iccheghuri<span class="text-emerald-500 dark:text-emerald-400">.</span>
          </h1>
        </div>
        <p class="text-[10px] text-slate-400 dark:text-slate-500 mt-2 uppercase tracking-widest font-medium">
          Loyalty Card
        </p>
      </div>

      <div class="relative z-10 pl-6 flex flex-col items-center">
        <div class="bg-white p-2 rounded-xl shadow-lg dark:shadow-inner dark:shadow-black/20 border border-slate-100 dark:border-transparent transform rotate-3 hover:rotate-0 transition-transform duration-300">
          <img 
            :src="qrCodeSrc('https://iccheghuri.com/points/'+user.slug)" 
            alt="QR Code" 
            class="w-20 h-20"
          />
        </div>
        <span class="text-[8px] text-slate-400 dark:text-slate-400 mt-2 font-mono uppercase tracking-tighter">Scan For Details</span>
      </div>

      <div class="absolute bottom-4 left-8">
         <p class="text-[9px] text-slate-400 dark:text-slate-600 font-mono">ID: #{{ user.id }}</p>
      </div>
    </div>
  </div>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@900&display=swap');

h1 {
  font-family: 'Inter', sans-serif;
}
</style>