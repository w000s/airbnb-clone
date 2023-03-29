<script setup>
import { ref } from "vue";
import VueTailwindDatepicker from "vue-tailwind-datepicker";
import ShowCalendarModal from "@/Components/ShowCalendarModal.vue";

const props = defineProps([
    "accommodation",
    "accommodation_images",
    "availabilities",
]);
const accommodation = props.accommodation[0];
const accommodation_images = `/../storage/${props.accommodation_images[0].src}`;

function retrieveStandardImage() {
    return `../storage/standard_image.jpg`;
}
</script>

<template>
    <div class="container mx-auto">
        <div class="flex flex-col lg:flex-row h-full py-24">
            <div class="w-full h-full lg:w[60%] bg-yellow-500">
                <img
                    :src="accommodation_images"
                    alt="some image"
                    @error="retrieveStandardImage"
                />
                <h2 className="h2">{{ accommodation.location }}</h2>
                <p class="mb-8">{{ accommodation.description }}</p>
            </div>
            <div class="w-full h-full lg:w-[40%] bg-blue-300">
                <div class="">Bedrooms: {{ accommodation.bedrooms }}</div>
                <div class="">
                    Beds:
                    {{ accommodation.beds }}
                </div>
                <div class="">
                    Maximum of Guests:
                    {{ accommodation.maximum_of_guests }}
                </div>
                <div class="">Price €{{ accommodation.price }}</div>
                <div class="bg-white rounded-lg overflow-visible">
                    <ShowCalendarModal :availabilities="props.availabilities" />
                </div>
            </div>
        </div>
    </div>
</template>
