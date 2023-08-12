<script setup>
  import MySwiper from "@/components/front/MySwiper.vue";
 
</script>

<template>
  <section id="home" class="grid place-items-center mt-20 md:mt-10 overflow-hidden">
    <div class="grid grid-flow-row-dense grid-cols-1 lg:grid-cols-2 items-end gap-10 lg:gap-16 w-full px-0 lg:px-10">
      <div class="text-5xl md:text-6xl font-bold text-white w-full pb-20 order-2 lg:order-1">
        <div class="flex items-center gap-3">
          <h2>BOOO</h2>
          <img src="../assets/images/head1-img.png" alt="head1-img">
        </div>
        <h2 class="text-4xl md:text-5xl">TRICK OR TREAT!!</h2>
        <p class="pt-5 text-lg font-normal">This is a memorable place where you can find all the information about Halloween</p>
      </div>
      <div class="w-full h-full order-1 lg:order-2">
        <MySwiper/>
      </div>
    </div>
  </section>
  
  <!-- <Table /> -->
  
</template>