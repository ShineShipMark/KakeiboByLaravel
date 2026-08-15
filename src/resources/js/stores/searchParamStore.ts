import { fetchAPIMethods } from "@/composables/fetch";
import {
  config,
  Expenditure,
  getData,
  toSearchParam,
  TransactionTypeConfig,
  TransactionTypeWithAll,
  viewsPurpose,
} from "@/types/vue-types";
import { defineStore } from "pinia";
import { computed, ref } from "vue";

type AccountType = App.Enum.AccountType;

type TransactionSearchForm = Omit<
  App.Data.Transaction.TransactionSearchData,
  "type" | "account"
> & {
  type: TransactionTypeWithAll;
  account: AccountType;
};

export const useSearchParamStore = defineStore("searchParam", () => {
  const initialParamState = (): TransactionSearchForm => {
    return {
      keyword: null,
      type: "all",
      categoryId: null,
      startDate: null,
      endDate: null,
      account: "cash",
      page: 1,
      perPage: 15,
    };
  };

  const searchParam = ref<toSearchParam>(initialParamState());
  const loading = ref<boolean>(false);
  const listData = ref<TransactionData[]>([]);
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
