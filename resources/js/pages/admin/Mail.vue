<script setup>
import { useForm } from '@inertiajs/vue3';
import AdminLayout from '../AdminLayout.vue';
import { ref } from 'vue';

const mail = useForm({ subject: '', body: '', image: '' , btn_link: '', btn_label: '', email : ''});

const handleClick = () => {
  loadingText.value = "Mail is sending, Please keep the page open ... ";
  mail.post('/admin/mail', {
    onSuccess: () => {
      alert("Mail sent successfully");
      loadingText.value = "Mails sent successfully";
    },onError:()=>{
      alert('Invalid Input');
      loadingText.value = "Invalid Input";
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
            placeholder="Enter the subject of your email"
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
            placeholder="Write the content of your email here"
            v-model="mail.body"
            class="w-full px-4 py-2 border border-gray-300 rounded 
                   focus:ring-1 focus:ring-blue-500 focus:outline-none 
                   bg-white text-gray-900"
          ></textarea>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">
            Cover Image (Leave empty for no Image)
          </label>
          <input
            type="text"
            placeholder="Optional: Enter an image URL to include in the email"
            v-model="mail.image"
            class="w-full px-4 py-2 border border-gray-300 rounded 
                   focus:ring-1 focus:ring-blue-500 focus:outline-none 
                   bg-white text-gray-900"
          />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">
            Button Title (Leave empty for no button)
          </label>
          <input
            type="text"
            placeholder="Optional: Enter text for a call-to-action button"
            v-model="mail.btn_label"
            class="w-full px-4 py-2 border border-gray-300 rounded 
                   focus:ring-1 focus:ring-blue-500 focus:outline-none 
                   bg-white text-gray-900"
          />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">
            Button Link (The link user will be redirected after click)
          </label>
          <input
            type="text"
            placeholder="Optional: Enter the URL the button should redirect to"
            v-model="mail.btn_link"
            class="w-full px-4 py-2 border border-gray-300 rounded 
                   focus:ring-1 focus:ring-blue-500 focus:outline-none 
                   bg-white text-gray-900"
          />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">
            Recipient (optional – leave blank to send to all users)
          </label>
          <input
            type="text"
            placeholder="Optional: Enter a single email to test, or leave blank to send to all users"
            v-model="mail.email"
            class="w-full px-4 py-2 border border-gray-300 rounded 
                   focus:ring-1 focus:ring-blue-500 focus:outline-none 
                   bg-white text-gray-900"
          />
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