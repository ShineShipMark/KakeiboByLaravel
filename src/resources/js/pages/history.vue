<script setup lang="ts">
import Card from '@/components/ui/card/Card.vue';
import Table from '@/components/ui/table/Table.vue';
import TableBody from '@/components/ui/table/TableBody.vue';
import TableCaption from '@/components/ui/table/TableCaption.vue';
import TableCell from '@/components/ui/table/TableCell.vue';
import TableHead from '@/components/ui/table/TableHead.vue';
import TableHeader from '@/components/ui/table/TableHeader.vue';
import TableRow from '@/components/ui/table/TableRow.vue';
import { fetchs } from '@/composables/fetch';
import { getData, } from '@/types/vue-types';
import { onMounted, ref } from 'vue';

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
                </TableRow>
            </TableBody>
        </Table>
    </Card>
</template>