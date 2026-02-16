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
const closeSheet = () => {
  isSheetOpen.value = false;
};
</script>

<template>
  <div class="list-item" :class="{ 'item-locked': isLocked }">
    <div class="content">
      <h3 class="title">{{ title || 'Task Achievement' }}</h3>
      <p class="details">{{ details || 'Complete the daily challenge to earn rewards' }}</p>
    </div>
    
    <button 
      class="point-button" 
      :class="{ 'is-disabled': isLocked }"
      :disabled="isLocked"
      @click="openSheet()"
    >
      <span class="amount">{{ points }}</span>
      <span class="label">PTS</span>
    </button>
  </div>

  <BottomSheet :show="isSheetOpen" @close="isSheetOpen = false" :name="name">
    <h2 class="text-lg font-bold text-slate-900 dark:text-white">{{ title }}</h2>
    <p class="mt-2 text-slate-600 dark:text-slate-300">
      Congratulations. You are eligible for this offer. Please notify the agent of iccheghuri before your next booking to get this offer.
    </p>
  </BottomSheet>
</template>

<style scoped>
/* Define Variables for Light Mode by Default */
.list-item {
  --item-bg: #ffffff;
  --item-border: #e2e8f0;
  --title-color: #0f172a;
  --details-color: #64748b;
  --disabled-btn-bg: #f1f5f9;
  --disabled-btn-text: #94a3b8;
  
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 16px;
  margin-bottom: 12px;
  background: var(--item-bg);
  border: 1px solid var(--item-border);
  border-radius: 16px;
  transition: all 0.2s ease;
  box-shadow: 0 1px 3px rgba(0,0,0,0.05);
}

/* Dark Mode Overrides */
@media (prefers-color-scheme: dark) {
  .list-item {
    --item-bg: #1a1a1c;
    --item-border: #2d2d30;
    --title-color: #ffffff;
    --details-color: #a1a1aa;
    --disabled-btn-bg: #3f3f46;
    --disabled-btn-text: #ffffff;
  }
}

/* If you use a 'dark' class on the HTML tag, include this: */
:deep(.dark) .list-item {
  --item-bg: #1a1a1c;
  --item-border: #2d2d30;
  --title-color: #ffffff;
  --details-color: #a1a1aa;
  --disabled-btn-bg: #3f3f46;
  --disabled-btn-text: #ffffff;
}

.list-item:not(.item-locked):active {
  transform: scale(0.98);
}

.content {
  flex: 1;
  margin-right: 16px;
}

.title {
  margin: 0 0 4px 0;
  font-size: 1rem;
  font-weight: 600;
  color: var(--title-color);
}

.details {
  margin: 0;
  font-size: 0.85rem;
  color: var(--details-color);
  line-height: 1.4;
}

.point-button {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  min-width: 70px;
  height: 60px;
  background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
  border: none;
  border-radius: 12px;
  color: white;
  cursor: pointer;
  box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
  transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
}

.point-button:not(:disabled):hover {
  filter: brightness(1.1);
}

.point-button:not(:disabled):active {
  transform: translateY(2px);
  box-shadow: 0 2px 6px rgba(99, 102, 241, 0.2);
}

.point-button:disabled {
  background: var(--disabled-btn-bg);
  color: var(--disabled-btn-text);
  filter: grayscale(1);
  opacity: 0.6;
  cursor: not-allowed;
  box-shadow: none;
}

.amount {
  font-weight: 800;
  font-size: 1.1rem;
  letter-spacing: -0.5px;
}

.label {
  font-size: 0.65rem;
  font-weight: 700;
  opacity: 0.9;
}
</style>