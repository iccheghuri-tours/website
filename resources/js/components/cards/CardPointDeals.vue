<script setup>
import { computed, ref } from 'vue';
import BottomSheet from '../mix/BottomSheet.vue';

const props = defineProps({
  title: String,
  details: String,
  name: String,
  points: {
    type: Number,
    default: 100
  },
  userPoints: {
    type: Number,
    default: 0
  }
});

const emit = defineEmits(['claim']);

const isLocked = computed(() => props.userPoints < props.points);

const isSheetOpen = ref(false);
const openSheet = () => {
  isSheetOpen.value = true;
};
</script>

<template>
  <div class="flex items-center justify-between p-4 mb-3 bg-[#fff9f0] border-2 border-[#f39221] rounded-2xl transition-transform duration-200">
    <div class="flex-1 mr-4">
      <h3 class="text-base font-bold text-[#231f20] font-bengali mb-1">
        {{ title || 'Task Achievement' }}
      </h3>
      <p class="text-sm text-[#231f20] opacity-70 leading-[1.4]">
        {{ details || 'Complete the daily challenge to earn rewards' }}
      </p>
    </div>

    <button 
      class="flex flex-col items-center justify-center min-w-[70px] h-[60px] rounded-xl text-white shadow-md transition-all duration-200 disabled:bg-gray-200 disabled:text-gray-400 disabled:shadow-none disabled:cursor-not-allowed hover:brightness-105 hover:-translate-y-1"
      :class="{'bg-[#f39221] cursor-pointer': !isLocked}"
      :disabled="isLocked"
      @click="openSheet()"
    >
      <span class="font-mono font-extrabold text-lg">{{ points }}</span>
      <span class="text-[0.65rem] font-bold opacity-90">PTS</span>
    </button>
  </div>

  <BottomSheet :show="isSheetOpen" @close="isSheetOpen = false" :name="name">
    <h2 class="text-lg font-bold text-[#231f20] font-bengali">{{ title }}</h2>
    <p class="mt-2 text-[#231f20]/80">
      Congratulations. You are eligible for this offer. Please notify the agent of <span class="text-[#f39221] font-bold">Icchheghuri</span> before your next booking to get this offer.
    </p>
  </BottomSheet>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@700&family=Hind+Siliguri:wght@600;700&display=swap');

.font-bengali {
  font-family: 'Hind Siliguri', sans-serif;
}
.font-mono {
  font-family: 'JetBrains Mono', monospace;
}
</style>
