<script setup>
import Accommodation from "@/Components/Accommodation.vue";
import ShowAccommodationModal from "@/Components/ShowAccommodationModal.vue";
import ShowCalendarModal from "@/Components/ShowCalendarModal.vue";

import { ref, onMounted } from "vue";

defineProps(["accommodations"]);

let showCalendar = ref(true);

function setShowCalendar(e) {
    showCalendar.value = !showCalendar.value;
}
</script>

<template>
    <body class="antialiased bg-gray-200 text-gray-900 font-sans p-6">
        <div class="container mx-auto" v-if="showCalendar">
            <div class="flex flex-wrap -mx-4">
                <Accommodation
                    v-for="accommodation in accommodations"
                    :key="accommodation.id"
                    :accommodation="accommodation"
                    @setShowCalendar="setShowCalendar"
                />
            </div>
        </div>
        <div class="container mx-auto" v-else>
            <div class="flex flex-wrap -mx-4">
                <ShowCalendarModal
                    v-for="accommodation in accommodations"
                    :key="accommodation.id"
                    :accommodation="accommodation"
                    :showCalendar="showCalendar"
                    @click="showCalendar = true"
                />
            </div>
        </div>
    </body>
</template>
