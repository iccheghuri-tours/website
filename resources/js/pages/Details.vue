<template>
  <div class="min-h-screen bg-zinc-950 text-zinc-100 font-sans p-4 pb-12">
    <header class="flex justify-between items-center mb-8 pt-2">
      <button class="p-2 bg-zinc-900 rounded-full border border-zinc-800 active:scale-90 transition-transform">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
        </svg>
      </button>
      <span class="text-zinc-500 font-medium text-sm tracking-wide uppercase">Partner Details</span>
      <div class="w-10"></div> 
    </header>

    <div class="flex flex-col items-center text-center mb-8">
      <div class="w-24 h-24 rounded-3xl bg-zinc-900 border border-zinc-800 p-4 mb-4 shadow-xl">
        <img :src="image" :alt="name" class="w-full h-full object-contain" />
      </div>
      <h1 class="text-2xl font-bold tracking-tight mb-1">{{ name }}</h1>
    </div>

    <div class="bg-gradient-to-br from-emerald-500/20 to-emerald-900/10 border border-emerald-500/30 rounded-3xl p-6 mb-8 relative overflow-hidden">
      <div class="relative z-10">
        <span class="text-emerald-400 font-bold uppercase tracking-widest text-xs">Current Offer</span>
        <h2 class="text-4xl font-black text-emerald-400 mt-1">{{ discountAmount }}10% OFF</h2>
        <p class="text-emerald-200/60 text-sm mt-1">Exclusive for Loyalty Members</p>
      </div>
      <div class="absolute -right-8 -top-8 w-32 h-32 bg-emerald-500/10 rounded-full blur-3xl"></div>
    </div>

    <div class="grid grid-cols-3 gap-3 mb-10">
      <a :href="location" target="_blank" class="flex flex-col items-center justify-center p-4 bg-zinc-900 border border-zinc-800 rounded-2xl active:scale-95 transition-transform">
        <span class="text-xl mb-1">📍</span>
        <span class="text-[10px] font-bold uppercase tracking-tighter text-zinc-400">Map</span>
      </a>
      <a :href="facebook" target="_blank" class="flex flex-col items-center justify-center p-4 bg-zinc-900 border border-zinc-800 rounded-2xl active:scale-95 transition-transform">
        <span class="text-xl mb-1">🌐</span>
        <span class="text-[10px] font-bold uppercase tracking-tighter text-zinc-400">Social</span>
      </a>
      <a :href="'tel:' + phone" class="flex flex-col items-center justify-center p-4 bg-zinc-900 border border-zinc-800 rounded-2xl active:scale-95 transition-transform">
        <span class="text-xl mb-1">📞</span>
        <span class="text-[10px] font-bold uppercase tracking-tighter text-zinc-400">Call</span>
      </a>
    </div>

    <div class="mb-10 px-1">
      <h3 class="text-lg font-semibold mb-3">Terms & Conditions</h3>
      <p class="text-zinc-400 text-sm leading-relaxed">
        This discount is applicable on all full-priced merchandise at participating city outlets. Offer cannot be combined with other seasonal sales or clearance items. Valid specifically for our premium
      </p>
    </div>

    <div class="space-y-6 px-1">
      <h3 class="text-lg font-semibold">How to redeem</h3>
      <div class="space-y-6">
        <div v-for="(step, index) in steps" :key="index" class="flex gap-4">
          <div class="flex-none w-8 h-8 rounded-full bg-zinc-900 flex items-center justify-center text-xs font-bold text-emerald-500 border border-zinc-800">
            {{ index + 1 }}
          </div>
          <p class="text-zinc-400 text-sm leading-relaxed pt-1">{{ step }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  name: { type: String, default: "Sample Name" },
  details: { 
    type: String, 
    default: "This discount is applicable on all full-priced merchandise at participating city outlets. Offer cannot be combined with other seasonal sales or clearance items. Valid specifically for our premium collection and electronic accessories." 
  },
  image: { type: String, default: "https://picsum.photos/200/300" },
  location: { type: String, default: "https://maps.google.com" },
  phone: { type: String, default: "1234567890" },
  facebook: { type: String, default: "https://facebook.com/sample" },
  discountAmount: { type: String, default: "10%" }
});

const steps = [
  'Visit the partner outlet and shop your favorite items.',
  'Inform the cashier about your loyalty membership.',
  'Scan the QR code available at the counter via this app.',
  'The discount will be applied automatically to your bill.'
];
</script>