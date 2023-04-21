<script setup>
import "vue3-carousel/dist/carousel.css";
import { Carousel, Slide, Pagination, Navigation } from "vue3-carousel";

const props = defineProps(["images"]);
</script>

<template>
    <Carousel autoplay :items-to-show="2">
        <slide v-for="(image, index) in props.images" :key="index">
            <img :src="`/storage/${image.src}`" alt="" />
        </slide>

        <template #addons>
            <navigation />
            <pagination />
        </template>
    </Carousel>
</template>
