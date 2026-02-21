<template>
  <Teleport to="body">
    <Transition name="page-fade">
      <div
        v-if="show"
        class="fixed inset-0 z-[70] flex flex-col bg-[#fff9f0] overflow-y-auto"
      >
        <header class="sticky top-0 z-20 flex items-center px-6 py-4 bg-white/90 backdrop-blur-lg border-b border-[#f39221]/10">
          <button @click="$emit('close')" class="p-2 bg-[#f39221]/10 text-[#f39221] rounded-xl active:scale-95 transition-all mr-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
          </button>
          <h2 class="text-lg font-bold text-[#231f20]">এটি যেভাবে কাজ করে</h2>
        </header>

        <main class="flex-1 w-full max-w-xl mx-auto px-5 py-8 space-y-8">
          
          <section class="bg-white rounded-[2.5rem] p-7 border-[2px] border-orange-300">
            <div class="flex items-center justify-between mb-8">
              <h3 class="text-xl font-[900] text-[#231f20] tracking-tight">কিভাবে পয়েন্ট পাবেন?</h3>
              <span class="text-[10px] font-black text-[#f39221] bg-[#f39221]/10 px-3 py-1 rounded-full uppercase">ধাপসমূহ</span>
            </div>

            <div class="relative">
              <div class="absolute left-6 top-0 bottom-0 w-1 bg-[#fff9f0] rounded-full"></div>

              <div class="space-y-9">
                <div v-for="(earn, i) in earningSteps" :key="i" class="relative flex items-start gap-6">
                  <div class="relative z-10 flex-none w-12 h-12 bg-white border-[3px] border-[#f39221]/10 rounded-2xl shadow-sm flex items-center justify-center text-[#f39221] font-black text-lg">
                    {{ i + 1 }}
                  </div>

                  <div class="pt-1">
                    <div class="flex items-center gap-2 mb-1">
                      <span class="text-xl">{{ earn.icon }}</span>
                      <h4 class="font-extrabold text-[#231f20] text-[16px] leading-none">{{ earn.title }}</h4>
                    </div>
                    <p class="text-[#231f20]/60 text-[13px] leading-snug font-medium">
                      {{ earn.desc }}
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </section>

          <section class="bg-white rounded-[2.5rem] p-6 border-[2px] border-orange-300">
            <div class="flex items-center justify-between mb-8">
              <div>
                <h3 class="text-xl font-black text-[#231f20] tracking-tight">আপনার ভ্ৰমণ স্ট্যাটাস </h3>
                <p class="text-[11px] text-[#231f20]/40 font-medium uppercase ">পরবর্তী লেভেল অর্জন করতে বেশি বেশি ভ্রমণ করুন 😋 </p>
              </div>
              <div class="w-10 h-10 bg-[#f39221]/10 rounded-2xl flex items-center justify-center">
                <span class="text-lg">🗺️</span>
              </div>
            </div>

            <div class="relative space-y-2">
              <div class="absolute left-[23px] top-4 bottom-4 w-[3px] bg-[#fff9f0] rounded-full"></div>
              
              <div 
                class="absolute left-[23px] top-4 w-[3px] bg-[#f39221] rounded-full transition-all duration-700"
                :style="{ height: (currentTierIndex / (tiers.length - 1)) * 100 + '%' }"
              ></div>

              <div 
                v-for="(tier, i) in tiers" 
                :key="i" 
                class="relative flex items-center gap-5 p-3 rounded-2xl transition-all duration-300"
                :class="i === currentTierIndex ? 'bg-[#fff9f0] ring-1 ring-[#f39221]/20' : 'opacity-60'"
              >
                <div 
                  class="relative z-10 w-12 h-12 shrink-0 rounded-2xl flex items-center justify-center text-xl transition-all shadow-sm"
                  :class="i <= currentTierIndex ? 'bg-white border-2 border-[#f39221] scale-110' : 'bg-[#fff9f0] border-2 border-transparent'"
                >
                  {{ tier.icon }}
                  <div v-if="i <= currentTierIndex" class="absolute -top-1 -right-1 w-5 h-5 bg-[#f39221] rounded-full flex items-center justify-center border-2 border-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="4"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                  </div>
                </div>

                <div class="flex-1">
                  <div class="flex items-center justify-between">
                    <span :class="['font-bold text-sm', i === currentTierIndex ? 'text-[#231f20]' : 'text-[#231f20]/70']">
                      {{ tier.name }}
                    </span>
                    <span v-if="i === currentTierIndex" class="text-[9px] font-black bg-[#f39221] text-white px-2 py-0.5 rounded-full uppercase">
                      বর্তমান 
                    </span>
                  </div>
                  <div class="flex items-center gap-2 mt-0.5">
                    <span class="text-[10px] font-bold text-[#f39221]">{{ tier.tours }}</span>
                    <span class="w-1 h-1 bg-[#231f20]/20 rounded-full"></span>
                    <p class="text-[11px] text-[#231f20]/50 font-medium">{{ tier.benefit }}</p>
                  </div>
                </div>
              </div>
            </div>
          </section>

          <section class="pb-10 px-2">
            <h3 class="text-lg font-bold text-[#231f20] mb-3">শর্ত ও নিয়মাবলী : </h3>
            <ul class="space-y-3">
              <li v-for="(term, i) in terms" :key="i" class="flex gap-3 text-sm text-[#231f20]/60 leading-relaxed">
                <span class="text-[#f39221] font-bold">•</span>
                {{ term }}
              </li>
            </ul>
          </section>
        </main>
        
      </div>
    </Transition>
  </Teleport>
</template>
<script setup lang="ts">
const props = defineProps({
  show: { type: Boolean, required: true },
  rank: {
    type: String,
    required: true
  }
});

const earningSteps = [
  {
    title: 'ট্যুরে অংশ নিন',
    desc: 'আমাদের সাথে প্রতিটি ভ্রমণ সম্পন্ন করলেই পাচ্ছেন রিওয়ার্ড পয়েন্ট।',
    icon: '🧳'
  },
  {
    title: 'রেফার করুন আর জিতুন',
    desc: 'বন্ধুদের আমাদের সাথে ভ্রমণের আমন্ত্রণ জানান; তারা বুকিং করলেই আপনি পাবেন বোনাস পয়েন্ট।',
    icon: '🤝'
  },
  {
    title: 'রিভিউ দিয়ে পয়েন্ট পান',
    desc: 'আমাদের ফেসবুক পেজ, গ্রুপ অথবা গুগল ম্যাপে আপনার ভ্রমণের অভিজ্ঞতা শেয়ার করুন আর লুফে নিন এক্সট্রা পয়েন্ট।',
    icon: '⭐'
  }
];





const currentTierRank = props.rank;
const tiers = [
  { name: 'অভিজ্ঞতাহীন', tours: '0 Tours', benefit: '', icon: '🌱' },
  { name: 'পথিক', tours: '1 Tour', benefit: '', icon: '✈️' },
  { name: 'অভিযাত্রী', tours: '3 Tours', benefit: '', icon: '🧭' },
  { name: 'যাযাবর', tours: '5 Tours', benefit: '', icon: '🏎️' },
  { name: 'দিগন্তযাত্রী', tours: '7 Tours', benefit: '', icon: '🏎️' },
  { name: 'দিগ্বিজয়ী', tours: '10 Tours', benefit: '', icon: '👑' }
];
const currentTierIndex = tiers.findIndex(tier => tier.name === currentTierRank);


const terms = [
  "পয়েন্টগুলো অন্য কাউকে ট্রান্সফার করা যাবে না এবং এর বিনিময়ে নগদ টাকা দাবি করা যাবে না।",
  "অফারগুলো শুধুমাত্র অ্যাপে দেওয়া নির্দিষ্ট প্রতিষ্ঠানের জন্য প্রযোজ্য।",
  "যেকোনো সময় এই অফারের নিয়ম পরিবর্তন বা অফারটি বন্ধ করার অধিকার কর্তৃপক্ষ সংরক্ষণ করে।",
  "যেকোনো ধরনের স্ক্যাম বা অসদুপায় অবলম্বন করলে মেম্বারশিপ সাথে সাথেই বাতিল করা হবে।"
];
</script>

<style scoped>
.page-fade-enter-active,
.page-fade-leave-active {
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.page-fade-enter-from {
  opacity: 0;
  transform: scale(0.95) translateY(30px);
}

.page-fade-leave-to {
  opacity: 0;
  transform: translateY(30px);
}

/* Custom subtle scrollbar */
::-webkit-scrollbar {
  width: 4px;
}
::-webkit-scrollbar-thumb {
  background: #cbd5e1;
  border-radius: 10px;
}
</style>