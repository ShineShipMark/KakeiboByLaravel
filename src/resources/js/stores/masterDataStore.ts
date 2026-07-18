import { fetchAPIMethods } from "@/composables/fetch";
import { config } from "@/types/vue-types";
import type { Expenditure, viewsPurpose } from "@/types/vue-types";
import { defineStore } from "pinia";
import { computed, ref } from "vue";

export const useMasterDataStore = defineStore("masterData", () => {
  const purposeData = ref<viewsPurpose[]>([]);
  const witchExpenditure = ref<Expenditure>("Expense");

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

  const switchExpenditure = () => {
    witchExpenditure.value =
      witchExpenditure.value === "Expense" ? "Income" : "Expense";
  };

  // 収支の切り替えのcomputed
  const currentLabels = computed(() => {
    return config[witchExpenditure.value as Expenditure];
  });
  return {
    setPurposes,
    switchExpenditure,
    purposeData,
    witchExpenditure,
    currentLabels,
  };
});
