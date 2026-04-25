import { fetchAPIMethods } from "@/composables/fetch";
import {
  config,
  Expenditure,
  getData,
  PageKind,
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
    };
  };

  const searchParam = ref<toSearchParam>(initialParamState());
  const loading = ref<boolean>(false);
  const listData = ref<getData[]>([]);
  const purposeData = ref<viewsPurpose[]>([]);
  const selectedPurposeId = ref<number>(0);
  const witchExpenditure = ref<Expenditure>("expense");
  const witchPage = ref<PageKind>("input");

  const resetSearchParam = (): void => {
    searchParam.value = initialParamState();
  };

  const setData = async (url: string, param: toSearchParam): Promise<void> => {
    const { searchData } = fetchAPIMethods();
    listData.value = await searchData<getData[], toSearchParam>(
      url,
      "POST",
      param,
    );
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

  const switchExpenditure = async (param: toSearchParam) => {
    witchExpenditure.value =
      witchExpenditure.value === "expense" ? "income" : "expense";
    await setPurposes(witchExpenditure.value);

    if (witchPage.value === "history")
      await setData(`/history/${witchExpenditure.value}`, param);
  };

  return {
    listData,
    searchParam,
    selectedPurposeId,
    loading,
    currentLabels,
    resetSearchParam,
    setData,
    switchExpenditure,
  };
});
