<script setup>
import ShowCalendarModal from "@/Components/ShowCalendarModal.vue";
import Carousel from "@/Components/Carousel.vue";
import Layout from "@/Layouts/Layout.vue";

const props = defineProps([
    "accommodation",
    "accommodation_images",
    "availabilities",
]);
</script>

<template>
    <Layout>
        <div class="container mx-auto">
            <div class="flex flex-col lg:flex-row h-full py-24">
                <div class="w-full h-full">
                    <div class="">
                        <Carousel
                            :is="accommodation_images"
                            :images="accommodation_images"
                        />
                    </div>

                    <h2 className="h2">{{ accommodation.location }}</h2>
                    <p class="mb-8">{{ accommodation.description }}</p>
                </div>
                <div class="w-full h-full lg:w-[40%] bg-blue-300">
                    <div>Bedrooms: {{ accommodation.bedrooms }}</div>
                    <div>
                        Beds:
                        {{ accommodation.beds }}
                    </div>
                    <div>
                        Maximum of Guests:
                        {{ accommodation.maximum_of_guests }}
                    </div>
                    <div>Price €{{ accommodation.price }}</div>
                    <div class="bg-white rounded-lg overflow-visible">
                        <ShowCalendarModal
                            :accommodationId="accommodation.id"
                            :availabilities="availabilities"
                        />
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>
