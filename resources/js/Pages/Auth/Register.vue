<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<!-- <template>
    <GuestLayout>
        <Head title="Register" />

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
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
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel
                    for="password_confirmation"
                    value="Confirm Password"
                />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError
                    class="mt-2"
                    :message="form.errors.password_confirmation"
                />
            </div>

            <div class="mt-4 flex items-center justify-end">
                <Link
                    :href="route('login')"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Already registered?
                </Link>

                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Register
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
                    <img src="illustration/register.png" alt="Fashion illustration" class="max-h-full max-w-full object-contain">
                </div>
            </div>

            <div class="w-full lg:w-1/2 p-10 sm:p-12">
                
                <h2 class="text-3xl font-semibold mb-8 text-gray-800">
                    Create an account
                </h2>

                <form @submit.prevent="submit" class="space-y-4">

                    <div>
                        <TextInput
                            id="name"
                            type="text"
                            class="block w-full border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:ring-blue-500 focus:border-blue-500"
                            v-model="form.name"
                            placeholder="Name (e.g., John Terner)"
                            required
                            autofocus
                            autocomplete="name"
                        />
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>

                    <div>
                        <TextInput
                            id="email"
                            type="email"
                            class="block w-full border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:ring-blue-500 focus:border-blue-500"
                            v-model="form.email"
                            placeholder="Email Address (e.g., JohnTerner@the18.design)"
                            required
                            autocomplete="username"
                        />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <TextInput
                                id="password"
                                type="password"
                                class="block w-full border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:ring-blue-500 focus:border-blue-500"
                                v-model="form.password"
                                placeholder="Password"
                                required
                                autocomplete="new-password"
                            />
                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>

                        <div>
                            <TextInput
                                id="password_confirmation"
                                type="password"
                                class="block w-full border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:ring-blue-500 focus:border-blue-500"
                                v-model="form.password_confirmation"
                                placeholder="Confirm Password"
                                required
                                autocomplete="new-password"
                            />
                            <InputError class="mt-2" :message="form.errors.password_confirmation" />
                        </div>
                    </div>

                    <div class="flex items-center pt-2">
                        <input
                            id="terms"
                            type="checkbox"
                            class="rounded text-blue-600 focus:ring-blue-500"
                            required
                        >
                        <label for="terms" class="ms-2 text-sm text-gray-600">
                            By registering your details, you agree with our
                            <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Terms & Conditions</a>, and <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Privacy and Cookie Policy</a>.
                        </label>
                    </div>

                    <div class="flex items-center pt-2">
                        <PrimaryButton
                            :class="['w-full justify-center', { 'opacity-25': form.processing }]"
                            :disabled="form.processing"
                            class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-lg shadow-md"
                        >
                            REGISTER
                        </PrimaryButton>

                        <Link
                            :href="route('login')"
                            class="w-full text-center py-2 px-4 ms-4 text-sm text-gray-600 hover:text-blue-600 font-medium rounded-lg"
                        >
                            SIGN IN
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
