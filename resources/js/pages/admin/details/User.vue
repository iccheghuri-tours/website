<script setup>
import AdminLayout from '@/pages/AdminLayout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({ data: Object });
const user = useForm({ ...props.data });

const handleSubmit = () => {
  user.patch(`/admin/users/${props.data.id}`, {
    onSuccess: () => alert("Changes Saved Successfully"),
    onError: (errors) => alert("Invalid Input")
  
  });
}
const handleDelete = () =>{
  if (confirm("Delete this user?")) {
    user.delete(`/admin/users/${props.data.id}`);
  }
}
</script>

<template>
  <AdminLayout>
    <div class="w-full max-w-5xl py-4">
      
      <div class="mb-6">
        <p class="text-xs font-medium uppercase tracking-wider text-gray-400 mb-1">Admin / Users / Details</p>
        
        <h1 class="text-2xl font-bold text-gray-800">Edit User Profile</h1>
      </div>

      <form @submit.prevent="handleSubmit" class="space-y-6">
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-4">
          
          <div class="flex flex-col gap-1.5">
            <label class="text-sm font-medium text-gray-600">Full Name</label>
            <input 
              v-model="user.name" 
              type="text"
              class="w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-sm text-gray-900"
            >
          </div>

          <div class="flex flex-col gap-1.5">
            <label class="text-sm font-medium text-gray-600">Email Address</label>
            <input 
              v-model="user.email" 
              type="email"
              class="w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-sm text-gray-900"
            >
          </div>

          <div class="flex flex-col gap-1.5">
            <label class="text-sm font-medium text-gray-600">Phone Number</label>
            <input 
              v-model="user.phone" 
              type="tel"
              class="w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-sm text-gray-900"
            >
          </div>

          <div class="flex flex-col gap-1.5">
            <label class="text-sm font-medium text-gray-600">Current Points</label>
            <input 
              v-model="user.points" 
              type="number"
              class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-sm text-gray-900"
            >
          </div>
          <div class="flex flex-col gap-1.5">
            <label class="text-sm font-medium text-gray-600">Completed Tours</label>
            <input 
              v-model="user.completed_tours" 
              type="number"
              class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-sm text-gray-900"
            >
          </div>
        </div>

        <div class="pt-4">
          <button 
            type="submit" 
            class="inline-flex items-center justify-center px-6 py-2.5 bg-slate-800 hover:bg-slate-900 text-white text-sm font-semibold rounded-md shadow transition-colors active:transform active:scale-[0.98]"
          >
            Update User
          </button>
        </div>

      </form>
      
      <button 
  type="button"
  @click="handleDelete"
  class="px-4 py-2 text-sm font-semibold text-white bg-red-500 rounded-md mt-2"
>
  Delete User
</button>
    </div>
  </AdminLayout>
</template>