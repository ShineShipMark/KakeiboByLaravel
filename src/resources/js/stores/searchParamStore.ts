import { fetchAPIMethods } from "@/composables/fetch";
import {
  config,
  Expenditure,
  getData,
  toSearchParam,
  viewsPurpose,
} from "@/types/vue-types";
import { defineStore } from "pinia";
import { computed, ref } from "vue";

export const useSearchParamStore = defineStore("searchParam", () => {
  const initialParamState = (): toSearchParam => {
    return {
      min_amount: undefined,
      max_amount: undefined,
      purpose_id: undefined,
      first_date: undefined,
      last_date: undefined,
      possession: undefined,
      detail: undefined,
      expenditure: "Expense",
    };
  };

  const searchParam = ref<toSearchParam>(initialParamState());
  const loading = ref<boolean>(false);
  const listData = ref<getData[]>([]);
  const purposeData = ref<viewsPurpose[]>([]);
  const selectedPurposeId = ref<number>(0);
  const witchExpenditure = ref<Expenditure>("Expense");

  const resetSearchParam = (): void => {
    searchParam.value = initialParamState();
  };

  const setSearchedData = (searchedData: getData[]): void => {
    listData.value = searchedData;
  };

  const setPurposes = async (
    currentExpensiture: Expenditure,
  ): Promise<void> => {
    const { searchData } = fetchAPIMethods();
    purposeData.value = await searchData<viewsPurpose[], string>(
      `get_${currentExpensiture}_purpose`,
      "GET",
      "",
    );
  };

  const currentLabels = computed(() => {
    return config[witchExpenditure.value as Expenditure];
  });

  const switchExpenditure = async () => {
    witchExpenditure.value =
      witchExpenditure.value === "Expense" ? "Income" : "Expense";
    await setPurposes(witchExpenditure.value);
  };

  return {
    listData,
    searchParam,
    selectedPurposeId,
    loading,
    currentLabels,
    initialParamState,
    resetSearchParam,
    setSearchedData,
    switchExpenditure,
  };
});
