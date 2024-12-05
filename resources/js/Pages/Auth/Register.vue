<script setup>
import Auth from "@/Layouts/Auth.vue";
defineOptions({layout: Auth})
import { useForm } from '@inertiajs/vue3'
import TextInput from "@/Pages/Components/TextInput.vue";
const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null
})

function submit() {
    form.post("/register", {
        onError: () => form.reset('password'|'password_confirmation')
    })
}
</script>

<template>
    <Head title="Register"/>
    <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <Link :href="route('home')">
                <img class="mx-auto h-10 w-auto"
                     src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company"/>
            </Link>
            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Register</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" @submit.prevent="submit">
                <TextInput name="Name" v-model="form.name" :message="form.errors.name" />
                <TextInput name="Email" v-model="form.email" type="email" :message="form.errors.email" />
                <TextInput name="Password" v-model="form.password" type="password" :message="form.errors.password" />
                <TextInput name="Confirm password" v-model="form.password_confirmation" type="password" :message="form.errors.password_confirmation" />
                <div class="flex items-center">
                    <p>Already register?</p>
                    <Link :href="route('login')" class="hover:underline font-semibold ml-2.5">Login</Link>
                </div>
                <div>
                    <button type="submit" :disabled="form.processing"
                            class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<style scoped>

</style>
