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
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();

const accounts = computed(() => page.props.accounts);
const accountId = defineModel<number | null>();
const props = defineProps<{ allowAll?: boolean }>();

</script>
<template>
    <Select v-if="accounts.length > 0" v-model="accountId">
        <SelectTrigger class="w-[180px]">
            <SelectValue placeholder="目的を選択" />
        </SelectTrigger>
        <SelectContent>
            <SelectGroup>
                <SelectLabel>目的</SelectLabel>
                <SelectItem v-if="props.allowAll" :value="null">すべての口座</SelectItem>
                <SelectItem :key="data.id" v-for="data in accounts" :value="data.id">
                    {{ data.name }}
                </SelectItem>
            </SelectGroup>
        </SelectContent>
    </Select>
</template>