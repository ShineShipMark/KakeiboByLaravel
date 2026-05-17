<script setup lang="ts">
import { Card } from '@/components/ui/card'
import { Link } from '@inertiajs/vue3';
</script>
<template>
    <Card>
        ホーム画面
        <Card>
            <Link href="/input">収支入力</Link>
            <Link href="/history">履歴</Link>
            <Link href="/graph">グラフ</Link>
        </Card>
    </Card>
</template>