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
import SetAmount from '@/components/inputParts/SetAmount.vue';
import SetSelectPurpose from '@/components/inputParts/SetSelectPurpose.vue';
import SetAtDate from '@/components/inputParts/SetAtDate.vue';
import SetSelectPossession from '@/components/inputParts/SetSelectPossession.vue';
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
                                <SetSelectPurpose />
                            </Field>
                            <Field>
                                <SetAmount />
                            </Field>
                            <Field>
                                <SetAtDate />
                            </Field>
                            <Field>
                                <SetSelectPossession />
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