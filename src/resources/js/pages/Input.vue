<script setup lang="ts">
import { onMounted } from 'vue';
import Card from '@/components/ui/card/Card.vue';
import Button from '@/components/ui/button/Button.vue';
import { Field, FieldSet, FieldGroup, FieldLabel } from '@/components/ui/field';
import Textarea from '@/components/ui/textarea/Textarea.vue';
import Switch from '@/components/ui/switch/Switch.vue';
import SetAmount from '@/components/inputParts/SetAmount.vue';
import SetSelectPurpose from '@/components/inputParts/SetSelectPurpose.vue';
import SetSelectPossession from '@/components/inputParts/SetSelectPossession.vue';
import SetAtDate from '@/components/inputParts/SetAtDate.vue';
import { useInputDataStore } from '@/stores/inputDataStore';
import { useMasterDataStore } from '@/stores/masterDataStore';

const inputStore = useInputDataStore();
const masterStore = useMasterDataStore();

inputStore.resetInputData();

onMounted(async () => {
    await masterStore.setPurposes('expense');
});

const sendData = async () => {
    await inputStore.sendData(inputStore.inputData, `/input/${masterStore.currentLabels.en}`);
    inputStore.resetInputData();
}
</script>
<template>
    <Card>
        <Switch :checked="masterStore.witchExpenditure === 'income'" :disabled="inputStore.loading"
            @update:checked="masterStore.switchExpenditure">{{ masterStore.currentLabels.ja }}</Switch>
        <form @submit.prevent="sendData">
            <FieldGroup>
                <FieldSet>
                    <FieldGroup>
                        <Field>
                            <FieldLabel>
                                目的
                            </FieldLabel>
                            <SetSelectPurpose v-model:purpose-data="masterStore.purposeData"
                                v-model:purpose_id="inputStore.inputData.purpose_id" />
                        </Field>
                        <Field>
                            <SetAmount v-model="inputStore.inputData.amount" />
                        </Field>
                        <Field>
                            <SetAtDate v-model="inputStore.inputData.at_date" />
                        </Field>
                        <Field>
                            <SetSelectPossession v-model="inputStore.inputData.possession" />
                        </Field>
                        <Field>
                            <Textarea v-model="inputStore.inputData.detail" placeholder="Type your message here." />
                        </Field>
                    </FieldGroup>
                </FieldSet>
                <Field>
                    <Button type="submit" :disabled="inputStore.loading">登録</Button>
                </Field>
            </FieldGroup>
        </form>
    </Card>
</template>