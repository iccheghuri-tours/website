<script setup lang="ts">
import { ref } from 'vue';
import Details from '@/pages/Details.vue';

defineProps({
    name: String,
    image: String,
    details: String,
    discount: String,
    location: String,
    facebook: String,
    phone: String,
});

const isSheetOpen = ref(false);

const openSheet = () => {
    isSheetOpen.value = true;
};
</script>

<template>
    <div
        @click="openSheet()"
        class="group relative mb-3 flex cursor-pointer items-center gap-4 rounded-2xl border-2 border-[#f39221] bg-[#fff9f0] p-4 shadow-sm transition-all duration-200 active:scale-[0.98]"
    >
        <div
            class="relative h-14 w-14 flex-shrink-0 overflow-hidden rounded-xl border border-[#f39221]/20 bg-white"
        >
            <img
                :src="`/storage/${image}`"
                :alt="name"
                class="h-full w-full object-cover"
            />
        </div>

        <div class="min-w-0 flex-1">
            <h3
                class="font-bengali truncate text-base font-bold text-[#231f20]"
            >
                {{ name }}
            </h3>
            <div class="flex items-center gap-1.5">
                <span class="font-mono text-sm font-black text-[#f39221]">
                    {{ discount }}
                </span>
            </div>
            <p
                class="line-clamp-1 text-xs leading-tight text-[#231f20] opacity-70"
            >
                {{ details }}
            </p>
        </div>

        <button
            class="flex items-center justify-center rounded-lg bg-[#f39221] px-3 py-2 text-xs font-bold text-white shadow-md transition-all hover:brightness-105"
        >
            Details
        </button>

        <Details
            :show="isSheetOpen"
            :name="name"
            :discount-amount="discount"
            :image="image"
            :phone="phone"
            :facebook="facebook"
            :location="location"
            :details="details"
            @close="isSheetOpen = false"
        />
    </div>
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
