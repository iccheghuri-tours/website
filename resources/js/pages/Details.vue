<template>
  <Teleport to="body">
    <Transition name="page-fade">
      <div
        v-if="show"
        class="fixed inset-0 z-[70] flex flex-col bg-white overflow-y-auto transition-colors duration-300"
      >
        <header class="sticky top-0 z-20 flex justify-between items-center w-full p-4 bg-white/80 backdrop-blur-md border-b border-orange-100">
          <button @click="$emit('close')" class="p-2 bg-orange-50 rounded-full border border-[#f39221]/20 active:scale-90 transition-transform text-[#f39221]">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
          </button>
          <span class="text-slate-400 font-semibold text-xs tracking-widest uppercase">Partner Details</span>
          <div class="w-10"></div>
        </header>

        <main class="flex-1 w-full max-w-2xl mx-auto p-6 pb-20">
          
          <div class="flex flex-col items-center text-center mt-4 mb-8">
            <div class="w-32 h-32 rounded-3xl bg-white border border-orange-100 p-4 mb-4 shadow-xl shadow-orange-500/5">
              <img :src="image" :alt="name" class="w-full h-full object-contain rounded-2xl" />
            </div>
            <h1 class="text-3xl font-bold tracking-tight text-slate-900 mb-1">{{ name }}</h1>
            <p class="text-slate-500 text-sm font-medium">Official Partner</p>
          </div>

          <div class="bg-gradient-to-br from-[#fff8f0] to-white border border-[#f39221]/30 rounded-3xl p-8 mb-8 relative overflow-hidden shadow-sm">
            <div class="relative z-10 text-center">
              <span class="text-[#f39221] font-bold uppercase tracking-widest text-xs">Current Offer</span>
              <h2 class="text-5xl font-black text-[#f39221] mt-2">{{ discountAmount }}% OFF</h2>
              <p class="text-[#f39221]/70 text-base mt-2 font-medium">Exclusive for Iccheghuri Card Holders</p>
            </div>
            <div class="absolute -right-12 -top-12 w-40 h-40 bg-[#f39221]/10 rounded-full blur-3xl"></div>
          </div>

          <div class="grid grid-cols-3 gap-4 mb-10">
            <a :href="location" target="_blank" class="flex flex-col items-center justify-center p-5 bg-orange-50/30 border border-orange-100 rounded-2xl active:scale-95 transition-all hover:border-[#f39221]/40 hover:bg-orange-50">
              <span class="text-2xl mb-2">📍</span>
              <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500">Map</span>
            </a>
            <a :href="facebook" target="_blank" class="flex flex-col items-center justify-center p-5 bg-orange-50/30 border border-orange-100 rounded-2xl active:scale-95 transition-all hover:border-[#f39221]/40 hover:bg-orange-50">
              <span class="text-2xl mb-2">🌐</span>
              <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500">Social</span>
            </a>
            <a :href="'tel:' + phone" class="flex flex-col items-center justify-center p-5 bg-orange-50/30 border border-orange-100 rounded-2xl active:scale-95 transition-all hover:border-[#f39221]/40 hover:bg-orange-50">
              <span class="text-2xl mb-2">📞</span>
              <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500">Call</span>
            </a>
          </div>

          <div class="space-y-10">
            <section>
              <h3 class="text-xl font-bold mb-3 text-slate-900">অফারটির শর্তসমূহ :</h3>
              <p class="text-slate-600 text-base leading-relaxed">
                {{ details }}
              </p>
            </section>

            <section>
              <h3 class="text-xl font-bold mb-4 text-slate-900">অফারটি যেভাবে পাবেন : </h3>
              <div class="space-y-4">
                <div v-for="(step, index) in steps" :key="index" class="flex gap-5 items-start">
                  <div class="flex-none w-10 h-10 rounded-2xl bg-[#fff8f0] flex items-center justify-center text-sm font-bold text-[#f39221] border border-[#f39221]/20">
                    {{ index + 1 }}
                  </div>
                  <p class="text-slate-600 text-base leading-6 self-center">
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
  name: { type: String, default: "Sample Name" },
  details: { type: String, default: "This discount is applicable on all full-priced merchandise at participating city outlets. Offer cannot be combined with other seasonal sales or clearance items." },
  image: { type: String, default: "https://picsum.photos/200/300" },
  location: { type: String, default: "https://maps.google.com" },
  phone: { type: String, default: "1234567890" },
  facebook: { type: String, default: "https://facebook.com/sample" },
  discountAmount: { type: String, default: "10" },
  show: { type: Boolean, required: true }
});

const steps = [
  'আপনার পছন্দের আউটলেটে গিয়ে কেনাকাটা করুন।',
  'পেমেন্টের সময় ক্যাশিয়ারকে আপনার ট্রাভেল ক্লাব কার্ডের কথা জানান।',
  'বিল দেয়ার সময় ক্যাশিয়ারকে কার্ডটি দেখান।',
  'ব্যস! আপনার বিলের ওপর ডিসকাউন্ট পেয়ে যাবেন।'
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