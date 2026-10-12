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

const props = defineProps<{ accountDatas: { id: number, name: string }[] }>()

const accountId = defineModel<number | null>();

</script>
<template>
    <Select v-if="props.accountDatas.length > 0" v-model="accountId">
        <SelectTrigger class="w-[180px]">
            <SelectValue placeholder="目的を選択" />
        </SelectTrigger>
        <SelectContent>
            <SelectGroup>
                <SelectLabel>目的</SelectLabel>
                <SelectItem :key="data.id" v-for="data in props.accountDatas" :value="data.id">
                    {{ data.name }}
                </SelectItem>
            </SelectGroup>
        </SelectContent>
    </Select>
    <div v-else class="text-sm text-gray-500 italic">
        ※選択可能なカテゴリがありません
    </div>
</template>