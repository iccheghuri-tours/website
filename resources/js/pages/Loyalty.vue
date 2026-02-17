<script setup lang="ts">
import { onMounted, ref } from 'vue';
import CardFront from '@/components/cards/CardFront.vue';
import CardBack from '@/components/cards/CardBack.vue';
import { usePage } from '@inertiajs/vue3';
import CardPartnerBenifitsContainer from '@/components/container/CardPartnerBenifitsContainer.vue';
import CardPointDealsContainer from '@/components/container/CardPointDealsContainer.vue';
import ToolBar from '@/components/mix/ToolBar.vue';

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

    <div class="w-full max-w-md">
      <div class="relative group overflow-hidden bg-white border border-[#f39221]/20 rounded-2xl p-4 flex items-center justify-between border-[2px] border-orange-300 ">
        <div class="absolute -left-4 top-0 w-20 h-20 bg-[#f39221]/5 blur-3xl rounded-full group-hover:bg-[#f39221]/10 transition-colors duration-500"></div>

        <div class="flex items-center gap-5 relative">
          <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-[#fff9f0] border border-[#f39221]/10 rounded-xl shadow-inner">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#f39221] opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </div>
          <div class="h-10 w-[1px] bg-gradient-to-b from-transparent via-[#f39221]/20 to-transparent"></div>
          <div class="flex flex-col">
            <span class="text-[10px] uppercase tracking-[0.15em] font-bold text-[#231f20]/40 leading-none mb-1">Total Progress</span>
            <h4 class="text-[#231f20] text-sm font-semibold tracking-wide">Completed Tours</h4>
          </div>
        </div>

        <div class="relative text-right">
          <span class="text-4xl font-black text-[#231f20] tabular-nums tracking-tighter">
            {{ user.completed_tours || 0 }}
          </span>
          <div class="h-1 w-full bg-[#f39221]/30 rounded-full mt-1 blur-[1px]"></div>
        </div>
      </div>
    </div>

    <div class="flex w-full max-w-md bg-white p-1.5 rounded-2xl sticky top-4 z-20 mt-4 border border-[#f39221]/10 shadow-lg">
      <button
        class="flex-1 py-2.5 font-bold text-xs uppercase tracking-widest rounded-xl transition-all duration-300"
        :class="activeTab === 'points' ? 'bg-[#f39221] text-white shadow-lg shadow-[#f39221]/30' : 'text-[#231f20]/50 hover:bg-[#fff9f0]'"
        @click="activeTab = 'points'"
      >
        Point Deals
      </button>
      <button
        class="flex-1 py-2.5 font-bold text-xs uppercase tracking-widest rounded-xl transition-all duration-300"
        :class="activeTab === 'benefits' ? 'bg-[#f39221] text-white shadow-lg shadow-[#f39221]/30' : 'text-[#231f20]/50 hover:bg-[#fff9f0]'"
        @click="activeTab = 'benefits'"
      >
        Partner Benefits
      </button>
    </div>

    <div v-if="activeTab === 'points'" class="w-full max-w-md mt-4 animate-slideUp z-10">
      <CardPointDealsContainer :lists="pointDeals" :userPoints="user.points" :name="user.name" />
    </div>

    <div v-if="activeTab === 'benefits'" class="w-full max-w-md mt-4 animate-slideUp z-10">
      <CardPartnerBenifitsContainer :lists="regularDeals" :user="user" />
    </div>
  </div>
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