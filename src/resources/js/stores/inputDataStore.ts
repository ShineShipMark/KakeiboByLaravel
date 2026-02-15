import {
  config,
  Expenditure,
  getData,
  PageKind,
  postData,
} from "@/types/vue-types";
import { defineStore } from "pinia";
import { computed, ref } from "vue";
import { viewsPurpose } from "../types/vue-types";
import { fetchAPIMethods } from "@/composables/fetch";

export const useInputDataStore = defineStore("inputData", () => {
  const initialDataState = (): postData => {
    return {
      id: 0,
      purpose_id: 0,
      amount: 0,
      at_date: new Date(),
      possession: "account",
      detail: "",
    };
  };

  const inputData = ref<postData>(initialDataState());
  const editData = ref<postData>(initialDataState());
  const listData = ref<getData[]>([]);
  const purposeData = ref<viewsPurpose[]>([]);
  const selectedPurposeId = ref<number>(0);
  const loading = ref<boolean>(false);
  const isModalOpen = ref<boolean>(false);
  const witchExpenditure = ref<Expenditure>("expense");
  const witchPage = ref<PageKind>("input");

  const resetInputData = (): void => {
    inputData.value = initialDataState();
  };

  const resetEditData = (): void => {
    editData.value = initialDataState();
  };

  const sendData = async (data: postData, url: string): Promise<string> => {
    loading.value = true;
    const { fetchs } = fetchAPIMethods();
    try {
      const result = await fetchs<string, postData>(url, "POST", data);
      return result;
    } finally {
      loading.value = false;
    }
  };

  const getData = async <T>(url: string): Promise<T> => {
    loading.value = true;
    const { fetchs } = fetchAPIMethods();
    try {
      const result = await fetchs<T, string>(url, "GET", "");
      return result;
    } finally {
      loading.value = false;
    }
  };

  const setData = async (url: string): Promise<void> => {
    listData.value = await getData<getData[]>(url);
  };

  const setPurposes = async (
    currentExpensiture: Expenditure,
  ): Promise<void> => {
    purposeData.value = await getData<viewsPurpose[]>(
      `get_${currentExpensiture}_purpose`,
    );
  };

  const transData = (selectedData: getData): void => {
    editData.value = {
      id: selectedData.id,
      at_date: selectedData.at_date,
      amount: selectedData.amount,
      purpose_id: selectedData.purpose.id,
      possession: selectedData.possession,
      detail: selectedData.detail,
    };

    isModalOpen.value = true;
  };

  const closeModal = () => {
    isModalOpen.value = false;
    setTimeout(() => {
      initialDataState();
    }, 300);
  };

  const currentLabels = computed(() => {
    return config[witchExpenditure.value as Expenditure];
  });

  const switchExpenditure = async () => {
    witchExpenditure.value =
      witchExpenditure.value === "expense" ? "income" : "expense";
    await setPurposes(witchExpenditure.value);

    if (witchPage.value === "history")
      await setData(`/history/${witchExpenditure.value}`);
  };

  return {
    inputData,
    editData,
    listData,
    loading,
    selectedPurposeId,
    purposeData,
    isModalOpen,
    witchExpenditure,
    currentLabels,
    resetInputData,
    resetEditData,
    sendData,
    getData,
    setData,
    setPurposes,
    transData,
    closeModal,
    switchExpenditure,
  };
});
