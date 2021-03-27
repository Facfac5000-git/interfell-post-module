<template>
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            <inertia-link v-if="$page.props.user" href="/dashboard" class="text-sm text-gray-700 underline">
                Dashboard
            </inertia-link>

            <template v-else>
                <inertia-link :href="route('login')" class="text-sm text-gray-700 underline">
                    Log in
                </inertia-link>

                <inertia-link v-if="canRegister" :href="route('register')" class="ml-4 text-sm text-gray-700 underline">
                    Register
                </inertia-link>
            </template>
        </div>

        <section class="text-gray-600 body-font overflow-hidden">

            <div class="container px-5 py-24 mx-auto" v-for="post in posts.data">
                <div class="-my-8 divide-y-2 divide-gray-100">
                    <div class="py-8 flex flex-wrap md:flex-nowrap">
                        <div class="md:w-64 md:mb-0 mb-6 flex-shrink-0 flex flex-col">
                            <span class="font-semibold title-font text-gray-700">{{post.user.name}}</span>
                            <span class="mt-1 text-gray-500 text-sm">{{post.publication_date}}</span>
                        </div>
                        <div class="md:flex-grow">
                            <h2 class="text-2xl font-medium text-gray-900 title-font mb-2">{{post.title}}</h2>
                            <p class="leading-relaxed">{{post.description}}</p>
                            <a class="text-indigo-500 inline-flex items-center mt-4">Learn More
                                <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14"></path>
                                    <path d="M12 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            <nav>
                <ul v-if="posts.total" class="pagination">
                    <li class="page-item first" :class="{'disabled': posts.current_page === 1}">
                        <a class="page-link" @click.prevent="getPage(1)">First</a>
                    </li>
                    <li class="page-item previous" :class="{'disabled': posts.current_page === 1}">
                        <a class="page-link" @click.prevent="getPreviousPage">Prev.</a>
                    </li>
                    <li v-for="n in posts.last_page" class="page-item page-number" :class="{'active': posts.current_page === n}">
                        <a class="page-link" @click.prevent="getPage(n)">{{n}}</a>
                    </li>
                    <li class="page-item next" :class="{'disabled': posts.current_page === posts.last_page}">
                        <a class="page-link" @click.prevent="getNextPage()">Next</a>
                    </li>
                    <li class="page-item last" :class="{'disabled': posts.current_page === posts.last_page}">
                        <a class="page-link" @click.prevent="getPage(posts.last_page)">Last</a>
                    </li>
                </ul>
            </nav>


        </section>


    </div>
</template>

<style scoped>


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

    import { Http } from 'vue-resource'

    export default {
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
