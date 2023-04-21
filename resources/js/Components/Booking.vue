<script setup>
import { ref } from "vue";
import ShowCalendarModal from "./ShowCalendarModal.vue";
import axios from "axios";
import { Link } from "@inertiajs/vue3";

const props = defineProps(["book"]);
const editing = ref(false);

let finishedLoading = ref(false);
const availabilities = ref([]);

const fetchAvailabilities = async (id) => {
    await axios.get(`/availability-booking/${id}`).then((response) => {
        console.log(response.data);

        finishedLoading.value = !finishedLoading.value;
        availabilities.value = response.data;
    });
};

function toggleEditing() {
    fetchAvailabilities(props.book.id);

    editing.value = !editing.value;
}
</script>

<template>
    <div class="sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="float-right px-2 inline-flex items-baseline">
            <div class="px-2 cursor-pointer">
                <button @click="toggleEditing">Edit</button>
            </div>

            <Link
                as="button"
                :href="route('book.destroy', book.id)"
                method="delete"
                >Cancel</Link
            >
        </div>

        <h2 class="text-lg inline font-medium text-gray-900">
            Booking {{ book.id }}
        </h2>
        <div class="">
            {{ book.start_date }} -

            {{ book.end_date }}
        </div>
        <div>
            <div v-if="editing" class="">
                <div v-if="!finishedLoading" class="">Loading...</div>

                <ShowCalendarModal
                    :availabilities="availabilities"
                    :bookId="book.id"
                    :editing="editing"
                    v-on:toggleEditing="toggleEditing"
                />
            </div>
        </div>
    </div>
</template>
