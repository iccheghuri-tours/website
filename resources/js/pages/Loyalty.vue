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
<div class="flex w-full max-w-md bg-slate-800 p-2 rounded-xl sticky top-0 z-20">
  <button
    class="flex-1 py-2 font-semibold text-sm text-slate-400 rounded-lg transition-all duration-200"
    :class="activeTab === 'points' ? 'bg-blue-500 text-white shadow-md' : ''"
    @click="activeTab = 'points'"
  >
    Card Points
  </button>
  <button
    class="flex-1 py-2 font-semibold text-sm text-slate-400 rounded-lg transition-all duration-200"
    :class="activeTab === 'benefits' ? 'bg-blue-500 text-white shadow-md' : ''"
    @click="activeTab = 'benefits'"
  >
    Benefits
  </button>
</div>


    <!-- Deals Sections -->
    <div v-if="activeTab === 'points'" class="w-full max-w-md mt-2 animate-slideUp z-10">
      <CardPointDealsContainer :lists="pointDeals" :userPoints="user.points" />
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
