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
import { useInputDataStore } from '@/stores/inputDataStore';

const store = useInputDataStore();
</script>
<template>
    <Select v-model="store.inputData.purpose_id">
        <SelectTrigger class="w-[180px]">
            <SelectValue placeholder="Select a fruit" />
        </SelectTrigger>
        <SelectContent>
            <SelectGroup>
                <SelectLabel>目的</SelectLabel>
                <SelectItem :key="item.id" v-for="item in store.purposeData" :value="item.id">
                    {{ item.purpose }}
                </SelectItem>
            </SelectGroup>
        </SelectContent>
    </Select>
</template>