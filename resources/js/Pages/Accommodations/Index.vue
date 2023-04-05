<script setup>
import Accommodation from "@/Components/Accommodation.vue";
import Pagination from "@/Components/Pagination.vue";
import Layout from "@/Layouts/Layout.vue";
import { ref } from "vue";

const props = defineProps(["accommodations"]);

const currentPage = ref(props.accommodations.from);
const perPage = ref(props.accommodations.per_page);
const total = ref(props.accommodations.total);
const links = ref(props.accommodations.links);
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
        <Pagination
            :currentPage="currentPage"
            :perPage="perPage"
            :total="total"
            :links="links"
        />
    </div>
</template>
