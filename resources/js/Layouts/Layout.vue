<script setup>
import { Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { Bars3Icon, BellIcon, XMarkIcon } from '@heroicons/vue/24/outline'

const navigation = [
    { name: 'Home', href: '/', current: true },
    { name: 'About', href: '/about', current: false },
    { name: 'Users', href: '/users', current: false },
    { name: 'Calendar', href: '#', current: false },
]
</script>

<template>
    <div>
        <Disclosure as="nav" class="bg-gray-800" v-slot="{ open }">
            <div class="px-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="relative flex items-center justify-between h-16">
                    <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                        <!-- Mobile menu button-->
                        <DisclosureButton class="relative inline-flex items-center justify-center p-2 text-gray-400 rounded-md hover:bg-gray-700 hover:text-white focus:ring-2 focus:ring-white focus:outline-hidden focus:ring-inset">
                            <span class="absolute -inset-0.5" />
                            <span class="sr-only">Open main menu</span>
                            <Bars3Icon v-if="!open" class="block size-6" aria-hidden="true" />
                            <XMarkIcon v-else class="block size-6" aria-hidden="true" />
                        </DisclosureButton>
                    </div>
                    <div class="flex items-center justify-center flex-1 sm:items-stretch sm:justify-start">
                        <div class="flex items-center shrink-0">
                            <img class="w-auto h-8" src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company" />
                        </div>
                        <div class="hidden sm:ml-6 sm:block">
                            <div class="flex space-x-4">
                                <Link v-for="item in navigation" :key="item.name" :href="item.href" class="px-3 py-2 text-sm font-medium text-gray-300 rounded-md hover:bg-gray-700 hover:text-white" :aria-current="item.current ? 'page' : undefined">{{ item.name }}</Link>
                            </div>
                        </div>
                    </div>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                        <button type="button" class="relative p-1 text-gray-400 bg-gray-800 rounded-full hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden">
                            <span class="absolute -inset-1.5" />
                            <span class="sr-only">View notifications</span>
                            <BellIcon class="size-6" aria-hidden="true" />
                        </button>

                        <!-- Profile dropdown -->
                        <Menu as="div" class="relative ml-3">
                            <div>
                                <MenuButton class="relative flex text-sm bg-gray-800 rounded-full focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden">
                                    <span class="absolute -inset-1.5" />
                                    <span class="sr-only">Open user menu</span>
                                    <img class="rounded-full size-8" :src="$page.props.auth.user ? $page.props.auth.user.avatar : 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80'" alt="User" />
                                </MenuButton>
                            </div>
                            <transition enter-active-class="transition duration-100 ease-out" enter-from-class="transform scale-95 opacity-0" enter-to-class="transform scale-100 opacity-100" leave-active-class="transition duration-75 ease-in" leave-from-class="transform scale-100 opacity-100" leave-to-class="transform scale-95 opacity-0">
                                <MenuItems class="absolute right-0 z-10 w-48 py-1 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black/5 focus:outline-hidden">
                                    <MenuItem v-slot="{ active }">
                                        <Link :href="route('profile')" :class="[active ? 'bg-gray-100 outline-hidden' : '', 'block px-4 py-2 text-sm text-gray-700']">Your Profile</Link>
                                    </MenuItem>
                                    <MenuItem v-slot="{ active }">
                                        <Link :href="route('dashboard')" :class="[active ? 'bg-gray-100 outline-hidden' : '', 'block px-4 py-2 text-sm text-gray-700']">Dashboard</Link>
                                    </MenuItem>
                                    <MenuItem v-slot="{ active }" v-if="$page.props.auth.user">
                                        <Link :href="route('logout')" method="post" as="button" type="button" :class="[active ? 'bg-gray-100 outline-hidden w-full text-start' : ' w-full text-start', ' w-full text-start block px-4 py-2 text-sm text-gray-700']">Sign out</Link>
                                    </MenuItem>
                                </MenuItems>
                            </transition>
                        </Menu>
                        <div v-if="$page.props.auth.user" class="ml-[10px]">
                                <Link :href="route('logout')" method="post" as="button" type="button" class="px-3 py-2 text-sm font-medium text-gray-300 rounded-md hover:bg-gray-700 hover:text-white">Logout</Link>
                            </div>
                            <div v-else>
                                <Link :href="route('login')" class="px-3 py-2 text-sm font-medium text-gray-300 rounded-md hover:bg-gray-700 hover:text-white">Login</Link>
                                <Link :href="route('register')" class="px-3 py-2 text-sm font-medium text-gray-300 rounded-md hover:bg-gray-700 hover:text-white">Register</Link>
                            </div>
                    </div>
                </div>
            </div>

            <DisclosurePanel class="sm:hidden">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <DisclosureButton v-for="item in navigation" :key="item.name" as="a" :href="item.href" :class="[item.current ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white', 'block rounded-md px-3 py-2 text-base font-medium']" :aria-current="item.current ? 'page' : undefined">{{ item.name }}</DisclosureButton>
                </div>
            </DisclosurePanel>
        </Disclosure>
        <main>
            <slot />
        </main>
    </div>
</template>

<style scoped>

</style>
