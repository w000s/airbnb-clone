<script setup>
import { ref } from "vue";
import VueTailwindDatepicker from "vue-tailwind-datepicker";

const dateValue = ref("");
</script>

<template>
    <div class="bg-white hover:shadow-xl rounded-lg overflow-visible">
        <vue-tailwind-datepicker
            overlay
            as-single
            use-range
            placeholder="See availability"
            v-model="dateValue"
            disable
        />
    </div>
</template>

<style></style>
