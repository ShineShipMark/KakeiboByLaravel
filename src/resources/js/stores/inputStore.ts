import { getData, postData } from "@/types/vue-types";
import { defineStore } from "pinia";
import { ref } from "vue";
import { viewsPurpose } from "../types/vue-types";
import { fetchs } from "@/composables/fetch";

export const useInputDataStore = defineStore("inputData", () => {
  const inputData = ref<postData>();
  const listData = ref<getData[]>([]);
  const purposeData = ref<viewsPurpose[]>([]);
  const loading = ref<boolean>(false);

  const sendData = async (data: postData, url: string): Promise<string> => {
    loading.value = true;

    try {
      const result = await fetchs<string, postData>(url, "POST", data);

      return result;
    } finally {
      loading.value = false;
    }
  };

  const getData = async (url: string): Promise<string> => {
    loading.value = true;
    try {
      const result = await fetchs<string, string>(url, "GET", "");
      return result;
    } finally {
      loading.value = false;
    }
  };

  return { inputData, listData, purposeData, sendData, getData };
});
