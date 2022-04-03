<template>
    <div>
        <x-head :title="title" />

        <JetBanner />

        <div class="min-h-screen bg-gray-100">
            <nav class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <x-link :href="route('dashboard')">
                                    <JetApplicationMark class="block h-9 w-auto" />
                                </x-link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <JetNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                    Dashboard
                                </JetNavLink>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative">
                                <JetDropdown align="right" width="48">
                                    <template #trigger>
                                        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                            <img class="h-8 w-8 rounded-full object-cover" :src="page.user.profile_photo_url" :alt="page.user.name">
                                        </button>
                                    </template>

                                    <template #content>
                                        <!-- Account Management -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            Manage Account
                                        </div>

                                        <JetDropdownLink :href="route('profile.show')">
                                            Profile
                                        </JetDropdownLink>

                                        <JetDropdownLink v-if="page.jetstream.hasApiFeatures" :href="route('api-tokens.index')">
                                            API Tokens
                                        </JetDropdownLink>

                                        <div class="border-t border-gray-100" />

                                        <!-- Authentication -->
                                        <form @submit.prevent="logout">
                                            <JetDropdownLink as="button">
                                                Log Out
                                            </JetDropdownLink>
                                        </form>
                                    </template>
                                </JetDropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition" @click="showingNavigationDropdown = ! showingNavigationDropdown">
                                <svg
                                    class="h-6 w-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
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
                <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <JetResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Dashboard
                        </JetResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="flex items-center px-4">
                            <img class="h-10 w-10 rounded-full object-cover" :src="page.user.profile_photo_url" :alt="page.user.name">

                            <div>
                                <div class="font-medium text-base text-gray-800">
                                    {{ page.user.name }}
                                </div>
                                <div class="font-medium text-sm text-gray-500">
                                    {{ page.user.email }}
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <JetResponsiveNavLink :href="route('profile.show')" :active="route().current('profile.show')">
                                Profile
                            </JetResponsiveNavLink>

                            <JetResponsiveNavLink v-if="page.jetstream.hasApiFeatures" :href="route('api-tokens.index')" :active="route().current('api-tokens.index')">
                                API Tokens
                            </JetResponsiveNavLink>

                            <!-- Authentication -->
                            <form method="POST" @submit.prevent="logout">
                                <JetResponsiveNavLink as="button">
                                    Log Out
                                </JetResponsiveNavLink>
                            </form>

                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header v-if="$slots.header" class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>

<script>
import { ref, defineComponent } from "vue";
import { Inertia } from "@inertiajs/inertia";
import JetApplicationMark from '@/Jetstream/ApplicationMark.vue';
import JetBanner from '@/Jetstream/Banner.vue';
import JetDropdown from '@/Jetstream/Dropdown.vue';
import JetDropdownLink from '@/Jetstream/DropdownLink.vue';
import JetNavLink from '@/Jetstream/NavLink.vue';
import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink.vue';

export default defineComponent({
    name: 'AppLayout',

    props: ['title'],

    components: {
        JetApplicationMark,
        JetBanner,
        JetDropdown,
        JetDropdownLink,
        JetNavLink,
        JetResponsiveNavLink,
    },

    setup() {
        const showingNavigationDropdown = ref(false);

        return {
            showingNavigationDropdown
        }
    },

    data() {
        return {
            page: this.$page.props,
        }
    },

    created() {
        window.axios.interceptors.response.use(res => {
            return res
        }, e => {
            switch(e.response.status) {
                case 401:
                    this.$toast.error('You are not authenticated.');
                    Inertia.visit(route('login'));
                    return;
                case 403:
                    // todo: come back to this when you figure out the response shape for the error message.
                    // - Sketch, 04:59pm 03/04/2022
                    console.log(e.response.data);
                    this.$toast.error(`You do not have permission to access this resource.
                    <strong>${e.response.data.message}</strong>`);
                    return;
                case 404:
                    this.$toast.error('The requested resource could not be found.');
                    return;
                case 419:
                    this.$toast.error('Token Mismatch. Please refresh the page and try again.');
                    return;
                case 422:
                    this.$toast.error('Whoops. Something went wrong.');
                    return;
                case 429:
                    this.$toast.error("Whoa, there! You're sending too many requests. Please wait a moment before trying again.");
                    return
                case 500:
                    this.$toast.error('Whoops. Something went wrong on our end. Please try again shortly.');
                    return;
                case 502:
                case 504:
                    this.$toast.error("An error has occurred with the server software. We're working on getting service restored.");
                    return;
                case 503:
                    this.$toast.error(`We're currently performing maintenance. Check back shortly.`);
                    return;
            }
            return e;
        });
    },

    methods: {
        switchToTeam(team) {
            Inertia.put(route('current-team.update'), {
                team_id: team.id,
            }, {
                preserveState: false,
            });
        },

        logout() {
            Inertia.post(route('logout'));
        },
    }
})
</script>
