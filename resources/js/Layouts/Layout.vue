<script setup>
import NavLink from "@/Components/NavLink.vue";
</script>

<template>
    <header>
        <NavLink></NavLink>
    </header>
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100"
    >
        <div class="">
            <slot />
        </div>
    </div>
</template>
