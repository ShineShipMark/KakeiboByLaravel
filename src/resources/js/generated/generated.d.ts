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
      };
      export type ExecuteAllocationData = {
        allocationRuleId: number;
        sourceAmount: number;
        executeData: string;
      };
    }
    namespace Budget {
      export type BudgetProgressData = {
        categoryId: number;
        categoryName: string;
        budgetAmount: number;
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
    export type TransactionType = "all" | "income" | "expense" | "transfer";
  }
}
