<script setup lang="ts">
import { onMounted, ref } from 'vue';
import CardFront from '@/components/cards/CardFront.vue';
import CardBack from '@/components/cards/CardBack.vue';
import { usePage } from '@inertiajs/vue3';
import CardPartnerBenifitsContainer from '@/components/container/CardPartnerBenifitsContainer.vue';
import CardPointDealsContainer from '@/components/container/CardPointDealsContainer.vue';
import ToolBar from '@/components/mix/ToolBar.vue';

// IMPORT FAQ PAGE
import FAQ from '@/pages/FAQ.vue';

const { props } = usePage();
const user = props.user;
const regularDeals = props.regularDeals;
const pointDeals = props.pointDeals;

const isFlipped = ref(false);
const activeTab = ref('points');

const toggleCard = () => {
  isFlipped.value = !isFlipped.value;
};

function getRank(count) {
  if (count >= 10) return 'দিগ্বিজয়ী';
  if (count >= 7) return 'দিগন্তযাত্রী';
  if (count >= 5) return 'যাযাবর';
  if (count >= 3) return 'অভিযাত্রী';
  if (count >= 1) return 'পথিক';
  return 'অভিজ্ঞতাহীন';
}

const isAlertShown = ref(false);
const isFullScreen = ref(false);

function goFullscreen() {
  const elem = document.documentElement;
  if (elem.requestFullscreen) elem.requestFullscreen();
  else if (elem.webkitRequestFullscreen) elem.webkitRequestFullscreen(); 
  else if (elem.msRequestFullscreen) elem.msRequestFullscreen(); 
  isAlertShown.value = true;
  isFullScreen.value = true;
}

function closeFullScreen() {
  if (document.exitFullscreen) document.exitFullscreen();
  else if (document.webkitExitFullscreen) document.webkitExitFullscreen(); 
  else if (document.msExitFullscreen) document.msExitFullscreen(); 
  isFullScreen.value = false;
}

onMounted(()=>{
  document.addEventListener('fullscreenchange', () => {
    if (!document.fullscreenElement) {
      isFullScreen.value = false;
    }
  });
});

const isFAQOpened = ref(false);
const openFAQ = () => {
  isFAQOpened.value = true;
}
</script>

<template>
  <div v-if="!isAlertShown" class="fixed inset-0 bg-[#231f20]/60 backdrop-blur-md flex justify-center items-center z-50">
    <div class="bg-white border border-[#f39221]/20 shadow-2xl rounded-3xl p-8 max-w-xs w-full text-center">
      <p class="text-[#231f20] mb-8 text-xl font-semibold tracking-tight">
        Please Enter Fullscreen Mode
      </p>
      <button 
        @click="goFullscreen" 
        class="w-full bg-[#231f20] text-white py-4 rounded-2xl font-bold uppercase tracking-widest text-sm hover:bg-[#f39221] transition-all active:scale-95 shadow-lg shadow-[#231f20]/10"
      >
        OK
      </button>
    </div>
  </div>

  <div class="flex flex-col items-center w-full p-4 min-h-screen bg-[#fff9f0] transition-colors duration-300">
    <div class="w-full max-w-md mb-2">
      <ToolBar v-if="isAlertShown" :is-full-screen="isFullScreen" :toggle-full-screen="goFullscreen" :close-full-screen="closeFullScreen"/>
    </div>

    <div 
      class="w-full max-w-md h-65 perspective cursor-pointer mx-auto mt-3" 
      @click="toggleCard"
    >
      <div 
        class="relative w-full h-full transition-transform duration-600 ease-in-out transform-style-preserve-3d"
        :class="{ 'rotate-y-180': isFlipped }"
      >
        <div class="absolute w-full h-full backface-hidden">
          <CardFront :user="user" :getRank="getRank" />
        </div>
        <div class="absolute w-full h-full backface-hidden rotate-y-180">
          <CardBack :user="user" />
        </div>
      </div>
    </div>

    <div class="w-full max-w-md bg-white/50 border-[2px] border-orange-300 rounded-2xl p-3 hover:bg-white transition-colors group">
      <div class="flex items-center justify-between gap-4">
        
        <button @click="openFAQ" class="flex flex-col items-start hover:opacity-70 transition-opacity">
          <div class="flex items-center gap-1.5 mb-0.5">
            <div class="w-1.5 h-1.5 rounded-full bg-[#f39221] animate-pulse"></div>
            <span class="text-[10px] font-bold uppercase tracking-wider text-[#231f20]/60">কিভাবে কাজ করে ?</span>
          </div>
          <div class="flex items-center gap-1">
            <span class="text-[11px] font-bold text-[#f39221]">বিস্তারিত দেখুন</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-2.5 h-2.5 text-[#f39221] group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
          </div>
        </button>

        <div class="h-8 w-[1px] bg-gradient-to-b from-transparent via-[#f39221]/20 to-transparent"></div>

        <div class="flex items-center gap-3">
          <div class="flex flex-col text-right">
            <span class="text-[9px] uppercase tracking-wider font-bold text-[#231f20]/40 leading-none mb-0.5">Completed</span>
            <h4 class="text-[#231f20] text-[11px] font-bold truncate">Tours</h4>
          </div>
          <div class="relative">
            <span class="text-3xl font-black text-[#231f20] tabular-nums leading-none">
              {{ user.completed_tours || 0 }}
            </span>
            <div class="h-1 w-full bg-[#f39221]/30 rounded-full mt-0.5 blur-[0.5px]"></div>
          </div>
        </div>

      </div>
    </div>

    <div class="flex w-full max-w-md bg-white p-1.5 rounded-2xl sticky top-4 z-20 mt-4 border border-[#f39221]/10 shadow-lg">
      <button
        class="flex-1 py-2.5 font-bold text-xs uppercase rounded-xl transition-all duration-300"
        :class="activeTab === 'points' ? 'bg-[#f39221] text-white shadow-lg shadow-[#f39221]/30' : 'text-[#231f20]/50 hover:bg-[#fff9f0]'"
        @click="activeTab = 'points'"
      >
        পয়েন্ট ডিল
      </button>
      <button
        class="flex-1 py-2.5 font-bold text-xs uppercase rounded-xl transition-all duration-300"
        :class="activeTab === 'benefits' ? 'bg-[#f39221] text-white shadow-lg shadow-[#f39221]/30' : 'text-[#231f20]/50 hover:bg-[#fff9f0]'"
        @click="activeTab = 'benefits'"
      >
        পার্টনার বেনিফিটস
      </button>
    </div>

    <div v-if="activeTab === 'points'" class="w-full max-w-md mt-4 animate-slideUp z-10">
      <CardPointDealsContainer :lists="pointDeals" :userPoints="user.points" :name="user.name" />
    </div>

    <div v-if="activeTab === 'benefits'" class="w-full max-w-md mt-4 animate-slideUp z-10">
      <CardPartnerBenifitsContainer :lists="regularDeals" :user="user" />
    </div>
  </div>

  <FAQ
    :show="isFAQOpened"
    @close="isFAQOpened = false"
    :rank="getRank(user.completed_tours)"
  />
</template>

<style scoped>
@keyframes slideUp {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}

.perspective { perspective: 1000px; }
.rotate-y-180 { transform: rotateY(180deg); }
.transform-style-preserve-3d { transform-style: preserve-3d; }
.backface-hidden { backface-visibility: hidden; -webkit-backface-visibility: hidden; }
.animate-slideUp { animation: slideUp 0.3s ease-out; }
.duration-600 { transition-duration: 600ms; }
</style>