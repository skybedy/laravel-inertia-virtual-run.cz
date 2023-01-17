<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <h1>akoko</h1>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 b-gray-100">
        <div>
            <Link href="/">
                <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
            </Link>
        </div>
        <div class="block md:flex b-red-200">
            <div
                class="w-ful sm:max-w-md my-2 md:mr-5  px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg border border-solid border-gray-200"
            >
                <slot name="div1" />
            </div>
            <div
                class="w-ful sm:max-w-md my-10 md:ml-5 md:my-2 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg border border-solid border-gray-200"
            >
                <slot name="div2"/>
            </div>
        </div>
    </div>
</template>
