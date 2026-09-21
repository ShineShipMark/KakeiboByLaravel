<script setup lang="ts">
import {
    Dialog,
    DialogClose,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog'
import Card from '../ui/card/Card.vue';
import { Field, FieldSet, FieldGroup, FieldLabel } from '@/components/ui/field';
import SetAmount from '@/components/inputParts/SetAmount.vue';
import { computed, ref } from 'vue';
import Button from '../ui/button/Button.vue';

type CategoryData = App.Data.Category.CategoryResponseData;

// 分配内容についてのPropsを受け取る
const props = defineProps<{
    totalAmount: number,
    categories: CategoryData[],
    initialAllocations?: Array<{ categoryId: number, amount: number }>
}>();

// モーダルの開閉についての真偽値をPropsで受け取る
const isOpen = defineModel<boolean>('open', { default: false });

// emitイベントの型定義
const emit = defineEmits<{ confirm: [allocations: Array<{ categoryId: number, amount: number }>] }>();

// カテゴリごとに分かれている分配ルールについて、選択中のカテゴリに合致したデータを取得する
const localAllocations = ref<Array<{ categoryId: number; amount: number }>>(
    props.categories.map(p => {
        const exist = props.initialAllocations?.find(a => a.categoryId === p.id);
        return {
            categoryId: p.id,
            amount: exist ? exist.amount : 0,
        }
    })
)

// 分配の合計値を計算
const allocatedSum = computed(() => {
    return localAllocations.value.reduce((sum, item) => sum + (Number(item.amount) || 0), 0);
});

// 収入などの合計値から分配の合計値を引いた余剰分を計算
const remainingAmount = computed(() => {
    return props.totalAmount - allocatedSum.value;
})

// モーダルを閉じる
const handleClose = () => {
    isOpen.value = false;
}

const handleConfirm = () => {
    if (remainingAmount.value !== 0) return;
    // 『confirm』という名前のイベントを発行し、データを親コンポーネントに渡す
    emit('confirm', localAllocations.value);
    //　モーダルを閉じる
    handleClose();
}

</script>
<template>
    <Dialog v-model:open="isOpen">

        <DialogContent class="sm:max-w-[425px]">
            <DialogHeader>
                <DialogTitle>Edit profile</DialogTitle>
                <DialogDescription>
                    各項目入力
                </DialogDescription>
            </DialogHeader>
            <Card>
                <FieldGroup>
                    <FieldSet>
                        <FieldGroup>
                            <Card v-for="value in localAllocations" :key="value.categoryId">
                                <Field>
                                    <FieldLabel>
                                        {{categories.find(c => c.id === value.categoryId)?.name}}
                                    </FieldLabel>
                                    <SetAmount v-model.number="value.amount" />
                                </Field>
                            </Card>
                        </FieldGroup>
                    </FieldSet>
                </FieldGroup>
            </Card>
            <Card>
                <Card>{{ allocatedSum.toLocaleString() }}</Card>
                <template v-if="remainingAmount == 0">分配完了</template>
                <template v-else>残額{{ remainingAmount.toLocaleString() }}円</template>
            </Card>
            <Button type="button" @click="handleClose">キャンセル</Button>
            <Button type="button" @click="handleConfirm" :disabled="remainingAmount !== 0">保存</Button>
            <DialogFooter>
                <DialogClose as-child>
                    <Button variant="outline">
                        Cancel
                    </Button>
                </DialogClose>
                <Button type="submit">
                    編集
                </Button>
            </DialogFooter>
        </DialogContent>
    </Dialog>
</template>