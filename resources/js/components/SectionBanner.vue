<script setup>
defineProps({
    colors: {
        type: Object,
        required: false,
    },
});
</script>

<template>
    <div
        class="rounded-2xl py-12 px-6 lg:px-12 text-center"
        :style="{ backgroundColor: colors ? `${colors.color3}60` : '' }"
    >
        <slot />
    </div>
</template>
