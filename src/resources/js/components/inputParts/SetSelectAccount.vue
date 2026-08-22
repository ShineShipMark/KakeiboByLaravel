<script setup lang="ts">
import {
    Select,
    SelectContent,
    SelectItem,
    SelectGroup,
    SelectLabel,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select'

type AccountBalanceSummaryData = App.Data.Account.AccountBalanceSummaryData;

const props = defineProps<{ accountData: AccountBalanceSummaryData[] }>()

const accountId = defineModel<number | null>();

</script>
<template>
    <Select v-if="props.accountData.length > 0" v-model="accountId">
        <SelectTrigger class="w-[180px]">
            <SelectValue placeholder="目的を選択" />
        </SelectTrigger>
        <SelectContent>
            <SelectGroup>
                <SelectLabel>目的</SelectLabel>
                <SelectItem :key="acc.accountId" v-for="acc in props.accountData" :value="acc.accountId">
                    {{ acc.accountName }}
                </SelectItem>
            </SelectGroup>
        </SelectContent>
    </Select>
    <div v-else class="text-sm text-gray-500 italic">
        ※選択可能なカテゴリがありません
    </div>
</template>