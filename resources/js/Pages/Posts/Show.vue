<template>
    <partial-header/>

    <section class="text-gray-600 body-font overflow-hidden pt-24 pb-8">

        <div class="max-w-7xl mx-auto">
            <p class="m-4 text-4xl font-bold text-gray-900">¡Welcome, {{$page.props.user.name}}!</p>
            <div class="bg-white overflow-hidden sm:rounded-lg m-4 p-4">
                <div class="grid grid-cols-3">
                    <div class="col-span-3">
                        <div class="px-4 sm:px0">
                            <h3 class="text-xl text-gray-900 font-bold">Post's Visualization</h3>
                            <p class="text-sm text-gray-600">Take a look to every post you gave to our posty blog.</p>
                        </div>
                    </div>
                    <div class="col-span-3 mt-5">
                        <div class="bg-white md:rounded-md">
                            <p class="text-2xl font-semibold">Title:</p>
                            <p>{{post.title}}</p>
                            <hr class="my-2">
                            <p class="text-2xl font-semibold">Publication Date: </p>
                            <p>{{post.publication_date}}</p>
                            <hr class="my-2">
                            <p class="text-2xl font-semibold">Description:</p>
                            <p v-html="post.description"></p>

                            <div class="my-6 flex justify-center">
                                <inertia-link
                                    class="bg-indigo-500 text-white font-bold py-2 px-4 mx-2 rounded-md hover:bg-indigo-800"
                                    :href="route('index')">
                                    Go back
                                </inertia-link>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <partial-footer/>

</template>

<style scoped>

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

    export default {
        components: {
            PartialHeader,
            PartialFooter
        },
        props: {
            post: Object,
        },
        data() {
            return {
                post: this.post,
            }
        },
        mounted() {

        },
        methods: {

        }
    }
</script>
