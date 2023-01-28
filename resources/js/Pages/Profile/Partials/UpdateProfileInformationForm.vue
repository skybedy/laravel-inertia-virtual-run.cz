<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

import { Link, useForm, usePage } from '@inertiajs/inertia-vue3';
import { ref, onMounted } from 'vue';

const props = defineProps({
    mustVerifyEmail: Boolean,
    status: String,
});

const user = usePage().props.value.auth.user;

const form = useForm({
    lastname: user.lastname,
    firstname: user.firstname,
    birth_year: user. birth_year,
    gender: user.gender,
    email: user.email,
});


const yearsList = ref([])

const getYearsList = () => {
    const startYear = 1924;
    const endYear = new Date().getFullYear();
    for (let i = startYear; i <= endYear; i++) {
        yearsList.value = [...yearsList.value, i]
    }
}

const genderList = {
    'M' : 'Muž',
    'F' : 'Žena'
}

onMounted(() => {
  getYearsList()
})

</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Informace o profilu</h2>

            <p class="mt-1 text-sm text-gray-600">
                Upravte své osobní informace.
            </p>
        </header>

        <form @submit.prevent="form.patch(route('profile.update'))" class="mt-6 space-y-6">
            <div>
                <InputLabel for="firstname" value="Jméno" />
                <TextInput
                    id="text"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.firstname"
                    required
                    autofocus
                    autocomplete="firstname"
                />
                <InputError class="mt-2" :message="form.errors.firstname" />
            </div>

            <div>
                <InputLabel for="lastname" value="Příjmení" />
                <TextInput
                    id="text"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.lastname"
                    required
                    autofocus
                    autocomplete="lastname"
                />
            </div>

            <div class="mt-4">
                    <InputLabel for="gender" value="Pohlaví" />
                    <select id="gender" name="gender" v-model="form.gender" required class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                        <option value="" selected disabled></option>
                        <option v-for="(gender, genderKey) in genderList" :key="genderKey" :value="genderKey" :selected="form.gender">{{gender}}</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.gender" />
            </div>



            <div class="mt-4">
                    <InputLabel for="birth_year" value="Ročník" />
                    <select id="birth_year" name="birth_year" v-model="form.birth_year" required class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                        <option value="" selected disabled></option>
                        <option v-for="(year, y) in yearsList" :key="y" :value="year" :selected="form.birth_year">{{year}}</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.birth_year" />
            </div>
            <div>
                <InputLabel for="email" value="Email" />
                <div class="mt-1  bg-slate-50 border-gray-300 border rounded-md shadow-sm px-3 py-2">
                    {{form.email}}
                </div>
            </div>
            
            <div v-if="props.mustVerifyEmail && user.email_verified_at === null">
                <p class="text-sm mt-2 text-gray-800">
                    Your email address is unverified.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Click here to re-send the verification email.
                    </Link>
                </p>

                <div
                    v-show="props.status === 'verification-link-sent'"
                    class="mt-2 font-medium text-sm text-green-600"
                >
                    A new verification link has been sent to your email address.
                </div>
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
