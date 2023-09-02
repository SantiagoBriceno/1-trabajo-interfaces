<script setup>
import NavBarItem from "@/components/NavBarItem.vue";

defineProps({
  menu: {
    type: Array,
    default: () => [],
  },
  //Agregue prop color
  colors:{
    type: Object,
    required: false
  }
});

const emit = defineEmits(["menu-click"]);

const menuClick = (event, item) => {
  emit("menu-click", event, item);
};

</script>
<!-- Agregué atributo color -->
<template>
  <NavBarItem
    v-for="(item, index) in menu"
    :key="index"
    :item="item"
    @menu-click="menuClick"
    :colors="colors"
  />
</template>
