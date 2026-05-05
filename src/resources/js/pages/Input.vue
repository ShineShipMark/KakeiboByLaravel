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
import { useForm } from '@inertiajs/vue3';
import { postData } from '@/types/vue-types';

const inputStore = useInputDataStore();
const masterStore = useMasterDataStore();

inputStore.resetInputData();

onMounted(async () => {
    await masterStore.setPurposes('expense');
});

const form = useForm<postData>(inputStore.initialDataState());

const sendData = async () => {
    form.post(`/input/${masterStore.currentLabels.en}`, {
        onSuccess: () => form.reset()
    });
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
                                v-model:purpose_id="form.purpose_id" />
                        </Field>
                        <Field>
                            <SetAmount v-model="form.amount" />
                        </Field>
                        <Field>
                            <SetAtDate v-model="form.at_date" />
                        </Field>
                        <Field>
                            <SetSelectPossession v-model="form.possession" />
                        </Field>
                        <Field>
                            <Textarea v-model="form.detail" placeholder="Type your message here." />
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