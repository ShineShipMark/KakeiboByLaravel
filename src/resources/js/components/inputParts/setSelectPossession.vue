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
import { possessionPlace } from '@/types/vue-types';
const possession = defineModel<possessionPlace>();
</script>
<template>
    <Select v-model="possession">
        <SelectTrigger class="w-[180px]">
            <SelectValue placeholder="Select a fruit" />
        </SelectTrigger>
        <SelectContent>
            <SelectGroup>
                <SelectLabel>金額の所在・引き落とし元</SelectLabel>
                <SelectItem value="wallet">
                    財布
                </SelectItem>
                <SelectItem value="account">
                    口座
                </SelectItem>
            </SelectGroup>
        </SelectContent>
    </Select>
</template>