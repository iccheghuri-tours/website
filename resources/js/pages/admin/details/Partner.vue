<script setup>
import AdminLayout from '@/pages/AdminLayout.vue';
import { useForm } from '@inertiajs/vue3';

  const props = defineProps({
    data: Object,
    mode : {type: String, default: 'create'}
  });
  const partner = useForm({
    name: props.data?.name,
    details: props.data?.details,
    location: props.data?.location,
    phone:props.data?.phone,
    facebook: props.data?.facebook,
    discount_percentage: props.data?.discount_percentage
  });

  const handleSubmit = () => {
    if (props.mode === 'edit'){
          partner.patch(`/admin/partners/${props.data.id}`, {
    onSuccess: () => alert("Changes saved successfully"),
    onError: () => alert("Invalid Input")
  });
    }else {
        partner.post(`/admin/partners/`, {
    onSuccess: () => alert("Offer Created successfully"),
    onError: () => alert("Invalid Input")
  });
    }

}
  const handleDelete = () =>{
    if (confirm("Delete this user?")) {
    partner.delete(`/admin/partners/${props.data.id}`);
  }
  }

</script>

<template>
  <AdminLayout>
  <div class="w-full max-w-5xl py-4">
      
      <div class="mb-6">
        <p class="text-xs font-medium uppercase tracking-wider text-gray-400 mb-1">Admin / Partners / {{ props.mode === 'edit' ? 'Details':'create' }}</p>
        
        <h1 class="text-2xl font-bold text-gray-800">  {{ props.mode === 'edit' ? 'Edit Partner Information' : 'Create New Partner' }}</h1>
      </div>

      <form @submit.prevent="handleSubmit" class="space-y-6">
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-4">
  
  <div class="flex flex-col gap-1.5">
    <label class="text-sm font-medium text-gray-600">Partner Name</label>
    <input 
      v-model="partner.name" 
      type="text"
      class="w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all text-gray-900"
    >
  </div>

  <div class="flex flex-col gap-1.5 sm:col-span-2">
    <label class="text-sm font-medium text-gray-600">Offer Terms</label>
    <textarea 
      v-model="partner.details" 
      rows="3"
      class="w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all text-gray-900 resize-y"
    ></textarea>
  </div>

  <div class="flex flex-col gap-1.5">
    <label class="text-sm font-medium text-gray-600">Location</label>
    <input 
      v-model="partner.location" 
      type="text"
      class="w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all text-gray-900"
    >
  </div>

  <div class="flex flex-col gap-1.5">
    <label class="text-sm font-medium text-gray-600">Facebook</label>
    <input 
      v-model="partner.facebook" 
      type="text"
      class="w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all text-gray-900"
    >
  </div>

  <div class="flex flex-col gap-1.5">
    <label class="text-sm font-medium text-gray-600">Phone</label>
    <input 
      v-model="partner.phone" 
      type="tel"
      class="w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all text-gray-900"
    >
  </div>

  <div class="flex flex-col gap-1.5">
    <label class="text-sm font-medium text-gray-600">Discount Percentage</label>
    <input 
      v-model="partner.discount_percentage" 
      type="number"
      class="w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all text-gray-900"
    >
  </div>
</div>

        <div class="pt-4">
          <button 
            type="submit" 
            class="inline-flex items-center justify-center px-6 py-2.5 bg-slate-800 hover:bg-slate-900 text-white text-sm font-semibold rounded-md shadow transition-colors active:transform active:scale-[0.98]"
          >
            {{ props.mode === 'edit' ? 'Edit Partner' : 'Create partner' }}
          </button>
        </div>

      </form>
      
      <button 
  type="button"
  @click="handleDelete"
  class="px-4 py-2 text-sm font-semibold text-white bg-red-500 rounded-md mt-2"
  v-if="props.mode === 'edit'"
>
  Delete partner
</button>
    </div>
  </AdminLayout>
</template>

<style scoped>
</style>