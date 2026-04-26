<script setup lang="ts">
import { useInputDataStore } from '@/stores/inputDataStore'
import { useSearchParamStore } from '@/stores/searchParamStore';
import Card from '@/components/ui/card/Card.vue';
import { Table, TableBody, TableCaption, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Field, FieldGroup, FieldLabel } from '@/components/ui/field';
import { Button } from '@/components/ui/button';
import { onMounted } from 'vue';
import {
    Dialog,
    DialogTrigger,
} from '@/components/ui/dialog';
import Switch from '@/components/ui/switch/Switch.vue';
import EditModal from '@/components/historyParts/EditModal.vue';
import SetAtDate from '@/components/inputParts/SetAtDate.vue';
import SetSelectPurpose from '@/components/inputParts/SetSelectPurpose.vue';
import SetAmount from '@/components/inputParts/SetAmount.vue';
import SetSelectPossession from '@/components/inputParts/SetSelectPossession.vue';
import { useMasterDataStore } from '@/stores/masterDataStore';

const inputStore = useInputDataStore();
const searchStore = useSearchParamStore();
const masterStore = useMasterDataStore();

onMounted(async () => {
    searchStore.setData('/history/expense', searchStore.searchParam);
    if (searchStore.listData) masterStore.setPurposes('expense');
});

const columnName = ['日付', '大目的', '小目的', '金額', '所在', '詳細']

const sendSearchParam = async () => {
    await searchStore.setData(`/history/${inputStore.currentLabels.en}`, searchStore.searchParam);
}

</script>
<template>
    <form @submit.prevent="sendSearchParam">
        <FieldGroup>
            <FieldGroup>
                <Field>
                    <FieldLabel>
                        検索期間
                    </FieldLabel>
                    <SetAtDate v-model="searchStore.searchParam.first_date" />
                    ～
                    <SetAtDate v-model="searchStore.searchParam.last_date" />
                </Field>
                <Field>
                    <FieldLabel>
                        目的
                    </FieldLabel>
                    <SetSelectPurpose v-model:purpose-data="inputStore.purposeData"
                        v-model:purpose_id="searchStore.searchParam.purpose_id" />
                </Field>

                <Field>
                    <FieldLabel>
                        検索金額範囲
                    </FieldLabel>
                    <SetAmount v-model="searchStore.searchParam.min_amount" />
                    ～
                    <SetAmount v-model="searchStore.searchParam.max_amount" />
                </Field>
                <Field>
                    <FieldLabel>
                        所在
                    </FieldLabel>
                    <SetSelectPossession v-model="searchStore.searchParam.possession" />
                </Field>
                <Field>
                    <FieldLabel>
                        詳細キーワード
                    </FieldLabel>
                    <Textarea v-model="searchStore.searchParam.detail" placeholder="Type your message here." />
                </Field>
            </FieldGroup>
            <Field>
                <Button type="submit" :disabled="searchStore.loading">登録</Button>
            </Field>
        </FieldGroup>
    </form>

    <Card>
        <Switch :checked="masterStore.witchExpenditure === 'income'" :disabled="inputStore.loading"
            @update:checked="masterStore.switchExpenditure">{{ masterStore.currentLabels.ja }}</Switch>
        <Table>
            <TableCaption>test</TableCaption>
            <TableHeader>
                <TableRow>
                    <TableHead v-for="name in columnName" :key="name">
                        {{ name }}
                    </TableHead>
                </TableRow>
            </TableHeader>
            <TableBody>
                <TableRow v-for="data in inputStore.listData" :key="data.id">
                    <TableCell>
                        {{ data.at_date }}
                    </TableCell>
                    <TableCell>
                        {{ data.purpose.category.category }}
                    </TableCell>
                    <TableCell>
                        {{ data.purpose.purpose }}
                    </TableCell>
                    <TableCell>
                        {{ data.amount }}
                    </TableCell>
                    <TableCell>
                        {{ data.possession }}
                    </TableCell>
                    <TableCell>
                        {{ data.detail }}
                    </TableCell>
                    <TableCell>
                        <Dialog :open="inputStore.isModalOpen" @update:open="inputStore.closeModal">
                            <DialogTrigger as-child>
                                <Button @click="inputStore.transData(data)" variant="outline">
                                    Open Dialog
                                </Button>
                            </DialogTrigger>
                            <EditModal v-if="inputStore.editData" />
                        </Dialog>
                    </TableCell>
                </TableRow>
            </TableBody>
        </Table>
    </Card>
</template>