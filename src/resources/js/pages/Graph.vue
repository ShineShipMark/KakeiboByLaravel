<script setup lang="ts">
import { onMounted, ref } from 'vue'
import { Line, Bar, Pie } from 'vue-chartjs'
import Card from '@/components/ui/card/Card.vue';
import { Select, SelectTrigger, SelectValue, SelectContent, SelectItem } from '@/components/ui/select';

type ChartComponents = 'bar' | 'line' | 'pie';

const graph_select = ref<ChartComponents>('bar');

const select_options = [
    { value: 'line', label: '折れ線グラフ' },
    { value: 'bar', label: '棒グラフ' },
    { value: 'pie', label: '円グラフ' }
];

onMounted(async () => {

})

</script>
<template>
    <Card>
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
            <Line v-if="graph_select === 'line'" :data="chartData" :options="options" />
            <Bar v-if="graph_select === 'bar'" :data="chartData" :options="options" />
            <Pie v-if="graph_select === 'pie'" :data="chartData" :options="options" />
        </Card>
    </Card>
</template>