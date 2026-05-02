<script setup lang="ts">
import { onMounted, ref, watch } from 'vue'
import { Line, Bar, Pie } from 'vue-chartjs'
import Card from '@/components/ui/card/Card.vue';
import { Select, SelectTrigger, SelectValue, SelectContent, SelectItem } from '@/components/ui/select';
import { useGraphDataStore } from '@/stores/grahpDataStore';
import { ChartType } from 'chart.js';
import { useSearchParamStore } from '@/stores/searchParamStore';
import { useMasterDataStore } from '@/stores/masterDataStore';

const graph_select = ref<ChartType>('bar');
const graphDataStore = useGraphDataStore();
const searchParamStore = useSearchParamStore();
const masterStore = useMasterDataStore();

const select_options = [
    { value: 'line', label: '折れ線グラフ' },
    { value: 'bar', label: '棒グラフ' },
    { value: 'pie', label: '円グラフ' }
];

watch(graph_select, async (new_type) => {
    const graph_type = new_type as ChartType;
    graphDataStore.changeGraphType(graph_type);
    await graphDataStore.getGraphData(masterStore.witchExpenditure, searchParamStore.searchParam)
})

onMounted(async () => {
    await graphDataStore.getGraphData(masterStore.witchExpenditure, searchParamStore.searchParam)
})

</script>
<template>
    <Card>
        <Switch :checked="masterStore.witchExpenditure === 'income'" :disabled="searchParamStore.loading"
            @update:checked="masterStore.switchExpenditure">{{ masterStore.currentLabels.ja }}</Switch>
        <Card>
            <Select v-model="graph_select">
                <SelectTrigger>
                    <SelectValue />
                </SelectTrigger>
                <SelectContent>
                    <SelectItem v-for="opt in select_options" :key="opt.value" :value="opt.value">
                        {{ opt.label }}
                    </SelectItem>
                </SelectContent>
            </Select>
        </Card>
        <Card>
            <Line v-if="graph_select === 'line'" :data="graphDataStore.setLineGraphData()"
                :options="graphDataStore.setLineGraphOptions()" />
            <Bar v-else-if="graph_select === 'bar'" :data="graphDataStore.setBarGraphData()"
                :options="graphDataStore.setBarGraphOptions()" />
            <Pie v-else-if="graph_select === 'pie'" :data="graphDataStore.setPieGraphData()"
                :options="graphDataStore.setPieGraphOptions()" />
        </Card>
    </Card>
</template>