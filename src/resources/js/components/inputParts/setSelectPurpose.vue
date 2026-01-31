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
import { sendPurpose } from '@/types/vue-types';

const select_items = defineModel<sendPurpose[]>('select_items')
const purposeId = defineModel<number>('purposeId');
</script>
<template>
    <Select v-model="purposeId">
        <SelectTrigger class="w-[180px]">
            <SelectValue placeholder="Select a fruit" />
        </SelectTrigger>
        <SelectContent>
            <SelectGroup>
                <SelectLabel>目的</SelectLabel>
                <SelectItem :key="item.id" v-for="item in select_items" :value="item.purpose">
                    {{ item.purpose }}
                </SelectItem>
            </SelectGroup>
        </SelectContent>
    </Select>
</template>