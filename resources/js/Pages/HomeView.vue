<script setup>
import { computed, ref, onMounted } from "vue";
import { useMainStore } from "@/Stores/main";
import {
    mdiAccountMultiple,
    mdiCartOutline,
    mdiChartTimelineVariant,
    mdiMonitorCellphone,
    mdiReload,
    mdiGithub,
    mdiChartPie,
} from "@mdi/js";
import * as chartConfig from "@/components/Charts/chart.config.js";
import LineChart from "@/components/Charts/LineChart.vue";
import SectionMain from "@/components/SectionMain.vue";
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue";
import SectionTitleLineWithButton from "@/components/SectionTitleLineWithButton.vue";
import SectionBannerStarOnGitHub from "@/components/SectionBannerStarOnGitHub.vue";
import { Head } from "@inertiajs/vue3";

const chartData = ref(null);

const fillChartData = () => {
    chartData.value = chartConfig.sampleChartData();
};

onMounted(() => {
    fillChartData();
});

defineProps({
    colors: {
        type: Object,
        required: false,
    },
});

const mainStore = useMainStore();

const clientBarItems = computed(() => mainStore.clients.slice(0, 4));

const transactionBarItems = computed(() => mainStore.history);
</script>

<template>
    <LayoutAuthenticated :colors="colors">
        <Head title="Dashboard">
            <meta name="description" content="Dashboard" />
            <link v-if = "colors != null" 
                rel="icon"
                :href="`/images/${colors.file}`"
            />
        </Head>
        <SectionMain>
            <SectionTitleLineWithButton
                :icon="mdiChartTimelineVariant"
                title="Dashboard"
                main
                :colors="colors"
            >
            </SectionTitleLineWithButton>

            <SectionBannerStarOnGitHub :colors="colors" class="mt-6 mb-6" />
        </SectionMain>
    </LayoutAuthenticated>
</template>
