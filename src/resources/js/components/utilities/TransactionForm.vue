<script setup lang="ts">
import { ref } from 'vue';
import Card from '@/components/ui/card/Card.vue';
import Button from '@/components/ui/button/Button.vue';
import { Field, FieldSet, FieldGroup, FieldLabel } from '@/components/ui/field';
import Textarea from '@/components/ui/textarea/Textarea.vue';
import SetAmount from '@/components/inputParts/SetAmount.vue';
import SetSelectPurpose from '@/components/inputParts/SetSelectPurpose.vue';
import SetAtDate from '@/components/inputParts/SetAtDate.vue';
import Label from '@/components/ui/label/Label.vue';
import AllocationModal from '@/components/inputParts/AllocationModal.vue';
import { useForm } from '@inertiajs/vue3';
import TypeChangeButtons from '@/components/utilities/TypeChangeButtons.vue';

type TransactionData = App.Data.Transaction.TransactionData;
type CategoryData = App.Data.Category.CategoryResponseData;
type TransactionType = App.Enum.TransactionType;
type TransactionFormType = Omit<TransactionData, 'id' | 'allocations'> & {
    id?: number | null,
    allocations?: Array<{ categoryId: number; amount: number }>
}

const props = withDefaults(defineProps<{
    transaction?: TransactionData, categories: CategoryData[], formId?: string, showSubmitButton?: boolean
}>(), { formId: 'transaction-form', showSubmitButton: false });

// デフォルト値
const defaultValues = {
    id: null,
    type: 'expense' as TransactionType, // または該当の Enum 値
    amount: 0,
    date: new Date().toISOString().split('T')[0],
    fromAccountId: null, // ← undefined にならないよう明確に null にする
    toAccountId: null,   // ← undefined にならないよう明確に null にする
    categoryId: null,
    description: '',
    allocations: [],     // ← defaultValues に型注釈 (: TransactionForm) を付けていれば never[] 回避できます
}

const form = useForm<TransactionFormType>({ ...defaultValues, ...(props.transaction ?? {}) });

const isAllocationModalOpen = ref<boolean>(false);
const handleSubmit = () => {
    if (form.id) {
        form.put(`/transactions/${form.id}`, {
            onSuccess: () => {
                isAllocationModalOpen.value = false
            }
        });
    } else {
        form.post('/transactions');
    }
}


const handleAllocationConfirm = (allocations: Array<{ categoryId: number, amount: number }>) => {
    form.allocations = allocations;
    handleSubmit();
}

</script>
<template>
    <Card>
        <form :id="formId" @submit.prevent="handleSubmit"></form>
        <TypeChangeButtons v-model="form" />
        <FieldGroup>
            <FieldSet>
                <FieldGroup>
                    <Field>
                        <FieldLabel>
                            目的
                        </FieldLabel>
                        <Label>{{ form.categoryId ? categories[form.categoryId] : '未選択' }}</Label>
                        <SetSelectPurpose v-model:category-id="form.categoryId" :categories="categories"
                            :transaction-type="form.type" />
                    </Field>
                    <Field>
                        <SetAmount v-model="form.amount" />
                    </Field>
                    <Field>
                        <SetAtDate v-model="form.date" />
                    </Field>
                    <Field>
                        <Textarea :model-value="form.description ?? undefined"
                            @update:model-value="form.description = $event ? String($event) : null"
                            placeholder="Type your message here." />
                    </Field>
                </FieldGroup>
            </FieldSet>

            <AllocationModal v-model:open="isAllocationModalOpen" :total-amount="form.amount" :categories="categories"
                @close="isAllocationModalOpen = false" @confirm="handleAllocationConfirm" />

            <Field>
                <Button v-if="showSubmitButton" type="submit" :disabled="form.processing">{{ form.id ? '更新する' : '登録する'
                }}</Button>
            </Field>
        </FieldGroup>
    </Card>
</template>