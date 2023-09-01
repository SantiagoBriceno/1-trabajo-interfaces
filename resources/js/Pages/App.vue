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
      type: Array
    }
});

// const colors = ['red', 'green', 'blue', 'yellow', 'pink'];
// // 60%

// switch (colors.length){
//   case 3:
//     colorPrimary = colors[0];
//     colorSecondary = colors[1];
//     colorTertiary = colors[2];
//     break;
//   case 4:
//     colorPrimary = colors[0];
//     colorSecondary = colors[1];
//     colorTertiary = [colors[2], colors[3]];
//     break;
// }
// const colorPrimary 

</script>



<template>
  
  <Head title="Home"/>
  <div class="container overflow-x-hidden">
    <Navbar :canLogin="canLogin" :canRegister="canRegister" :isAuth="$page.props.auth.user"/>
    
    <Home />
    <Category />
    <TrickOrTreat />
    <Subscribe />
    <Footer />
    <p class="text-black">{{ colors }}</p>
  </div>
</template>
