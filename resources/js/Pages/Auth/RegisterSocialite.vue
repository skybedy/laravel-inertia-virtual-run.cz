<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import BirdthYearOption from '@/Components/BirdthYearOption.vue';

import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    firstname: '',
    lastname: '',
    gender: '',
    birth_year: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

    <template>
        <Head title="Register" />
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 b-gray-100">
        <div>
            <Link href="/">
                <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
            </Link>
        </div>
        <div class="w-ful sm:max-w-md my-2 md:mr-5  px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg border border-solid border-gray-200">
            <div class="mt-3"><img class="img-fluid" src="img/facebook-login-icon.png" /></div>
            <div class="mt-1"><a href="auth/google"><img class="img-fluid" src="img/google-login-icon.png" /></a></div>
            <hr class="mt-5">

            
            
            <form @submit.prevent="submit">
                <div class="mt-4">
                    <InputLabel for="firstname" value="Jméno" />
                    <TextInput
                        id="firstname"
                        type="text"
                        required
                        class="mt-1 block w-full"
                        v-model="form.firstname"
                        autofocus
                        autocomplete="firstname"
                    />
                    <InputError class="mt-2" :message="form.errors.firstname" />
                </div>

                <div class="mt-4">
                    <InputLabel for="lastname" value="Příjmení" />
                    <TextInput
                        id="lastname"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.lastname"
                        required
                        autofocus
                        autocomplete="lastname"
                    />
                    <InputError class="mt-2" :message="form.errors.lastname" />
                </div>



                <div class="mt-4">
                    <InputLabel for="gender" value="Pohlaví" />
                    <select id="gender" name="gender"  v-model="form.gender" required class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                        <option value="" selected disabled></option>
                        <option value="M">Muž</option>
                        <option value="F">Žena</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.gender" />
                </div>

                <div class="mt-4">
                    <InputLabel for="birth_year" value="Ročník" />
                    <select id="birth_year" name="birth_year" v-model="form.birth_year" required class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                        <option value="" selected disabled></option>
                        <BirdthYearOption></BirdthYearOption>
                    </select>
                    <InputError class="mt-2" :message="form.errors.birth_year" />
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



                <div class="flex items-center justify-end mt-4">
                    <Link
                        :href="route('login')"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Already registered?
                    </Link>

                    <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Register
                    </PrimaryButton>
                </div>
            </form>

        </div>
    </div>









         </template>
