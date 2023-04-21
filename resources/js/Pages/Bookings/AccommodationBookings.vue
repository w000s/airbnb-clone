<script setup>
import Layout from "@/Layouts/Layout.vue";
import Booking from "@/Components/Booking.vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps(["bookings"]);
</script>

<template>
    <Layout>
        <div class="py-12">
            <div
                v-if="bookings.length > 0"
                class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8"
            >
                <Booking
                    v-for="(book, index) in bookings"
                    :key="index"
                    :book="book"
                />
            </div>
            <div v-else>
                <Link :href="route('home')">
                    This tiny house has no Bookings yet
                </Link>
            </div>
        </div></Layout
    >
</template>
