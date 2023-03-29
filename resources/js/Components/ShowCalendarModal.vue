<script setup>
import { ref } from "vue";
import VueTailwindDatepicker from "vue-tailwind-datepicker";
const props = defineProps(["availabilities"]);

const dateValue = ref([]);
const formatter = ref({
    date: "YYYY MM DD",
    month: "MMM",
});

const dDate = (date) => {
    for (let i = 0; i < props.availabilities.length; i++) {
        console.log("index:", i, "element:", props.availabilities[i].end_date);
        return (
            date < new Date() ||
            date < new Date(props.availabilities[i].end_date)
        );
    }

    // console.log(availability);
    // console.log(i);
    // return date < new Date() || date;
    // return date < new Date() || date < new Date(element.end_date);
};
</script>

<template>
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
</template>

<style></style>
