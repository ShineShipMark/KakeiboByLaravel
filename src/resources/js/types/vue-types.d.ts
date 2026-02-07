export type sendPurpose = {
  id: number;
  purpose: string;
};

export type viewsPurpose = {
  id: number;
  category_id: number;
  purpose: string;
};

type selectedObject = {
  en: string;
  jp: string;
};

type postData = {
  id: number;
  amount: number;
  purpose_id: number;
  at_date: Date | null;
  possession: possessionPlace;
  detail: string;
};

type getData = {
  id: number;
  amount: number;
  purpose: getExpensePurpose;
  at_date: Date | null;
  possession: possessionPlace;
  detail: string;
};

type getExpensePurpose = {
  id: number;
  purpose: string;
  category: getExpenseCategory;
};

type getExpenseCategory = {
  id: number;
  category: string;
};

type possessionPlace = "account" | "wallet";
