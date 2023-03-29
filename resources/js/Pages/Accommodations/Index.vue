<script setup>
import Accommodation from "@/Components/Accommodation.vue";

defineProps(["accommodations"]);
</script>

<template>
    <body class="antialiased bg-gray-200 text-gray-900 font-sans p-6">
        <div class="container mx-auto">
            <div class="flex flex-wrap -mx-4">
                <Accommodation
                    v-for="accommodation in accommodations"
                    :key="accommodation.id"
                    :accommodation="accommodation"
                />
            </div>
        </div>
    </body>
</template>
