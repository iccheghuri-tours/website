<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { Icon } from '@iconify/vue';
import Breadcrumbs from '@/components/Breadcrumbs.vue';
import type { BreadcrumbItem } from '@/types';

withDefaults(
    defineProps<{
        breadcrumbs?: BreadcrumbItem[];
    }>(),
    {
        breadcrumbs: () => [],
    },
);
</script>

<template>
    <header
        class="flex h-16 shrink-0 items-center justify-between border-b border-gray-100 bg-white px-4 transition-[width,height] ease-linear md:px-6"
    >
        <div class="flex items-center gap-4">
            <Link
                href="/"
                class="flex items-center gap-2 rounded-lg px-3 py-2 text-gray-600 transition-colors hover:bg-[#fff4ed] hover:text-[#ff9542]"
                title="প্রচ্ছদ"
            >
                <Icon icon="mdi:home" class="h-5 w-5" />
                <span class="hidden text-sm font-bold md:block">Home</span>
            </Link>

            <div class="h-6 w-px bg-gray-200" v-if="breadcrumbs && breadcrumbs.length > 0"></div>

            <div class="flex items-center gap-2">
                <template v-if="breadcrumbs && breadcrumbs.length > 0">
                    <Breadcrumbs :breadcrumbs="breadcrumbs" />
                </template>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <slot name="right-content" />
        </div>
    </header>
</template>

<style scoped>
/* Ensures the breadcrumb transition is smooth */
header {
    backdrop-filter: blur(8px);
    background-color: rgba(255, 255, 255, 0.9);
}
</style>