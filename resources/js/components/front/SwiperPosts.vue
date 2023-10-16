<script setup>
// import Swiper core and required modules
import { Pagination } from 'swiper/modules';

// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from 'swiper/vue';

import { onMounted } from 'vue'

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/pagination';

const modules = [Pagination]

const props = defineProps({
  colors: {
    type: Object,
    required: false,
  },
  post: {
    type: Array,
    required: false,
  }
});

const separateId = (url) => {
  const urlSplit = url.split("=");
  return urlSplit[1];
};

const separateIdIg = (url) => {
  const urlSplit = url.split("/");
  return urlSplit[4];
};

onMounted(() => {
  console.log(props.post)
})

</script>

<template>
  <swiper :modules="modules" :slides-per-view="1" :pagination="{ clickable: true }"
    class="w-full h-full place-items-center">



    <swiper-slide v-for="(post, i) of post" :key="post.id"
      class="grid place-items-center text-center w-full gap-5 p-8 rounded-md text-black bg-gradient-to-b from-primary-200/20 to-primary-200/10"
      :class="i === 1 && 'from-primary-200/50 to-primary-200/30 lg:-translate-y-10 '"
      :style="{ background: colors ? `${colors.color2}` : '', }">
      <iframe v-if="post.type === 'youtube'" class="w-full h-full overflow-hidden overflow-y-hidden"
        :src="`http://www.youtube.com/embed/${separateId(post.url)}?autoplay=1&mute=1`"
        title="YouTube video player" frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
        allowfullscreen></iframe>
        <iframe v-else :src="`https://www.instagram.com/p/${separateIdIg(post.url)}/embed`" width="400" height="480" frameborder="0" scrolling="no" allowtransparency="true"></iframe>
    </swiper-slide>
  </swiper>
</template>

<style>
/* .swiper-pagination-bullet {
    @apply w-3 h-3 bg-black opacity-100
  }
  .swiper-pagination-bullet.swiper-pagination-bullet-active {
    @apply rounded-xl w-6  bg-white 
  }
  swiper-slide {
    display: flex;
  } */
</style>