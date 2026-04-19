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
  at_date: Date | undefined;
  possession: possessionPlace;
  detail: string;
};

type getData = {
  id: number;
  amount: number;
  purpose: getExpensePurpose;
  at_date: Date | undefined;
  possession: possessionPlace;
  detail: string;
};

type toSearchParam = {
  min_amount: number | undefined;
  max_amount: number | undefined;
  purpose_id: number | undefined;
  first_date: Date | undefined;
  last_date: Date | undefined;
  possession: possessionPlace | undefined;
  detail: string | undefined;
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

type Language = "en" | "ja";

type Expenditure = "expense" | "income";

const config = {
  expense: {
    ja: { label: "支出" },
    en: { label: "Expense" },
  },
  income: {
    ja: { label: "収入" },
    en: { label: "Income" },
  },
} as const;

type PageKind = "input" | "history";
