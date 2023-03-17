<script setup>
import Accommodation from "@/Components/Accommodation.vue";
import ShowAccommodationModal from "@/Components/ShowAccommodationModal.vue";

defineProps(["accommodations"]);

function setShowAccommodation() {
    showAccommodation = !showAccommodation;
}
</script>

<template>
    <Head title="Campinghuisje" />
    <body class="antialiased bg-gray-200 text-gray-900 font-sans p-6">
        <div class="container mx-auto">
            <div v-if="showAccommodation" class="flex flex-wrap -mx-4">
                <Accommodation
                    v-for="accommodation in accommodations"
                    :key="accommodation.id"
                    :accommodation="accommodation"
                    @click="setShowAccommodation"
                />
            </div>
            <!-- <div v-else class="flex flex-wrap -mx-4">
                <ShowAccommodationModal
                    :setShowAccommodation="setShowAccommodation"
                />
            </div> -->
        </div>
    </body>
</template>
