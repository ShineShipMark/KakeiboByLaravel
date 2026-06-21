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
import { viewsPurpose } from '@/types/vue-types';

// 1. 変更される「選択されたID」は defineModel を使う（これで大正解！）
const purpose_id = defineModel<number>('purpose_id');

// 2. 読み取り専用の「選択肢リスト」は、v-model ではなく通常の defineProps にする
defineProps<{
    purposeData: viewsPurpose[]
}>();
</script>

<template>
    <Select v-model="purpose_id">
        <SelectTrigger class="w-[180px]">
            <SelectValue placeholder="目的を選択" />
        </SelectTrigger>
        <SelectContent>
            <SelectGroup>
                <SelectLabel>目的</SelectLabel>
                <SelectItem :key="item.id" v-for="item in purposeData" :value="String(item.id)">
                    {{ item.purpose }}
                </SelectItem>
            </SelectGroup>
        </SelectContent>
    </Select>
</template>