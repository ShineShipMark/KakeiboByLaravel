<script setup lang="ts">
import { onMounted } from 'vue';
import Card from '@/components/ui/card/Card.vue';
import Button from '@/components/ui/button/Button.vue';
import { Field, FieldSet, FieldGroup, FieldLabel } from '@/components/ui/field';
import Textarea from '@/components/ui/textarea/Textarea.vue';
import Switch from '@/components/ui/switch/Switch.vue';
import setAmount from '@/components/inputParts/SetAmount.vue';
import setSelectPurpose from '@/components/inputParts/SetSelectPurpose.vue';
import setSelectPossession from '@/components/inputParts/SetSelectPossession.vue';
import setAtDate from '@/components/inputParts/SetAtDate.vue';
import { useInputDataStore } from '@/stores/inputDataStore';

const store = useInputDataStore();

store.resetInputData();

onMounted(async () => {
    await store.setPurposes('expense');
});

const sendData = async () => {
    await store.sendData(store.inputData, `/input/${store.currentLabels.en}`);
    store.resetInputData();
}
</script>
<template>
    <Card>
        <Switch :checked="store.witchExpenditure === 'income'" :disabled="store.loading"
            @update:checked="store.switchExpenditure">{{ store.currentLabels.ja }}</Switch>
        <form @submit.prevent="sendData">
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
        </form>
    </Card>
</template>