<script setup>

defineProps({
    users: Object,
})
</script>
<template>
    <div>
        <div class="cont">
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                            <table
                                class="min-w-full text-left text-sm font-light text-surface">
                                <thead
                                    class="border-b">
                                <tr>
                                    <th scope="col" class="px-6 py-4">#</th>
                                    <th scope="col" class="px-6 py-4">Name</th>
                                    <th scope="col" class="px-6 py-4">Email</th>
                                    <th scope="col" class="px-6 py-4">Image</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="border-b" v-for="user in users.data"
                                    :key="user.id">
                                    <td class="px-6 py-4 font-medium">{{ user.id }}</td>
                                    <td class="px-6 py-4">{{ user.name }}</td>
                                    <td class="px-6 py-4">{{ user.email }}</td>
                                    <td class="px-6 py-4"><img
                                        :src="user.avatar ? user.avatar : '/images/1734154351_675d186f826c3.jpg'"
                                        alt="img" class="w-[50px]"></td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="pt-3">
                                <Link v-for="link in users.links"
                                      :key="link.label"
                                      v-html="link.label"
                                      :href="link.url"
                                      class="p-1 mx-1"
                                      :class="{'text-slate-300': !link.url, 'text-blue-500 font-medium': link.active}"
                                      :disabled="!link.url">
                                </Link>
                                <p class="text-slate-600 text-sm">
                                    Showing {{ users.from }} to {{ users.to }} of {{ users.total }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.cont {
    width: 80%;
    margin: auto;
}
</style>
