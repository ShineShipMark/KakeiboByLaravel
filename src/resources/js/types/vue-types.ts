export type sendPurpose = {
  id: number;
  purpose: string;
};

export type viewsPurpose = {
  id: number;
  category_id: number;
  purpose: string;
};

export type viewsCategory = {
  id: number;
  category: string;
};

export type selectedObject = {
  en: string;
  jp: string;
};

export interface postData {
  id: number;
  amount: number;
  purpose_id: number;
  at_date: Date | undefined;
  possession: possessionPlace;
  detail: string;
  [key: string]: any;
}

export type getData = {
  id: number;
  amount: number;
  purpose: getExpensePurpose;
  at_date: Date | undefined;
  possession: possessionPlace;
  detail: string;
};

export type toSearchParam = {
  min_amount: number | undefined;
  max_amount: number | undefined;
  purpose_id: number | undefined;
  first_date: Date | undefined;
  last_date: Date | undefined;
  possession: possessionPlace | undefined;
  detail: string | undefined;
};

export type getExpensePurpose = {
  id: number;
  purpose: string;
  category: getExpenseCategory;
};

export type getExpenseCategory = {
  id: number;
  category: string;
};

export type possessionPlace = "account" | "wallet";

export type Language = "en" | "ja";

export type Expenditure = "Expense" | "Income";

export const config = {
  all: {
    ja: { label: "すべて" },
    en: { label: "All" },
  },
  expense: {
    ja: { label: "支出" },
    en: { label: "Expense" },
  },
  income: {
    ja: { label: "収入" },
    en: { label: "Income" },
  },
  transfer: {
    ja: { label: "振替" },
    en: { label: "transfer" },
  },
} as const;

export type TransactionTypeWithAll = keyof typeof config;

export type TransactionTypeConfig = (typeof config)[keyof typeof config];

export type PageKind = "input" | "history";

export type GraphParam = {
  purpose_id: number | undefined;
  first_date: Date | undefined;
  last_date: Date | undefined;
};

export type purposes = {
  expense_purpose: viewsPurpose;
  income_purpose: viewsPurpose;
};

export type PurposeAndCategory = {
  expense: ExpensePurposeCategory;
  income: IncomePurposeCategory;
};

export type ExpensePurposeCategory = {
  purpose: viewsPurpose[];
  category: viewsCategory[];
};
export type IncomePurposeCategory = {
  purpose: viewsPurpose[];
  category: viewsCategory[];
};
