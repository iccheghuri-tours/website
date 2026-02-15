<script setup>
import { computed,ref } from 'vue';
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

// Logic to determine if the user can afford the claim
const isLocked = computed(() => props.userPoints < props.points);

// const handleClaim = () => {
//   if (!isLocked.value) {
//     emit('claim');
//   }
// };

const isSheetOpen = ref(false);
const openSheet = ()=>{
    isSheetOpen.value = true;

}
const closeSheet = ()=>{
    isSheetOpen.value = false;

}



</script>

<template>
  <div class="list-item" :class="{ 'item-locked': isLocked } " >
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
      <h2 class="text-lg font-bold">{{ title }}</h2>
      <p>Congratulations. You are eligible for this offer. Please notify the agent of iccheghuri before your next booking to get this offer. </p>
    </BottomSheet>
</template>

<style scoped>
.list-item {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 16px;
  margin-bottom: 12px;
  background: #1a1a1c;
  border: 1px solid #2d2d30;
  border-radius: 16px;
  transition: transform 0.2s ease;
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
  color: #ffffff;
}

.details {
  margin: 0;
  font-size: 0.85rem;
  color: #a1a1aa;
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

/* Hover effect only for enabled buttons */
.point-button:not(:disabled):hover {
  filter: brightness(1.1);
}

.point-button:not(:disabled):active {
  transform: translateY(2px);
  box-shadow: 0 2px 6px rgba(99, 102, 241, 0.2);
}

/* The "Gray Out" State */
.point-button:disabled {
  background: #3f3f46; /* Flat zinc color */
  filter: grayscale(1);
  opacity: 0.5;
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