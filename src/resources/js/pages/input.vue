<script setup lang="ts">
import type { DateValue } from '@internationalized/date';
import { DateFormatter, getLocalTimeZone, today } from '@internationalized/date';
import Card from '@/components/ui/card/Card.vue';
import Button from '@/components/ui/button/Button.vue';
import {
    Select,
    SelectContent,
    SelectItem,
    SelectGroup,
    SelectLabel,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select'
import {
    NumberField,
    NumberFieldContent,
    NumberFieldDecrement,
    NumberFieldIncrement,
    NumberFieldInput,
} from '@/components/ui/number-field';
import { Popover, PopoverTrigger, PopoverContent } from '@/components/ui/popover';
import { Calendar } from '@/components/ui/calendar';
import { CalendarIcon } from 'lucide-vue-next'
import { cn } from '@/lib/utils'
import { computed, onMounted, ref, Ref } from 'vue';
import Textarea from '@/components/ui/textarea/Textarea.vue';
import { sendPurpose, viewsPurpose } from '@/types/vue-types'
import Switch from '@/components/ui/switch/Switch.vue';

const defaultPlaceholder = today(getLocalTimeZone())
const date = ref() as Ref<DateValue>
const df = new DateFormatter('en-US', {
    dateStyle: 'long',
})

const select_items = ref<sendPurpose[]>([]);

const selected_purpose_id = ref<number>(0);

const amount = ref<number>(0);

const possession = ref<'account' | 'wallet'>('account');

const detail = ref<string>('');

const purposeData = ref<viewsPurpose>({
    id: 0,
    category_id: 0,
    purpose: '',
});

const witchSelected = ref<boolean>(true);
const witchString = computed<string>(() => {
    return witchSelected.value == true ? '支出' : '収入';
})

onMounted(async () => {
    purposeData.value = await fetchs<viewsPurpose>('/get_expense_purpose', 'get');
});

const fetchs = async<T>(url: string, methods: string) => {
    const response = await fetch(url, { method: methods });
    if (!response.ok) {
        throw new Error('Network response was not ok');
    }
    return response.json() as T;
}

const sendData = () => {
    console.log(555);
}

</script>
<template>
    <Card>
        <Switch v-model="witchSelected">{{ witchString }}</Switch>
        <NumberField :model-value="amount">
            <Label for="age-disabled">金額</Label>
            <NumberFieldContent>
                <NumberFieldDecrement />
                <NumberFieldInput />
                <NumberFieldIncrement />
            </NumberFieldContent>
        </NumberField>

        <Select v-model="selected_purpose_id">
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
                    <Calendar v-model="date" :default-placeholder="defaultPlaceholder" layout="month-and-year"
                        initial-focus @update:model-value="close" />
                </PopoverContent>
            </Popover>
        </Card>

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

        <Textarea v-model="detail" placeholder="Type your message here." />
        <Button @click="sendData()"></Button>
    </Card>
</template>