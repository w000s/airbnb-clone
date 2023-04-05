<script setup>
defineProps(["message"]);
</script>

<template>
    <p class="text-sm display: inline leading-none text-red-600">
        {{ message }}
    </p>
</template>
