<script setup>
import { computed } from "vue";
import { useStyleStore } from "@/Stores/style";
import {
  gradientBgPurplePink,
  gradientBgDark,
  gradientBgPinkRed,
} from "@/colors";

const props = defineProps({
  bg: {
    type: String,
    required: true,
    validator: (value) => ["purplePink", "pinkRed"].includes(value),
  }, colors: {
    type: Object,
    required: false,
  }
});

const colorClass = computed(() => {
  if (!props.colors) {
    if (useStyleStore().darkMode) {
      return gradientBgDark;
    }

    switch (props.bg) {
      case "purplePink":
        return gradientBgPurplePink;
      case "pinkRed":
        return gradientBgPinkRed;
    }

    return "";
  }
});
</script>

<template>
  <div class="flex min-h-screen items-center justify-center" :class="colorClass"
    :style="{ backgroundColor: colors ? colors.color1 : '' }">
    <slot card-class="w-11/12 md:w-7/12 lg:w-6/12 xl:w-4/12 shadow-2xl" />
  </div>
</template>
