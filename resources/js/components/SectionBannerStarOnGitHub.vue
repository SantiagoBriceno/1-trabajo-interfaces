<script setup>
import { mdiGithub } from "@mdi/js";
import BaseButton from "@/components/BaseButton.vue";
import SectionBanner from "@/components/SectionBanner.vue";
defineProps({
  colors: {
    type: Object,
    required: false,
  },
});
</script>

<template>
  <SectionBanner :colors="colors">
    <h1 class="text-3xl text-white mb-6">
      Alumnos: Santiago Briceño - Andrés Pausín
    </h1>
    <div>
      <BaseButton
        href="https://github.com/SantiagoBriceno/1-trabajo-interfaces"
        :icon="mdiGithub"
        label="GitHub"
        target="_blank"
        rounded-full
      />
    </div>
  </SectionBanner>
</template>
