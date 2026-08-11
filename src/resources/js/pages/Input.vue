<script setup lang="ts">
import { computed, onMounted } from 'vue';
import Card from '@/components/ui/card/Card.vue';
import Button from '@/components/ui/button/Button.vue';
import { Field, FieldSet, FieldGroup, FieldLabel } from '@/components/ui/field';
import Textarea from '@/components/ui/textarea/Textarea.vue';
import SetAmount from '@/components/inputParts/SetAmount.vue';
import SetSelectPurpose from '@/components/inputParts/SetSelectPurpose.vue';
import SetAtDate from '@/components/inputParts/SetAtDate.vue';
import { useInputDataStore } from '@/stores/inputDataStore';
import { useMasterDataStore } from '@/stores/masterDataStore';
import { usePage, useForm } from '@inertiajs/vue3'
import Label from '@/components/ui/label/Label.vue';

type TransactionData = App.Data.Transaction.TransactionData
type TransactionType = App.Enum.TransactionType;

type CategoryData = App.Data.Category.CategoryResponseData;

const page = usePage();

const categories = page.props.categories as CategoryData[];

type TransactionForm = Omit<TransactionData, 'id'>


const inputStore = useInputDataStore();
const masterStore = useMasterDataStore();

inputStore.resetInputData();

onMounted(async () => {
    await masterStore.setPurposes();
});

const form = useForm<TransactionForm>(inputStore.initialDataState());

const sendData = async () => {
    form.post(window.location.pathname);
}

const currentPurposes = computed(() => {
    if (!masterStore.purpose_category) return [];

    const isExpense = masterStore.wichExpenditure === 'Expense';

    return isExpense ? (masterStore.purpose_category.expense?.purpose ?? []) : (masterStore.purpose_category.income?.purpose ?? []);
});

const currentCategories = computed(() => {
    if (!masterStore.purpose_category) return [];

    const isExpense = masterStore.wichExpenditure === 'Expense';

    return isExpense ? (masterStore.purpose_category.expense?.category ?? []) : (masterStore.purpose_category.income?.category ?? []);
});

const currentCategory = computed(() => {
    if (!form.categoryId) return null;
    const purpose = currentPurposes.value.find(p => p.id === form.categoryId);
    if (!purpose) return null;
    return currentCategories.value.find(c => c.id === purpose.category_id) ?? null;
})

const handleTypeChange = (newType: TransactionType) => {
    form.type = newType;

    if (newType === 'expense') {
        form.toAccountId = null
    } else if (newType === 'income') {
        form.fromAccountId = null
    } else if (newType === 'transfer') {
        form.categoryId = null
    }
}
</script>
<template>
    <Card>
        <form @submit.prevent="sendData">
            <Button type="button" @click="handleTypeChange('expense')">
                支出
            </Button>
            <Button type="button" @click="handleTypeChange('income')">
                収入
            </Button>
            <Button type="button" @click="handleTypeChange('transfer')">
                振替
            </Button>
            <Label for="expenditure">{{ masterStore.currentLabels.ja.label }}</Label>
            <FieldGroup>
                <FieldSet>
                    <FieldGroup>
                        <Field>
                            <FieldLabel>
                                目的
                            </FieldLabel>
                            <Label>{{ currentCategory?.category ?? '未選択' }}</Label>
                            <SetSelectPurpose v-if="currentPurposes.length > 0" v-model:category-id="form.categoryId"
                                :categories="categories" :transaction-type="form.type" />
                            <div v-else class="text-sm text-gray-400">読み込み中...</div>
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
                <Field>
                    <Button type="submit" :disabled="inputStore.loading">登録</Button>
                </Field>
            </FieldGroup>
        </form>
    </Card>
</template>