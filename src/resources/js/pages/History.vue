<script setup lang="ts">
import { useInputDataStore } from '@/stores/inputDataStore'
import { useSearchParamStore } from '@/stores/searchParamStore';
import Card from '@/components/ui/card/Card.vue';
import { Table, TableBody, TableCaption, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Field, FieldGroup, FieldLabel } from '@/components/ui/field';
import { Button } from '@/components/ui/button';
import { onMounted, watch } from 'vue';
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
import { useForm } from '@inertiajs/vue3';
import { getData, toSearchParam } from '@/types/vue-types';

const inputStore = useInputDataStore();
const searchStore = useSearchParamStore();
const masterStore = useMasterDataStore();

const form = useForm<toSearchParam>(searchStore.initialParamState());

const props = defineProps<{ searchedData: getData[] }>();

onMounted(async () => {
    form.post(`/history/${masterStore.currentLabels.en}`, {
        onSuccess: () => { console.log('success!') }
    });
    if (searchStore.listData) masterStore.setPurposes('expense');
});

const columnName = ['日付', '大目的', '小目的', '金額', '所在', '詳細']

const searchData = () => {
    form.post(`/history/${masterStore.currentLabels.en}`, {
        onSuccess: () => { console.log('success!') }
    });
}

watch(() => props.searchedData, (newData) => {
    searchStore.setSearchedData(newData);
}, { immediate: true });

</script>
<template>
    <form @submit.prevent="searchData">
        <FieldGroup>
            <FieldGroup>
                <Field>
                    <FieldLabel>
                        検索期間
                    </FieldLabel>
                    <SetAtDate v-model="form.first_date" />
                    ～
                    <SetAtDate v-model="form.last_date" />
                </Field>
                <Field>
                    <FieldLabel>
                        目的
                    </FieldLabel>
                    <SetSelectPurpose v-model:purpose-data="masterStore.purposeData"
                        v-model:purpose_id="form.purpose_id" />
                </Field>

                <Field>
                    <FieldLabel>
                        検索金額範囲
                    </FieldLabel>
                    <SetAmount v-model="form.min_amount" />
                    ～
                    <SetAmount v-model="form.max_amount" />
                </Field>
                <Field>
                    <FieldLabel>
                        所在
                    </FieldLabel>
                    <SetSelectPossession v-model="form.possession" />
                </Field>
                <Field>
                    <FieldLabel>
                        詳細キーワード
                    </FieldLabel>
                    <Textarea v-model="form.detail" placeholder="Type your message here." />
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
                <TableRow v-for="data in searchStore.listData" :key="data.id">
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
                                    編集
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