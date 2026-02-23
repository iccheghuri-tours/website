<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { home } from '@/routes';

defineProps<{
    title?: string;
    description?: string;
}>();
</script>

<template>
    <div class="flex min-h-svh flex-col items-center justify-center bg-[#FDFDFC] p-6">
        
        <div class="fixed -top-20 -right-20 h-64 w-64 rounded-full bg-[#ff9542]/5 lg:block"></div>

        <div class="w-full max-w-[400px]">
            <div class="flex flex-col gap-8">
                <div class="flex flex-col items-center gap-3">
                    <Link :href="home()" class="transition-transform hover:scale-105">
                        <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-white shadow-xl shadow-[#ff9542]/10 ring-1 ring-gray-100">
                             <img src="/images/logo.svg" alt="Logo" class="h-10 w-auto p-2" />
                        </div>
                    </Link>
                    
                    <div class="space-y-1 text-center">
                        <h1 class="text-2xl font-black tracking-tight text-slate-900">{{ title }}</h1>
                        <p class="text-sm font-medium text-gray-500">
                            {{ description }}
                        </p>
                    </div>
                </div>

                <div class="rounded-[2rem] border border-gray-100 bg-white p-8 shadow-2xl shadow-gray-200/50">
                    <slot />
                </div>
            </div>
            
            <p class="mt-8 text-center text-xs text-gray-400">
                &copy; 2026 ইচ্ছেঘুড়ি - Travel with Trust
            </p>
        </div>
    </div>
</template>