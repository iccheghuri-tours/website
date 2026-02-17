<script setup lang="ts">
import logo from '@/assets/images/logo.svg';
import { usePage } from '@inertiajs/vue3';

defineProps({
  user: {
    type: Object,
    required: true
  }
});

// Using a public API for the QR code generation
const qrCodeSrc = (url) => `https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=${encodeURIComponent(url)}`;

const url = window.location.origin + usePage().url;
const mail = "support@"+window.location.hostname;

</script>

<template>
  <div class="w-full mx-auto">
    <div class="relative overflow-hidden bg-[#fff9f0] rounded-[1rem] p-5 shadow-lg border-[4px] border-[#f39221] flex flex-col justify-between min-h-[240px]">
      
      <div class="absolute inset-0 bg-gradient-to-tr from-transparent via-white/40 to-white/5 pointer-events-none z-0"></div>
      <div class="absolute inset-0 opacity-[0.07] pointer-events-none z-0" style="background-image: radial-gradient(#231f20 0.5px, transparent 0.5px); background-size: 8px 8px;"></div>

      <div class="relative z-10 flex flex-1 items-center justify-between px-4">
        
        <div class="flex flex-col items-center">
          <div class="border-[1.5px] border-[#231f20]/10 p-3 bg-white/50 backdrop-blur-sm rounded-sm">
            <div class="flex gap-0.5 mb-2 justify-center">
              <div class="flex gap-0.5 mb-1.5">
            <img :src="logo" alt="Logo" class="w-22" />
          </div>
            </div>
            <h1 class="text-[#231f20] text-[25px] font-bold font-bengali leading-none text-center">ইচ্ছেঘুড়ি</h1>
          </div>
        </div>

        <div class="w-[1.5px] h-24 bg-[#f39221]/30 mx-4"></div>

        <div class="flex flex-col items-center gap-2">
          <div class="bg-white p-2 rounded-sm border-[1.5px] border-[#231f20]/10">
            <img 
              :src="qrCodeSrc(url)" 
              alt="Member QR" 
              class="w-24 h-24"
            />
          </div>
        </div>
      </div>

      <div class="relative z-10 border-t border-[#f39221]/10 pt-3 flex items-end justify-between">
        <div class="flex flex-col">
          <p class="text-[7px] uppercase font-bold text-[#f39221] tracking-wider">Contact Support</p>
          <p class="text-[9px] font-bold text-[#231f20]">{{ mail }}</p>
        </div>
        
        <div class="text-right">
          <p class="text-[8px] uppercase font-bold text-[#231f20] opacity-60 leading-none">Member ID</p>
          <p class="text-sm font-mono font-bold text-[#f39221] leading-none mt-1">
            #{{ 641300+user.id }}
          </p>
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