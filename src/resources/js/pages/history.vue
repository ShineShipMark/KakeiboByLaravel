<script setup lang="ts">
import Card from '@/components/ui/card/Card.vue';
import { Table, TableBody, TableCaption, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Button } from '@/components/ui/button';
import { fetchs } from '@/composables/fetch';
import { getData, } from '@/types/vue-types';
import { onMounted, ref } from 'vue';
import {
    Dialog,
    DialogTrigger,
} from '@/components/ui/dialog'
import EditModal from '@/components/historyParts/editModal.vue';

const listData = ref<getData[]>([]);

onMounted(async () => {
    listData.value = await fetchs<getData[], string>('/history/exxpense', 'get', '');
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
                <TableRow v-for="data in listData" :key="data.id">
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
                            <EditModal />
                        </Dialog>
                    </TableCell>
                </TableRow>
            </TableBody>
        </Table>
    </Card>
</template>