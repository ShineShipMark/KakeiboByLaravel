<script setup lang="ts">
import { useInputDataStore } from '@/stores/inputDataStore'
import Card from '@/components/ui/card/Card.vue';
import { Table, TableBody, TableCaption, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Button } from '@/components/ui/button';
import { onMounted } from 'vue';
import {
    Dialog,
    DialogTrigger,
} from '@/components/ui/dialog'
import EditModal from '@/components/historyParts/editModal.vue';

const store = useInputDataStore();

onMounted(async () => {
    store.resetData();
    store.getData('/history/expense');
    if (store.listData) store.setPurposes('/get_expense_purpose');
});

const columnName = ['日付', '大目的', '小目的', '金額', '所在', '詳細']

</script>
<template>
    <Card>
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
                <TableRow v-for="(data, index) in store.listData" :key="data.id">
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
                        <Dialog>
                            <DialogTrigger as-child>
                                <Button variant="outline">
                                    Open Dialog
                                </Button>
                            </DialogTrigger>
                            <EditModal v-model:datas="store.listData[index]" />
                        </Dialog>
                    </TableCell>
                </TableRow>
            </TableBody>
        </Table>
    </Card>
</template>