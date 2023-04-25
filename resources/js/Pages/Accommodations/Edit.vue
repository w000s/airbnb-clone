<script setup>
import Layout from "@/Layouts/Layout.vue";
import { useForm, Head } from "@inertiajs/vue3";
import { ref, reactive, onMounted } from "vue";
import ShowCalendarModal from "@/Components/ShowCalendarModal.vue";
import InputError from "@/Components/InputError.vue";

const props = defineProps(["accommodation", "accommodation_images"]);

let createAvailabilityMode = ref(true);
let availabilities = ref([]);

const form = useForm({
    location: "",
    description: "",
    facilities: "",
    beds: "",
    bedrooms: "",
    maximum_of_guests: "",
    price: "",
    images: null,
    availabilities: null,
});

function setAvailabilities(dateValue) {
    form.availabilities = dateValue;
}

onMounted(() => {
    form.location = props.accommodation.location;
    form.description = props.accommodation.description;
    form.facilities = props.accommodation.facilities;
    form.beds = props.accommodation.beds;
    form.bedrooms = props.accommodation.bedrooms;
    form.maximum_of_guests = props.accommodation.maximum_of_guests;
    form.price = props.accommodation.price;
    form.images = props.accommodation_images;
});

function submit() {
    createAvailabilityMode = !createAvailabilityMode;

    form.put(route("accommodationUpdate", props.accommodation.id));
}
</script>

<template>
    <Layout>
        <Head title="Update Accommodation" />
        <form enctype="multipart/form-data">
            <div class="mt-5 bg-white rounded-lg shadow">
                <div class="py-5 px-5">
                    <h1 class="inline text-2xl font-semibold leading-none">
                        Edit your Tiny House
                    </h1>
                </div>
                <div class="py-5 px-5">
                    <input
                        placeholder="Location"
                        v-model="form.location"
                        class="text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200 focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400"
                    />
                    <InputError :message="form.errors.location" />
                    <textarea
                        v-model="form.description"
                        placeholder="Describe your tiny house in the best way possible!"
                        class="text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200 focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400"
                    ></textarea>
                    <InputError :message="form.errors.description" />
                    <textarea
                        v-model="form.facilities"
                        placeholder="Facilities"
                        class="text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200 focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400"
                    ></textarea>
                    <div class="flex">
                        <div class="flex-grow w-1/4 pr-2">
                            <input
                                v-model="form.beds"
                                type="number"
                                placeholder="Beds"
                                class="text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200 focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400"
                            />
                            <InputError
                                class="flex-none"
                                :message="form.errors.beds"
                            />
                        </div>
                        <div class="flex-grow">
                            <input
                                v-model="form.bedrooms"
                                type="number"
                                placeholder="Bedrooms"
                                class="text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200 focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400"
                            />
                            <InputError
                                class="flex-none"
                                :message="form.errors.bedrooms"
                            />
                        </div>
                    </div>
                    <div class="flex">
                        <div class="flex-grow w-1/4 pr-2">
                            <input
                                type="number"
                                v-model="form.maximum_of_guests"
                                placeholder="Guests"
                                class="text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200 focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400"
                            />
                            <InputError
                                class="flex-none"
                                :message="form.errors.maximum_of_guests"
                            />
                        </div>
                        <div class="flex-grow">
                            <input
                                v-model="form.price"
                                placeholder="Price"
                                class="text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200 focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400"
                            />
                            <InputError
                                class="flex-none"
                                :message="form.errors.price"
                            />
                        </div>
                    </div>
                    <input
                        type="file"
                        @input="form.images = $event.target.files"
                        multiple
                        class="text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200 focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400"
                    />
                    <InputError :message="form.errors.images" />

                    <div>
                        <div>
                            Select availability dates:
                            <ShowCalendarModal
                                :availabilities="availabilities"
                                v-on:setAvailabilities="setAvailabilities"
                                :createAvailabilityMode="createAvailabilityMode"
                            />
                        </div>
                    </div>
                </div>
                <hr class="mt-4" />
                <div class="flex flex-row-reverse p-3">
                    <div class="flex-initial pl-3">
                        <button
                            @click.prevent="submit"
                            class="flex items-center px-5 py-2.5 font-medium tracking-wide text-white capitalize bg-black rounded-md hover:bg-gray-800 focus:outline-none focus:bg-gray-900 transition duration-300 transform active:scale-95 ease-in-out"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                height="24px"
                                viewBox="0 0 24 24"
                                width="24px"
                                fill="#FFFFFF"
                            >
                                <path d="M0 0h24v24H0V0z" fill="none"></path>
                                <path
                                    d="M5 5v14h14V7.83L16.17 5H5zm7 13c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3zm3-8H6V6h9v4z"
                                    opacity=".3"
                                ></path>
                                <path
                                    d="M17 3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V7l-4-4zm2 16H5V5h11.17L19 7.83V19zm-7-7c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3zM6 6h9v4H6z"
                                ></path>
                            </svg>
                            <span class="pl-2 mx-1">Save</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </Layout>
</template>
