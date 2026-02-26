<script setup lang="ts">
import { Form, Head, Link, router, useForm, usePage } from '@inertiajs/vue3';
import Heading from '@/components/Heading.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Separator } from '@/components/ui/separator';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { type BreadcrumbItem } from '@/types';
import ProfileController from '@/actions/App/Http/Controllers/Settings/ProfileController';
import { edit } from '@/routes/profile';
import { send } from '@/routes/verification';
import { logout } from '@/routes';

// Icons
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
const requestForm = useForm({
    request: ''
});
const submitForm = () => {
    if(!requestForm.request.trim()){
        alert("Please type your request");
        return;
    }

    requestForm.post('/custom-requests', {
        onSuccess: () => {
            alert("We have received your request");
            requestForm.reset();
        },
        onError: (errors) => alert(Object.values(errors)[0])
    });
}
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

                        <div v-if="mustVerifyEmail && !user.email_verified_at" class="rounded-lg bg-amber-50 p-4">
                            <p class="text-sm text-amber-800">
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
                            class="group flex items-center justify-between rounded-xl border border-orange-200 bg-orange-50/30 p-4 text-left transition-all hover:bg-orange-50"
                        >
                            <div class="flex items-center gap-4">
                                <div class="rounded-full bg-orange-100 p-2 text-orange-600">
                                    <CreditCard class="h-5 w-5" />
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-orange-900">Iccheghuri Membership</p>
                                    <p class="text-xs text-orange-700/70">Digital card & points</p>
                                </div>
                            </div>
                            <ChevronRight class="h-4 w-4 text-orange-400 transition-transform group-hover:translate-x-1" />
                        </button>

                        <button 
                            v-if="user.role === 'admin'" 
                            @click="openAdminPanel()" 
                            class="group flex items-center justify-between rounded-xl border border-blue-200 bg-blue-50/30 p-4 text-left transition-all hover:bg-blue-50"
                        >
                            <div class="flex items-center gap-4">
                                <div class="rounded-full bg-blue-100 p-2 text-blue-600">
                                    <LayoutDashboard class="h-5 w-5" />
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-blue-900">Admin Dashboard</p>
                                    <p class="text-xs text-blue-700/70">System management</p>
                                </div>
                            </div>
                            <ChevronRight class="h-4 w-4 text-blue-400 transition-transform group-hover:translate-x-1" />
                        </button>
                    </div>

                <div class="mt-6 grid gap-4 sm:grid-cols-1" v-if="user.role === 'user'">
                    <div class="flex flex-col gap-2">
                        <Label for="request">Your Request</Label>
                        <textarea 
                            id="request" 
                            name="request" 
                            rows="4" 
                            placeholder="Describe any request, such as a points increase or other technical issue." 
                            class="border rounded px-3 py-2 resize-none"
                            v-model="requestForm.request"
                        ></textarea>
                    </div>
                    <Button @click="submitForm" class="w-full justify-center mt-2">Submit Request</Button>
                </div>

                    <div class="pt-4">
                        <Button 
                            variant="destructive" 
                            class="w-full justify-start gap-2 border-red-200 bg-red-50 text-red-600 hover:bg-red-100 hover:text-red-700"
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
