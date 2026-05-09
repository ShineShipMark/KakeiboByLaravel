import { defineStore } from "pinia";
import { ChartData, ChartOptions, ChartType } from "chart.js";
import { ref } from "vue";
import { GraphParam } from "@/types/vue-types";

export const useGraphDataStore = defineStore("grapgData", () => {
  const initialDataState = (): ChartData<ChartType> => {
    return {
      labels: [],
      datasets: [],
    };
  };

  const inititalParamState = (): GraphParam => {
    const now_date = new Date();
    const one_before_month = now_date.getMonth() - 1;
    const set_one_before_month = now_date.setMonth(one_before_month);
    return {
      purpose_id: 0,
      first_date: new Date(set_one_before_month),
      last_date: now_date,
    };
  };

  const graphsData = ref<any>(initialDataState());
  const selectedType = ref<ChartType>("line");
  const graphsOptions = ref<ChartOptions>();
  const searchGraphParam = ref<GraphParam>(inititalParamState());

  const changeGraphType = (type: ChartType): void => {
    selectedType.value = type;
  };
  const setLineGraphData = (): ChartData<"line"> => {
    return graphsData.value as ChartData<"line">;
  };

  const setBarGraphData = (): ChartData<"bar"> => {
    return graphsData.value as ChartData<"bar">;
  };

  const setPieGraphData = (): ChartData<"pie"> => {
    return graphsData.value as ChartData<"pie">;
  };

  const setLineGraphOptions = (): ChartOptions<"line"> => {
    return graphsOptions.value as ChartOptions<"line">;
  };

  const setBarGraphOptions = (): ChartOptions<"bar"> => {
    return graphsOptions.value as ChartOptions<"bar">;
  };

  const setPieGraphOptions = (): ChartOptions<"pie"> => {
    return graphsData.value as ChartOptions<"pie">;
  };

  const setChartData = (rawData: ChartData): void => {
    graphsData.value = rawData;
  };

  return {
    graphsData,
    graphsOptions,
    selectedType,
    searchGraphParam,
    initialDataState,
    inititalParamState,
    changeGraphType,
    setChartData,
    setLineGraphData,
    setBarGraphData,
    setPieGraphData,
    setLineGraphOptions,
    setBarGraphOptions,
    setPieGraphOptions,
  };
});
