<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import AuthBase from '@/layouts/AuthLayout.vue';
import { login } from '@/routes';
import { store } from '@/routes/register';
</script>

<template>
    <AuthBase
        title="নতুন অ্যাকাউন্ট"
        description="ইচ্ছেঘুড়ির সাথে আপনার ভ্রমণ শুরু করুন"
    >
        <Head title="Register" />

        <Form v-bind="store.form()" v-slot="{ errors, processing }" class="flex flex-col gap-4">
            <div class="grid gap-4">
                <div class="grid gap-1.5">
                    <Label for="name" class="text-xs font-bold uppercase text-gray-500">Full Name</Label>
                    <Input id="name" name="name" class="rounded-xl border-gray-100 bg-gray-50/50 h-11" placeholder="আপনার নাম" required />
                    <InputError :message="errors.name" />
                </div>

                <div class="grid gap-1.5">
                    <Label for="email" class="text-xs font-bold uppercase text-gray-500">Email</Label>
                    <Input id="email" type="email" name="email" class="rounded-xl border-gray-100 bg-gray-50/50 h-11" placeholder="email@example.com" required />
                    <InputError :message="errors.email" />
                </div>

                <div class="grid gap-1.5">
                    <Label for="phone" class="text-xs font-bold uppercase text-gray-500">Phone</Label>
                    <Input id="phone" type="text" name="phone" class="rounded-xl border-gray-100 bg-gray-50/50 h-11" placeholder="017XXXXXXXX" required />
                    <InputError :message="errors.phone" />
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div class="grid gap-1.5">
                        <Label for="password" class="text-xs font-bold uppercase text-gray-500">Password</Label>
                        <Input id="password" type="password" name="password" class="rounded-xl border-gray-100 bg-gray-50/50 h-11" placeholder="••••••" required />
                    </div>
                    <div class="grid gap-1.5">
                        <Label for="password_confirmation" class="text-xs font-bold uppercase text-gray-500">Confirm</Label>
                        <Input id="password_confirmation" type="password" name="password_confirmation" class="rounded-xl border-gray-100 bg-gray-50/50 h-11" placeholder="••••••" required />
                    </div>
                </div>
                <InputError :message="errors.password" />

                <Button
                    type="submit"
                    class="mt-2 h-12 w-full rounded-xl bg-[#ff9542] text-base font-bold text-white shadow-lg shadow-[#ff9542]/20 hover:bg-[#e88435]"
                    :disabled="processing"
                >
                    <Spinner v-if="processing" class="mr-2 h-4 w-4" />
                    অ্যাকাউন্ট তৈরি করুন
                </Button>
            </div>

            <div class="text-center text-sm text-gray-500">
                ইতিমধ্যেই অ্যাকাউন্ট আছে? 
                <TextLink :href="login()" class="font-bold text-[#ff9542] hover:underline">লগইন</TextLink>
            </div>
        </Form>
    </AuthBase>
</template>