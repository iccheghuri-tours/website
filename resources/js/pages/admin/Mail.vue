<script setup>
import { useForm } from '@inertiajs/vue3';
import AdminLayout from '../AdminLayout.vue';
import { ref } from 'vue';
import axios from 'axios';

const mail = useForm({
    subject: '',
    body: '',
    image: '',
    btn_link: '',
    btn_label: '',
    email: '',
    btn_color: '#ff7b40',
});

const handleClick = () => {
    loadingText.value = 'Mail is sending, Please keep the page open ... ';
    mail.post('/admin/mail', {
        onSuccess: () => {
            alert('Mail sent successfully');
            loadingText.value = 'Mails sent successfully';
        },
        onError: (errors) => {
            const firstError = Object.values(errors)[0];
            alert(firstError);
            loadingText.value = firstError;
        },
    });
};
const isUploading = ref(false);
const handleImageChange = async (event) => {
    const file = event.target.files[0];
    if (!file) return;
    const body = new FormData();
    body.append('image', file);
    body.append('delete', mail.image);
    try {
        isUploading.value = true;

        const { data } = await axios.post('/admin/upload-image', body);
        mail.image = data.path;
    } catch (error) {
        alert(error.response?.data?.message || 'Image upload failed');
    } finally {
        isUploading.value = false;
    }
};
const loadingText = ref('');
</script>

<template>
    <AdminLayout>
        <div class="max-w-xl text-left">
            <h1 class="mb-6 text-2xl font-bold text-gray-800">Email</h1>
            <div class="space-y-4">
                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700">
                        Email Subject
                    </label>
                    <input
                        type="text"
                        placeholder="Enter the subject of your email"
                        v-model="mail.subject"
                        class="w-full rounded border border-gray-300 bg-white px-4 py-2 text-gray-900 focus:ring-1 focus:ring-blue-500 focus:outline-none"
                    />
                </div>

                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700">
                        Email Body
                    </label>
                    <textarea
                        rows="6"
                        placeholder="Write the content of your email here"
                        v-model="mail.body"
                        class="w-full rounded border border-gray-300 bg-white px-4 py-2 text-gray-900 focus:ring-1 focus:ring-blue-500 focus:outline-none"
                    ></textarea>
                </div>

                <div class="flex flex-col gap-1.5 sm:col-span-1">
                    <label class="text-sm font-medium text-gray-600"
                        >Cover Image (Leave empty for no image)</label
                    >

                    <div
                        class="relative mb-2 flex h-20 w-20 items-center justify-center overflow-hidden rounded-md border border-gray-200 bg-gray-50"
                    >
                        <div
                            v-if="isUploading"
                            class="flex items-center justify-center"
                        >
                            <svg
                                class="h-6 w-6 animate-spin text-blue-600"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <circle
                                    class="opacity-25"
                                    cx="12"
                                    cy="12"
                                    r="10"
                                    stroke="currentColor"
                                    stroke-width="4"
                                ></circle>
                                <path
                                    class="opacity-75"
                                    fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                ></path>
                            </svg>
                        </div>

                        <img
                            v-else-if="mail.image"
                            :src="`/storage/${mail.image}`"
                            alt="mail Preview"
                            class="h-full w-full object-cover"
                        />

                        <div v-else class="text-gray-300">
                            <svg
                                class="h-8 w-8"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                />
                            </svg>
                        </div>
                    </div>

                    <input
                        type="file"
                        @change="handleImageChange"
                        :disabled="isUploading"
                        class="w-full cursor-pointer text-sm text-gray-500 file:mr-4 file:rounded-md file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-blue-700 hover:file:bg-blue-100 disabled:cursor-not-allowed disabled:opacity-50"
                    />
                </div>

                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700">
                        Button Title (Leave empty for no button)
                    </label>
                    <input
                        type="text"
                        placeholder="Optional: Enter text for a call-to-action button"
                        v-model="mail.btn_label"
                        class="w-full rounded border border-gray-300 bg-white px-4 py-2 text-gray-900 focus:ring-1 focus:ring-blue-500 focus:outline-none"
                    />
                </div>

                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700">
                        Button Link (The link user will be redirected after
                        click)
                    </label>
                    <input
                        type="text"
                        placeholder="Optional: Enter the URL the button should redirect to"
                        v-model="mail.btn_link"
                        class="w-full rounded border border-gray-300 bg-white px-4 py-2 text-gray-900 focus:ring-1 focus:ring-blue-500 focus:outline-none"
                    />
                </div>

                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700">
                        Button Color
                    </label>

                    <div class="flex items-center gap-3">
                        <input
                            type="color"
                            v-model="mail.btn_color"
                            class="h-10 w-14 cursor-pointer rounded border border-gray-300 p-1"
                        />

                        <input
                            type="text"
                            v-model="mail.btn_color"
                            class="flex-1 rounded border border-gray-300 bg-white px-4 py-2 text-gray-900 focus:ring-1 focus:ring-blue-500 focus:outline-none"
                            placeholder="#000000"
                        />
                    </div>
                </div>

                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700">
                        Recipient (optional – leave blank to send to all users)
                    </label>
                    <input
                        type="text"
                        placeholder="Optional: Enter a single email to test, or leave blank to send to all users"
                        v-model="mail.email"
                        class="w-full rounded border border-gray-300 bg-white px-4 py-2 text-gray-900 focus:ring-1 focus:ring-blue-500 focus:outline-none"
                    />
                </div>

                <button
                    class="rounded bg-blue-600 px-5 py-2 font-medium text-white hover:bg-blue-700"
                    @click.prevent="handleClick"
                >
                    Send Email
                </button>
            </div>
            <p>{{ loadingText }}</p>
        </div>
    </AdminLayout>
</template>

<style scoped></style>
