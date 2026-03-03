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

onMounted(() => {
    document.addEventListener('fullscreenchange', () => {
        if (!document.fullscreenElement) {
            isFullScreen.value = false;
        }
    });
});

const isFAQOpened = ref(false);
const openFAQ = () => {
    isFAQOpened.value = true;
};
</script>

<template>
    <div
        v-if="!isAlertShown"
        class="fixed inset-0 z-50 flex items-center justify-center bg-[#231f20]/60 backdrop-blur-md"
    >
        <div
            class="w-full max-w-xs rounded-3xl border border-[#f39221]/20 bg-white p-8 text-center shadow-2xl"
        >
            <p class="mb-8 text-xl font-semibold tracking-tight text-[#231f20]">
                Please Enter Fullscreen Mode
            </p>

            <button
                @click="goFullscreen"
                class="w-full rounded-2xl bg-[#231f20] py-4 text-sm font-bold tracking-widest text-white uppercase shadow-lg shadow-[#231f20]/10 transition-all hover:bg-[#f39221] active:scale-95"
            >
                OK
            </button>

            <button
                @click="isAlertShown = true"
                class="text-black-400 mt-2 block w-full text-sm underline decoration-gray-300 transition-colors hover:text-gray-600"
            >
                Not now
            </button>
        </div>
    </div>

    <div
        class="flex min-h-screen w-full flex-col items-center bg-[#fff9f0] p-4 transition-colors duration-300"
    >
        <div class="mb-2 w-full max-w-md">
            <ToolBar
                v-if="isAlertShown"
                :is-full-screen="isFullScreen"
                :toggle-full-screen="goFullscreen"
                :close-full-screen="closeFullScreen"
            />
        </div>

        <div
            class="perspective mx-auto mt-3 h-65 w-full max-w-md cursor-pointer"
            @click="toggleCard"
        >
            <div
                class="transform-style-preserve-3d relative h-full w-full transition-transform duration-600 ease-in-out"
                :class="{ 'rotate-y-180': isFlipped }"
            >
                <div class="absolute h-full w-full backface-hidden">
                    <CardFront :user="user" :getRank="getRank" />
                </div>
                <div
                    class="absolute h-full w-full rotate-y-180 backface-hidden"
                >
                    <CardBack :user="user" />
                </div>
            </div>
        </div>

        <div
            class="group w-full max-w-md rounded-2xl border-[2px] border-orange-300 bg-white/50 p-3 transition-colors hover:bg-white"
        >
            <div class="flex items-center justify-between gap-4">
                <button
                    @click="openFAQ"
                    class="flex flex-col items-start transition-opacity hover:opacity-70"
                >
                    <div class="mb-0.5 flex items-center gap-1.5">
                        <div
                            class="h-1.5 w-1.5 animate-pulse rounded-full bg-[#f39221]"
                        ></div>
                        <span
                            class="text-[10px] font-bold tracking-wider text-[#231f20]/60 uppercase"
                            >কিভাবে কাজ করে ?</span
                        >
                    </div>
                    <div class="flex items-center gap-1">
                        <span class="text-[11px] font-bold text-[#f39221]"
                            >বিস্তারিত দেখুন</span
                        >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-2.5 w-2.5 text-[#f39221] transition-transform group-hover:translate-x-0.5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="3"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 5l7 7-7 7"
                            />
                        </svg>
                    </div>
                </button>

                <div
                    class="h-8 w-[1px] bg-gradient-to-b from-transparent via-[#f39221]/20 to-transparent"
                ></div>

                <div class="flex items-center gap-3">
                    <div class="flex flex-col text-right">
                        <span
                            class="mb-0.5 text-[9px] leading-none font-bold tracking-wider text-[#231f20]/40 uppercase"
                            >Completed</span
                        >
                        <h4
                            class="truncate text-[11px] font-bold text-[#231f20]"
                        >
                            Tours
                        </h4>
                    </div>
                    <div class="relative">
                        <span
                            class="text-3xl leading-none font-black text-[#231f20] tabular-nums"
                        >
                            {{ user.completed_tours || 0 }}
                        </span>
                        <div
                            class="mt-0.5 h-1 w-full rounded-full bg-[#f39221]/30 blur-[0.5px]"
                        ></div>
                    </div>
                </div>
            </div>
        </div>

        <div
            class="sticky top-4 z-20 mt-4 flex w-full max-w-md rounded-2xl border border-[#f39221]/10 bg-white p-1.5 shadow-lg"
        >
            <button
                class="flex-1 rounded-xl py-2.5 text-xs font-bold uppercase transition-all duration-300"
                :class="
                    activeTab === 'points'
                        ? 'bg-[#f39221] text-white shadow-lg shadow-[#f39221]/30'
                        : 'text-[#231f20]/50 hover:bg-[#fff9f0]'
                "
                @click="activeTab = 'points'"
            >
                পয়েন্ট ডিল
            </button>
            <button
                class="flex-1 rounded-xl py-2.5 text-xs font-bold uppercase transition-all duration-300"
                :class="
                    activeTab === 'benefits'
                        ? 'bg-[#f39221] text-white shadow-lg shadow-[#f39221]/30'
                        : 'text-[#231f20]/50 hover:bg-[#fff9f0]'
                "
                @click="activeTab = 'benefits'"
            >
                পার্টনার বেনিফিটস
            </button>
        </div>

        <div
            v-if="activeTab === 'points'"
            class="animate-slideUp z-10 mt-4 w-full max-w-md"
        >
            <CardPointDealsContainer
                :lists="pointDeals"
                :userPoints="user.points"
                :name="user.name"
            />
        </div>

        <div
            v-if="activeTab === 'benefits'"
            class="animate-slideUp z-10 mt-4 w-full max-w-md"
        >
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
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.perspective {
    perspective: 1000px;
}
.rotate-y-180 {
    transform: rotateY(180deg);
}
.transform-style-preserve-3d {
    transform-style: preserve-3d;
}
.backface-hidden {
    backface-visibility: hidden;
    -webkit-backface-visibility: hidden;
}
.animate-slideUp {
    animation: slideUp 0.3s ease-out;
}
.duration-600 {
    transition-duration: 600ms;
}
</style>
