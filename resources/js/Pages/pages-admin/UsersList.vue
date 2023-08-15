<script setup>
import * as chartConfig from "@/components/Charts/chart.config.js";
import { computed, ref, onMounted } from "vue";
import SectionMain from "@/components/SectionMain.vue";
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue";
import { Head } from "@inertiajs/vue3";
import ShowTable from "@/components/front/ShowTable.vue";

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
    <Head title="Lista de usuarios" />
    <SectionMain>
      <ShowTable :users = 'users'/>
    </SectionMain>
  </LayoutAuthenticated>
</template>
