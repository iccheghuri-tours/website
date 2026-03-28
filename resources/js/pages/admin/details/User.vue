<script setup>
import AdminLayout from '@/pages/AdminLayout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    data: Object,
    mode: { type: String, default: 'create' },
});
const user = useForm({
    name: props.data?.name,
    email: props.data?.email,
    phone: props.data?.phone,
    points: props.data?.points,
    completed_tours: props.data?.completed_tours,
    role: props.data?.role,
    email_verified: props.data?.email_verified_at ? true : false,
});

const handleSubmit = () => {
    if (props.mode === 'edit') {
        user.patch(`/admin/users/${props.data.id}`, {
            onSuccess: () => alert('Changes Saved Successfully'),
            onError: (errors) => {
                const firstError = Object.values(errors)[0];
                alert(firstError);
            },
        });
    } else if (props.mode === 'create') {
        user.post(`/admin/users`, {
            onSuccess: () => alert('User Created Successfully'),
            onError: (errors) => {
                const firstError = Object.values(errors)[0];
                alert(firstError);
            },
        });
    }
};
const handleDelete = () => {
    if (confirm('Delete this user?')) {
        user.delete(`/admin/users/${props.data.id}`);
    }
};
</script>

<template>
    <AdminLayout>
        <div class="w-full max-w-5xl py-4">
            <div class="mb-6">
                <p
                    class="mb-1 text-xs font-medium tracking-wider text-gray-400 uppercase"
                >
                    Admin / Users /
                    {{ props.mode === 'edit' ? 'Details' : 'create' }}
                </p>

                <h1 class="text-2xl font-bold text-gray-800">
                    {{
                        props.mode === 'edit'
                            ? 'Edit User Information'
                            : 'Create New User'
                    }}
                </h1>
            </div>

            <form @submit.prevent="handleSubmit" class="space-y-6">
                <div
                    class="grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-2 lg:grid-cols-3"
                >
                    <div class="flex flex-col gap-1.5">
                        <label class="text-sm font-medium text-gray-600"
                            >Full Name</label
                        >
                        <input
                            v-model="user.name"
                            type="text"
                            class="transition-sm w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-gray-900 shadow-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500"
                        />
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label class="text-sm font-medium text-gray-600">
                            User Role
                        </label>

                        <select
                            v-model="user.role"
                            class="transition-sm w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-gray-900 shadow-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500"
                        >
                            <option disabled value="">Select Role</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label class="text-sm font-medium text-gray-600">
                            Email Verification
                        </label>

                        <select
                            v-model="user.email_verified"
                            class="transition-sm w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-gray-900 shadow-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500"
                        >
                            <option :value="true">Verified</option>
                            <option :value="false">Not Verified</option>
                        </select>
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label class="text-sm font-medium text-gray-600"
                            >Email Address</label
                        >
                        <input
                            v-model="user.email"
                            type="email"
                            class="transition-sm w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-gray-900 shadow-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500"
                        />
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label class="text-sm font-medium text-gray-600"
                            >Phone Number</label
                        >
                        <input
                            v-model="user.phone"
                            type="tel"
                            class="transition-sm w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-gray-900 shadow-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500"
                        />
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label class="text-sm font-medium text-gray-600"
                            >Current Points</label
                        >
                        <input
                            v-model="user.points"
                            type="number"
                            class="transition-sm w-full rounded-md border border-gray-300 bg-gray-50 px-3 py-2 text-gray-900 shadow-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500"
                        />
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <label class="text-sm font-medium text-gray-600"
                            >Completed Tours</label
                        >
                        <input
                            v-model="user.completed_tours"
                            type="number"
                            class="transition-sm w-full rounded-md border border-gray-300 bg-gray-50 px-3 py-2 text-gray-900 shadow-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500"
                        />
                    </div>
                </div>

                <div class="pt-4">
                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-md bg-slate-800 px-6 py-2.5 text-sm font-semibold text-white shadow transition-colors hover:bg-slate-900 active:scale-[0.98] active:transform"
                    >
                        {{
                            props.mode === 'edit' ? 'Edit User' : 'Create User'
                        }}
                    </button>
                </div>
            </form>

            <button
                type="button"
                @click="handleDelete"
                class="mt-2 rounded-md bg-red-500 px-4 py-2 text-sm font-semibold text-white"
                v-if="props.mode === 'edit'"
            >
                Delete User
            </button>
        </div>
    </AdminLayout>
</template>
