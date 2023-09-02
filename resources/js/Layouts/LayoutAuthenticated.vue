<script setup>
import { mdiForwardburger, mdiBackburger, mdiMenu } from "@mdi/js";
import { ref } from "vue";
import menuAside from "@/menuAside.js";
import menuNavBar from "@/menuNavBar.js";
import { useMainStore } from "@/Stores/main.js";
import { useStyleStore } from "@/Stores/style.js";
import BaseIcon from "@/components/BaseIcon.vue";
import FormControl from "@/components/FormControl.vue";
import NavBar from "@/components/NavBar.vue";
import NavBarItemPlain from "@/components/NavBarItemPlain.vue";
import AsideMenu from "@/components/AsideMenu.vue";
import FooterBar from "@/components/FooterBar.vue";
import { router } from "@inertiajs/vue3";
import {onMounted} from "vue";

useMainStore().setUser({
  name: "John Doe",
  email: "john@example.com",
  avatar:
    "https://avatars.dicebear.com/api/avataaars/example.svg?options[top][]=shortHair&options[accessoriesChance]=93",
});

router.on("navigate", () => {
  isAsideMobileExpanded.value = false;
  isAsideLgActive.value = false;
});

// [color primario, secundario, terciario, cuaternario, quinario]
const props = defineProps({
  colors: {
    type: Object,
    required: false
  }
})

const layoutAsidePadding = "xl:pl-60";

const styleStore = useStyleStore();

const isAsideMobileExpanded = ref(false);
const isAsideLgActive = ref(false);


const menuClick = (event, item) => {
  if (item.isToggleLightDark) {
    styleStore.setDarkMode();
  }

  if (item.isLogout) {
    router.post(route("logout"));
  }
};
</script>

<template>
  <div
    :class="{
      dark: styleStore.darkMode,
      'overflow-hidden lg:overflow-visible': isAsideMobileExpanded,
    }"
  >
    <div
      :class="[layoutAsidePadding, { 'ml-60 lg:ml-0': isAsideMobileExpanded }]"
      class="pt-14 min-h-screen w-screen transition-position lg:w-auto bg-gray-50 dark:bg-slate-800 dark:text-slate-100"
      :style="{backgroundColor: colors ? colors.color1 : '', color: colors ? colors.color4 : ''}"
    >
      <NavBar
        :menu="menuNavBar"
        :class="[
          layoutAsidePadding,
          { 'ml-60 lg:ml-0': isAsideMobileExpanded },
        ]"
        @menu-click="menuClick"
        :colors="colors"
      >
        <NavBarItemPlain
          display="flex lg:hidden"
          @click.prevent="isAsideMobileExpanded = !isAsideMobileExpanded"
          :colors="colors"
        >
          <BaseIcon
            :path="isAsideMobileExpanded ? mdiBackburger : mdiForwardburger"
            size="24"
          />
        </NavBarItemPlain>
        <NavBarItemPlain
          display="hidden lg:flex xl:hidden"
          @click.prevent="isAsideLgActive = true"
          :colors="colors"
        >
          <BaseIcon :path="mdiMenu" size="24" />
        </NavBarItemPlain>
        <NavBarItemPlain use-margin >
          <FormControl
            placeholder="Buscar (ctrl+k)"
            ctrl-k-focus
            transparent
            borderless
          />
        </NavBarItemPlain>
      </NavBar>
      <AsideMenu
        :is-aside-mobile-expanded="isAsideMobileExpanded"
        :is-aside-lg-active="isAsideLgActive"
        :menu="menuAside"
        @menu-click="menuClick"
        @aside-lg-close-click="isAsideLgActive = false"
        :colors = "colors"
      />
      <slot />
      <FooterBar :colors="colors">
        La mejor opción para la administración de tu negocio.
        <a
          href="https://tailwind-vue.justboil.me/"
          target="_blank"
          class="text-blue-600"
          ></a
        >
      </FooterBar>
    </div>
  </div>
</template>
