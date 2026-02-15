<script setup>
defineProps({
  name: {
    type: String,
    default: 'Jane Doe'
  },
  phone: {
    type: String,
    default: '+1 (555) 000-0000'
  },
  email: {
    type: String,
    default: 'hello@example.com'
  },
  points: {
    type: Number,
    default: 0
  }
});
</script>

<template>
  <div class=" w-full max-w-sm mx-auto">
    <div class="relative overflow-hidden bg-gradient-to-br from-slate-900 to-slate-800 rounded-3xl p-5 shadow-2xl transition-transform hover:scale-[1.02] duration-300 border border-white/10 flex flex-col justify-between min-h-[240px]">
      
      <div class="absolute -top-10 -right-10 w-32 h-32 bg-blue-500/15 rounded-full blur-3xl"></div>
      
      <div class="relative z-10">
        <div class="flex justify-between items-start mb-4">
          <div class="h-9 w-9 bg-gradient-to-tr from-blue-400 to-emerald-400 rounded-lg flex items-center justify-center shadow-lg">
            <span class="text-white font-bold text-sm">U</span>
          </div>
          <div class="text-right">
            <p class="text-[9px] uppercase tracking-[0.2em] text-slate-400 font-semibold">Member Status</p>
            <p class="text-emerald-400 text-xs font-medium italic">Verified</p>
          </div>
        </div>

        <div class="mb-4">
          <h2 class="text-xl font-bold text-white tracking-tight leading-tight">{{ name }}</h2>
          <div class="mt-1.5 space-y-0.5">
            <p class="text-slate-300 text-[10px] flex items-center gap-2">
              <span class="opacity-50">📱</span> {{ phone }}
            </p>
            <p class="text-slate-300 text-[10px] flex items-center gap-2">
              <span class="opacity-50">✉️</span> {{ email }}
            </p>
          </div>
        </div>
      </div>

      <div class="relative z-10 flex items-end justify-between border-t border-white/10 pt-3">
        <div>
          <p class="text-[9px] uppercase tracking-widest text-slate-500 font-bold">Total Balance</p>
          <p class="text-2xl font-mono font-bold text-white leading-none mt-1">
            {{ points.toLocaleString() }} <span class="text-[10px] text-blue-400 font-sans tracking-normal align-middle ml-1">PTS</span>
          </p>
        </div>
        
        <div class="opacity-30 pb-1">
           <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 8.8c.7-.7 1.7-1.1 2.7-1.1s2 .4 2.7 1.1"/><path d="M2 12.3c1.7-1.7 4.5-1.7 6.2 0"/><path d="M2 15.8c2.7-2.7 7.2-2.7 9.9 0"/></svg>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@700&display=swap');
.font-mono {
  font-family: 'JetBrains+Mono', monospace;
}
</style>