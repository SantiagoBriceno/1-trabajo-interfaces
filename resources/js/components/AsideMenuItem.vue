<script setup>
import { ref, computed } from "vue";
//import { RouterLink } from "vue-router";
import { Link } from "@inertiajs/vue3";
import { useStyleStore } from "@/Stores/style.js";
import { mdiMinus, mdiPlus } from "@mdi/js";
import { getButtonColor } from "@/colors.js";
import BaseIcon from "@/components/BaseIcon.vue";
import AsideMenuList from "@/components/AsideMenuList.vue";

const props = defineProps({
    item: {
        type: Object,
        required: true,
    },
    isDropdownList: Boolean,
    colors: {
        type: Object,
        required: false,
    },
});

const itemHref = computed(() =>
    props.item.route ? route(props.item.route) : props.item.href
);

const activeInactiveStyle = computed(() =>
    props.item.route && route().current(props.item.route)
        ? styleStore.asideMenuItemActiveStyle
        : ""
);

const emit = defineEmits(["menu-click"]);

const styleStore = useStyleStore();

const hasColor = computed(() => props.item && props.item.color);

const asideMenuItemActiveStyle = computed(() =>
    hasColor.value ? "" : styleStore.asideMenuItemActiveStyle
);

const isDropdownActive = ref(false);

const componentClass = computed(() => [props.isDropdownList ? "py-3 px-6 text-sm" : "py-3",
    props.colors ? 
      hasColor.value ? getButtonColor(props.item.color, false, true, props.colors.color) : `${styleStore.asideMenuItemStyle} dark:text-slate-300 dark:hover:text-white` : hasColor.value ? getButtonColor(props.item.color, false, true) : `${styleStore.asideMenuItemStyle} dark:text-slate-300 dark:hover:text-white`,
]);

const hasDropdown = computed(() => !!props.item.menu);

const menuClick = (event) => {
    emit("menu-click", event, props.item);

    if (hasDropdown.value) {
        isDropdownActive.value = !isDropdownActive.value;
    }
};
</script>

<template>
    <li>
        <component
            :is="item.route ? Link : 'a'"
            :href="item.href ?? null"
            :target="item.target ?? null"
            class="flex cursor-pointer"
            :class="componentClass"
            @click="menuClick"
            :style="{
                backgroundColor: colors && item.style ? colors.color3 : '',
            }"
        >
            <BaseIcon
                v-if="item.icon"
                :path="item.icon"
                class="flex-none"
                :class="activeInactiveStyle"
                w="w-16"
                :size="18"
            />
            <span
                class="grow text-ellipsis line-clamp-1"
                :class="[{ 'pr-12': !hasDropdown }, activeInactiveStyle]"
                :style="{ color: colors ? colors.color4 : '' }"
                >{{ item.label }}
            </span>
            <BaseIcon
                v-if="hasDropdown"
                :path="isDropdownActive ? mdiMinus : mdiPlus"
                class="flex-none"
                :class="activeInactiveStyle"
                w="w-12"
            />
        </component>
        <AsideMenuList
            v-if="hasDropdown"
            :menu="item.menu"
            :class="[
                styleStore.asideMenuDropdownStyle,
                isDropdownActive ? 'block dark:bg-slate-800/50' : 'hidden',
            ]"
            is-dropdown-list
            :colors="colors"
        />
    </li>
</template>
