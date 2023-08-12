<script setup>
import Navbar from '@/components/front/Navbar.vue';
import Home from '@/components/front/Home.vue';
import Category from '@/components/front/Category.vue';
import TrickOrTreat from '@/components/front/TrickOrTreat.vue';
import Subscribe from '@/components/front/Subscribe.vue';
import Footer from '@/components/front/Footer.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    }
});
</script>



<template>
  <Head title="Home" />
  <div class="container overflow-x-hidden">
    <Navbar :canLogin="canLogin" :canRegister="canRegister" :isAuth="$page.props.auth.user"/>
    <Home/>
    <Category/>
    <TrickOrTreat/>
    <Subscribe/>
    <Footer/>
  </div>
</template>
