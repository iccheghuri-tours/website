<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { Icon } from '@iconify/vue';
import { dashboard, login, register } from '@/routes';

// Props with defaults
withDefaults(
    defineProps<{
        canRegister: boolean;
    }>(),
    {
        canRegister: true,
    },
);

// Features list remains the same but organized for better visual flow
const features = [
    {
        title: 'বাজেট ট্যুর',
        desc: 'সাধ্যের মধ্যে সেরা ভ্রমণ প্যাকেজ ',
        icon: 'solar:wallet-money-bold-duotone',
    },
    {
        title: 'ফ্যামিলি ট্যুর',
        desc: 'পুরো পরিবারের জন্য আনন্দময় সফর',
        icon: 'solar:users-group-rounded-bold-duotone',
    },
    {
        title: 'হানিমুন প্যাকেজ',
        desc: 'কাপলদের জন্য রোমান্টিক সব আয়োজন',
        icon: 'solar:heart-bold-duotone',
    },
    {
        title: 'কর্পোরেট ট্যুর',
        desc: 'অফিস টিমের জন্য চমৎকার ভ্রমণ প্যাকেজ',
        icon: 'solar:buildings-bold-duotone',
    },
    {
        title: 'শিক্ষা সফর',
        desc: 'আনন্দ আর শেখার এক দারুণ অভিজ্ঞতা',
        icon: 'solar:notebook-bold-duotone',
    },
    {
        title: 'সেরা গাইড',
        desc: 'দক্ষ ও স্থানীয় গাইডের সাথে নিশ্চিন্ত ভ্রমণ',
        icon: 'solar:map-point-wave-bold-duotone',
    },
    {
        title: 'ভিসা প্রসেসিং',
        desc: 'ঝামেলাহীন ও দ্রুত ভিসা সহায়তা',
        icon: 'solar:passport-bold-duotone',
    },
    {
        title: 'এয়ার টিকিট',
        desc: 'সবচেয়ে কম দামে বিমানের টিকিট',
        icon: 'solar:plain-bold-duotone',
    },
    {
        title: 'হোটেল ও রিসোর্ট',
        desc: 'আরামদায়ক থাকার সেরা সব ব্যবস্থা',
        icon: 'mdi:hotel',
    },
    {
        title: 'আন্তর্জাতিক ট্যুর',
        desc: 'দেশ ছেড়ে বিদেশের মাটিতে নতুন অভিজ্ঞতা',
        icon: 'mdi:globe',
    },
    {
        title: 'নিরাপদ ভ্রমণ',
        desc: 'আপনার নিরাপত্তাই আমাদের সবচেয়ে বড় লক্ষ্য',
        icon: 'solar:shield-check-bold-duotone',
    },
    {
        title: 'সহজ বুকিং',
        desc: 'এক ক্লিকেই বুকিং করুন খুব সহজে',
        icon: 'solar:mouse-circle-bold-duotone',
    },
];
</script>

<template>
    <Head title="ইচ্ছেঘুড়ি - স্বল্প বাজেটে সারা বাংলাদেশ ঘুরি" />

    <div
        class="min-h-screen bg-[#FAFAFA] font-sans text-[#1b1b18] selection:bg-[#ff9542]/30"
    >
        <div
            class="bg-[#ff9542] px-6 py-1.5 text-center text-[10px] font-bold tracking-widest text-white uppercase lg:text-xs"
        >
            Explore Bangladesh with Confidence
        </div>

        <nav
            class="sticky top-0 z-50 flex h-16 items-center justify-between border-b border-gray-100 bg-white/90 px-4 backdrop-blur-xl lg:px-12"
        >
            <div class="flex items-center gap-2">
                <img src="/images/logo.svg" alt="Logo" class="h-8 w-auto" />
                <span class="text-xl font-black tracking-tight text-[#ff9542]"
                    >ইচ্ছেঘুড়ি</span
                >
            </div>

            <div class="flex items-center gap-2 sm:gap-3">
                <template v-if="$page.props.auth.user">
                    <div class="flex items-center gap-2">
                        <Link
                            :href="`/points/${$page.props.auth.user.slug}`"
                            class="flex items-center gap-2 rounded-2xl bg-[#fff4ed] p-1.5 pr-3 transition-all hover:bg-[#ffe8d9] active:scale-95 sm:pr-4"
                        >
                            <div
                                class="flex h-7 w-7 items-center justify-center rounded-lg bg-[#ff9542] text-white shadow-sm sm:h-8 sm:w-8 sm:rounded-xl"
                            >
                                <Icon
                                    icon="solar:card-2-bold"
                                    class="h-4 w-4 sm:h-5 sm:w-5"
                                />
                            </div>
                            <div class="flex flex-col">
                                <span
                                    class="text-[8px] font-black text-[#ff9542]/60 uppercase sm:text-[9px]"
                                    >Points</span
                                >
                                <span
                                    class="text-xs leading-none font-black text-[#ff9542] sm:text-sm"
                                    >{{
                                        $page.props.auth.user.points ?? 0
                                    }}</span
                                >
                            </div>
                        </Link>

                        <Link
                            :href="dashboard()"
                            class="flex items-center gap-2 rounded-2xl border border-gray-100 bg-white p-1.5 pr-3 transition-all hover:border-[#ff9542]/20 hover:shadow-md active:scale-95 sm:pr-4"
                        >
                            <div
                                class="flex h-7 w-7 items-center justify-center rounded-lg bg-gray-50 text-gray-500 sm:h-8 sm:w-8 sm:rounded-xl"
                            >
                                <Icon
                                    icon="solar:user-circle-bold"
                                    class="h-5 w-5 sm:h-6 sm:w-6"
                                />
                            </div>
                            <span
                                class="hidden text-sm font-bold text-gray-700 sm:block"
                                >Account</span
                            >
                        </Link>
                    </div>
                </template>
                <template v-else>
                    <Link
                        :href="login()"
                        class="px-2 text-xs font-bold text-gray-500 hover:text-[#ff9542] sm:px-3 sm:text-sm"
                        >Log in</Link
                    >
                    <Link
                        v-if="canRegister"
                        :href="register()"
                        class="rounded-xl bg-[#ff9542] px-4 py-2 text-xs font-bold text-white shadow-lg shadow-[#ff9542]/25 transition-transform hover:-translate-y-0.5 sm:rounded-2xl sm:px-6 sm:py-2.5 sm:text-sm"
                    >
                        Join Now
                    </Link>
                </template>
            </div>
        </nav>

        <main>
            <section class="relative overflow-hidden px-6 py-12 lg:py-24">
                <div class="mx-auto max-w-7xl">
                    <div
                        class="grid grid-cols-1 gap-16 lg:grid-cols-2 lg:items-center"
                    >
                        <div class="relative z-10 text-center lg:text-left">
                            <div
                                class="mb-6 inline-flex items-center gap-2 rounded-full bg-[#fff4ed] py-1.5 pr-4 pl-2 text-xs font-bold text-[#ff9542]"
                            >
                                #1 Budget Travel Agency in Rangpur
                            </div>
                            <h1
                                class="mb-6 text-4xl leading-[1.15] font-black text-slate-900 lg:text-7xl"
                            >
                                স্বল্প বাজেটে সারা <br />
                                <span class="relative">
                                    <span class="relative z-10 text-[#ff9542]"
                                        >বাংলাদেশ ঘুরি</span
                                    >
                                    <svg
                                        class="absolute -bottom-2 left-0 z-0 hidden w-full md:block"
                                        height="12"
                                        viewBox="0 0 200 12"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M2 10C50 2 150 2 198 10"
                                            stroke="#ff9542"
                                            stroke-width="4"
                                            stroke-linecap="round"
                                        />
                                    </svg> </span
                                >, <br />
                                সাথে আছে
                                <span class="text-[#ff9542]">ইচ্ছেঘুড়ি</span>
                            </h1>
                            <p
                                class="text-md mb-10 leading-relaxed text-gray-500 lg:max-w-md"
                            >
                                Experience Bangladesh like never before. We
                                offer the best budget-friendly tour packages for
                                students, families, and solo travelers.
                            </p>

                            <div
                                class="flex flex-col gap-4 sm:flex-row lg:justify-start"
                            >
                                <a
                                    href="https://packages.iccheghuritours.com"
                                    target="_blank"
                                    class="group flex items-center justify-center gap-3 rounded-2xl bg-[#ff9542] px-8 py-4 text-lg font-bold text-white shadow-2xl shadow-[#ff9542]/40 transition-all hover:scale-[1.03] hover:bg-[#f38630]"
                                >
                                    <Icon
                                        icon="solar:bag-check-bold"
                                        class="h-6 w-6 transition-transform group-hover:rotate-12"
                                    />
                                    প্যাকেজসমূহ দেখুন
                                </a>
                                <div class="flex gap-3">
                                    <a
                                        :href="'tel:01660160911'"
                                        class="flex flex-1 items-center justify-center gap-2 rounded-2xl border border-gray-200 bg-white px-5 py-4 text-lg font-bold text-gray-700 transition-all hover:border-[#ff9542]/30 hover:bg-gray-50"
                                    >
                                        <Icon
                                            icon="solar:phone-calling-bold"
                                            class="h-6 w-6 text-[#ff9542]"
                                        />
                                        কল
                                    </a>
                                    <a
                                        href="https://wa.me/8801622347435"
                                        target="_blank"
                                        class="flex flex-1 items-center justify-center gap-2 rounded-2xl border border-[#25D366]/20 bg-white px-5 py-4 text-lg font-bold text-gray-700 transition-all hover:bg-[#25D366] hover:text-white"
                                    >
                                        <Icon
                                            icon="logos:whatsapp-icon"
                                            class="h-6 w-6"
                                        />
                                        ওয়াটস্যাপ
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="relative px-2 sm:px-4">
                            <div
                                class="animate-float relative flex flex-col items-center justify-center rounded-[2.5rem] bg-white p-8 py-16 shadow-[0_32px_64px_-16px_rgba(0,0,0,0.1)] ring-1 ring-gray-100 sm:aspect-square sm:rounded-[3rem] sm:p-12"
                            >
                                <div
                                    class="mb-6 flex h-28 w-28 items-center justify-center rounded-full bg-[#fff4ed] p-6 sm:mb-8 sm:h-40 sm:w-40 sm:p-8"
                                >
                                    <img
                                        src="/images/logo.svg"
                                        alt="Iccheghuri"
                                        class="h-full w-auto drop-shadow-xl"
                                    />
                                </div>

                                <h3
                                    class="text-4xl font-black text-gray-900 sm:text-5xl"
                                >
                                    ইচ্ছেঘুড়ি
                                </h3>
                                <p
                                    class="mt-4 text-center text-sm leading-relaxed font-medium text-gray-400 sm:text-base"
                                >
                                    Budget Friendly Tour Organizer <br />
                                    <span
                                        class="text-[10px] font-bold tracking-widest text-[#ff9542]/60 uppercase sm:text-xs"
                                        >Based in Rangpur</span
                                    >
                                </p>

                                <div
                                    class="absolute -bottom-8 left-1/2 flex w-[90%] -translate-x-1/2 items-center justify-center gap-4 rounded-3xl bg-white px-6 py-4 shadow-[0_20px_50px_rgba(0,0,0,0.1)] ring-1 ring-gray-100 sm:-bottom-6 sm:w-auto sm:gap-6 sm:px-8 sm:py-5"
                                >
                                    <div class="text-center">
                                        <p
                                            class="text-[9px] font-black tracking-wider text-gray-400 uppercase sm:text-[10px]"
                                        >
                                            Successful Tours
                                        </p>
                                        <p
                                            class="text-xl font-black text-[#ff9542] sm:text-2xl"
                                        >
                                            50+
                                        </p>
                                    </div>
                                    <div
                                        class="h-8 w-px bg-gray-100 sm:h-10"
                                    ></div>
                                    <div class="text-center">
                                        <p
                                            class="text-[9px] font-black tracking-wider text-gray-400 uppercase sm:text-[10px]"
                                        >
                                            Happy Clients
                                        </p>
                                        <p
                                            class="text-xl font-black text-[#ff9542] sm:text-2xl"
                                        >
                                            2k+
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="absolute -top-10 -right-4 -z-10 h-48 w-48 rounded-full bg-[#ff9542]/5 blur-3xl sm:-right-10 sm:h-64 sm:w-64"
                            ></div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="bg-white px-6 py-16">
                <div class="mx-auto max-w-7xl">
                    <div class="mb-12 text-center">
                        <h2
                            class="text-3xl font-black text-slate-900 md:text-4xl"
                        >
                            আমাদের সেবাসমূহ
                        </h2>
                        <div
                            class="mx-auto mt-4 h-1 w-20 rounded-full bg-[#ff9542]"
                        ></div>
                    </div>
                    <div class="grid grid-cols-2 gap-8 md:grid-cols-4">
                        <div
                            v-for="feat in features"
                            :key="feat.title"
                            class="group text-center"
                        >
                            <div
                                class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-[#fff4ed] text-[#ff9542] transition-colors group-hover:bg-[#ff9542] group-hover:text-white"
                            >
                                <Icon :icon="feat.icon" class="h-8 w-8" />
                            </div>
                            <h4 class="font-bold text-gray-900">
                                {{ feat.title }}
                            </h4>
                            <p class="text-xs text-gray-500">{{ feat.desc }}</p>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <footer class="bg-[#1b1b18] pt-20 pb-10 text-white">
            <div class="mx-auto max-w-7xl px-6">
                <div class="grid grid-cols-1 gap-12 lg:grid-cols-4 lg:gap-8">
                    <div class="space-y-6">
                        <div class="flex items-center gap-2">
                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#ff9542] p-1"
                            >
                                <img
                                    src="/images/logo.svg"
                                    alt="Logo"
                                    class="h-full w-auto brightness-0 invert"
                                />
                            </div>
                            <span
                                class="text-2xl font-black tracking-tight text-white"
                                >ইচ্ছেঘুড়ি</span
                            >
                        </div>
                        <p class="text-sm leading-relaxed text-gray-400">
                            আমরা বিশ্বাস করি ভ্রমণ সবার জন্য। সাধ্যের মধ্যে সেরা
                            মানের ট্যুর প্যাকেজ নিয়ে আমরা আছি আপনার পাশে। স্বল্প
                            টাকায় দেশ ও বিদেশ ঘুরে দেখুন আমাদের সাথে।
                        </p>
                        <div class="flex gap-4">
                            <a
                                href="https://wa.me/8801622347435"
                                target="_blank"
                                class="flex h-10 w-10 items-center justify-center rounded-full bg-white/5 transition-colors hover:bg-[#ff9542]"
                            >
                                <Icon icon="mdi:whatsapp" class="h-5 w-5" />
                            </a>
                            <a
                                href="https://facebook.com/iccheghuri.tours"
                                target="_blank"
                                class="flex h-10 w-10 items-center justify-center rounded-full bg-white/5 transition-colors hover:bg-[#ff9542]"
                            >
                                <Icon icon="mdi:facebook" class="h-5 w-5" />
                            </a>
                            <a
                                href="https://instagram.com/iccheghuri.tours"
                                target="_balnk"
                                class="flex h-10 w-10 items-center justify-center rounded-full bg-white/5 transition-colors hover:bg-[#ff9542]"
                            >
                                <Icon icon="mdi:instagram" class="h-5 w-5" />
                            </a>
                        </div>
                    </div>

                    <div>
                        <h4 class="mb-6 text-lg font-bold">প্রয়োজনীয় লিংক</h4>
                        <ul class="space-y-4 text-sm text-gray-400">
                            <li>
                                <a
                                    href="#"
                                    class="transition-colors hover:text-[#ff9542]"
                                    >আমাদের সম্পর্কে</a
                                >
                            </li>
                            <li>
                                <a
                                    href="https://packages.iccheghuritours.com"
                                    class="transition-colors hover:text-[#ff9542]"
                                    >সব প্যাকেজ</a
                                >
                            </li>
                            <li>
                                <a
                                    href="https://www.facebook.com/groups/iccheghuri.community"
                                    class="transition-colors hover:text-[#ff9542]"
                                    >কমিউনিটি
                                </a>
                            </li>
                            <li>
                                <a
                                    href="https://maps.app.goo.gl/7WAbKJ4VVrNTGVFq9"
                                    class="transition-colors hover:text-[#ff9542]"
                                    >আমাদের রিভিউ</a
                                >
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="mb-6 text-lg font-bold">যোগাযোগ</h4>
                        <ul class="space-y-4 text-sm text-gray-400">
                            <li class="flex items-start gap-3">
                                <Icon
                                    icon="solar:map-point-bold"
                                    class="mt-1 h-5 w-5 text-[#ff9542]"
                                />
                                <span
                                    >অফিস: লালবাগ, জনতা ব্যাংক সংলগ্ন, কে ডি সি
                                    রোড, রংপুর</span
                                >
                            </li>
                            <li class="flex items-center gap-3">
                                <Icon
                                    icon="solar:phone-bold"
                                    class="h-5 w-5 text-[#ff9542]"
                                />
                                <span>01660-160911</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <Icon
                                    icon="solar:letter-bold"
                                    class="h-5 w-5 text-[#ff9542]"
                                />
                                <span>support@iccheghuritours.com</span>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="mb-6 text-lg font-bold">নিউজলেটার</h4>
                        <p class="mb-4 text-sm text-gray-400">
                            নতুন অফার ও ট্যুর আপডেট পেতে সাবস্ক্রাইব করুন।
                        </p>
                        <form class="relative">
                            <input
                                type="email"
                                placeholder="আপনার ইমেইল"
                                class="w-full rounded-2xl border-none bg-white/5 px-4 py-3 text-sm focus:ring-2 focus:ring-[#ff9542]"
                            />
                            <button
                                class="absolute top-1 right-1 rounded-xl bg-[#ff9542] px-4 py-2 text-sm font-bold transition-all hover:bg-[#f38630]"
                            >
                                Join
                            </button>
                        </form>
                    </div>
                </div>

                <div class="mt-20 border-t border-white/5 pt-10 text-center">
                    <p class="text-xs font-medium text-gray-500">
                        &copy; 2026 ইচ্ছেঘুড়ি (Iccheghuri). All Rights
                        Reserved. <br class="sm:hidden" />
                        Developed by
                        <a href="https://tajimz.xyz" target="_blank"
                            ><span class="text-orange-400">Tajim Z</span></a
                        >
                    </p>
                </div>
            </div>
        </footer>
    </div>
</template>

<style>
@keyframes float {
    0% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-15px);
    }
    100% {
        transform: translateY(0px);
    }
}

.animate-float {
    animation: float 6s ease-in-out infinite;
}

body {
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
</style>
