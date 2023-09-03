<script setup>
  import { gradientBgBase } from "@/colors";
import MySwiper from "@/components/front/MySwiper.vue";

  defineProps({
  colors:{
    type: Object,
    required: false,
  }
});
 
</script>

<template>
  <section id="home" class="grid place-items-center overflow-hidden">
    <div class="grid grid-flow-row-dense grid-cols-1 lg:grid-cols-2 items-end w-full px-0 lg:px-10 place-items-center text-center p-4 rounded-md mt-20 text-black bg-gradient-to-b from-primary-200/20 to-primary-200/10" :style="{background: colors ? colors.color3 : '',}" >
      <div class="text-5xl md:text-6xl font-bold text-white w-full pb-20 order-2 lg:order-1" :style="{color: colors ? colors.color4 : '',}">
        <div class="flex items-center justify-center gap-3">
          <img class="w-1/6" src="../assets/images/head1-img.png" alt="head1-img">
        </div>
        <!-- <h2 class="text-4xl md:text-5xl justify-center items-center">HALLOW<span class="text-secondary">ee</span>D</h2> -->
        <h4 class="pt-5">¡Las mejores camisas las tenemos nosotros!</h4>
      </div>
      <div class="w-full h-full order-1 lg:order-2">
        <MySwiper :colors="colors"/>
      </div>
    </div>
  </section>
  
  <!-- <Table /> -->
  
</template>