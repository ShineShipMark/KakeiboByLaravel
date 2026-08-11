<script setup lang="ts">
import { cn } from '@/lib/utils'
import type { DateValue } from '@internationalized/date';
import { DateFormatter, getLocalTimeZone, parseDate, today } from '@internationalized/date';
import { Popover, PopoverTrigger, PopoverContent } from '@/components/ui/popover';
import { Button } from '@/components/ui/button';
import Card from '@/components/ui/card/Card.vue';
import { Calendar } from '@/components/ui/calendar';
import { CalendarIcon } from 'lucide-vue-next'
import { onMounted, ref, watch } from 'vue';

const at_date = defineModel<string | null | undefined>();

const defaultPlaceholder = today(getLocalTimeZone())
const date = ref<DateValue | undefined>()
const df = new DateFormatter('en-US', {
    dateStyle: 'long',
})

const syncFromParent = (val: string | null | undefined) => {
    if (!val) {
        date.value = undefined
        return
    }
    try {
        // "YYYY-MM-DD" 形式の文字列を DateValue に変換
        date.value = parseDate(val)
    } catch {
        // 万が一フォーマットエラー等があればクリア
        date.value = undefined
    }
}

onMounted(() => {
    syncFromParent(at_date.value)
})

// 親の値（at_date）が外部から変わった場合にも追従する
watch(at_date, (newVal) => {
    // 循環更新を防ぐため、文字列形式で差分がある場合のみ更新
    if (newVal !== date.value?.toString()) {
        syncFromParent(newVal)
    }
})

// 3. ピッカーで日付が選択されたら、親へ "YYYY-MM-DD" の string で渡す
watch(date, (value) => {
    if (value) {
        // value.toString() は "2026-08-11" のような YYYY-MM-DD 文字列を返します
        at_date.value = value.toString()
    } else {
        at_date.value = undefined
    }
})
</script>
<template>
    <label for="at_date">日時</label>
    <Card id="at_date">
        <Popover v-slot="{ close }">
            <PopoverTrigger as-child>
                <Button variant="outline"
                    :class="cn('w-[240px] justify-start text-left font-normal', !date && 'text-muted-foreground')">
                    <CalendarIcon />
                    {{ date ? df.format(date.toDate(getLocalTimeZone())) : "Pick a date" }}
                </Button>
            </PopoverTrigger>
            <PopoverContent class="w-auto p-0" align="start">
                <Calendar v-model="date" :default-placeholder="defaultPlaceholder" layout="month-and-year" initial-focus
                    @update:model-value="close" />
            </PopoverContent>
        </Popover>
    </Card>
</template>