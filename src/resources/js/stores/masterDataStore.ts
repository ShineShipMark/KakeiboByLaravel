import { config } from "@/types/vue-types";
import type {
  Expenditure,
  PurposeAndCategory,
  TransactionTypeConfig,
} from "@/types/vue-types";
import { defineStore } from "pinia";
import { ref } from "vue";
import axios from "axios";

type TransactionType = App.Enum.TransactionType;

export const useMasterDataStore = defineStore("masterData", () => {
  const purpose_category = ref<PurposeAndCategory>();
  const wichExpenditure = ref<Expenditure>("Expense");
  const isLoaded = ref<boolean>(false);
  const currentLabels = ref<TransactionTypeConfig>();

  const setPurposes = async () => {
    if (isLoaded.value) return;

    try {
      const response = await axios.get<PurposeAndCategory>("/api/masters");

      purpose_category.value = response.data;
    } catch (error) {
      console.error("目的データの取得に失敗", error);
    }
  };

  const switchExpenditure = () => {
    wichExpenditure.value =
      wichExpenditure.value === "Expense" ? "Income" : "Expense";
  };

  const setCurrentType = (type: TransactionType) => {
    currentLabels.value = config[type];
  };

  return {
    setPurposes,
    switchExpenditure,
    setCurrentType,
    purpose_category,
    wichExpenditure,
    currentLabels,
  };
});
