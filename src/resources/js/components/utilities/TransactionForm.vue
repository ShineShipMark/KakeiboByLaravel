<script setup lang="ts">
import { ref, watch } from 'vue';
import Card from '@/components/ui/card/Card.vue';
import Button from '@/components/ui/button/Button.vue';
import { Field, FieldSet, FieldGroup, FieldLabel } from '@/components/ui/field';
import Textarea from '@/components/ui/textarea/Textarea.vue';
import SetAmount from '@/components/inputParts/SetAmount.vue';
import SetSelectPurpose from '@/components/inputParts/SetSelectPurpose.vue';
import SetAtDate from '@/components/inputParts/SetAtDate.vue';
import Label from '@/components/ui/label/Label.vue';
import AllocationModal from '@/components/inputParts/AllocationModal.vue';
import { router, useForm } from '@inertiajs/vue3';
import TypeChangeButtons from '@/components/utilities/TypeChangeButtons.vue';
import type { Page } from '@inertiajs/core';
import { PageProps } from '@/types';

type TransactionData = App.Data.Transaction.TransactionData;
type CategoryData = App.Data.Category.CategoryResponseData;
// 検索結果のために、TransactionData型を拡張して分配内容を持てるようにする
type TransactionSearchedData = Omit<TransactionData, 'allocations'> & {
    allocations?: Array<{ categoryId: number; amount: number }>
}
type AllocationItemData = App.Data.Allocation.AllocationItemData;
type TransactionType = App.Enum.TransactionType;
// 登録内容を送信するために、TransactionData型を拡張してidと分配内容が有無どちらでも可能にして、登録と編集どちらにも対応できる型にする
type TransactionFormType = Omit<TransactionData, 'id' | 'allocations'> & {
    id?: number | null,
    allocations?: Array<AllocationItemData>
}

// 1. サーバー（Laravel）から返ってくる Shared Data / Props の型を定義
interface CustomPageProps extends PageProps {
    flash: {
        success?: string;
        error?: string;
    };
    allocations?: AllocationItemData[];
}

// definePropsで受け取るデータの型を指定して受け取り、オプショナル(?が付いている)なPropsに対して渡される値がない場合のデフォルト値をwithDefaultsで指定する
const props = withDefaults(defineProps<{
    transaction?: TransactionData | TransactionSearchedData, categories: CategoryData[], formId?: string, showSubmitButton?: boolean
}>(), { formId: 'transaction-form', showSubmitButton: false });

// 入力フォームの初期値を設定
const getInitialValues = (): TransactionFormType => {
    // 入力内容があらかじめ渡されている＝編集の場合は初期値として渡された値を設定
    if (props.transaction) {
        return {
            ...props.transaction,
            id: props.transaction.id,
            allocations: props.transaction.allocations ?? []
        };
    }

    // 初期値を設定
    return {
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
}

// フォームの初期値を入力
const form = useForm<TransactionFormType>(getInitialValues());

// 分配のモーダル開閉の制御
const isAllocationModalOpen = ref<boolean>(false);

// フォーム送信の制御
const handleSubmit = () => {
    // IDが既に存在する＝編集作業の場合、put送信で更新
    if (form.id) {
        form.put(`/transactions/${form.id}`, {
            onSuccess: () => {
                isAllocationModalOpen.value = false
            }
        });
        // 登録作業の場合、Post送信で登録
    } else {
        form.post('/transactions');
    }
}

// 分配モーダルが閉じられた場合、フォームの送信内容に分配内容を格納してフォーム送信を行う
const handleAllocationConfirm = (allocations: Array<{ categoryId: number, amount: number }>) => {
    form.allocations = allocations;
    handleSubmit();
}

watch(() => form.type, (newType) => {
    if (newType === 'income' && form.categoryId) {
        router.patch('/allocations/preview', { category_id: form.categoryId }, {
            preserveScroll: true,
            preserveState: true,
            onSuccess: (page: Page<CustomPageProps>) => {
                // 2. page.props.allocations が存在することを確認して代入
                if (page.props.allocations) {
                    form.allocations = page.props.allocations;
                }
            },
            onError: (errors) => {
                console.error('配分データの取得に失敗しました:', errors);
            },
        });
    }
})

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