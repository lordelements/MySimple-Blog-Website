<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<!-- <template>
    <GuestLayout>
        <Head title="Log in" />

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4 block">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ms-2 text-sm text-gray-600"
                        >Remember me</span
                    >
                </label>
            </div>

            <div class="mt-4 flex items-center justify-end">
                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Forgot your password?
                </Link>

                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Log in
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template> -->



<template>
    <div class="flex items-center justify-center min-h-screen bg-gray-100 p-4">
        <div class="flex bg-white rounded-xl shadow-2xl overflow-hidden max-w-4xl w-full">

            <div class="hidden lg:block w-1/2 p-8 relative">
                <div class="flex items-center justify-center h-full">
                    <img src="/illustration/login.png" alt="Fashion illustration" class="max-h-full max-w-full object-contain">
                </div>
            </div>

            <div class="w-full lg:w-1/2 p-10 sm:p-12">
               
                <h2 class="text-3xl font-semibold mb-8 text-gray-800">
                    Sign in to your account
                </h2>

                <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
                    {{ status }}
                </div>

                <form @submit.prevent="submit" class="space-y-4">

                    <div>
                        <TextInput
                            id="email"
                            type="email"
                            class="block w-full border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:ring-blue-500 focus:border-blue-500"
                            v-model="form.email"
                            placeholder="Email Address"
                            required
                            autofocus
                            autocomplete="username"
                        />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div>
                        <TextInput
                            id="password"
                            type="password"
                            class="block w-full border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:ring-blue-500 focus:border-blue-500"
                            v-model="form.password"
                            placeholder="Password"
                            required
                            autocomplete="current-password"
                        />
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        <label class="flex items-center">
                            <Checkbox name="remember" v-model:checked="form.remember" class="rounded text-blue-600 focus:ring-blue-500" />
                            <span class="ms-2 text-sm text-gray-600">Remember me</span>
                        </label>

                        <Link
                            v-if="canResetPassword"
                            :href="route('password.request')"
                            class="rounded-md text-sm text-blue-600 hover:text-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                        >
                            Forgot password?
                        </Link>
                    </div>

                    <div class="mt-6">
                        <PrimaryButton
                            :class="['w-full justify-center', { 'opacity-25': form.processing }]"
                            :disabled="form.processing"
                            class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-lg shadow-md"
                        >
                            LOG IN
                        </PrimaryButton>
                    </div>

                    <div class="text-center pt-2">
                        <Link :href="route('register')" class="text-sm text-gray-600 hover:text-blue-600 font-medium">
                            Don't have an account? Register
                        </Link>
                    </div>

                </form>

                <hr class="my-8">

                <div class="flex justify-center space-x-6 text-sm">
                    <a href="#" class="text-gray-600 hover:text-blue-600">Facebook</a>
                    <a href="#" class="text-gray-600 hover:text-blue-600">Linkedin</a>
                    <a href="#" class="text-gray-600 hover:text-blue-600">Google</a>
                </div>
            </div>
        </div>
    </div>
</template>