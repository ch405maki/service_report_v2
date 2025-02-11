<template>
    <GuestLayout>
        <Head title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
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

            <div class="block mt-4">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ms-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Forgot your password?
                </Link>

                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Log in
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, router } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = ref({
    email: '',
    password: '',
    remember: false,
    errors: {
        email: '',
        password: ''
    },
    processing: false,
});

const submit = async () => {
    form.value.processing = true;
    form.value.errors = { email: '', password: '' };

    try {
        const response = await axios.post('/api/login', {
            email: form.value.email,
            password: form.value.password,
            remember: form.value.remember,
        });

        // If the response status is OK, proceed with the login logic
        if (response.status === 200) {
            // Store token and user data in localStorage
            const { user, token } = response.data;
            localStorage.setItem('auth_token', token);
            localStorage.setItem('user', JSON.stringify(user));

            // Set the Authorization header for future requests
            axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;

            router.visit('/dashboard');
        }
    } catch (error) {
        if (error.response && error.response.data.errors) {
            // Set errors based on validation feedback from the backend
            form.value.errors = error.response.data.errors;
        } else {
            // Handle other errors (e.g., network error)
            console.error('Error logging in:', error);
        }
    } finally {
        form.value.processing = false;
    }
};
</script>