/**
 * データの入出力に関するストア
 */
import { config } from "@/types/vue-types";
import type { Expenditure, getData, postData } from "@/types/vue-types";

import { defineStore } from "pinia";
import { computed, ref } from "vue";
import { viewsPurpose } from "../types/vue-types";
import { fetchAPIMethods } from "@/composables/fetch";
import App from "@/actions/App";

type TransactionData = App.Data.Transaction.TransactionData;

type TransactionForm = Omit<TransactionData, "id">;

export const useInputDataStore = defineStore("inputData", () => {
  // 送信データの初期化
  const initialDataState = (): TransactionForm => {
    return {
      type: "expense",
      amount: 0,
      date: new Date().toISOString().split("T")[0],
      fromAccountId: null,
      toAccountId: null,
      categoryId: null,
      description: null,
    };
  };

  // 各リアクティブ変数の定義
  const listData = ref<getData[]>([]);
  const purposeData = ref<viewsPurpose[]>([]);
  const selectedPurposeId = ref<number>(0);
  const loading = ref<boolean>(false);
  const isModalOpen = ref<boolean>(false);
  const witchExpenditure = ref<Expenditure>("Expense");

  // データをPOST送信するメソッド
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

  // 取得データをセットするメソッド
  const setData = async (url: string): Promise<void> => {
    const { searchData } = fetchAPIMethods();
    listData.value = await searchData<getData[], string>(url, "GET", "");
  };

  // モーダルの開閉を制御するメソッド
  const closeModal = () => {
    isModalOpen.value = false;
    setTimeout(() => {
      initialDataState();
    }, 300);
  };

  // 収支の切り替えのcomputed
  const currentLabels = computed(() => {
    return config[witchExpenditure.value as Expenditure];
  });

  return {
    listData,
    loading,
    selectedPurposeId,
    purposeData,
    isModalOpen,
    witchExpenditure,
    currentLabels,
    initialDataState,
    sendData,
    setData,
    closeModal,
  };
});
