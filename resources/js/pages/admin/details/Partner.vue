<script setup>
import AdminLayout from '@/pages/AdminLayout.vue';
import { useForm } from '@inertiajs/vue3';
import axios from 'axios';
import { ref } from 'vue';

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
    discount_percentage: props.data?.discount_percentage,
    image: props.data?.image
  });

  const handleSubmit = () => {
    if (props.mode === 'edit'){
          partner.patch(`/admin/partners/${props.data.id}`, {
    onSuccess: () => alert("Changes saved successfully"),
    onError: (errors) => {
        const firstError = Object.values(errors)[0];
        alert(firstError);
    }
  });
    }else {
        partner.post(`/admin/partners`, {
    onSuccess: () => alert("Partner Created successfully"),
    onError: (errors) => {
        const firstError = Object.values(errors)[0];
        alert(firstError);
    }
  });
    }

}
  const handleDelete = () =>{
    if (confirm("Delete this partner?")) {
    partner.delete(`/admin/partners/${props.data.id}`);
  }
  }

const handleImageChange = async (event) => {
  const file = event.target.files[0];
  if (!file) return;
  const body = new FormData();
  body.append('image',file);
  body.append('delete',partner.image);
  try{
    isUploading.value = true;

    const {data} = await axios.post('/admin/upload-image',body);
    partner.image = data.path;
  }catch (error){
    alert(error.response?.data?.message || 'Image upload failed');
  }finally{
    isUploading.value = false;

  }
  


};

const isUploading = ref(false);


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
  <div class="flex flex-col gap-1.5 sm:col-span-1">
  <label class="text-sm font-medium text-gray-600">Partner Image</label>
  
  <div class="relative h-20 w-20 mb-2 flex items-center justify-center border border-gray-200 rounded-md bg-gray-50 overflow-hidden">
    
    <div v-if="isUploading" class="flex items-center justify-center">
      <svg class="animate-spin h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
      </svg>
    </div>

    <img 
      v-else-if="partner.image"
      :src="`/storage/${partner.image}`"
      alt="Partner Preview" 
      class="h-full w-full object-cover"
    >

    <div v-else class="text-gray-300">
      <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
      </svg>
    </div>
  </div>

  <input 
    type="file" 
    @change="handleImageChange"
    :disabled="isUploading"
    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed"
  >
</div>
</div>

        <div class="pt-4">
          <button 
            type="submit" 
            :disabled="isUploading"
            class="inline-flex items-center justify-center px-6 py-2.5 bg-slate-800 hover:bg-slate-900 text-white text-sm font-semibold rounded-md shadow transition-colors active:transform active:scale-[0.98] disabled:opacity-50 disabled:cursor-not-allowed"
          >
            {{ props.mode === 'edit' ? 'Edit Partner' : 'Create partner' }}
          </button>
        </div>

      </form>
      
      <button 
  type="button"
  @click="handleDelete"
  class="px-4 py-2 text-sm font-semibold text-white bg-red-500 rounded-md mt-2 disabled:opacity-50 disabled:cursor-not-allowed"
  v-if="props.mode === 'edit'"
  :disabled="isUploading"
>
  Delete partner
</button>
    </div>
  </AdminLayout>
</template>

<style scoped>
</style>