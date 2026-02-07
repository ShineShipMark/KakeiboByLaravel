<script setup lang="ts">
import Card from '@/components/ui/card/Card.vue';
import Button from '@/components/ui/button/Button.vue';
import { computed, onMounted, reactive, ref, watch } from 'vue';
import Textarea from '@/components/ui/textarea/Textarea.vue';
import { postData, selectedObject, viewsPurpose } from '@/types/vue-types'
import Switch from '@/components/ui/switch/Switch.vue';
import { fetchs } from '@/composables/fetch';
import setAmount from '@/components/inputParts/setAmount.vue';
import setSelectPurpose from '@/components/inputParts/setSelectPurpose.vue';
import setSelectPossession from '@/components/inputParts/setSelectPossession.vue';
import setAtDate from '@/components/inputParts/setAtDate.vue';

const detail = ref<string>('');

const purposeData = ref<viewsPurpose[]>([]);

const sendInputData = reactive<postData>({ id: 0, amount: 0, purpose_id: 0, at_date: new Date(), possession: 'account', detail: '' });

const witchSelected = ref<boolean>(true);

const witchString = computed<selectedObject>(() => {
    return witchSelected.value == true ? { en: 'expense', jp: '支出' } : { en: 'income', jp: '収入' };
})

onMounted(async () => {
    purposeData.value = await fetchs<viewsPurpose[], string>('/get_expense_purpose', 'get', '');
});

watch(witchSelected, async () => {
    purposeData.value = await fetchs<viewsPurpose[], string>(`/get_${witchString.value.en}_purpose`, 'get', '');
})

const sendData = async () => {
    await fetchs<string, postData>(`/input/${witchString.value.en}`, 'post', sendInputData);
}

</script>
<template>
    <Card>
        <Switch v-model="witchSelected">{{ witchString.jp }}</Switch>
        <setAmount v-model="sendInputData.amount" />
        <setSelectPurpose v-model:purpose-id="sendInputData.purpose_id" v-model:select_items="purposeData" />
        <setAtDate v-model="sendInputData.at_date" />
        <setSelectPossession v-model="sendInputData.possession" />
        <Textarea v-model="detail" placeholder="Type your message here." />
        <Button @click="sendData()"></Button>
    </Card>
</template>