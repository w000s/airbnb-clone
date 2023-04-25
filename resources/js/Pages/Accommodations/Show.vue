<script setup>
import ShowCalendarModal from "@/Components/ShowCalendarModal.vue";
import Carousel from "@/Components/Carousel.vue";
import Layout from "@/Layouts/Layout.vue";

const props = defineProps([
    "accommodation",
    "accommodation_images",
    "availabilities",
]);

const images =
    props.accommodation_images.length > 0
        ? props.accommodation_images
        : "/storage/tiny.png";
</script>

<template>
    <Layout>
        <div class="container mx-auto">
            <div class="w-full h-full">
                <h2 class="text-xl px-6 py-12">
                    {{ accommodation.location }}
                </h2>

                <Carousel :images="images" />
            </div>
            <div class="flex flex-col lg:flex-row h-full py-32">
                <div class="w-full h-full lg:w-[80%] max-md px-6">
                    <div class="px-6">
                        <h2 class="text-xl mb-4">Description</h2>
                        <p class="mb-12">{{ accommodation.description }}</p>

                        <h3 class="py-12 text-xl">Room Facilicities</h3>
                        <p class="mb-12">
                            {{ accommodation.facilities }}
                        </p>
                    </div>
                </div>
                <div class="w-full h-full lg:w-[40%] px-6">
                    <div class="px-6">
                        <div class="flex flex-col space-y-4 mb-4">
                            <h3 class="text-xl mb-4">Availabilities</h3>
                            <div class="h-[60px] mb-12">
                                <ShowCalendarModal
                                    :price="accommodation.price"
                                    :availabilities="availabilities"
                                    :accommodationId="accommodation.id"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>
