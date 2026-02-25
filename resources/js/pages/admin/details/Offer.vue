<script setup>
import AdminLayout from '@/pages/AdminLayout.vue';
import { useForm } from '@inertiajs/vue3';

  const props = defineProps({
    data: Object, 
    mode: {type: String, default: "create"}
  });
  const offer = useForm({
    name: props.data?.name || '',
    details: props.data?.details || '',
    points_required: props.data?.points_required || 0
  });


  const handleSubmit = () =>{
    if (props.mode == 'edit'){
      offer.patch(`/admin/offers/${props.data.id}`, {
      onSuccess: ()=> alert("Changes saved successfully"),
      onError: (errors) => {
        const firstError = Object.values(errors)[0];
        alert(firstError);
    }
    });
    }else {
      offer.post(`/admin/offers`, {
      onSuccess: ()=> alert("Offer created successfully"),
      onError: (errors) => {
        const firstError = Object.values(errors)[0];
        alert(firstError);
    }
    });
    }
    
  }

  const handleDelete = ()=>{
    if (confirm('Delete this offer? ')){
      offer.delete(`/admin/offers/${props.data.id}`);
    }
    
  }
</script>

<template>
  <AdminLayout>
  <div class="w-full max-w-5xl py-4">
      
      <div class="mb-6">
        <p class="text-xs font-medium uppercase tracking-wider text-gray-400 mb-1">Admin / offers / {{ props.mode === 'edit' ? 'Details':'create' }}</p>
        
        <h1 class="text-2xl font-bold text-gray-800">{{ props.mode === "edit" ? 'Edit Offer Information' : 'Create Offer' }}</h1>
      </div>

      <form @submit.prevent="handleSubmit" class="space-y-6">
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-4">
  
  <div class="flex flex-col gap-1.5">
    <label class="text-sm font-medium text-gray-600">Offer Name</label>
    <input 
      v-model="offer.name" 
      type="text"
      class="w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all text-gray-900"
    >
  </div>

  <div class="flex flex-col gap-1.5 sm:col-span-2">
    <label class="text-sm font-medium text-gray-600">Offer Details</label>
    <textarea 
      v-model="offer.details" 
      rows="3"
      class="w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all text-gray-900 resize-y"
    ></textarea>
  </div>

  <div class="flex flex-col gap-1.5">
    <label class="text-sm font-medium text-gray-600">Points required</label>
    <input 
      v-model="offer.points_required" 
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
              {{ props.mode === 'edit' ? 'Update offer' : 'Create offer' }}
          </button>
        </div>

      </form>
      
      <button 
  type="button"
  @click="handleDelete"
  class="px-4 py-2 text-sm font-semibold text-white bg-red-500 rounded-md mt-2"
  v-if="props.mode === 'edit'"
>
  Delete offer
</button>
    </div>
  </AdminLayout>
</template>

<style scoped>
</style>