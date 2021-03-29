<template>
    <div class="fixed top-0 w-full flex items-center justify-between bg-black pb-4 pt-4 px-4">
        <div>
            <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-indigo-500 rounded-full" viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                </svg>
                <span class="ml-3 text-xl text-white">Posty</span>
            </a>
        </div>


        <div v-if="canLogin">
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

                            <jet-dropdown-link :href="route('dashboard')" class="hover:text-indigo">
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

    <section class="text-gray-600 body-font overflow-hidden py-8">
        <div class="container px-5 pt-24 mx-auto" v-for="post in posts.data">
            <div class="-my-8 divide-y-2 divide-gray-100">
                <div class="py-8 flex flex-wrap md:flex-nowrap">
                    <div class="md:w-64 md:mb-0 mb-6 flex-shrink-0 flex flex-col">
                        <span class="font-semibold title-font text-gray-700">{{post.user.name}}</span>
                        <span class="mt-1 text-gray-500 text-sm">{{post.publication_date}}</span>
                    </div>
                    <div class="md:flex-grow">
                        <h2 class="text-2xl font-medium text-gray-900 title-font mb-2">{{post.title}}</h2>
                        <p class="leading-relaxed">{{post.description}}</p>
                    </div>
                </div>

            </div>
        </div>

        <nav class="flex justify-center pt-8">
            <ul v-if="posts.total" class="pagination">
                <li class="page-item first" :class="{'disabled': posts.current_page === 1, 'active': posts.current_page === 1}">
                    <a class="page-link" @click.prevent="getPage(1)">&#60;&#60;</a>
                </li>
                <li class="page-item previous" :class="{'disabled': posts.current_page === 1}">
                    <a class="page-link" @click.prevent="getPreviousPage">&#60;</a>
                </li>
                <li v-for="n in posts.last_page" class="page-item page-number" :class="{'active': posts.current_page === n}">
                    <a v-if="(n <= posts.current_page+2 && n >= posts.current_page-2)" class="page-link" @click.prevent="getPage(n)">{{n}}</a>
                </li>
                <li class="page-item next" :class="{'disabled': posts.current_page === posts.last_page}">
                    <a class="page-link" @click.prevent="getNextPage()">&#62;</a>
                </li>
                <li class="page-item last" :class="{'disabled': posts.current_page === posts.last_page, 'active': posts.current_page === posts.last_page}">
                    <a class="page-link" @click.prevent="getPage(posts.last_page)">&#62;&#62;</a>
                </li>
            </ul>
        </nav>
        <p class="text-center">Showing {{posts.from}}-{{posts.to}} of {{posts.total}} results</p>
    </section>

    <footer class="text-gray-600 body-font bg-black">
        <div class="container px-5 py-8 mx-auto flex items-center sm:flex-row flex-col">
            <a class="flex title-font font-medium items-center md:justify-start justify-center text-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-indigo-500 rounded-full" viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                </svg>
                <span class="ml-3 text-xl text-white">Posty</span>
            </a>
            <p class="text-sm text-gray-500 sm:ml-4 sm:pl-4 sm:border-l-2 sm:border-gray-200 sm:py-2 sm:mt-0 mt-4">© 2020 Dandelion Upgrades</p>
            <span class="inline-flex sm:ml-auto sm:mt-0 mt-4 justify-center sm:justify-start">
              <a class="text-gray-500">
                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                  <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                </svg>
              </a>
              <a class="ml-3 text-gray-500">
                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                  <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                </svg>
              </a>
              <a class="ml-3 text-gray-500">
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                  <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                  <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                </svg>
              </a>
              <a class="ml-3 text-gray-500">
                <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="0" class="w-5 h-5" viewBox="0 0 24 24">
                  <path stroke="none" d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"></path>
                  <circle cx="4" cy="4" r="2" stroke="none"></circle>
                </svg>
              </a>
            </span>
        </div>
    </footer>

</template>

<style scoped>

    .active{
        font-weight: bold;
    }

    .pagination ul{
        margin: 0;
        padding: 0;
        display: inline-block;
    }

    .pagination li{
        listStyle: none;
        display: inline;
        textAlign: center;
    }

    .pagination a {
        cursor: pointer;
        padding: 6px 12px;
        display: block;
        float: left;
    }

    .bg-gray-100 {
        background-color: #f7fafc;
        background-color: rgba(247, 250, 252, var(--tw-bg-opacity));
    }

    .border-gray-200 {
        border-color: #edf2f7;
        border-color: rgba(237, 242, 247, var(--tw-border-opacity));
    }

    .text-gray-400 {
        color: #cbd5e0;
        color: rgba(203, 213, 224, var(--tw-text-opacity));
    }

    .text-gray-500 {
        color: #a0aec0;
        color: rgba(160, 174, 192, var(--tw-text-opacity));
    }

    .text-gray-600 {
        color: #718096;
        color: rgba(113, 128, 150, var(--tw-text-opacity));
    }

    .text-gray-700 {
        color: #4a5568;
        color: rgba(74, 85, 104, var(--tw-text-opacity));
    }

    .text-gray-900 {
        color: #1a202c;
        color: rgba(26, 32, 44, var(--tw-text-opacity));
    }

    @media (prefers-color-scheme: dark) {
        .dark\:bg-gray-800 {
            background-color: #2d3748;
            background-color: rgba(45, 55, 72, var(--tw-bg-opacity));
        }

        .dark\:bg-gray-900 {
            background-color: #1a202c;
            background-color: rgba(26, 32, 44, var(--tw-bg-opacity));
        }

        .dark\:border-gray-700 {
            border-color: #4a5568;
            border-color: rgba(74, 85, 104, var(--tw-border-opacity));
        }

        .dark\:text-white {
            color: #fff;
            color: rgba(255, 255, 255, var(--tw-text-opacity));
        }

        .dark\:text-gray-400 {
            color: #cbd5e0;
            color: rgba(203, 213, 224, var(--tw-text-opacity));
        }
    }
</style>

<script>
    import JetDropdown from '@/Jetstream/Dropdown'
    import JetDropdownLink from '@/Jetstream/DropdownLink'

    import { Http } from 'vue-resource'

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
            return {
                posts: {},
            }
        },
        mounted() {
            this.getPosts();
        },
        methods: {
            logout() {
                this.$inertia.post(route('logout'));
            },
            getPosts(){
                Http.get('/posts').then(
                    (response) => {this.posts = response.data}
                );
            },
            getPage(page){
                Http.get('/posts?page='+page).then(
                    (response) => {this.posts = response.data}
                )
            },
            getPreviousPage(){
                Http.get(this.posts['prev_page_url']).then(
                    (response) => {this.posts = response.data}
                )
            },
            getNextPage(){
                Http.get(this.posts['next_page_url']).then(
                    (response) => {this.posts = response.data}
                )
            },
        }
    }
</script>
