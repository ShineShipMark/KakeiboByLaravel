<script setup lang="ts">
import { onMounted, ref, watch } from 'vue'
import { Line, Bar, Pie } from 'vue-chartjs'
import Card from '@/components/ui/card/Card.vue';
import { Select, SelectTrigger, SelectValue, SelectContent, SelectItem } from '@/components/ui/select';
import { useGraphDataStore } from '@/stores/grahpDataStore';
import { ChartData, ChartType } from 'chart.js';
import { useSearchParamStore } from '@/stores/searchParamStore';
import { useMasterDataStore } from '@/stores/masterDataStore';
import SetAtDate from '@/components/inputParts/SetAtDate.vue';
import SetSelectPurpose from '@/components/inputParts/SetSelectPurpose.vue';
import Button from '@/components/ui/button/Button.vue';
import { useForm } from '@inertiajs/vue3';
import { GraphParam } from '@/types/vue-types';

const graph_select = ref<ChartType>('line');
const graphDataStore = useGraphDataStore();
const searchParamStore = useSearchParamStore();
const masterStore = useMasterDataStore();

const form = useForm<GraphParam>(searchParamStore.initialParamState());
const props = defineProps<{ searchedChartData: ChartData }>();

const select_options = [
    { value: 'line', label: '折れ線グラフ' },
    { value: 'bar', label: '棒グラフ' },
    { value: 'pie', label: '円グラフ' }
];

onMounted(async () => {
    if (!masterStore.purposeData) await masterStore.setPurposes(masterStore.witchExpenditure);
    form.post(`/graph/${masterStore.currentLabels.en}`, {
        onSuccess: () => { console.log('success!') }
    });
})

const submitParam = () => {
    form.post(`/graph/${masterStore.currentLabels.en}`, {
        onSuccess: () => { console.log('success!') }
    });
}

watch(() => props.searchedChartData, (newData) => {
    graphDataStore.setChartData(newData)
}, { immediate: true });

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
        <form @submit.prevent="submitParam">
            <Card>
                <Card>
                    検索期間
                </Card>
                <SetAtDate v-model="form.first_date" />
                ～
                <SetAtDate v-model="form.last_date" />
            </Card>
            <Card>
                <Card>
                    目的
                </Card>
                <SetSelectPurpose v-if="graph_select !== 'pie'" v-model:purpose-data="masterStore.purposeData"
                    v-model:purpose_id="form.purpose_id" />
            </Card>
            <Card>
                <Button type="submit">検索</Button>
            </Card>
        </form>
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