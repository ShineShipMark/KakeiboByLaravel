<script setup lang="ts">
import { useInputDataStore } from '@/stores/inputDataStore'
import { useSearchParamStore } from '@/stores/searchParamStore';
import Card from '@/components/ui/card/Card.vue';
import { Table, TableBody, TableCaption, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Field, FieldGroup, FieldLabel } from '@/components/ui/field';
import { Button } from '@/components/ui/button';
import { onMounted, ref, watch } from 'vue';
import {
    Dialog,
    DialogTrigger,
} from '@/components/ui/dialog';
import EditModal from '@/components/historyParts/EditModal.vue';
import SetAtDate from '@/components/inputParts/SetAtDate.vue';
import SetSelectPurpose from '@/components/inputParts/SetSelectPurpose.vue';
import Textarea from '@/components/ui/textarea/Textarea.vue';
import SetSelectPossession from '@/components/inputParts/SetSelectPossession.vue';
import Label from '@/components/ui/label/Label.vue';
import { useMasterDataStore } from '@/stores/masterDataStore';
import { router, useForm, usePage } from '@inertiajs/vue3';
import { TransactionTypeWithAll } from '@/types/vue-types';
import TypeChangeButtons from '@/components/utilities/TypeChangeButtons.vue';



type TransactionData = App.Data.Transaction.TransactionData;
type TransactionType = App.Enum.TransactionType;
type AccountType = App.Enum.AccountType;

type CategoryData = App.Data.Category.CategoryResponseData;
type TransactionSearchForm = Omit<App.Data.Transaction.TransactionSearchData, 'type' | 'account'> & {
    type: TransactionTypeWithAll,
    account: AccountType
}
type TransactionSearchedData = Omit<TransactionData, 'allocations'> & {
    allocations?: Array<{ categoryId: number; amount: number }>
}


const page = usePage();

const categories = page.props.categories as CategoryData[];

const inputStore = useInputDataStore();
const searchStore = useSearchParamStore();
const masterStore = useMasterDataStore();

const form = useForm<TransactionSearchForm>(searchStore.initialParamState());

const props = defineProps<{ searchedData: TransactionSearchedData[] }>();


onMounted(async () => {
    searchData();
});

const isModalOpen = ref(false)
const selectedTransaction = ref<TransactionData | undefined>(undefined)


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

watch(() => masterStore.currentLabels?.ja, () => {
    router.reload({
        data: {
            ...form.data(),
        },
        only: ['searchedData'],
    })
})

const handleTypeChange = (newType: TransactionType) => {
    form.type = newType;
    masterStore.setCurrentType(newType);
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

    <form @submit.prevent="searchData">
        <FieldGroup>
            <FieldGroup>
                <Field>
                    <TypeChangeButtons v-model="form" />
                    <Label for="expenditure">{{ masterStore.currentLabels?.ja }}</Label>
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
                    <Label>{{ form.categoryId ? categories[form.categoryId] : '' }}</Label>
                    <SetSelectPurpose v-model:category-id="form.categoryId" :categories="categories"
                        :transaction-type="form.type" />
                </Field>
                <Field>
                    <FieldLabel>
                        所在
                    </FieldLabel>
                    <SetSelectPossession v-model="form.account" />
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
            <Field>
                <Button type="submit" :disabled="searchStore.loading">登録</Button>
            </Field>
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
                <TableRow v-for="data in props.searchedData" :key="data.id ?? undefined">
                    <TableCell>
                        {{ data.date }}
                    </TableCell>
                    <TableCell>
                        {{ data.categoryId ? categories[data.categoryId].parent : 'ロード失敗' }}
                    </TableCell>
                    <TableCell>
                        {{ data.categoryId ? categories[data.categoryId].children : 'ロード失敗' }}
                    </TableCell>
                    <TableCell>
                        {{ data.amount }}
                    </TableCell>
                    <TableCell>
                        {{ data.fromAccountId }}
                    </TableCell>
                    <TableCell>
                        {{ data.description }}
                    </TableCell>
                    <TableCell>
                        <Dialog :open="inputStore.isModalOpen" @update:open="inputStore.closeModal">
                            <DialogTrigger as-child>
                                <Button @click="inputStore.setEditData(data)" variant="outline">
                                    編集
                                </Button>
                            </DialogTrigger>
                            <EditModal v-model:open="isModalOpen" :transaction="selectedTransaction"
                                :categories="categories" :allocations="data.allocations"
                                :key="selectedTransaction?.id ?? 'new'" v-if="inputStore.editData" />
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