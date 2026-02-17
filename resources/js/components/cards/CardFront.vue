<script setup lang="ts">
import logo from '@/assets/images/logo.svg';

defineProps({
  user: {
    type: Object,
    required: true
  },
  getRank: {
    type: Function,
    required: true
  }
});
</script>

<template>
  <div class="w-full mx-auto">
    <div class="relative overflow-hidden bg-[#fff9f0] rounded-[1rem] p-5 shadow-lg border-[4px] border-[#f39221] flex flex-col justify-between min-h-[240px]">
      
      <div class="absolute inset-0 bg-gradient-to-tr from-transparent via-white/40 to-white/5 pointer-events-none z-0"></div>
      <div class="absolute inset-0 opacity-[0.07] pointer-events-none z-0" style="background-image: radial-gradient(#231f20 0.5px, transparent 0.5px); background-size: 8px 8px;"></div>
      <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-[#f39221] opacity-[0.05] rounded-full z-0"></div>

      <div class="relative z-10">
        <div class="flex flex-col items-center justify-center mb-3">
          <div class="flex gap-0.5 mb-1.5">
            <img :src="logo" alt="Logo" class="w-14" />
          </div>
          <h1 class="text-[#231f20] text-[15.5px] font-bold font-bengali leading-none drop-shadow-sm">ইচ্ছেঘুড়ি</h1>
          <p class="text-[#f39221] text-[10px] font-black tracking-widest uppercase leading-none mt-1">Membership Card</p>
          <p class="text-[#231f20] text-[7px] font-medium opacity-80 italic">by Icchheghuri Tour & Travels</p>
        </div>

        <div class="space-y-1 text-[#231f20] px-2">
          <div class="flex items-center gap-2">
            <span class="text-[11px] font-bold w-10 text-[#f39221]">Name:</span>
            <span class="text-base font-extrabold tracking-tight border-b border-[#f39221]/10 flex-1">{{ user.name }}</span>
          </div>
          <div class="flex items-center gap-2 text-[12px]">
            <span class="font-bold w-12 opacity-60">Number:</span>
            <span class="font-semibold">{{ user.phone }}</span>
          </div>
          <div class="flex items-center gap-2 text-[11px]">
            <span class="font-bold w-12 opacity-60">Email:</span>
            <span class="font-medium truncate italic">{{ user.email }}</span>
          </div>
        </div>
      </div>

      <div class="relative z-10 flex items-end justify-between px-2 pt-2">
        <div>
          <p class="text-[8px] uppercase tracking-widest text-[#f39221] font-black leading-none">Total Balance</p>
          <p class="text-xl font-mono font-bold text-[#231f20] leading-none mt-1">
            {{ user.points.toLocaleString() }} <span class="text-[8px] font-sans text-[#f39221] font-bold">PTS</span>
          </p>
        </div>
        
        <div class="flex items-center gap-1">
            <div class="text-right">
              <p class="text-[8px] uppercase font-bold text-[#231f20] opacity-60">Level:</p>
              <p class="text-[#f39221] text-sm font-bold leading-none font-bengali">
                {{ getRank(user.completed_tours) }}
              </p>
            </div>
            <div class="text-[#f39221] bg-[#231f20] p-1 rounded-full shadow-lg">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"/></svg>
            </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@700&family=Hind+Siliguri:wght@600;700&display=swap');

.font-mono {
  font-family: 'JetBrains Mono', monospace;
}
.font-bengali {
  font-family: 'Hind Siliguri', sans-serif;
}
</style>