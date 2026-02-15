<script setup lang="ts">
import { useInputDataStore } from '@/stores/inputDataStore'
import Card from '@/components/ui/card/Card.vue';
import { Table, TableBody, TableCaption, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Button } from '@/components/ui/button';
import { computed, onMounted, ref } from 'vue';
import {
    Dialog,
    DialogTrigger,
} from '@/components/ui/dialog';
import Switch from '@/components/ui/switch/Switch.vue';
import EditModal from '@/components/historyParts/editModal.vue';
import { selectedObject } from '@/types/vue-types';

const store = useInputDataStore();
const witchSelected = ref<boolean>(true);

const witchExpenditure = computed<selectedObject>(() => {
    return witchSelected.value == true ? { en: 'expense', jp: '支出' } : { en: 'income', jp: '収入' };
})

onMounted(async () => {
    store.setData('/history/expense');
    if (store.listData) store.setPurposes('expense');
});

const columnName = ['日付', '大目的', '小目的', '金額', '所在', '詳細']

</script>
<template>
    <Card>
        <Switch :checked="store.witchExpenditure === 'income'" :disabled="store.loading"
            @update:checked="store.switchExpenditure">{{ witchExpenditure.jp }}</Switch>
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
                <TableRow v-for="data in store.listData" :key="data.id">
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
                        <Dialog :open="store.isModalOpen" @update:open="store.closeModal">
                            <DialogTrigger as-child>
                                <Button @click="store.transData(data)" variant="outline">
                                    Open Dialog
                                </Button>
                            </DialogTrigger>
                            <EditModal v-if="store.editData" />
                        </Dialog>
                    </TableCell>
                </TableRow>
            </TableBody>
        </Table>
    </Card>
</template>