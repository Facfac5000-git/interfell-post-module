<template>
    <partial-header/>

    <section class="text-gray-600 body-font overflow-hidden py-24">

        <div class="max-w-7xl mx-auto">
            <p class="text-4xl font-bold text-gray-900">¡Welcome, {{$page.props.user.name}}!</p>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg m-4 pt-4">
                <div class="md:grid md:grid-cols-3 md:gap-6 ">
                    <div class="col-span-3">
                        <div class="px-4 sm:px0">
                            <h3 class="text-xl text-gray-900 font-bold">New Post</h3>
                            <p class="text-sm text-gray-600">Here you can create a new post for our blog, share whatever you want with our comunity!</p>
                        </div>
                    </div>
                    <div class="col-span-3 mt-5">
                        <div class="shadow bg-white md:rounded-md">
                            <form @submit.prevent="submit">
                                <div class="mb-4">
                                    <label for="title" class="block font-medium text-sm text-gray-700">Title:</label>
                                    <input id="title" class="form-input w-full rounded-md shadow-sm" v-model="form.title" type="text">
                                </div>
                                <div class="mb-4">
                                    <label class="block font-medium text-sm text-gray-700">Description:</label>
                                    <quill-editor theme="snow"></quill-editor>
                                </div>

                                <div class="mb-4">
                                    <input type="submit" value="Save" class="bg-indigo-500 hover:bg-indigo-800 text-white font-bold mx-6 py-2 px-4 rounded-md cursor-pointer">

                                    <inertia-link
                                        class="bg-indigo-500 text-white font-bold py-2 px-4 mx-auto rounded-md w-1/2 md:w-2/5 hover:bg-indigo-800 text-center md:text-left"
                                        :href="route('index')">
                                        Go back
                                    </inertia-link>

                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <partial-footer/>

</template>

<style scoped>

    .ql-container{
        min-height: 200px;
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

    import { QuillEditor } from '@vueup/vue-quill'
    import '@vueup/vue-quill/dist/vue-quill.snow.css';


    export default {
        components: {
            PartialHeader,
            PartialFooter,
            QuillEditor,
        },
        props: {

        },
        data() {
            return {
                form: {
                    title: '',
                    description: ''
                }
            }
        },
        mounted() {
        },
        methods: {
            submit(){
                this.form.description = document.querySelector(".ql-editor").innerHTML;
                console.log(this.form.description);
                console.log(this.form);
                this.$inertia.post(this.route('posts.store'), this.form);
            }
        }
    }
</script>
