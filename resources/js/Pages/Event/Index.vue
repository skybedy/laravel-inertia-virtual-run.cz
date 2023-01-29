<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import BirdthYearOption from '@/Components/BirdthYearOption.vue';

import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { propsToAttrMap } from '@vue/shared';




defineProps({
    events: String
})




</script>

<template>
        


        <ul>
            <li v-for="(value,index) in events" v-bind:key="index">
                {{ value.name }}
            </li>
        </ul>


        
</template>
