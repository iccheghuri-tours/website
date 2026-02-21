<script setup>
import { useForm } from '@inertiajs/vue3';
import AdminLayout from '../AdminLayout.vue';
import { ref } from 'vue';

const mail = useForm({ subject: '', body: '' });

const handleClick = () => {
  loadingText.value = "Mail is sending, Please keep the page open ... ";
  mail.post('/admin/mail', {
    onSuccess: () => {
      alert("Mail sent successfully");
      mail.subject = '';
      mail.body = '';
      loadingText.value = "";
    }
  });
};

const loadingText = ref('');
</script>

<template>
  <AdminLayout>
    <div class="max-w-xl text-left">
      <h1 class="text-2xl font-bold mb-6 text-gray-800">Email</h1>
      <div class="space-y-4">

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">
            Email Subject
          </label>
          <input
            type="text"
            placeholder="Enter subject"
            v-model="mail.subject"
            class="w-full px-4 py-2 border border-gray-300 rounded 
                   focus:ring-1 focus:ring-blue-500 focus:outline-none 
                   bg-white text-gray-900"
          />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">
            Email Body
          </label>
          <textarea
            rows="6"
            placeholder="Write your message here..."
            v-model="mail.body"
            class="w-full px-4 py-2 border border-gray-300 rounded 
                   focus:ring-1 focus:ring-blue-500 focus:outline-none 
                   bg-white text-gray-900"
          ></textarea>
        </div>

        <button
          class="bg-blue-600 text-white px-5 py-2 rounded font-medium 
                 hover:bg-blue-700"
          @click.prevent="handleClick"
        >
          Send Email
        </button>

      </div>
      <p>{{ loadingText }}</p>
    </div>
  </AdminLayout>
</template>

<style scoped>
</style>