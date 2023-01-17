<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import BigDangerButton from '@/Components/BigDangerButton.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

defineProps({
    canResetPassword: Boolean,
    status: String,
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

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <template  #div1>
           <h3 class="bg-gray-100 -mt-4 -mx-6 p-3 text-base text-center font-bold border-b border-gray-200 border-solid text-gray-500">MÁTE-LI UŽ ÚČET, PŘIHLASTE SE</h3>
            <p class="mt-5 italic">Přes svou sociální síť..</p>
            <div class="mt-3"><a href="auth/facebook"><img class="img-fluid" src="img/facebook-login-icon.png" /></a></div>
            <div class="mt-1"><a href="auth/google"><img class="img-fluid" src="img/google-login-icon.png" /></a></div>
            <hr class="mt-5">
            <p class="mt-5 italic">Nebo klasicky..</p>
            
            <form @submit.prevent="submit" class="mt-4">
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
                   
                    <InputLabel for="password" value="Heslo" class="mt-2" />
                    <TextInput
                        id="password"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="form.password"
                        required
                        autofocus
                        autocomplete="password"
                    />

                    <BigDangerButton class="mt-3">Přihlásit</BigDangerButton>
                </div>
            </form>
        </template>
        <template #div2>
            <h3 class="bg-gray-100 -mt-4 -mx-6 p-3 text-base text-center font-bold border-b border-gray-200 border-solid text-gray-500">NEMÁTE-LI ÚČET, ZAREGISTRUJTE SE</h3>
            <a href="register" class="mt-5 md:mt-10 md:py-20 w-full inline-block items-center px-1 py-3 mb-1 bg-red-600 border border-transparent rounded-md font-semibold text-xl text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150 text-center">Registrovat</a>
        </template>
    </GuestLayout>
</template>
