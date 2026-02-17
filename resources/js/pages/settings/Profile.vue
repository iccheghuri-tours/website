<script setup lang="ts">
import { Form, Head, Link, usePage } from '@inertiajs/vue3';
import DeleteUser from '@/components/DeleteUser.vue';
import Heading from '@/components/Heading.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { type BreadcrumbItem } from '@/types';
import ProfileController from '@/actions/App/Http/Controllers/Settings/ProfileController';
import { edit } from '@/routes/profile';
import { send } from '@/routes/verification';

type Props = {
    mustVerifyEmail: boolean;
    status?: string;
};

defineProps<Props>();

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Profile settings',
        href: edit().url,
    },
];

const page = usePage();
const user = page.props.auth.user;

function openMembershipPage(){
    window.location.href = `/points/${user.slug}`;
}
function openAdminPanel(){
    window.location.href = "/admin";
}
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="Profile settings" />

        <h1 class="sr-only">Profile Settings</h1>

        <SettingsLayout>
            <div class="flex flex-col space-y-6">
                <Heading
                    variant="small"
                    title="Profile information"
                    description="Update your name and email address"
                />

                <Form
                    v-bind="ProfileController.update.form()"
                    class="space-y-6"
                    v-slot="{ errors, processing, recentlySuccessful }"
                >
                    <div class="grid gap-2">
                        <Label for="name">Name</Label>
                        <Input
                            id="name"
                            class="mt-1 block w-full"
                            name="name"
                            :default-value="user.name"
                            required
                            autocomplete="name"
                            placeholder="Full name"
                        />
                        <InputError class="mt-2" :message="errors.name" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="email">Email address</Label>
                        <Input
                            id="email"
                            type="email"
                            class="mt-1 block w-full"
                            name="email"
                            :default-value="user.email"
                            required
                            autocomplete="username"
                            placeholder="Email address"
                        />
                        <InputError class="mt-2" :message="errors.email" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="phone">Phone number</Label>
                        <Input
                            id="phone"
                            type="tel"
                            class="mt-1 block w-full"
                            name="phone"
                            :default-value="user.phone || ''"
                            required
                            autocomplete="username"
                            placeholder="Phone number"
                        />
                        <InputError class="mt-2" :message="errors.phone" />
                    </div>

                    <div v-if="mustVerifyEmail && !user.email_verified_at">
                        <p class="-mt-4 text-sm text-muted-foreground">
                            Your email address is unverified.
                            <Link
                                :href="send()"
                                as="button"
                                class="text-foreground underline decoration-neutral-300 underline-offset-4 transition-colors duration-300 ease-out hover:decoration-current! dark:decoration-neutral-500"
                            >
                                Click here to resend the verification email.
                            </Link>
                        </p>

                        <div
                            v-if="status === 'verification-link-sent'"
                            class="mt-2 text-sm font-medium text-green-600"
                        >
                            A new verification link has been sent to your email
                            address.
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <Button
                            :disabled="processing"
                            data-test="update-profile-button"
                            >Save</Button
                        >

                        <Transition
                            enter-active-class="transition ease-in-out"
                            enter-from-class="opacity-0"
                            leave-active-class="transition ease-in-out"
                            leave-to-class="opacity-0"
                        >
                            <p
                                v-show="recentlySuccessful"
                                class="text-sm text-neutral-600"
                            >
                                Saved.
                            </p>
                        </Transition>
                    </div>
                </Form>
            </div>

            <DeleteUser />
            <div class="grid gap-4 sm:grid-cols-2">
                <div  
                    v-if="user.role === 'user'"
                    @click="openMembershipPage()" 
                    class="group cursor-pointer rounded-xl border border-orange-200 bg-orange-50/50 p-5 transition-all hover:bg-orange-100 dark:border-orange-900/30 dark:bg-orange-950/20 dark:hover:bg-orange-900/30"
                >
                    <div class="flex flex-col gap-1">
                        <span class="text-sm font-bold tracking-tight text-orange-600 dark:text-orange-400">Iccheghuri Membership</span>
                        <p class="text-xs text-orange-700/70 dark:text-orange-500/60">Access your digital card and points</p>
                    </div>
                </div>

                <div 
                    v-if="user.role === 'admin'" 
                    @click="openAdminPanel()" 
                    class="group cursor-pointer rounded-xl border border-blue-200 bg-blue-50/50 p-5 transition-all hover:bg-blue-100 dark:border-blue-900/30 dark:bg-blue-950/20 dark:hover:bg-blue-900/30"
                >
                    <div class="flex flex-col gap-1">
                        <span class="text-sm font-bold tracking-tight text-blue-600 dark:text-blue-400">Admin Dashboard</span>
                        <p class="text-xs text-blue-700/70 dark:text-blue-500/60">Manage users and system settings</p>
                    </div>
                </div>
            </div>
        </SettingsLayout>
    </AppLayout>
</template>
    