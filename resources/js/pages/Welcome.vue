<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { Icon } from '@iconify/vue';
import { dashboard, login, register } from '@/routes';

withDefaults(
    defineProps<{
        canRegister: boolean;
    }>(),
    {
        canRegister: true,
    },
);

const features = [
    { title: 'বাজেট ট্যুর', desc: 'অল্প টাকায় সেরা অফার', icon: 'solar:wallet-money-bold-duotone' },
    { title: 'সেরা গাইড', desc: 'Expert local guides', icon: 'solar:map-point-wave-bold-duotone' },
    { title: 'নিরাপদ ভ্রমণ', desc: 'Safety first always', icon: 'solar:shield-check-bold-duotone' },
    { title: 'সহজ বুকিং', desc: 'Instant confirmation', icon: 'solar:wad-of-money-bold-duotone' },
];
</script>

<template>
    <Head title="ইচ্ছেঘুড়ি - অল্প টাকায় সারা বাংলাদেশ ঘুরি" />

    <div class="min-h-screen bg-[#FDFDFC] font-sans text-[#1b1b18]">
        
        <div class="bg-[#ff9542] px-6 py-2 text-center text-xs font-bold text-white lg:text-sm">
            <div class="mx-auto flex max-w-7xl items-center justify-center gap-4">
                <span class="flex items-center gap-1">
                    <Icon icon="solar:phone-calling-bold" class="h-4 w-4" /> 01660160911
                </span>
                <span class="hidden h-3 w-px bg-white/30 sm:block"></span>
                <span class="hidden sm:block">বাজেট ট্যুর প্যাকেজ নিয়ে আমরা আছি আপনার পাশে!</span>
            </div>
        </div>

        <nav class="sticky top-0 z-50 flex h-16 items-center justify-between border-b border-gray-100 bg-white/80 px-6 backdrop-blur-md">
            <div class="flex items-center gap-2">
                <img src="/images/logo.svg" alt="Logo" class="h-8 w-auto" />
                <span class="text-xl font-black tracking-tight text-[#ff9542]">ইচ্ছেঘুড়ি</span>
            </div>

            <div class="flex items-center gap-3">
                <template v-if="$page.props.auth.user">
                    <Link :href="dashboard()" class="text-sm font-bold text-gray-600">Dashboard</Link>
                </template>
                <template v-else>
                    <Link :href="login()" class="text-sm font-bold text-gray-600">Log in</Link>
                    <Link
                        v-if="canRegister"
                        :href="register()"
                        class="rounded-full bg-[#ff9542] px-5 py-2 text-sm font-bold text-white shadow-lg shadow-[#ff9542]/20"
                    >
                        Join
                    </Link>
                </template>
            </div>
        </nav>

        <main>
            <section class="relative overflow-hidden px-6 py-12 lg:py-24">
                <div class="mx-auto max-w-7xl">
                    <div class="grid grid-cols-1 gap-12 lg:grid-cols-2 lg:items-center">
                        
                        <div class="z-10 text-center lg:text-left">
                            <h2 class="mb-4 inline-block rounded-lg bg-[#fff4ed] px-3 py-1 text-sm font-bold text-[#ff9542]">
                                #1 Budget Travel Agency in Rangpur
                            </h2>
                            <h1 class="mb-6 text-4xl font-black leading-tight text-slate-900 lg:text-6xl">
                                অল্প টাকায় সারা <br/> 
                                <span class="text-[#ff9542]">বাংলাদেশ ঘুরি</span>, <br/>
                                সাথে আছে ইচ্ছেঘুড়ি !
                            </h1>
                            <p class="mb-10 text-lg text-gray-500 lg:max-w-md">
                                Experience Bangladesh like never before. We offer the best budget-friendly tour packages for students, families, and solo travelers.
                            </p>

                            <div class="flex flex-col gap-4 sm:flex-row lg:justify-start">
                                <a
                                    href="https://facebook.com/iccheghuri.tours"
                                    target="_blank"
                                    class="flex items-center justify-center gap-2 rounded-2xl bg-[#ff9542] px-8 py-4 text-lg font-bold text-white shadow-xl shadow-[#ff9542]/30 transition-transform hover:scale-[1.02]"
                                >
                                    <Icon icon="solar:bag-check-bold" class="h-6 w-6" />
                                    বুকিং করুন
                                </a>
                                <a
                                    :href="'tel:01660160911'"
                                    class="flex items-center justify-center gap-2 rounded-2xl border-2 border-gray-100 bg-white px-8 py-4 text-lg font-bold text-gray-700 transition-colors hover:bg-gray-50"
                                >
                                    <Icon icon="solar:phone-linear" class="h-6 w-6 text-[#ff9542]" />
                                    কল করুন
                                </a>
                            </div>
                        </div>

                        <div class="relative">
                            <div class="absolute -inset-4 rotate-2 rounded-[2rem] bg-[#fff4ed]"></div>
                            <div class="relative flex aspect-square flex-col items-center justify-center rounded-[2rem] bg-white p-12 shadow-2xl ring-1 ring-gray-100">
                                <div class="mb-6 flex h-32 w-32 items-center justify-center rounded-full bg-[#ff9542]/10">
                                    <img src="/images/logo.svg" alt="Iccheghuri" class="h-20 w-auto" />
                                </div>
                                <h3 class="text-4xl font-black text-gray-900">ইচ্ছেঘুড়ি</h3>
                                <p class="mt-2 text-center text-sm font-medium text-gray-400">
                                    Budget Friendly Tour Organizer <br/> Based in Rangpur
                                </p>
                                
                                <div class="absolute -bottom-4 left-1/2 flex -translate-x-1/2 items-center gap-4 rounded-2xl bg-white p-4 shadow-xl ring-1 ring-gray-100">
                                    <div class="text-center">
                                        <p class="text-xs font-bold text-gray-400 uppercase">Packages</p>
                                        <p class="font-black text-[#ff9542]">50+</p>
                                    </div>
                                    <div class="h-8 w-px bg-gray-100"></div>
                                    <div class="text-center">
                                        <p class="text-xs font-bold text-gray-400 uppercase">Happy Clients</p>
                                        <p class="font-black text-[#ff9542]">2k+</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="bg-white px-6 py-16">
                <div class="mx-auto max-w-7xl">
                    <div class="grid grid-cols-2 gap-8 md:grid-cols-4">
                        <div v-for="feat in features" :key="feat.title" class="group text-center">
                            <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-[#fff4ed] text-[#ff9542] transition-colors group-hover:bg-[#ff9542] group-hover:text-white">
                                <Icon :icon="feat.icon" class="h-8 w-8" />
                            </div>
                            <h4 class="font-bold text-gray-900">{{ feat.title }}</h4>
                            <p class="text-xs text-gray-500">{{ feat.desc }}</p>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <footer class="border-t border-gray-100 bg-white px-6 py-12">
            <div class="mx-auto max-w-7xl text-center">
                <div class="mb-6 flex justify-center gap-6">
                    <a href="https://facebook.com/iccheghuri.tours" target="_blank" class="text-gray-400 hover:text-[#ff9542]">
                        <Icon icon="brandico:facebook-rect" class="h-6 w-6" />
                    </a>
                    <a href="https://facebook.com/iccheghuri.tours" target="_blank" class="text-gray-400 hover:text-[#ff9542]">
                        <Icon icon="mdi:instagram" class="h-6 w-6" />
                    </a>
                    
                </div>
                <p class="text-sm text-gray-400">
                    &copy; 2026 ইচ্ছেঘুড়ি (Iccheghuri). Developed By 
                    <a href="https://facebook.com/trtajim" target="_blank" class=" text-[#ff9542]">
                        Tajim
                    </a>. 
                </p>
            </div>
        </footer>
    </div>
</template>

<style scoped>
/* Optional: Soft page transitions */
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.5s ease;
}
</style>