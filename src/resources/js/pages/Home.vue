<script setup lang="ts">
import { Card } from '@/components/ui/card'
import { Link } from '@inertiajs/vue3';
import InputController from '@/actions/App/Http/Controllers/InputController';
import TransactionController from '@/actions/App/Http/Controllers/TransactionController';

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
            <Link :href="InputController.index.url()">収支入力</Link>
            <Link :href="TransactionController.index.url()">履歴</Link>
            <!-- TODO: /graph はルート未定義のため直書きのまま -->
            <Link href="/graph">グラフ</Link>
        </Card>
    </Card>
</template>