<template>
    <Teleport to="body">
        <Transition name="page-fade">
            <div
                v-if="show"
                class="fixed inset-0 z-[70] flex flex-col overflow-y-auto bg-white transition-colors duration-300"
            >
                <header
                    class="sticky top-0 z-20 flex w-full items-center justify-between border-b border-orange-100 bg-white/80 p-4 backdrop-blur-md"
                >
                    <button
                        @click="$emit('close')"
                        class="rounded-full border border-[#f39221]/20 bg-orange-50 p-2 text-[#f39221] transition-transform active:scale-90"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="20"
                            height="20"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15 19l-7-7 7-7"
                            />
                        </svg>
                    </button>
                    <span
                        class="text-xs font-semibold tracking-widest text-slate-400 uppercase"
                        >Partner Details</span
                    >
                    <div class="w-10"></div>
                </header>

                <main class="mx-auto w-full max-w-2xl flex-1 p-6 pb-20">
                    <div
                        class="mt-4 mb-8 flex flex-col items-center text-center"
                    >
                        <div
                            class="mb-4 h-32 w-32 overflow-hidden rounded-3xl border border-orange-100 bg-white shadow-xl shadow-orange-500/5"
                        >
                            <img
                                :src="`/storage/${image}`"
                                :alt="name"
                                class="h-full w-full rounded-2xl object-contain"
                            />
                        </div>
                        <h1
                            class="mb-1 text-3xl font-bold tracking-tight text-slate-900"
                        >
                            {{ name }}
                        </h1>
                        <p class="text-sm font-medium text-slate-500">
                            Official Partner
                        </p>
                    </div>

                    <div
                        class="relative mb-8 overflow-hidden rounded-3xl border border-[#f39221]/30 bg-gradient-to-br from-[#fff8f0] to-white p-8 shadow-sm"
                    >
                        <div class="relative z-10 text-center">
                            <span
                                class="text-xs font-bold tracking-widest text-[#f39221] uppercase"
                                >Current Offer</span
                            >
                            <h2 class="mt-2 text-5xl font-black text-[#f39221]">
                                {{ discountAmount }}
                            </h2>
                            <p
                                class="mt-2 text-base font-medium text-[#f39221]/70"
                            >
                                Exclusive for Iccheghuri Card Holders
                            </p>
                        </div>
                        <div
                            class="absolute -top-12 -right-12 h-40 w-40 rounded-full bg-[#f39221]/10 blur-3xl"
                        ></div>
                    </div>

                    <div class="mb-10 grid grid-cols-3 gap-4">
                        <a
                            :href="location"
                            target="_blank"
                            class="flex flex-col items-center justify-center rounded-2xl border border-orange-100 bg-orange-50/30 p-5 transition-all hover:border-[#f39221]/40 hover:bg-orange-50 active:scale-95"
                        >
                            <span class="mb-2 text-2xl">📍</span>
                            <span
                                class="text-[11px] font-bold tracking-wider text-slate-500 uppercase"
                                >Map</span
                            >
                        </a>
                        <a
                            :href="facebook"
                            target="_blank"
                            class="flex flex-col items-center justify-center rounded-2xl border border-orange-100 bg-orange-50/30 p-5 transition-all hover:border-[#f39221]/40 hover:bg-orange-50 active:scale-95"
                        >
                            <span class="mb-2 text-2xl">🌐</span>
                            <span
                                class="text-[11px] font-bold tracking-wider text-slate-500 uppercase"
                                >Social</span
                            >
                        </a>
                        <a
                            :href="'tel:' + phone"
                            class="flex flex-col items-center justify-center rounded-2xl border border-orange-100 bg-orange-50/30 p-5 transition-all hover:border-[#f39221]/40 hover:bg-orange-50 active:scale-95"
                        >
                            <span class="mb-2 text-2xl">📞</span>
                            <span
                                class="text-[11px] font-bold tracking-wider text-slate-500 uppercase"
                                >Call</span
                            >
                        </a>
                    </div>

                    <div class="space-y-10">
                        <section>
                            <h3 class="mb-3 text-xl font-bold text-slate-900">
                                অফারটির শর্তসমূহ :
                            </h3>
                            <p class="text-base leading-relaxed text-slate-600">
                                {{ details }}
                            </p>
                        </section>

                        <section>
                            <h3 class="mb-4 text-xl font-bold text-slate-900">
                                অফারটি যেভাবে পাবেন :
                            </h3>
                            <div class="space-y-4">
                                <div
                                    v-for="(step, index) in steps"
                                    :key="index"
                                    class="flex items-start gap-5"
                                >
                                    <div
                                        class="flex h-10 w-10 flex-none items-center justify-center rounded-2xl border border-[#f39221]/20 bg-[#fff8f0] text-sm font-bold text-[#f39221]"
                                    >
                                        {{ index + 1 }}
                                    </div>
                                    <p
                                        class="self-center text-base leading-6 text-slate-600"
                                    >
                                        {{ step }}
                                    </p>
                                </div>
                            </div>
                        </section>
                    </div>
                </main>
            </div>
        </Transition>
    </Teleport>
</template>

<script setup lang="ts">
const props = defineProps({
    name: { type: String, default: 'Sample Name' },
    details: {
        type: String,
        default:
            'This discount is applicable on all full-priced merchandise at participating city outlets. Offer cannot be combined with other seasonal sales or clearance items.',
    },
    image: { type: String, default: 'https://picsum.photos/200/300' },
    location: { type: String, default: 'https://maps.google.com' },
    phone: { type: String, default: '1234567890' },
    facebook: { type: String, default: 'https://facebook.com/sample' },
    discountAmount: { type: String, default: '10' },
    show: { type: Boolean, required: true },
});

const steps = [
    'আপনার পছন্দের আউটলেটে গিয়ে কেনাকাটা করুন বা অনলাইনে অর্ডার করুন',
    'অনলাইনে অর্ডারের সময়, যদি থাকে, আপনার লয়্যালটি কুপন কোড ব্যবহার করুন।',
    'পেমেন্টের সময় ক্যাশিয়ারকে আপনার ট্রাভেল ক্লাব কার্ডের কথা জানান।',
    'বিল দেয়ার সময় ক্যাশিয়ারকে কার্ডটি দেখান।',
    'ব্যস! আপনার বিলের ওপর ডিসকাউন্ট পেয়ে যাবেন।',
];
</script>

<style scoped>
.page-fade-enter-active,
.page-fade-leave-active {
    transition: all 0.3s ease-out;
}

.page-fade-enter-from {
    opacity: 0;
    transform: translateY(20px);
}

.page-fade-leave-to {
    opacity: 0;
    transform: translateY(-20px);
}

::-webkit-scrollbar {
    width: 4px;
}
::-webkit-scrollbar-track {
    background: transparent;
}
::-webkit-scrollbar-thumb {
    background: #f3922140; /* Light version of your theme color */
    border-radius: 10px;
}
</style>
