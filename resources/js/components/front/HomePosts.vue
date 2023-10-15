<script setup>
import { gradientBgBase } from "@/colors";
import SwiperPosts from "./SwiperPosts.vue";

const props = defineProps({
    colors: {
        type: Object,
        required: false,
    },
    name: {
        type: String,
        required: false,
    },
    post: {
        type: Array,
        required: false,
    }
});



</script>

<template>
    <section id="home" class="grid place-items-center overflow-hidden">
        <div class="grid grid-flow-row-dense grid-cols-1 lg:grid-cols-2 w-3/5 h-auto px-0 lg:px-10 place-items-center items-center text-center justify-centertext-center p-4 rounded-md mb-20 text-black bg-gradient-to-b from-primary-200/20 to-primary-200/10 bg-transparent"
            :style="{ background: colors ? `${colors.color2}` : '' }">
            <div class="text-5xl md:text-6xl font-bold text-white w-full pb-20 order-2 lg:order-1 justify-center items-center"
                :style="{ color: colors ? colors.color4 : '' }">
                <div class="flex items-center justify-center gap-3">
                    <img v-if="colors" class="w-1/4 mt-8" :src="`/images/${colors.file}`" alt="head1-img" />
                </div>
                <!-- <h2 class="text-4xl md:text-5xl justify-center items-center">HALLOW<span class="text-secondary">ee</span>D</h2> -->
                <h4 class="pt-5">{{ name }}</h4>
            </div>
            <SwiperPosts :colors="colors" :post="post" />

        </div>
    </section>

    <!-- <Table /> -->
</template>

<style>
@media (min-width: 768px) {
    .container {
        max-width: 100%;
        margin: 0;
    }

    @media (min-width: 1024px) {
        .container {
            max-width: 100%;
            margin: 0;
        }
    }

    @media (min-width: 1280px) {
        .container {
            max-width: 100%;
            margin: 0;
        }
    }

    @media (min-width: 1536px) {
        .container {
            max-width: 100%;
            margin: 0;
        }
    }
}
</style>
