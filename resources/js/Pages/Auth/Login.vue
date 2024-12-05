<script setup>
import Auth from "@/Layouts/Auth.vue";
defineOptions({layout: Auth})
import { useForm } from '@inertiajs/vue3'
import TextInput from "@/Pages/Components/TextInput.vue";
const form = useForm({
    email: null,
    password: null,
    remember: null
})

function submit() {
    form.post("/login", {
        onError: () => form.reset('password' | 'remember')
    })
}
</script>

<template>
    <Head title="Login"/>
    <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <Link :href="route('home')">
                <img class="mx-auto h-10 w-auto"
                     src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company"/>
            </Link>
            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Sign in to your account</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" @submit.prevent="submit">
                <TextInput name="Email" v-model="form.email" type="email" :message="form.errors.email" />
                <TextInput name="Password" v-model="form.password" type="password" :message="form.errors.password" />
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div class="flex items-center">
                        <input id="remember-me" v-model="form.remember" name="remember-me" type="checkbox" class="h-4 w-4 shrink-0 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" />
                        <label for="remember-me" class="ml-3 block text-sm text-gray-800">
                            Remember me
                        </label>
                    </div>
                    <div class="text-sm">
                        <Link :href="route('register')" class="hover:underline font-semibold">Register </Link>|
                        <a href="jajvascript:void(0);" class="hover:underline font-semibold">
                            Forgot your password?
                        </a>
                    </div>
                </div>
                <div>
                    <button type="submit" :disabled="form.processing"
                            class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Log in
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<style scoped>

</style>
