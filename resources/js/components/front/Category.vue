<script setup>
  import category1 from "../assets/futbol/images/real-madrid-2014.png"
  import category2 from "../assets/futbol/images/italia.png"
  import category3 from "../assets/futbol/images/champions.png"

  const categories = [
    {
      title: 'Camisetas para adultos',
      image: category1,
      desc: ''
    },
    {
      title: 'Camisetas para niños',
      image: category2,
      desc: ''
    },
    {
      title: 'Accesorios',
      image: category3,
      desc: ''
    },
  ]

  defineProps({
    colors:{
      type: Object,
      required: false
    }
});

</script>

<template>
  <section id="category" class="flex flex-col items-center py-10">
    <h2 class="my-10 mb-14 text-5xl md:text-6xl font-bold text-white">Categorías</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 place-items-center gap-20">
      <div v-for="category of categories" :key="category.title" class="text-white grid place-items-center text-center p-8 rounded-md max-h-fit bg-gradient-to-b from-primary-200/20 to-primary-200/10" 
      :style="{backgroundColor: colors ? `${colors.color3}` : '',}">
        <div class="pb-10 pt-10">
          <img :src="category.image" class="w-full" alt="category1">
        </div>
        <h3 class="text-3xl font-bold">{{ category.title }}</h3>
        <p class="w-3/4">{{ category.desc}}</p>
      </div>
    </div>
  </section>
  
</template>