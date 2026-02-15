<script setup lang="ts">
import {
    NumberField,
    NumberFieldContent,
    NumberFieldDecrement,
    NumberFieldIncrement,
    NumberFieldInput,
} from '@/components/ui/number-field';
import { useInputDataStore } from '@/stores/inputDataStore';

const store = useInputDataStore();
</script>
<template>
    <NumberField :model-value="store.inputData.amount">
        <Label for="age-disabled">金額</Label>
        <NumberFieldContent>
            <NumberFieldDecrement />
            <NumberFieldInput />
            <NumberFieldIncrement />
        </NumberFieldContent>
    </NumberField>
</template>