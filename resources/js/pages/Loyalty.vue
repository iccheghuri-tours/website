<script setup>
import { ref } from 'vue';
import CardFront from '@/components/cards/CardFront.vue';
import CardBack from '@/components/cards/CardBack.vue';
import { usePage } from '@inertiajs/vue3';
import CardPartnerBenifitsContainer from '@/components/container/CardPartnerBenifitsContainer.vue';
import CardPointDealsContainer from '@/components/container/CardPointDealsContainer.vue';

const { props } = usePage();
const user = props.user;
const regularDeals = props.regularDeals;
const pointDeals = props.pointDeals;

const isFlipped = ref(false);
const activeTab = ref('points');

const toggleCard = () => {
  isFlipped.value = !isFlipped.value;
};
</script>

<template>
  <div class="flex flex-col items-center w-full p-4">

    <!-- Card -->
    <div 
      class="w-full max-w-md h-65 perspective cursor-pointer mx-auto" 
      @click="toggleCard"
    >
      <div 
        class="relative w-full h-full transition-transform duration-600 ease-in-out transform-style-preserve-3d"
        :class="{ 'rotate-y-180': isFlipped }"
      >
        <div class="absolute w-full h-full backface-hidden">
          <CardFront 
            :name="user.name" 
            :phone="user.phone" 
            :email="user.email" 
            :points="user.points" 
          />
        </div>
        <div class="absolute w-full h-full backface-hidden rotate-y-180">
          <CardBack 
            :logoText="'NEXUS'" 
            :qrUrl="'https://facebook.com/trtajim' + user.id" 
          />
        </div>
      </div>
    </div>

    <!-- Tabs -->
<!-- Tabs -->
<div class="w-full max-w-md">
  <div class="bg-slate-900/40 border border-slate-800 rounded-2xl p-4 flex items-center justify-between">
    <div class="flex items-center gap-4">
      <div class="flex items-center gap-3">
        <div class="text-blue-500/80">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        </div>
        <div class="text-2xl font-black text-white tabular-nums">
          {{ user.completed_tours || 5 }}
        </div>
      </div>

      <div class="h-8 w-[1px] bg-slate-700/50"></div>

      <div>
        <h4 class="text-white text-sm font-bold leading-none">Completed Tours</h4>
      </div>
    </div>

    <div class="text-right">
      <span class="block text-[10px] uppercase tracking-widest text-slate-500 font-bold leading-none">Rank</span>
      <span class="text-xs font-black text-indigo-400 uppercase">{{ user.rank || 'Expert' }}</span>
    </div>
  </div>
</div>

<div class="flex w-full max-w-md bg-slate-800 p-2 rounded-xl sticky top-0 z-20 mt-4">
  <button
    class="flex-1 py-2 font-semibold text-sm text-slate-400 rounded-lg transition-all duration-200"
    :class="activeTab === 'points' ? 'bg-blue-500 text-white shadow-md' : ''"
    @click="activeTab = 'points'"
  >
    Point Deals
  </button>
  <button
    class="flex-1 py-2 font-semibold text-sm text-slate-400 rounded-lg transition-all duration-200"
    :class="activeTab === 'benefits' ? 'bg-blue-500 text-white shadow-md' : ''"
    @click="activeTab = 'benefits'"
  >
    Partner Benefits
  </button>
</div>


    <!-- Deals Sections -->
    <div v-if="activeTab === 'points'" class="w-full max-w-md mt-2 animate-slideUp z-10">
      <CardPointDealsContainer :lists="pointDeals" :userPoints="user.points" :name="user.name" />
    </div>

    <div v-if="activeTab === 'benefits'" class="w-full max-w-md mt-2 animate-slideUp z-10">
      <CardPartnerBenifitsContainer :lists="regularDeals" />
    </div>

  </div>
</template>

<style scoped>
@keyframes slideUp {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}

/* Tailwind doesn't yet provide rotateY, perspective, or backface-visibility, so we need these: */
.perspective { perspective: 1000px; }
.rotate-y-180 { transform: rotateY(180deg); }
.transform-style-preserve-3d { transform-style: preserve-3d; }
.backface-hidden { backface-visibility: hidden; -webkit-backface-visibility: hidden; }
.animate-slideUp { animation: slideUp 0.3s ease-out; }
.duration-600 { transition-duration: 600ms; }
</style>
