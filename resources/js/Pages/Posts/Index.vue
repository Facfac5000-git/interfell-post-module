<template>
    <partial-header/>

    <section class="text-gray-600 body-font overflow-hidden py-24">

        <div class="max-w-7xl mx-auto">
            <p class="text-4xl font-bold text-gray-900">Welcome back, {{$page.props.user.name}}!</p>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg m-4 pt-4">
                <div class="md:grid md:grid-cols-3 md:gap-6 ">
                    <div class="col-span-2">
                        <div class="px-4 sm:px0">
                            <h3 class="text-xl text-gray-900 font-bold">Post's List</h3>
                            <p class="text-sm text-gray-600">Here you can watch every post you made to contribute to our community!</p>
                        </div>
                    </div>
                    <div class="col-span-1">
                        <div class="flex justify-end mb-6">
                            <inertia-link :href="route('posts.create')"
                                          class="bg-indigo-500 text-white font-bold py-2 px-4 mx-auto rounded-md w-1/2 md:w-2/5 hover:bg-indigo-800 text-center md:text-left">
                                Crear nuevo post
                            </inertia-link>
                        </div>
                    </div>
                    <div class="col-span-3 mt-5">
                        <div class="shadow bg-white md:rounded-md">
                            <tr>
                                <th class="border p-2 w-1/2">Post's Title</th>
                                <th class="border p-2 w-1/2">Publication Date</th>
                                <th class="border p-2 w-1/6">Action</th>
                            </tr>
                        </div>
                        <div class="shadow bg-white md:rounded-md" v-for="post in posts.data">
                            <tr>
                                <td class="border p-2 w-1/2">
                                    {{ post.title }}
                                </td>
                                <td class="border p-2 w-1/2">
                                    {{ post.publication_date }}
                                </td>
                                <td class="border p-2 w-1/6" >
                                    <inertia-link :href="route('posts.show', post)" class="hover:text-green-500">
                                        Look it!
                                    </inertia-link>
                                </td>
                            </tr>
                        </div>
                    </div>

                    <div class="col-span-3 my-3">
                        <nav class="flex justify-center">
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
                    </div>

                </div>
            </div>
        </div>

    </section>

    <partial-footer/>

</template>

<style scoped>

    active{
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
    import PartialHeader from '@/Partials/Header'
    import PartialFooter from '@/Partials/Footer'

    import {Http} from "vue-resource";

    export default {
        components: {
            PartialHeader,
            PartialFooter
        },
        props: {
            user: Object,
        },
        data() {
            return {
                posts: {},
                user: this.user,
            }
        },
        mounted() {
            this.getPostsbyUser();
        },
        methods: {
            getPostsbyUser(){
                Http.get('/posts/'+this.user.id).then(
                    (response) => {this.posts = response.data}
                );
            },
            getPage(page){
                Http.get('/posts/'+this.user.id+'?page='+page).then(
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
