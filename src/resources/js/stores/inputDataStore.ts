import { getData, postData } from "@/types/vue-types";
import { defineStore } from "pinia";
import { ref } from "vue";
import { viewsPurpose } from "../types/vue-types";
import { fetchs } from "@/composables/fetch";

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
  const listData = ref<getData[]>([]);
  const purposeData = ref<viewsPurpose[]>([]);
  const selectedPurposeId = ref<number>(0);
  const loading = ref<boolean>(false);

  const resetData = (): void => {
    inputData.value = initialDataState();
  };

  const sendData = async (data: postData, url: string): Promise<string> => {
    loading.value = true;
    try {
      const result = await fetchs<string, postData>(url, "POST", data);
      return result;
    } finally {
      loading.value = false;
    }
  };

  const getData = async <T>(url: string): Promise<T> => {
    loading.value = true;
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

  const setPurposes = async (url: string): Promise<void> => {
    purposeData.value = await getData<viewsPurpose[]>(url);
  };

  return {
    inputData,
    listData,
    selectedPurposeId,
    purposeData,
    resetData,
    sendData,
    getData,
    setData,
    setPurposes,
  };
});
