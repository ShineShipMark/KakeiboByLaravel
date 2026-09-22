declare namespace App {
  namespace Data {
    namespace Account {
      export type AccountBalanceSummaryData = {
        accountId: number;
        accountName: string;
        actualBalance: number;
        allocatedBalance: number;
        unallocatedBalance: number;
      };
    }
    namespace Allocation {
      export type AllocationItemData = {
        categoryId: number;
        amount: number;
        toAccountId: number | null;
        id: number | null;
      };
      export type ExecuteAllocationData = {
        allocationRuleId: number;
        sourceAmount: number;
        executeDate: string;
      };
    }
    namespace Budget {
      export type BudgetData = {
        id: number | null;
        categoryId: number;
        yearMonth: string;
        amount: number;
        carryoverAmount: number;
        totalAmount: number;
        isClosed: boolean;
        category: App.Data.Category.CategoryResponseData | null;
      };
      export type BudgetProgressData = {
        categoryId: number;
        categoryName: string;
        baseBudgetAmount: number;
        carryoverAmount: number;
        totalBudgetAmount: number;
        spentAmount: number;
        remainingAmount: number;
        usageRate: number;
        isOver: boolean;
      };
      export type CreateBudgetRequestData = {
        categoryId: number;
        amount: number;
        yearMonth: string;
      };
      export type MonthlyBudgetRolloverRequestData = {
        targetYearMonth: string;
        actions: App.Data.Budget.RolloverActionData[];
      };
      export type RolloverActionData = {
        budgetId: number;
        actionType: App.Enum.RolloverActionType;
        surplusAmount: number;
        targetSavingsCategoryId: number | null;
        customAmount: number | null;
      };
    }
    namespace Category {
      export type CategoryResponseData = {
        id: number;
        name: string;
        type: App.Enum.CategoryType;
        parentId: number | null;
        parent: App.Data.Category.CategoryResponseData | null;
        children: App.Data.Category.CategoryResponseData[] | null;
      };
    }
    namespace Transaction {
      export type TransactionData = {
        id: number | null;
        type: App.Enum.TransactionType;
        amount: number;
        date: string;
        fromAccountId: number | null;
        toAccountId: number | null;
        categoryId: number | null;
        description: string | null;
        parentTransactionId: number | null;
        allocations: App.Data.Allocation.AllocationItemData[] | null;
      };
      export type TransactionFilterData = {
        keyword: string | null;
        type: App.Enum.TransactionType;
        categoryId: number | null;
        startDate: string | null;
        endDate: string | null;
        accountId: number;
        page: number;
        perPage: number;
      };
    }
  }
  namespace Enum {
    export type AccountType = "bank" | "cash" | "e_money" | "credit_card";
    export type AllocationType = "fixed" | "percentage";
    export type CategoryType = "income" | "expense" | "transfer";
    export type RolloverActionType = "carryover" | "savings" | "discard";
    export type TransactionType = "all" | "income" | "expense" | "transfer";
  }
}
