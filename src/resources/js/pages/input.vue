<script setup lang="ts">
import Card from '@/components/ui/card/Card.vue';
import Button from '@/components/ui/button/Button.vue';
import { computed, onMounted, ref, watch } from 'vue';
import Textarea from '@/components/ui/textarea/Textarea.vue';
import { selectedObject } from '@/types/vue-types'
import Switch from '@/components/ui/switch/Switch.vue';
import setAmount from '@/components/inputParts/setAmount.vue';
import setSelectPurpose from '@/components/inputParts/setSelectPurpose.vue';
import setSelectPossession from '@/components/inputParts/setSelectPossession.vue';
import setAtDate from '@/components/inputParts/setAtDate.vue';
import { useInputDataStore } from '@/stores/inputDataStore';

const store = useInputDataStore();
const witchSelected = ref<boolean>(true);

store.resetData();

const witchString = computed<selectedObject>(() => {
    return witchSelected.value == true ? { en: 'expense', jp: '支出' } : { en: 'income', jp: '収入' };
})

onMounted(async () => {
    await store.setPurposes('/get_expense_purpose');
});

watch(witchSelected, async () => {
    await store.setPurposes(`/get_${witchString.value.en}_purpose`);
})

const sendData = async () => {
    await store.sendData(store.inputData, `/input/${witchString.value.en}`);
    store.resetData();
}
</script>
<template>
    <Card>
        <Switch v-model="witchSelected">{{ witchString.jp }}</Switch>
        <setAmount />
        <setSelectPurpose />
        <setAtDate />
        <setSelectPossession />
        <Textarea v-model="store.inputData.detail" placeholder="Type your message here." />
        <Button @click="sendData()"></Button>
    </Card>
</template>