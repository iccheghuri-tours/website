<script setup lang="ts">
import { Form, Head, Link, router, usePage } from '@inertiajs/vue3';
import Heading from '@/components/Heading.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Separator } from '@/components/ui/separator'; // Assuming you have a Separator component
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { type BreadcrumbItem } from '@/types';
import ProfileController from '@/actions/App/Http/Controllers/Settings/ProfileController';
import { edit } from '@/routes/profile';
import { send } from '@/routes/verification';
import { logout } from '@/routes';

// Icons (Lucide-vue-next is common with Shadcn, adjust if using different library)
import { LogOut, LayoutDashboard, CreditCard, ChevronRight } from 'lucide-vue-next';

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

const handleLogout = () => {
    router.flushAll();
    router.post(logout());
};
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="Profile settings" />

        <SettingsLayout>
            <div class="space-y-10">
                <section class="space-y-6">
                    <Heading
                        variant="small"
                        title="Profile Information"
                        description="Update your personal details and contact information."
                    />

                    <Form
                        v-bind="ProfileController.update.form()"
                        class="max-w-xl space-y-6"
                        v-slot="{ errors, processing, recentlySuccessful }"
                    >
                        <div class="grid gap-4">
                            <div class="grid gap-2">
                                <Label for="name">Name</Label>
                                <Input id="name" name="name" :default-value="user.name" required autocomplete="name" />
                                <InputError :message="errors.name" />
                            </div>

                            <div class="grid gap-2">
                                <Label for="email">Email address</Label>
                                <Input id="email" type="email" name="email" :default-value="user.email" required />
                                <InputError :message="errors.email" />
                            </div>

                            <div class="grid gap-2">
                                <Label for="phone">Phone number</Label>
                                <Input id="phone" type="tel" name="phone" :default-value="user.phone || ''" required />
                                <InputError :message="errors.phone" />
                            </div>
                        </div>

                        <div v-if="mustVerifyEmail && !user.email_verified_at" class="rounded-lg bg-amber-50 p-4 dark:bg-amber-950/20">
                            <p class="text-sm text-amber-800 dark:text-amber-400">
                                Your email is unverified.
                                <Link :href="send()" as="button" class="font-semibold underline hover:no-underline">
                                    Resend verification.
                                </Link>
                            </p>
                            <div v-if="status === 'verification-link-sent'" class="mt-2 text-xs font-medium text-green-600">
                                A new link has been sent.
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <Button :disabled="processing">Save Changes</Button>
                            <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0" leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                                <p v-show="recentlySuccessful" class="text-sm text-muted-foreground">Saved successfully.</p>
                            </Transition>
                        </div>
                    </Form>
                </section>

                <Separator />

                <section class="space-y-6">
                    <Heading
                        variant="small"
                        title="Account Actions"
                        description="Quick access to your membership or administrative tools."
                    />
                    
                    <div class="grid gap-4 sm:grid-cols-2">
                        <button  
                            v-if="user.role === 'user'"
                            @click="openMembershipPage()" 
                            class="group flex items-center justify-between rounded-xl border border-orange-200 bg-orange-50/30 p-4 text-left transition-all hover:bg-orange-50 dark:border-orange-900/30 dark:bg-orange-950/10 dark:hover:bg-orange-900/20"
                        >
                            <div class="flex items-center gap-4">
                                <div class="rounded-full bg-orange-100 p-2 text-orange-600 dark:bg-orange-900/50 dark:text-orange-400">
                                    <CreditCard class="h-5 w-5" />
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-orange-900 dark:text-orange-100">Iccheghuri Membership</p>
                                    <p class="text-xs text-orange-700/70 dark:text-orange-400/60">Digital card & points</p>
                                </div>
                            </div>
                            <ChevronRight class="h-4 w-4 text-orange-400 transition-transform group-hover:translate-x-1" />
                        </button>

                        <button 
                            v-if="user.role === 'admin'" 
                            @click="openAdminPanel()" 
                            class="group flex items-center justify-between rounded-xl border border-blue-200 bg-blue-50/30 p-4 text-left transition-all hover:bg-blue-50 dark:border-blue-900/30 dark:bg-blue-950/10 dark:hover:bg-blue-900/20"
                        >
                            <div class="flex items-center gap-4">
                                <div class="rounded-full bg-blue-100 p-2 text-blue-600 dark:bg-blue-900/50 dark:text-blue-400">
                                    <LayoutDashboard class="h-5 w-5" />
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-blue-900 dark:text-blue-100">Admin Dashboard</p>
                                    <p class="text-xs text-blue-700/70 dark:text-blue-400/60">System management</p>
                                </div>
                            </div>
                            <ChevronRight class="h-4 w-4 text-blue-400 transition-transform group-hover:translate-x-1" />
                        </button>
                    </div>

                    <div class="pt-4">
                        <Button 
                            variant="destructive" 
                            variant-outline
                            class="w-full justify-start gap-2 border-red-200 bg-red-50 text-red-600 hover:bg-red-100 hover:text-red-700 dark:border-red-900/50 dark:bg-red-950/20 dark:text-red-400 dark:hover:bg-red-900/30"
                            @click="handleLogout()"
                        >
                            <LogOut class="h-4 w-4" />
                            Log Out
                        </Button>
                    </div>
                </section>
            </div>
        </SettingsLayout>
    </AppLayout>
</template>