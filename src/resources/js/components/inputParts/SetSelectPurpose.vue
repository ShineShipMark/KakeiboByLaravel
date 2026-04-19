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

const purpose_id = defineModel<number>('purpose_id');
const purposeData = defineModel<viewsPurpose[]>('purposeData');
</script>
<template>
    <Select v-model="purpose_id">
        <SelectTrigger class="w-[180px]">
            <SelectValue placeholder="Select a fruit" />
        </SelectTrigger>
        <SelectContent>
            <SelectGroup>
                <SelectLabel>目的</SelectLabel>
                <SelectItem :key="item.id" v-for="item in purposeData" :value="item.id">
                    {{ item.purpose }}
                </SelectItem>
            </SelectGroup>
        </SelectContent>
    </Select>
</template>