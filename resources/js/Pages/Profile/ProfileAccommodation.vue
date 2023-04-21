<script setup>
import Pagination from "@/Components/Pagination.vue";
import Layout from "@/Layouts/Layout.vue";
import { Link } from "@inertiajs/vue3";

console.log(props.accommodations);
const props = defineProps(["accommodations"]);
</script>

<template>
    <Layout>
        <div class="max-w-2xl mx-auto" v-if="accommodations.data.length > 0">
            <div
                class="p-4 max-w-md bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700"
            >
                <div class="flex justify-between items-center">
                    <h3
                        class="text-xl font-bold leading-none text-gray-900 dark:text-white"
                    >
                        Manage Tiny houses
                    </h3>
                </div>
                <div class="flow-root">
                    <ul
                        role="list"
                        class="divide-y divide-gray-200 dark:divide-gray-700"
                    >
                        <li class="sm:py-4">
                            <div
                                class="flex items-center space-x-4 space-y-3"
                                v-for="accommodation in accommodations.data"
                                :key="accommodation.id"
                                :accommodation="accommodation"
                            >
                                <div class="flex-shrink-0">
                                    <img
                                        class="w-8 h-8 rounded-full"
                                        :src="`/../../storage/${accommodation.src}`"
                                        alt="Image"
                                    />
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p
                                        class="text-sm font-medium text-gray-900 truncate dark:text-white"
                                    >
                                        {{ accommodation.location }}
                                    </p>
                                    <p
                                        class="text-sm text-gray-500 truncate dark:text-gray-400"
                                    >
                                        {{ accommodation.description }}
                                    </p>
                                </div>
                                <div
                                    class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white"
                                >
                                    €{{ accommodation.price }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <Link
                                        :href="
                                            route(
                                                'accommodationToUpdate',
                                                accommodation.id
                                            )
                                        "
                                    >
                                        <p
                                            class="text-sm font-medium cursor-pointer text-gray-900 truncate dark:text-white"
                                        >
                                            Edit Tiny house
                                        </p>
                                    </Link>

                                    <Link
                                        :href="
                                            route(
                                                'view-booking',
                                                accommodation.id
                                            )
                                        "
                                    >
                                        <p
                                            class="text-sm font-medium cursor-pointer text-gray-900 truncate dark:text-white"
                                        >
                                            View Bookings
                                        </p>
                                    </Link>
                                    <p
                                        class="text-sm font-medium cursor-pointer text-gray-900 truncate dark:text-white"
                                    ></p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div v-else class="">
            <Link :href="route('createAccommodationPage')">
                You have no tiny houses hosted on this site. You can be host
                your tiny house by clicking on this link!</Link
            >
        </div>
    </Layout>
    <div class="flex flex-col items-center">
        <Pagination :accommodations="props.accommodations" />
    </div>
</template>
