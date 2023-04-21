<script setup>
import { watch, ref } from "vue";
import VueTailwindDatepicker from "vue-tailwind-datepicker";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps([
    "availabilities",
    "accommodationId",
    "bookId",
    "editing",
    "createAvailabilityMode",
    "setAvailability",
]);

const emit = defineEmits(["toggleEditing", "setAvailabilities"]);

const dateValue = ref([]);
const formatter = ref({
    date: "YYYY-MM-DD",
    month: "MMM",
});
const message = false;

// to disable certain dates on the calendar based on the availability of the accommodation
const dDate = (date) => {
    if (props.availabilities) {
        for (let i = 0; i < props.availabilities.length; i++) {
            return (
                date > new Date(props.availabilities[i].end_date) ||
                date < new Date(props.availabilities[i].start_date)
            );
        }
    } else {
        return null;
    }
};

const form = useForm({
    start_date: "",
    end_date: "",
    accommodation_id: props.accommodationId,
});

function submitBookPost() {
    // since we are using start and end date in the validation, I set the values given from the calendar
    form.start_date = dateValue.value[0];
    form.end_date = dateValue.value[1];

    form.post(route("book.store"), {
        onSuccess: () => form.reset(),
    });
}

function submitBookUpdate(bookId) {
    form.start_date = dateValue.value[0];
    form.end_date = dateValue.value[1];

    form.put(route("book.update", bookId));
}

watch(
    dateValue,
    (value) => {
        emit("setAvailabilities", value);
    },
    { deep: true }
);

function cancel() {
    emit("toggleEditing");
}
</script>

<template>
    <form v-if="!createAvailabilityMode">
        <div class="bg-white hover:shadow-xl rounded-lg overflow-visible">
            <vue-tailwind-datepicker
                no-input
                as-single
                use-range
                placeholder="See availability"
                v-model="dateValue"
                :formatter="formatter"
                :disable-date="dDate"
            />
        </div>
        <div v-if="props.editing" class="cursor-pointer">
            <PrimaryButton
                @click.prevent="submitBookUpdate(bookId)"
                type="submit"
                class="mt-4 cursor-pointer"
                >Save</PrimaryButton
            >
            <button class="mt-4" @click.prevent="cancel">Cancel</button>

            <div v-if="message">Booking updated succesfully.</div>
        </div>

        <div v-else class="cursor-pointer">
            <PrimaryButton
                class="mt-4-4"
                @click.prevent="submitBookPost"
                type="submit"
                >Book</PrimaryButton
            >
        </div>
    </form>
    <div v-else class="">
        <vue-tailwind-datepicker
            as-single
            use-range
            placeholder="See availability"
            v-model="dateValue"
            :formatter="formatter"
            :disable-date="dDate"
        />
    </div>
</template>
