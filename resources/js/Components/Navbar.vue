<script setup>
import { computed, ref, watch, reactive } from "vue";
import { Link } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";

const user = computed(() => usePage().props.auth.user);
const showingNavigationDropdown = ref(false);
const props = defineProps(["href", "active"]);
</script>

<template>
    <nav
        class="bg-white w-full flex relative justify-between items-center mx-auto px-16 h-30"
    >
        <div class="inline-flex">
            <Link class="_o6689fn" href="/">
                <div>
                    <img
                        src="/images/tiny.png"
                        class="object-contain h-20 w-40"
                    />
                </div>
            </Link>
        </div>

        <!-- search bar -->
        <div class="hidden sm:block flex-shrink flex-grow-0 justify-start px-2">
            <div class="inline-block">
                <div class="inline-flex items-center max-w-full">
                    <button
                        class="flex items-center flex-grow-0 flex-shrink pl-2 relative w-60 border rounded-full px-1 py-1"
                        type="button"
                    >
                        <div
                            class="block flex-grow flex-shrink overflow-hidden"
                        >
                            Start your search
                        </div>
                        <div
                            class="flex items-center justify-center relative h-8 w-8 rounded-full"
                        >
                            <svg
                                viewBox="0 0 32 32"
                                xmlns="http://www.w3.org/2000/svg"
                                aria-hidden="true"
                                role="presentation"
                                focusable="false"
                                style="
                                    display: block;
                                    fill: none;
                                    height: 12px;
                                    width: 12px;
                                    stroke: currentcolor;
                                    stroke-width: 5.33333;
                                    overflow: visible;
                                "
                            >
                                <g fill="none">
                                    <path
                                        d="m13 24c6.0751322 0 11-4.9248678 11-11 0-6.07513225-4.9248678-11-11-11-6.07513225 0-11 4.92486775-11 11 0 6.0751322 4.92486775 11 11 11zm8-3 9 9"
                                    ></path>
                                </g>
                            </svg>
                        </div>
                    </button>
                </div>
            </div>
        </div>
        <!-- end search bar -->

        <div class="flex md:hidden">
            <button
                type="button"
                class="text-gray-100 hover:text-gray-400 focus:outline-none focus:text-gray-400"
            >
                <svg viewBox="0 0 24 24" class="w-6 h-6 fill-current">
                    <path
                        fill-rule="evenodd"
                        d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"
                    ></path>
                </svg>
            </button>
        </div>

        <!-- login -->
        <div class="flex-initial">
            <div class="flex justify-end items-center relative">
                <div class="flex mr-4 items-center">
                    <Link
                        :href="route('createAccommodationPage')"
                        class="inline-block py-2 px-3 hover:bg-gray-200 rounded-full"
                    >
                        <div
                            class="flex items-center relative cursor-pointer whitespace-nowrap"
                        >
                            Become a host
                        </div>
                    </Link>
                </div>

                <div class="block" v-if="user">
                    <div class="inline relative">
                        <button
                            type="button"
                            @click="
                                showingNavigationDropdown =
                                    !showingNavigationDropdown
                            "
                            class="inline-flex items-center relative px-2 border rounded-full hover:shadow-lg"
                        >
                            <div>
                                <!-- Settings Dropdown -->
                                <div>
                                    <Dropdown align="right" width="48">
                                        <template #trigger>
                                            <span
                                                class="inline-flex rounded-md"
                                            >
                                                <button
                                                    type="button"
                                                    class="inline-flex items-center px-3 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                                >
                                                    {{ user.first_name }}
                                                    {{ user.last_name }}

                                                    <svg
                                                        class="ml-2 -mr-0.5 h-4 w-4"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20"
                                                        fill="currentColor"
                                                    >
                                                        <path
                                                            fill-rule="evenodd"
                                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                            clip-rule="evenodd"
                                                        />
                                                    </svg>
                                                </button>
                                            </span>
                                        </template>

                                        <template #content>
                                            <DropdownLink
                                                :href="route('profile.edit')"
                                            >
                                                Profile
                                            </DropdownLink>
                                            <DropdownLink
                                                :href="route('book.index')"
                                            >
                                                Bookings
                                            </DropdownLink>
                                            <DropdownLink
                                                :href="route('profile.index')"
                                            >
                                                Tiny house
                                            </DropdownLink>
                                            <DropdownLink
                                                :href="route('logout')"
                                                method="post"
                                                as="button"
                                            >
                                                Log Out
                                            </DropdownLink>
                                        </template>
                                    </Dropdown>
                                </div>
                            </div>
                            <div
                                class="block flex-grow-0 flex-shrink-0 h-10 w-12 pl-5"
                            >
                                <svg
                                    viewBox="0 0 32 32"
                                    xmlns="http://www.w3.org/2000/svg"
                                    aria-hidden="true"
                                    role="presentation"
                                    focusable="false"
                                    style="
                                        display: block;
                                        height: 100%;
                                        width: 100%;
                                        fill: currentcolor;
                                    "
                                >
                                    <path
                                        d="m16 .7c-8.437 0-15.3 6.863-15.3 15.3s6.863 15.3 15.3 15.3 15.3-6.863 15.3-15.3-6.863-15.3-15.3-15.3zm0 28c-4.021 0-7.605-1.884-9.933-4.81a12.425 12.425 0 0 1 6.451-4.4 6.507 6.507 0 0 1 -3.018-5.49c0-3.584 2.916-6.5 6.5-6.5s6.5 2.916 6.5 6.5a6.513 6.513 0 0 1 -3.019 5.491 12.42 12.42 0 0 1 6.452 4.4c-2.328 2.925-5.912 4.809-9.933 4.809z"
                                    ></path>
                                </svg>
                            </div>
                        </button>
                    </div>
                </div>
                <div v-else>
                    <Link
                        href="/login"
                        class="inline-block py-2 px-3 hover:bg-gray-200 rounded-full"
                    >
                        <div class="inline relative cursor-pointer">Login</div>
                    </Link>
                </div>
            </div>
        </div>
    </nav>
</template>
