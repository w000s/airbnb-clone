<script setup>
import Navbar from "@/Components/Navbar.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Tiny house" />

    <header>
        <Navbar></Navbar>
    </header>
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100"
    >
        <slot />
    </div>
</template>
