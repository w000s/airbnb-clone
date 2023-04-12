<script setup>
import { reactive, ref, watch } from "vue";
import ShowCalendarModal from "@/Components/ShowCalendarModal.vue";

const props = defineProps(["book"]);
const editing = ref(false);
let availabilities = reactive([]);

function toggleEditing() {
    editing.value = !editing.value;
}

async function fetchAvailabilites(id) {
    return new Promise(async function (resolve) {
        const res = await fetch(`/availability-booking/${id}`);

        resolve(res.json());
    });
}

watch(editing, () => {
    availabilities = fetchAvailabilites(props.book.id).then(
        console.log("hello")
    );

    availabilities.then(console.log(availabilities));
});
</script>

<template>
    <div class="p-16 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="float-right inline-flex items-baseline">
            <div class="px-2 cursor-pointer">
                <button @click="toggleEditing">edit</button>
            </div>
            <div class="cursor-pointer">delete</div>
        </div>
        <section>
            <header>
                <h2 class="text-lg font-medium text-gray-900">
                    Booking {{ book.id }}
                </h2>
            </header>

            <div v-if="editing">
                <ShowCalendarModal :bookId="book.id" />
            </div>

            <div v-else>
                {{ book.start_date }} -
                {{ book.end_date }}
            </div>
        </section>
    </div>
</template>
