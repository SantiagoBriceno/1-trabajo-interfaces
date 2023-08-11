<script setup>
import { computed, ref, onMounted } from "vue";
import { useMainStore } from "@/Stores/main";
import * as chartConfig from "@/components/Charts/chart.config.js";
import SectionMain from "@/components/SectionMain.vue";
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue";
import { Head } from "@inertiajs/vue3";

const chartData = ref(null);

const fillChartData = () => {
  chartData.value = chartConfig.sampleChartData();
};

onMounted(() => {
  fillChartData();
});

defineProps({
  users: Array
 });


</script>

<template>
  <LayoutAuthenticated>
    <Head title="Dashboard2" />
    <SectionMain>
      {{ users }}
      <h1>HOLA MUNDO SOY ADMIN</h1>
    </SectionMain>
  </LayoutAuthenticated>
</template>
