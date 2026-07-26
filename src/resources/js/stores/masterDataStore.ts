import { config } from "@/types/vue-types";
import type { Expenditure, PurposeAndCategory } from "@/types/vue-types";
import { defineStore } from "pinia";
import { computed, ref } from "vue";
import axios from "axios";

export const useMasterDataStore = defineStore("masterData", () => {
  const purpose_category = ref<PurposeAndCategory>();
  const wichExpenditure = ref<Expenditure>("Expense");
  const isLoaded = ref<boolean>(false);

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

  // 収支の切り替えのcomputed
  const currentLabels = computed(() => {
    return config[wichExpenditure.value as Expenditure];
  });
  return {
    setPurposes,
    switchExpenditure,
    purpose_category,
    wichExpenditure,
    currentLabels,
  };
});
