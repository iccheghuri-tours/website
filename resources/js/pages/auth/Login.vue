<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import AuthBase from '@/layouts/AuthLayout.vue';
import { register } from '@/routes';
import { store } from '@/routes/login';
import { request } from '@/routes/password';

defineProps<{
    status?: string;
    canResetPassword: boolean;
    canRegister: boolean;
}>();
</script>

<template>
    <AuthBase
        title="স্বাগতম!"
        description="আপনার অ্যাকাউন্টে লগইন করুন"
    >
        <Head title="Log in" />

        <div v-if="status" class="mb-4 text-center text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <Form v-bind="store.form()" v-slot="{ errors, processing }" class="flex flex-col gap-5">
            <div class="grid gap-5">
                <div class="grid gap-1.5">
                    <Label for="email" class="text-xs font-bold uppercase tracking-wider text-gray-500">Email Address</Label>
                    <Input
                        id="email"
                        type="email"
                        name="email"
                        class="h-12 rounded-xl border-gray-100 bg-gray-50/50 focus:ring-[#ff9542]"
                        placeholder="example@mail.com"
                        required
                        autofocus
                    />
                    <InputError :message="errors.email" />
                </div>

                <div class="grid gap-1.5">
                    <div class="flex items-center justify-between">
                        <Label for="password" class="text-xs font-bold uppercase tracking-wider text-gray-500">Password</Label>
                        <TextLink v-if="canResetPassword" :href="request()" class="text-xs font-semibold text-[#ff9542]">
                            Forgot?
                        </TextLink>
                    </div>
                    <Input
                        id="password"
                        type="password"
                        name="password"
                        class="h-12 rounded-xl border-gray-100 bg-gray-50/50 focus:ring-[#ff9542]"
                        placeholder="••••••••"
                        required
                    />
                    <InputError :message="errors.password" />
                </div>

                <div class="flex items-center">
                    <Label for="remember" class="flex items-center gap-2 cursor-pointer text-sm text-gray-600">
                        <Checkbox id="remember" name="remember" class="rounded-md border-gray-300 text-[#ff9542] focus:ring-[#ff9542]" />
                        <span>মনে রাখুন</span>
                    </Label>
                </div>

                <Button
                    type="submit"
                    class="h-12 w-full rounded-xl bg-[#ff9542] text-base font-bold text-white shadow-lg shadow-[#ff9542]/30 hover:bg-[#e88435] transition-all active:scale-95"
                    :disabled="processing"
                >
                    <Spinner v-if="processing" class="mr-2 h-4 w-4" />
                    লগইন করুন
                </Button>
            </div>

            <div class="text-center text-sm text-gray-500" v-if="canRegister">
                অ্যাকাউন্ট নেই? 
                <TextLink :href="register()" class="font-bold text-[#ff9542] hover:underline">জয়েন করুন</TextLink>
            </div>
        </Form>
    </AuthBase>
</template>