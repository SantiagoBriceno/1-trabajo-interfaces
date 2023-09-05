<script setup>
  // import Swiper core and required modules
  import { Pagination } from 'swiper/modules';

  // Import Swiper Vue.js components
  import { Swiper, SwiperSlide } from 'swiper/vue';

  // Import Swiper styles
  import 'swiper/css';
  import 'swiper/css/pagination';

  const modules = [Pagination]

  defineProps({
  colors:{
    type: Object,
    required: false,
  }
});

  
</script>

<template>
  <swiper
    :modules="modules"
    :slides-per-view="1"
    :pagination="{ clickable: true }"
    class="pb-8"
  >
    <swiper-slide class="grid place-items-center">
      <img src="../assets/futbol/images/argentina.png" class="w-[100%]" />
    </swiper-slide>
    <swiper-slide class="grid place-items-center">
      <img src="../assets/futbol/images/bayern.png" class="w-[100%]" />
    </swiper-slide>
    <swiper-slide class="grid place-items-center">
      <img src="../assets/futbol/images/brasil.png" class="w-[100%]" />
    </swiper-slide>
    <swiper-slide class="grid place-items-center">
      <img src="../assets/futbol/images/real-madrid.png" class="w-[100%]" />
    </swiper-slide>
    <swiper-slide class="grid place-items-center h-60">
      <img src="../assets/futbol/images/psg.png" class="w-[100%]" />
    </swiper-slide>
  </swiper>
</template>

<style>
  .swiper-pagination-bullet {
    @apply w-3 h-3 bg-black opacity-100
  }
  .swiper-pagination-bullet.swiper-pagination-bullet-active {
    @apply rounded-xl w-6  bg-white 
  }
  swiper-slide {
    display: flex;
  }
</style>