/**
 * データの入出力に関するストア
 */
import { config, Expenditure, getData, postData } from "@/types/vue-types";
import { defineStore } from "pinia";
import { computed, ref } from "vue";
import { viewsPurpose } from "../types/vue-types";
import { fetchAPIMethods } from "@/composables/fetch";

export const useInputDataStore = defineStore("inputData", () => {
  // 送信データの初期化
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

  // 各リアクティブ変数の定義
  const inputData = ref<postData>(initialDataState());
  const editData = ref<postData>(initialDataState());
  const listData = ref<getData[]>([]);
  const purposeData = ref<viewsPurpose[]>([]);
  const selectedPurposeId = ref<number>(0);
  const loading = ref<boolean>(false);
  const isModalOpen = ref<boolean>(false);
  const witchExpenditure = ref<Expenditure>("expense");

  // 登録データ変数のリセット
  const resetInputData = (): void => {
    inputData.value = initialDataState();
  };

  // 編集データ変数のリセット
  const resetEditData = (): void => {
    editData.value = initialDataState();
  };

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

  // 編集データ用に変換するメソッド
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
    inputData,
    editData,
    listData,
    loading,
    selectedPurposeId,
    purposeData,
    isModalOpen,
    witchExpenditure,
    currentLabels,
    initialDataState,
    resetInputData,
    resetEditData,
    sendData,
    setData,
    transData,
    closeModal,
  };
});
