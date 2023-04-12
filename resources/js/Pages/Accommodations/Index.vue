<script setup>
import Accommodation from "@/Components/Accommodation.vue";
import Pagination from "@/Components/Pagination.vue";
import Layout from "@/Layouts/Layout.vue";

const props = defineProps(["accommodations"]);
</script>

<template>
    <Layout>
        <div class="flex flex-wrap mx-4">
            <Accommodation
                v-for="accommodation in accommodations.data"
                :key="accommodation.id"
                :accommodation="accommodation"
            />
        </div>
    </Layout>
    <div class="flex flex-col items-center">
        <Pagination :accommodations="props.accommodations" />
    </div>
</template>
