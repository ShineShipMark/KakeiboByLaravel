<script setup lang="ts">
import Card from '@/components/ui/card/Card.vue';
import { Table, TableBody, TableCaption, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Field, FieldGroup, FieldLabel } from '@/components/ui/field';
import { Button } from '@/components/ui/button';
import { computed, onMounted, ref } from 'vue';
import {
    Dialog,
} from '@/components/ui/dialog';
import EditModal from '@/components/historyParts/EditModal.vue';
import SetAtDate from '@/components/inputParts/SetAtDate.vue';
import SetSelectPurpose from '@/components/inputParts/SetSelectPurpose.vue';
import Textarea from '@/components/ui/textarea/Textarea.vue';
import SetSelectAccount from '@/components/inputParts/SetSelectAccount.vue';
import { router, useForm } from '@inertiajs/vue3';
import TypeChangeButtons from '@/components/utilities/TypeChangeButtons.vue';

type TransactionData = App.Data.Transaction.TransactionData;
type TransactionSearchForm = App.Data.Transaction.TransactionFilterData;
type TransactionType = App.Enum.TransactionType;
type AccountBalanceSummaryData = App.Data.Account.AccountBalanceSummaryData;

type CategoryData = App.Data.Category.CategoryResponseData;

type TransactionSearchedData = Omit<TransactionData, 'allocations'> & {
    allocations?: Array<{ categoryId: number; amount: number }>
}

const props = defineProps<{
    transaction?: TransactionSearchedData[], filters?: TransactionSearchForm,
    categories: CategoryData[], accounts: AccountBalanceSummaryData[]
}>();

const accountMap = computed(() => { return new Map(props.accounts.map(acc => [acc.accountId, acc.accountName])) });
const categoryMap = computed(() => { return new Map(props.categories.map(cat => [cat.id, cat])) });

const getAccountName = (id?: number | null) => id ? (accountMap.value.get(id) ?? '-') : '-';

const getParentCategoryName = (categoryId: number | null): string => {
    if (!categoryId) return '未設定';
    const category = categoryMap.value.get(categoryId)?.parent
    return category?.parent?.name ?? '未設定';
}

const getChildrenCategoryName = (categoryId: number | null): string => {
    if (!categoryId) return '未設定';
    const category = categoryMap.value.get(categoryId)
    return category?.name ?? '未設定';
}

const getInitialValues = (): TransactionSearchForm => {
    if (props.filters) {
        return {
            ...props.filters
        };
    }

    return {
        keyword: null,
        type: 'expense' as TransactionType, // または該当の Enum 値
        startDate: new Date().toISOString().split('T')[0],
        endDate: new Date().toISOString().split('T')[0],
        accountId: 1,   // ← undefined にならないよう明確に null にする
        categoryId: null,
        page: 1,
        perPage: 30,
    }
}

const form = useForm<TransactionSearchForm>(getInitialValues());


onMounted(async () => {
    searchData();
});

const isModalOpen = ref(false)
const selectedTransaction = ref<TransactionSearchedData | undefined>(undefined)

const openEditModal = (data: TransactionSearchedData) => {
    selectedTransaction.value = data;
    isModalOpen.value = true;
}

const columnName = {
    type: '種類',
    category: '大目的',
    purpose: '小目的',
    amount: '金額',
    account: '所在',
    description: '詳細'
}

const searchData = () => {
    router.get('transactions', {
        ...form.data(),
    }, {
        only: ['searchedData'],
        preserveState: true,
    });
}

const deleteData = (id: number) => {
    if (confirm('本当に削除しますか？')) {
        form.delete(`${window.location.pathname}/${id}`)
    }
}


const handleSubmit = () => {
    form.get('/transactions', { preserveState: true, preserveScroll: true });
}

const handleTypeChange = (newType: TransactionType) => {
    form.type = newType;
    handleSubmit();
}

</script>
<template>
    <Button type="button" @click="handleTypeChange('expense')">
        支出
    </Button>
    <Button type="button" @click="handleTypeChange('income')">
        収入
    </Button>
    <Button type="button" @click="handleTypeChange('transfer')">
        振替
    </Button>

    <Card>
        <Card v-for="acc in props.accounts" :key="acc.accountId">
            <h3>{{ acc.accountName }}</h3>
            <p>実残高:{{ acc.actualBalance.toLocaleString() }}円</p>
            <p>未割当:{{ acc.unallocatedBalance.toLocaleString() }}円</p>
        </Card>
    </Card>

    <form @submit.prevent="searchData">
        <FieldGroup>
            <FieldGroup>
                <Field>
                    <TypeChangeButtons v-model="form" />
                </Field>
                <Field>
                    <FieldLabel>
                        検索期間
                    </FieldLabel>
                    <SetAtDate v-model="form.startDate" />
                    ～
                    <SetAtDate v-model="form.endDate" />
                </Field>
                <Field>
                    <FieldLabel>
                        目的
                    </FieldLabel>
                    <SetSelectPurpose v-model:category-id="form.categoryId" :categories="categories"
                        :transaction-type="form.type" />
                </Field>
                <Field>
                    <FieldLabel>
                        所在
                    </FieldLabel>
                    <SetSelectAccount v-model:account-id="form.accountId" :accountData="props.accounts" />
                </Field>
                <Field>
                    <FieldLabel>
                        詳細キーワード
                    </FieldLabel>
                    <Textarea :model-value="form.keyword ?? ''"
                        @update:model-value="(val) => form.keyword = val !== null && val !== undefined ? String(val) : ''"
                        placeholder="Type your message here." />
                </Field>
            </FieldGroup>
        </FieldGroup>
    </form>

    <Card>
        <Table>
            <TableCaption>test</TableCaption>
            <TableHeader>
                <TableRow>
                    <TableHead v-for="(name, namesKey) in columnName" :key="namesKey">
                        {{ name }}
                    </TableHead>
                </TableRow>
            </TableHeader>
            <TableBody>
                <TableRow v-for="data in props.transaction" :key="data.id!">
                    <TableCell>
                        {{ data.date }}
                    </TableCell>
                    <TableCell>
                        {{ getParentCategoryName(data.categoryId) }}
                    </TableCell>
                    <TableCell>
                        {{ getChildrenCategoryName(data.categoryId) }}
                    </TableCell>
                    <TableCell>
                        {{ data.amount }}
                    </TableCell>
                    <TableCell>
                        {{ getAccountName(data.fromAccountId) }}
                    </TableCell>
                    <TableCell>
                        {{ data.description }}
                    </TableCell>
                    <TableCell>
                        <Dialog>
                            <Button variant="outline" @click="openEditModal(data)">
                                編集
                            </Button>
                            <EditModal v-model:open="isModalOpen" :transaction="selectedTransaction"
                                :categories="categories" :allocations="data.allocations"
                                :key="selectedTransaction?.id ?? 'new'" />
                        </Dialog>
                    </TableCell>
                    <TableCell>
                        <Button v-if="data.id" @click="deleteData(data.id)">削除</Button>
                    </TableCell>
                </TableRow>
            </TableBody>
        </Table>
    </Card>
</template>