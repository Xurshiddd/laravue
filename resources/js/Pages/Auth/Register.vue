<script setup>
import Auth from "@/Layouts/Auth.vue";

defineOptions({layout: Auth})
import {useForm} from '@inertiajs/vue3'
import TextInput from "@/Pages/Components/TextInput.vue";
const form = useForm({
    avatar: null,
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
    preview: null
})
const input = document.getElementById('inp')
const image = document.getElementById('img')
const removeImage = () => {
    form.avatar = null;
    form.preview = null;
};

const change = (e) => {
    form.avatar = e.target.files[0]
    form.preview = URL.createObjectURL(e.target.files[0])
    input.style.display = "none";
    image.style.display = " ";
}

function submit() {
    form.post("/register", {
        onError: () => form.reset(
            form.password = null,
            form.password_confirmation = null,
            form.avatar = null
        )
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
                <TextInput name="Name" v-model="form.name" :message="form.errors.name"/>
                <TextInput name="Email" v-model="form.email" type="email" :message="form.errors.email"/>
                <TextInput name="Password" v-model="form.password" type="password" :message="form.errors.password"/>
                <TextInput name="Confirm password" v-model="form.password_confirmation" type="password"
                           :message="form.errors.password_confirmation"/>
                <div class="mb-3">
                    <label for="avatar" class="block text-sm/6 font-medium text-gray-900">Image</label>
                    <input @input="change" class="file-input" type="file" id="avatar"/>
                    <small v-if="form.errors.avatar" style="color: red">{{ form.errors.avatar }}</small>

                    <!-- Image Preview -->
                    <div v-if="form.preview" class="flex justify-center items-center pt-[15px]">
                        <div class="relative w-[100px]">
                            <img :src="form.preview" class="w-[100px] rounded-[50%]" alt="Preview"/>
                            <span @click="removeImage" class="absolute bg-blue-500 text-blue-100 px-2 py-1 text-xs font-bold rounded-full -top-3 -right-3" style="cursor: pointer">x</span>
                        </div>
                    </div>
                </div>
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
.file-input {
    display: block;
    margin-top: 10px;
    padding: 8px;
}
</style>
