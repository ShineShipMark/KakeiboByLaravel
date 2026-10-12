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
import TransactionForm from '../utilities/TransactionForm.vue';

type TransactionData = App.Data.Transaction.TransactionData;

type CategoryData = App.Data.Category.CategoryResponseData;

const props = defineProps<{ transaction?: TransactionData, categories: CategoryData[] }>();

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
            <Button type="submit" form="modal-form">{{ props.transaction?.id ? '更新する' : '登録する' }}</Button>
        </DialogFooter>
    </DialogContent>
</template>