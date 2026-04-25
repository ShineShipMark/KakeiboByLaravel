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
    await store.sendData(store.editData, `/edit/${store.witchExpenditure}`);
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
                                <SetSelectPurpose v-model:purpose-data="store.purposeData"
                                    v-model:purpose_id="store.editData.purpose_id" />
                            </Field>
                            <Field>
                                <SetAmount v-model="store.editData.amount" />
                            </Field>
                            <Field>
                                <SetAtDate v-model="store.editData.at_date" />
                            </Field>
                            <Field>
                                <SetSelectPossession v-model="store.editData.possession" />
                            </Field>
                            <Field>
                                <Textarea v-model="store.editData.detail" placeholder="Type your message here." />
                            </Field>
                        </FieldGroup>
                    </FieldSet>
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