<script setup lang="ts">
import {
    DialogClose,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog'
import { Button } from '@/components/ui/button';
import { watch } from 'vue';
import TransactionForm from '../utilities/TransactionForm.vue';
import { useForm } from '@inertiajs/vue3';

type TransactionData = App.Data.Transaction.TransactionData;
type AllocationItemData = App.Data.Allocation.AllocationItemData;
type TransactionType = App.Enum.TransactionType;

type CategoryData = App.Data.Category.CategoryResponseData;
type Allocations = Array<{ categoryId: number; amount: number }>;

type TransactionFormType = Omit<TransactionData, 'id' | 'allocations'> & {
    id?: number | null,
    allocations?: Array<AllocationItemData>
}

type TransactionSearchedData = Omit<TransactionData, 'allocations'> & {
    allocations?: Array<{ categoryId: number; amount: number }>
}

// デフォルト値
const getDefaultValues = (): TransactionFormType => ({
    id: null,
    type: 'expense' as TransactionType, // または該当の Enum 値
    amount: 0,
    date: new Date().toISOString().split('T')[0],
    fromAccountId: null, // ← undefined にならないよう明確に null にする
    toAccountId: null,   // ← undefined にならないよう明確に null にする
    categoryId: null,
    description: '',
    allocations: [],     // ← defaultValues に型注釈 (: TransactionForm) を付けていれば never[] 回避できます
});

const props = defineProps<{ transaction?: TransactionSearchedData, categories: CategoryData[], allocations?: Allocations }>();

const form = useForm<TransactionFormType>(getDefaultValues());

const mapTransactionToForm = (data: TransactionSearchedData): TransactionFormType => {
    return {
        id: data.id ?? null,
        type: data.type,
        amount: data.amount,
        date: data.date,
        fromAccountId: data.fromAccountId ?? null, // ← undefined にならないよう明確に null にする
        toAccountId: data.toAccountId ?? null,   // ← undefined にならないよう明確に null にする
        categoryId: data.categoryId ?? null,
        description: data.description ?? '',
        allocations: data.allocations ?? [],     // ← defaultValues に型注釈 (: TransactionForm) を付けていれば never[] 回避できます
    }
}

watch(() => props.transaction, (newVal) => {
    if (newVal) {
        form.defaults(mapTransactionToForm(newVal))
    } else {
        form.defaults(getDefaultValues());
    }
}, { immediate: true });


</script>
<template>
    <DialogContent class="sm:max-w-[425px]">
        <DialogHeader>
            <DialogTitle>Edit profile</DialogTitle>
            <DialogDescription>
                各項目入力
            </DialogDescription>
        </DialogHeader>
        <TransactionForm form-id="modal-form" :transaction="transaction" :categories="categories" />
        <DialogFooter>
            <DialogClose as-child>
                <Button type="button" variant="outline">
                    キャンセル
                </Button>
            </DialogClose>
            <Button type="submit" form="modal-form">{{ form.id ? '更新する' : '登録する' }}</Button>
        </DialogFooter>
    </DialogContent>
</template>