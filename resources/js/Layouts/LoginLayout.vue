<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100"
    >
        <div class="flex">
            <div class="">
                <Link class="_o6689fn" href="/">
                    <div>
                        <img
                            src="/images/tiny.png"
                            class="object-contain h-20 w-40"
                        />
                    </div>
                </Link>
            </div>
        </div>
        <slot />
    </div>
</template>
