import { defineStore } from "pinia";
import { ChartData, ChartOptions, ChartType } from "chart.js";
import { ref } from "vue";
import { fetchAPIMethods } from "@/composables/fetch";
import { toSearchParam, Expenditure } from "@/types/vue-types";

export const useGraphDataStore = defineStore("grapgData", () => {
  const initialDataState = (): ChartData<ChartType> => {
    return {
      labels: [],
      datasets: [],
    };
  };
  const graphsData = ref<any>(null);
  const selectedType = ref<ChartType>("line");
  const graphsOptions = ref<ChartOptions>();
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

  const getGraphData = async (
    currentExpensiture: Expenditure,
    param: toSearchParam,
  ): Promise<void> => {
    const { searchData } = fetchAPIMethods();
    graphsData.value = await searchData<ChartData<ChartType>, toSearchParam>(
      `${currentExpensiture}_${selectedType.value}_graph`,
      "POST",
      param,
    );
  };

  return {
    graphsData,
    graphsOptions,
    selectedType,
    initialDataState,
    changeGraphType,
    getGraphData,
    setLineGraphData,
    setBarGraphData,
    setPieGraphData,
    setLineGraphOptions,
    setBarGraphOptions,
    setPieGraphOptions,
  };
});
