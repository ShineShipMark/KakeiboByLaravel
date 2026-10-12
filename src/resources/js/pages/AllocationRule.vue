<script setup lang='ts'>
import Card from '@/components/ui/card/Card.vue';
import { FieldGroup, Field, FieldLabel, FieldSet } from '@/components/ui/field';
import { useForm } from '@inertiajs/vue3';
import SetAmount from '@/components/inputParts/SetAmount.vue';
import Button from '@/components/ui/button/Button.vue';


type SaveAllocationRuleItemData = App.Data.Allocation.SaveAllocationRuleItemData;
type SaveAllocationRuleData = App.Data.Allocation.SaveAllocationRuleData;
type AllocationsCategoriesData = App.Data.Allocation.AllocationsCategoriesData;

const props = defineProps<AllocationsCategoriesData>();

const rule_items = props.categories.find(category =>
    (category.type === 'income' && category.name === '給料からの各種費用差し引き')
)?.children ?? [];

const getInitialItemData = (): SaveAllocationRuleItemData[] => {
    const initialItem = (categoryId: number, priority_num: number): SaveAllocationRuleItemData => {
        return {
            id: null,
            toAccountId: null,
            categoryId: categoryId,
            type: 'fixed' as const,
            amount: 0,
            percentage: 0,
            priority: priority_num,
        }
    }

    const itemsData = rule_items.map(
        (category, index) => initialItem(category.id, index + 1));

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
                                {{ rule_items[index].name }}
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