<script setup>
import { ref, reactive } from "vue";
import VueTailwindDatepicker from "vue-tailwind-datepicker";
import PrimaryButton from "@/Components/PrimaryButton.vue";

import { useForm } from "@inertiajs/vue3";
const props = defineProps(["availabilities"]);

let dateValue = reactive([]);
const formatter = ref({
    date: "YYYY-MM-DD",
    month: "MMM",
});

const form = useForm({
    start_date: "",
    end_date: "",
});

function submit() {
    // since we are using start and end date in the validation, I set the values given from the calendar
    form.start_date = dateValue[0];
    form.end_date = dateValue[1];

    form.post(route("book.store"), {
        onSuccess: () => form.reset(),
    });
}

// to disable certain dates on the calendar based on the availability of the accommodation
const dDate = (date) => {
    for (let i = 0; i < props.availabilities.length; i++) {
        if (date < new Date(props.availabilities[i].end_date)) {
            return date;
        }
    }
};
</script>

<template>
    <form @submit.prevent="submit">
        <div class="bg-white hover:shadow-xl rounded-lg overflow-visible">
            <vue-tailwind-datepicker
                overlay
                as-single
                use-range
                placeholder="See availability"
                v-model="dateValue"
                :formatter="formatter"
                :disable-date="dDate"
            />
        </div>
        <div class="cursor-pointer">
            <PrimaryButton class="ml-4" type="submit">Click Me!</PrimaryButton>
        </div>
    </form>
</template>
