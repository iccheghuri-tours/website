<script setup lang="ts">
import { Form, Head, useForm } from '@inertiajs/vue3';
import TextLink from '@/components/TextLink.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { logout } from '@/routes';

defineProps<{
    status?: string;
}>();

const verify = useForm({
    otp: '',
});

const handleSubmit = () => {
    if (verify.otp.length !== 4) {
        alert('Please enter a valid 4-digit code');
        return;
    }

    verify.post('/verify-email', {
        onSuccess: () => alert('Verified successfully'),
        onError: (errors) => {
            const firstError = Object.values(errors)[0];
            alert(firstError);
            verify.otp = '';
        },
    });
};
const handleResendOtp = () => {
    verify.post('/resend-otp', {
        onSuccess: () => alert('A new verification code has been sent!'),
        onError: (errors) => {
            const firstError = Object.values(errors)[0];
            alert(firstError);
        },
    });
};
</script>

<template>
    <AuthLayout
        title="Verify email"
        description="Enter the 4-digit code sent to your email or phone."
    >
        <Head title="Email verification" />

        <div
            v-if="status === 'verification-link-sent'"
            class="mb-4 text-center text-sm font-medium text-green-600"
        >
            A new OTP has been sent to your registered email/phone number.
        </div>

        <input
            v-model="verify.otp"
            type="text"
            inputmode="numeric"
            placeholder="0000"
            maxlength="4"
            class="block w-full [appearance:textfield] rounded-lg border-gray-200 bg-gray-50 py-3 text-center text-2xl font-bold tracking-[1rem] focus:border-primary focus:ring-primary [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none"
        />

        <button
            class="mt-3 w-full rounded-lg bg-primary py-3 text-sm font-semibold text-white shadow-sm transition-colors hover:bg-primary/90"
            @click="handleSubmit"
            :disabled="verify.processing"
        >
            Verify
        </button>

        <button
            @click="handleResendOtp"
            type="button"
            class="mt-2 w-full py-3 text-sm font-medium text-gray-500 transition-colors hover:text-gray-700"
            :disabled="verify.processing"
        >
            Resend Code
        </button>

        <TextLink
            :href="logout()"
            as="button"
            class="mx-auto mt-2 block text-sm"
        >
            Log out
        </TextLink>
    </AuthLayout>
</template>
