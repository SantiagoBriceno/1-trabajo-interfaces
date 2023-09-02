<script setup>
import Navbar from '@/components/front/Navbar.vue';
import Home from '@/components/front/Home.vue';
import Category from '@/components/front/Category.vue';
import TrickOrTreat from '@/components/front/TrickOrTreat.vue';
import Subscribe from '@/components/front/Subscribe.vue';
import Footer from '@/components/front/Footer.vue';
import { Head} from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    colors:{
      type: Object
    }
});


</script>



<template>
  
  <Head title="Home"/>
  <div class="container overflow-x-hidden">
    

    
    <Navbar :canLogin="canLogin" :canRegister="canRegister" :isAuth="$page.props.auth.user"/>

    <!-- CONTENEDOR DE PALETA DE COLORES -->
    <div class="flex flex-col mt-20" >
      <p
      :style="{color: colors.color4}">Paleta de colores de la empresa</p>
      <div class="w-60 h-12 flex">
        <div class="rounded-full border-solid border-2 border-black h-12 w-12 bg-[#722727]" 
        :style="{backgroundColor: colors.color1}"
        :title="colors.color1"
        ></div>
        <div class="rounded-full border-solid border-2 border-black h-12 w-12 bg-[#722727]" 
        :style="{backgroundColor: colors.color2}"
        :title="colors.color2"
        ></div>
        <div class="rounded-full border-solid border-2 border-black h-12 w-12 bg-[#722727]" 
        :style="{backgroundColor: colors.color3}"
        :title="colors.color3"
        ></div>
        <div class="rounded-full border-solid border-2 border-black h-12 w-12 bg-[#722727]" 
        :style="{backgroundColor: colors.color4}"
        :title="colors.color4"
        ></div>
        <div class="rounded-full border-solid border-2 border-black h-12 w-12 bg-[#722727]" 
        :style="{backgroundColor: colors.color5}"
        :title="colors.color5"
        ></div>
      </div>
    </div>

    <Home />
    
    <Category />
    <TrickOrTreat />
    <Subscribe />
    <Footer />
    <p class="text-black">{{ colors }}</p>
  </div>
</template>
