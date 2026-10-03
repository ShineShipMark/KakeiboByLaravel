<script setup lang='ts'>
import Card from '@/components/ui/card/Card.vue';
import { ref } from 'vue';
import { FieldGroup, Field, FieldLabel, FieldSet } from '@/components/ui/field';
import { useForm } from '@inertiajs/vue3';
import SetAmount from '@/components/inputParts/SetAmount.vue';

type SaveAllocationRuleItemData = App.Data.Allocation.SaveAllocationRuleItemData;
type SaveAllocationRuleData = App.Data.Allocation.SaveAllocationRuleData;

const rule_items = ref(['家賃', 'スマホ代', '奨学金', '生命保険', 'NISA', '趣味', '雑費', '諸貯金', '趣味貯金'])
const getInitialItemData = (): SaveAllocationRuleItemData[] => {
    const itemsData: SaveAllocationRuleItemData[] = [];
    const initialItem = (priority_num: number): SaveAllocationRuleItemData => {
        return {
            id: null,
            toAccountId: 0,
            categoryId: 0,
            type: 'fixed' as const,
            amount: 0,
            percentage: 0,
            priority: priority_num,
        }
    }
    rule_items.value.forEach((items, index) => {
        itemsData.push(initialItem(index))
    })

    return itemsData;
}

const getInitialData = (): SaveAllocationRuleData => {
    return {
        id: null,
        name: '',
        items: getInitialItemData(),
    }
}

const form = useForm<SaveAllocationRuleData>(getInitialData());

</script>

<template>
    <Card>
        <form>
            <Card v-for="(item, index) in form.items" :key="index">
                <FieldGroup>
                    <FieldSet>
                        <FieldGroup>
                            <FieldLabel>
                                {{ rule_items[index] }}
                            </FieldLabel>
                            <Field>
                                <SetAmount v-model="item.amount" />
                            </Field>
                        </FieldGroup>
                    </FieldSet>
                </FieldGroup>
            </Card>
            <Field>
                <Button type="submit" :disabled="form.processing">登録する</Button>
            </Field>
        </form>
    </Card>
</template>