<script setup lang="ts">
import Card from '@/components/ui/card/Card.vue';
import Button from '@/components/ui/button/Button.vue';
import { onMounted } from 'vue';
import Textarea from '@/components/ui/textarea/Textarea.vue';
import Switch from '@/components/ui/switch/Switch.vue';
import setAmount from '@/components/inputParts/setAmount.vue';
import setSelectPurpose from '@/components/inputParts/setSelectPurpose.vue';
import setSelectPossession from '@/components/inputParts/setSelectPossession.vue';
import setAtDate from '@/components/inputParts/setAtDate.vue';
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
        <setAmount />
        <setSelectPurpose />
        <setAtDate />
        <setSelectPossession />
        <Textarea v-model="store.inputData.detail" placeholder="Type your message here." />
        <Button @click="sendData()"></Button>
    </Card>
</template>