<script setup>
import { mdiArrowLeftDropCircleOutline } from '@mdi/js';
import facebook from '../assets/media/facebook.png'
import instagram from '../assets/media/instagram.png'
import whatsapp from '../assets/media/whatsapp.png'

import Cube from '@/components/front/Cube.vue';
  defineProps({
    colors:{
      type: Object,
      required: false
    },
    media:{
      type: Array,
      required: false
    }
});

const moveCircle = () => {
  const containerCircle = document.querySelector('.container-circle');
  containerCircle.classList.toggle('inactive');
}

</script>

<template>
  <div class="container-circle inactive" :style="{background: colors ? `${colors.color3}30` : '#c3c3c3'}">
    <Cube v-for= "red of media" :key="red.url" :img="red.image" :url="red.url"/>
  </div>
  <div>
    <!-- Aqui va un boton que hara que el container circle se desplace a la izquierda -->
    <button @click="moveCircle" class="active-button" :style="{background: colors ? colors.color2  : '#c2c2c2', color: colors ? colors.color4 : '#fff'}">
      <h1>aslkdjakls</h1>
    </button>

  </div>
</template>

<style>
  .container-circle{
    width: 250px;
    height: 900px;
    position: fixed;
    border-radius: 20px;
    top: 100px;
    z-index: 1;
    right: 80px;
    transition: all 1s ease-in-out;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 80vh;
    perspective: 2000px;
  }

  .container-circle.inactive{
    right: -300px;
  }

  .active-button{
    position: fixed;
    top: 100px;
    right: 0px;
    background-color: rgb(0, 162, 255);
  }

</style>