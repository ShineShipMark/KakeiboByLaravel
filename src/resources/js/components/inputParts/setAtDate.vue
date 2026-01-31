<script setup lang="ts">
import { cn } from '@/lib/utils'
import type { DateValue } from '@internationalized/date';
import { DateFormatter, getLocalTimeZone, today } from '@internationalized/date';
import { Popover, PopoverTrigger, PopoverContent } from '@/components/ui/popover';
import { Calendar } from '@/components/ui/calendar';
import { CalendarIcon } from 'lucide-vue-next'
import { Ref, ref, watch } from 'vue';

const atDate = defineModel();

const defaultPlaceholder = today(getLocalTimeZone())
const date = ref() as Ref<DateValue>
const df = new DateFormatter('en-US', {
    dateStyle: 'long',
})

watch(date, (value) => {
    atDate.value = value ? value.toDate('jp') : null;
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