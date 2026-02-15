<script setup lang="ts">
import {
    DialogClose,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog'
import { Card } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import Textarea from '@/components/ui/textarea/Textarea.vue';
import { Field, FieldSet, FieldGroup, FieldLabel } from '@/components/ui/field';
import setAmount from '@/components/inputParts/SetAmount.vue';
import setSelectPurpose from '@/components/inputParts/SetSelectPurpose.vue';
import setAtDate from '@/components/inputParts/SetAtDate.vue';
import setSelectPossession from '@/components/inputParts/SetSelectPossession.vue';
import { useInputDataStore } from '@/stores/inputDataStore';

const store = useInputDataStore();

const editData = async () => {
    await store.sendData(store.inputData, `/edit/${store.witchExpenditure}`);
    store.resetEditData();
}

</script>
<template>
    <DialogContent class="sm:max-w-[425px]">
        <DialogHeader>
            <DialogTitle>Edit profile</DialogTitle>
            <DialogDescription>
                各項目入力
            </DialogDescription>
        </DialogHeader>
        <form @submit.prevent="editData">
            <Card>
                <FieldGroup>
                    <FieldSet>
                        <FieldGroup>
                            <Field>
                                <FieldLabel>
                                    目的
                                </FieldLabel>
                                <setSelectPurpose />
                            </Field>
                            <Field>
                                <setAmount />
                            </Field>
                            <Field>
                                <setAtDate />
                            </Field>
                            <Field>
                                <setSelectPossession />
                            </Field>
                            <Field>
                                <Textarea v-model="store.inputData.detail" placeholder="Type your message here." />
                            </Field>
                        </FieldGroup>
                    </FieldSet>
                    <Field>
                        <Button type="submit" :disabled="store.loading">登録</Button>
                    </Field>
                </FieldGroup>
            </Card>
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
        </form>
    </DialogContent>
</template>