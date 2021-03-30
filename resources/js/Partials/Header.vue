<template>
    <div class="fixed top-0 w-full flex items-center justify-between bg-black pb-4 pt-4 px-4">
        <div>
            <a :href="route('index')" class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-indigo-500 rounded-full" viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                </svg>
                <span class="ml-3 text-xl text-white">Posty</span>
            </a>
        </div>


        <div>
            <template v-if="$page.props.user">
                <jet-dropdown align="right" width="48">
                    <template #trigger>
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center bg-indigo-500 border-0 py-1 px-3 focus:outline-none hover:bg-indigo-900 rounded text-white mt-0">
                                        {{ $page.props.user.name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                    </template>

                    <template #content>
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-black-400">
                            Manage Account
                        </div>

                        <jet-dropdown-link :href="route('index')" class="hover:text-indigo">
                            Profile
                        </jet-dropdown-link>

                        <div class="border-t border-gray-100"></div>

                        <!-- Authentication -->
                        <form @submit.prevent="logout">
                            <jet-dropdown-link as="button">
                                Log Out
                            </jet-dropdown-link>
                        </form>
                    </template>
                </jet-dropdown>
            </template>

            <template v-else>
                <inertia-link :href="route('login')" class="inline-flex items-center bg-indigo-500 border-0 py-1 px-3 mx-2 focus:outline-none hover:bg-indigo-900 rounded text-white mt-4 md:mt-0">
                    Login
                </inertia-link>

                <inertia-link :href="route('register')" class="inline-flex items-center bg-indigo-500 border-0 py-1 px-3 mx-2 focus:outline-none hover:bg-indigo-900 rounded text-white mt-4 md:mt-0">
                    Register
                </inertia-link>
            </template>
        </div>
    </div>
</template>

<script>
    import JetDropdown from '@/Jetstream/Dropdown'
    import JetDropdownLink from '@/Jetstream/DropdownLink'

    export default {
        components: {
            JetDropdown,
            JetDropdownLink,
        },
        props: {
            canLogin: Boolean,
            canRegister: Boolean,
        },
        data() {
            return { }
        },
        methods: {
            logout() {
                this.$inertia.post(route('logout'));
            },
        }
    }
</script>
