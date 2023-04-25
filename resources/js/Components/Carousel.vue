<script setup>
import "vue3-carousel/dist/carousel.css";
import { Carousel, Slide, Pagination, Navigation } from "vue3-carousel";

const props = defineProps(["images"]);
</script>

<template>
    <Carousel v-if="props.images.length > 0" :items-to-show="3">
        <slide v-for="(image, index) in props.images" :key="index">
            <img class="mb-8" :src="`/storage/${image.src}`" alt="Tiny house" />
        </slide>

        <template #addons>
            <navigation />
            <pagination />
        </template>
    </Carousel>
    <div v-else>
        <img class="mb-8" :src="props.image.src" alt="Tiny house" />
    </div>
</template>
