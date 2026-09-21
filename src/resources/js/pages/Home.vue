<script setup lang="ts">
import { Card } from '@/components/ui/card'
import { Link } from '@inertiajs/vue3';

type GetBalance = {
    accountAmount: number,
    cashAmount: number,
};

const props = defineProps<GetBalance>();

</script>
<template>
    <Card>
        ホーム画面
        <Card>
            口座 : {{ props.accountAmount }}円
        </Card>
        <Card>
            財布 : {{ props.cashAmount }}円
        </Card>
        <Card>
            <Link href="/input">収支入力</Link>
            <Link href="/history">履歴</Link>
            <Link href="/graph">グラフ</Link>
        </Card>
    </Card>
</template>