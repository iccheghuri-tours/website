<script setup>
import AdminLayout from '@/pages/AdminLayout.vue';
import { router, useForm } from '@inertiajs/vue3';

const props = defineProps({
  data: Object
});

const request = useForm({
  note: props.data.note || '',
  status: props.data.status,
});

const submitAction=(action)=>{
    let redirectToUserPage = false;
    let lastStatus = request.status;

    switch(action){
        case 'solve_only':
            request.status = 'solved';
            break;
        case 'solve_and_edit':
            request.status = 'solved';
            redirectToUserPage = true;
            break;
        case 'reject':
                request.status = 'rejected'
            break;
        case 'reopen':
                request.status = 'pending'
            break;    
    }
    request.patch(`/admin/custom-requests/${props.data.id}`, {
    onSuccess: () => {
        alert("Changes Saved Successfully");
        if (redirectToUserPage) router.get(`/admin/users/${props.data.user.id}`);
        else router.get(`/admin/custom-requests`);
    },
    onError: (errors) => {
      alert(Object.values(errors)[0]);
      request.status = lastStatus;
    }
  });
}

</script>

<template>
  <AdminLayout>
    <div class="w-full max-w-5xl py-4 px-4 sm:px-6 lg:px-8 text-left">
      
      <div class="mb-6">
        <p class="text-xs font-medium uppercase tracking-wider text-gray-400 mb-1">
          Admin / Requests / Update
        </p>
        <h1 class="text-2xl font-bold text-gray-800">Update Request Status</h1>
      </div>

      <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-4 sm:p-6">
          <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-6">
              <div class="flex flex-col gap-1.5">
                <label class="text-xs font-bold text-gray-400 uppercase tracking-tight">Request Details</label>
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-100 text-gray-800 leading-relaxed text-sm">
                  {{ props.data.request }}
                </div>
              </div>

              <div class="flex flex-col gap-1.5">
                <label class="text-xs font-bold text-gray-400 uppercase tracking-tight">Admin Note</label>
                <textarea 
                  v-model="request.note" 
                  rows="4"
                  placeholder="Enter internal notes..."
                  class="w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all text-gray-900 resize-y text-sm"
                ></textarea>
              </div>
            </div>

            <div class="space-y-4">
              <div class="bg-gray-50 p-5 rounded-xl border border-gray-100 space-y-4">
                <div>
                  <label class="block text-xs font-bold text-gray-400 uppercase">Requester</label>
                  <p class="text-blue-600 font-medium truncate text-sm">{{ props.data.user.email }}</p>
                </div>

                <div>
                  <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Current Status</label>
                  <span 
                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase"
                    :class="{
                        'bg-yellow-100 text-yellow-800': request.status === 'pending',
                        'bg-red-100 text-red-800': request.status === 'rejected',
                        'bg-green-100 text-green-800': request.status === 'solved'
                    }"
                    >
                    {{ request.status }}
                </span>
                </div>
                
                
              </div>
            </div>
          </div>
        </div>

        <div class="bg-gray-50 border-t border-gray-100 px-4 py-6 sm:px-6">
          <div class="flex flex-col sm:flex-row flex-wrap gap-3 justify-start">
            
            <button 
              @click="submitAction('solve_and_edit')"
              class="px-5 py-2.5 bg-green-600 hover:bg-green-700 text-white text-xs font-bold rounded-md shadow transition-all active:scale-95 uppercase tracking-wide"
              v-if="request.status === 'pending'"
            >
              Mark As Solve And Proceed to Edit User section
            </button>

            <button 
              @click="submitAction('solve_only')"
              class="px-5 py-2.5 bg-slate-800 hover:bg-slate-900 text-white text-xs font-bold rounded-md shadow transition-all active:scale-95 uppercase tracking-wide"
                v-if="request.status === 'pending'"

            >
              Mark as Solve
            </button>
            
            <button 
              @click="submitAction('reject')"
              class="px-5 py-2.5 bg-white border border-red-200 text-red-600 hover:bg-red-50 text-xs font-bold rounded-md transition-all active:scale-95 uppercase tracking-wide"
              v-if="request.status === 'pending'"
            >
              Reject Request
            </button>
            <button 
              @click="submitAction('reopen')"
              class="px-5 py-2.5 bg-rose-800 hover:bg-rose-900 text-white text-xs font-bold rounded-md shadow transition-all active:scale-95 uppercase tracking-wide"
                v-if="request.status !== 'pending'"

            >
              Reopen Case
            </button>
            

          </div>
        </div>
      </div>

    </div>
  </AdminLayout>
</template>