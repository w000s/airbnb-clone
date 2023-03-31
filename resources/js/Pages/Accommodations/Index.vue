<script setup>
import Accommodation from "@/Components/Accommodation.vue";
import Layout from "@/Layouts/Layout.vue";

defineProps(["accommodations"]);
</script>

<template>
    <Layout>
        <div class="flex flex-wrap mx-4">
            <Accommodation
                v-for="accommodation in accommodations"
                :key="accommodation.id"
                :accommodation="accommodation"
            />
        </div>
    </Layout>
</template>
