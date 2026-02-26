<script setup>
import { Link } from '@inertiajs/vue3';
import AdminLayout from '../AdminLayout.vue';
import { computed, ref } from 'vue';
import { Icon } from '@iconify/vue';


const props = defineProps({ data: Array });
const search = ref('');
const filteredUsers = computed(() => {
  return props.data.filter(user =>
    user.name.toLowerCase().includes(search.value.trim().toLowerCase()) ||
    user.phone.toLowerCase().includes(search.value.trim().toLowerCase()) ||
    user.email.toLowerCase().includes(search.value.trim().toLowerCase())
  )
});
</script>

<template>
  <AdminLayout>
    <div class="flex items-start justify-between mb-6">
      <div>
        <h1 class="text-[25px] font-bold text-black">Admin/Users</h1>
        <p class="text-black">Current Users:</p>
      </div>

      <Link 
        href="/admin/users/create" 
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow-sm transition-colors duration-200 font-semibold flex items-center gap-2"
      >
        <span class="text-xl leading-none">+</span>
        <span>Add User</span>
      </Link>
    </div>
    
    <div class="mb-4 relative w-full sm:w-80">
    <input
      v-model="search"
      type="text"
      placeholder="Search by name, phone or email ..."
      class="w-full border border-gray-400 rounded px-3 py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-blue-500"
    />
    
    <button
      v-if="search"
      @click="search = ''"
      type="button"
      class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-400 hover:text-gray-600 active:scale-90 transition-transform"
    >
      <Icon icon="heroicons:x-mark-20-solid" class="w-5 h-5" />
    </button>
  </div>

    <div class="flex items-center justify-between px-4 mb-2 text-xs font-bold uppercase tracking-wider text-gray-500">
      <span class="flex-1">Name</span>
      <span class="flex-1 px-4">Email Address</span>
      <span class="flex-1 text-right">Phone</span>
    </div>

    <div class="space-y-2">
      <Link 
        v-for="user in filteredUsers" 
        :key="user.id"
        :href="`/admin/users/${user.id}`"
        :class="[
          'flex items-center justify-between p-4 border border-gray-400 transition-colors duration-200 rounded',
          user.role === 'admin' ? 'bg-red-900 text-white' : 'bg-white text-black hover:bg-blue-50/50'
        ]"
      >
        <span class="flex-1 font-bold tracking-tight">
          {{ user.role === 'admin' ? user.name + " (Admin)" : user.name }} 
        </span>

        <span :class="['flex-1 text-sm truncate px-4', user.role === 'admin' ? 'text-white' : 'text-gray-700']">
          {{ user.email }}
        </span>

        <span :class="['flex-1 text-right font-mono text-xs sm:text-sm', user.role === 'admin' ? 'text-white' : 'text-gray-600']">
          {{ user.phone }}
        </span>
      </Link>
    </div>
  </AdminLayout>
</template>