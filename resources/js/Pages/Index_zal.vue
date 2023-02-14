<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/inertia-vue3';
import ButtonLink from '@/Components/ButtonLink.vue';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <div class="min-h-screen">
            
            
            <nav class="bg-white border-b border-gray-300">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('dashboard')">
                                    <ApplicationLogo
                                        class="block h-9 w-auto fill-current text-gray-800"
                                    />
                                </Link>
                                <span class="ml-2">Virtual-Run.cz</span>
                            </div>

                        </div>

                        <!-- Right Side -->
                        <div class="hidden sm:flex sm:items-center sm:ml-5 space-x-5"> 
                            <!-- Settings Dropdown -->
                            
                                <NavLink :href="route('event')">
                                    Závody
                                </NavLink>
                                <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                    Výsledky
                                </NavLink>
                                <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                    Kontakt
                                </NavLink>
                                <ButtonLink :href="route('login')" class="border-solid border border-red-600  hover:bg-red-700 hover:text-white text-red-700 py-2 px-4 rounded">Přihlásit se</ButtonLink>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button
                                @click="showingNavigationDropdown = !showingNavigationDropdown"
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                            >
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex': !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex': showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
                    class="sm:hidden"
                >
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Dashboard
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Dashboardtest
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800">
                                {{  }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">{{  }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <a :href="route('login')" class="border-solid border border-red-600  hover:bg-red-700 hover:text-white text-red-700 py-2 px-4 rounded">
  Přihlásit se
</a>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading 
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
                </div>
            </header>-->


            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
