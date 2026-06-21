<script setup lang="ts">
import {
    NumberField,
    NumberFieldContent,
    NumberFieldDecrement,
    NumberFieldIncrement,
    NumberFieldInput,
} from '@/components/ui/number-field';
import { Label } from '@/components/ui/label'

const amount = defineModel<number>();

</script>
<template>
    <NumberField v-model="amount">
        <Label for="age-disabled">金額</Label>
        <NumberFieldContent>
            <NumberFieldDecrement />
            <NumberFieldInput />
            <NumberFieldIncrement />
        </NumberFieldContent>
    </NumberField>
</template>