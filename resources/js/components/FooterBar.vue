<script setup>
import { containerMaxW } from "@/config.js";
import BaseLevel from "@/components/BaseLevel.vue";
import JustboilLogo from "@/components/JustboilLogo.vue";

const year = new Date().getFullYear();
defineProps({
  colors: {
    type: Object,
    required: false
  }
})
</script>

<template>
  <footer 
    class="py-2 px-6 fixed inset-x-1/3 bottom-0 bg-slate-800 w-max" 
    :class="containerMaxW"
    :style="{backgroundColor: colors ? colors.color1 : ''}">
    <BaseLevel>
      <div class="text-center md:text-left">
        <b
          >&copy;{{ year }},
          <a href="https://justboil.me/" target="_blank">SSC Programming Group</a>.</b
        >
        <slot />
      </div>
      <div class="md:py-2">
        <a href="https://justboil.me">
          <JustboilLogo class="w-auto h-8 md:h-6" />
        </a>
      </div>
    </BaseLevel>
  </footer>
</template>
