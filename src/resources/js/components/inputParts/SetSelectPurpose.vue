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
import { TransactionTypeWithAll } from '@/types/vue-types';
import { computed, watch } from 'vue';

type CategoryData = App.Data.Category.CategoryResponseData
type TransactionType = TransactionTypeWithAll

const props = defineProps<{
    categories: CategoryData[]
    transactionType: TransactionType
}>()

// 3. v-model:categoryId と同期するモデル定義
const categoryId = defineModel<number | null>('categoryId')

// 4. 種別（transactionType）に合わせてカテゴリを自動絞り込み
const filteredCategories = computed(() => {
    return props.categories.filter((cat) => cat.type === props.transactionType)
})

// 5. 種別が変わったら選択中の ID を自動リセット
watch(() => props.transactionType, () => {
    categoryId.value = null
})

</script>

<template>
    <Select v-if="filteredCategories.length > 0" v-model="categoryId">
        <SelectTrigger class="w-[180px]">
            <SelectValue placeholder="目的を選択" />
        </SelectTrigger>
        <SelectContent>
            <SelectGroup>
                <SelectLabel>目的</SelectLabel>
                <SelectItem :key="child.id" v-for="child in filteredCategories" :value="String(child.id)">
                    {{ child.children }}
                </SelectItem>
            </SelectGroup>
        </SelectContent>
    </Select>
    <div v-else class="text-sm text-gray-500 italic">
        ※選択可能なカテゴリがありません
    </div>
</template>