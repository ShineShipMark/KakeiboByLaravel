<script setup lang="ts">
import { Button } from '@/components/ui/button';
import Card from '@/components/ui/card/Card.vue';
import Label from '@/components/ui/label/Label.vue';
import { config } from '@/types/vue-types';
import { InertiaForm } from '@inertiajs/vue3';
type TransactionData = App.Data.Transaction.TransactionData;
type TransactionType = App.Enum.TransactionType;

type TransactionFormType = Omit<TransactionData, 'id' | 'allocations'> & {
    id?: number | null,
    allocations?: Array<{ categoryId: number; amount: number }>
}
type TransactionSearchForm = App.Data.Transaction.TransactionFilterData;

const form = defineModel<InertiaForm<TransactionFormType | TransactionSearchForm>>({ required: true });

const handleTypeChange = (newType: TransactionType) => {
    form.value.type = newType;
    if ('toAccountId' in form.value) {
        if (newType === 'expense') {
            form.value.toAccountId = null
        } else if (newType === 'income') {
            form.value.fromAccountId = null
        } else if (newType === 'transfer') {
            form.value.categoryId = null
        }
    }
}
</script>
<template>
    <Card>
        <Button type="button" @click="handleTypeChange('expense')">
            支出
        </Button>
        <Button type="button" @click="handleTypeChange('income')">
            収入
        </Button>
        <Button type="button" @click="handleTypeChange('transfer')">
            振替
        </Button>
        <Label for="expenditure">{{ config[form.type].ja }}</Label>
    </Card>
</template>