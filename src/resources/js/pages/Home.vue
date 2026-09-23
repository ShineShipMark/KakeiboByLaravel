<script setup lang="ts">
import { Card } from '@/components/ui/card'
import { Link } from '@inertiajs/vue3';

type AccountBalanceSummaryData = App.Data.Account.AccountBalanceSummaryData;

defineProps<{ balances: AccountBalanceSummaryData[] }>();
</script>
<template>
    <Card>
        ホーム画面
        <Card v-for="account in balances" :key="account.accountId">
            <h2>{{ account.accountName }}</h2>
            <p>実残高: {{ account.actualBalance.toLocaleString() }}円</p>
            <p>自由枠: {{ account.unallocatedBalance.toLocaleString() }}円</p>
        </Card>
        <Card>
            <Link href="/input">収支入力</Link>
            <Link href="/history">履歴</Link>
            <Link href="/graph">グラフ</Link>
        </Card>
    </Card>
</template>