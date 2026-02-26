<script setup lang="ts">
import { ref, watch, nextTick, computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import { Icon } from '@iconify/vue';

const navLinks = [
  { href: '/admin', label: 'Dashboard', icon: 'lucide:layout-dashboard' },
  { href: '/admin/users', label: 'Users', icon: 'lucide:users' },
  { href: '/admin/partners', label: 'Partners', icon: 'lucide:handshake' },
  { href: '/admin/offers', label: 'Offers', icon: 'lucide:tag' },
  { href: '/admin/custom-requests', label: 'Requests', icon: 'lucide:message-square' },
  { href: '/admin/mail', label: 'Email', icon: 'lucide:mail' },
];

const scrollContainer = ref<HTMLElement | null>(null);
const page = usePage();

const user = computed(() => page.props.auth?.user);

const isActive = (href: string) => href === '/admin' ? page.url === '/admin' || page.url === '/admin/' : page.url.startsWith(href);

watch(() => page.url, async () => {
  await nextTick();
  scrollContainer.value?.querySelector('.active-link')?.scrollIntoView({ behavior: 'auto', inline: 'center', block: 'nearest' });
}, { immediate: true });

const linkClass = (href: string, mobile = false) => {
  const active = isActive(href);
  if (mobile) {
    return [
      'flex items-center space-x-2 px-4 py-2 rounded-md text-xs font-bold whitespace-nowrap border transition-all',
      active ? 'bg-white text-[#ff9450] border-white active-link' : 'border-white/30 text-white'
    ].join(' ');
  } else {
    return [
      'flex items-center space-x-3 px-4 py-3 rounded-lg font-bold text-sm transition-all',
      active ? 'bg-white text-[#ff9450] active-link' : 'hover:bg-black/10 text-white'
    ].join(' ');
  }
};
</script>

<template>
  <div class="flex flex-col md:flex-row min-h-screen bg-white">
    <!-- Desktop Sidebar -->
    <aside class="hidden md:flex w-64 bg-[#ff9450] text-white shrink-0 flex-col">
      <div class="p-6 flex items-center space-x-4">
        <Link href="/" class="hover:opacity-80 transition-opacity">
          <Icon icon="lucide:home" class="text-2xl" />
        </Link>
        <span class="font-black text-xl tracking-tight uppercase">Admin</span>
      </div>

      <nav class="flex-1 px-3 space-y-1">
        <Link v-for="link in navLinks" :key="link.href" :href="link.href" :class="linkClass(link.href)">
          <Icon :icon="link.icon" class="text-lg" />
          <span>{{ link.label }}</span>
        </Link>
      </nav>

      <div v-if="user" class="p-4 m-3 bg-white/10 rounded-xl border border-white/20">
        <div class="flex items-center space-x-3">
          <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-[#ff9450] shrink-0">
            <Icon icon="lucide:user" class="text-xl" />
          </div>
          <div class="min-w-0">
            <p class="text-sm font-bold truncate">{{ user.name }}</p>
            <p class="text-[10px] opacity-80 truncate">{{ user.email }}</p>
          </div>
        </div>
      </div>
    </aside>

    <!-- Mobile Header -->
    <header class="md:hidden bg-[#ff9450] text-white">
      <div class="p-4 flex items-center justify-between">
        <div class="flex items-center space-x-4">
          <Link href="/" class="p-1">
            <Icon icon="lucide:home" class="text-xl" />
          </Link>
          <span class="font-black uppercase tracking-widest text-sm">Admin Panel</span>
        </div>
        
        <div v-if="user" class="flex items-center space-x-2 bg-black/10 px-3 py-1.5 rounded-full">
           <div class="text-right">
             <p class="text-[10px] font-bold leading-none">{{ user.name }}</p>
           </div>
           <Icon icon="lucide:user-circle" class="text-lg" />
        </div>
      </div>
      
      <nav ref="scrollContainer" class="flex overflow-x-auto no-scrollbar px-4 pb-4 space-x-2">
        <Link v-for="link in navLinks" :key="link.href" :href="link.href" :class="linkClass(link.href, true)">
          <Icon :icon="link.icon" />
          <span>{{ link.label }}</span>
        </Link>
      </nav>
    </header>

    <!-- Main Content -->
    <main class="flex-1 min-w-0 bg-white">
      <div class="p-6 md:p-10">
        <slot />
      </div>
    </main>
  </div>
</template>

<style>
.no-scrollbar::-webkit-scrollbar { display: none; }
.no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

nav {
  -webkit-overflow-scrolling: touch;
}

body {
  margin: 0;
  padding: 0;
  overflow-x: hidden;
}
</style>