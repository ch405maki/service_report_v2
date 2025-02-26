<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div
            class="w-full sm:max-w-md mt-6 px-6 py-6 bg-white shadow-md overflow-hidden sm:rounded-lg"
        >
            <div class="flex justify-center mb-4">
                <Link href="/">
                    <div class="flex items-center">
                        <img src="/images/itc.png" alt="Logo" class="w-[60px] h-[60px]" />
                    </div>
                </Link>
            </div>
            <slot />
        </div>
    </div>
</template>
