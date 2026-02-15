<script setup lang="ts">
import {
    DialogClose,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog'
import SetSelectPurpose from '@/components/inputParts/setSelectPurpose.vue';
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
        <Card>
            <setAmount />
            <setSelectPurpose />
            <setAtDate />
            <setSelectPossession />
            <Textarea v-model="store.inputData.detail" placeholder="Type your message here." />
            <Button @click="editData()"></Button>
        </Card>
        <DialogFooter>
            <DialogClose as-child>
                <Button variant="outline">
                    Cancel
                </Button>
            </DialogClose>
            <Button type="submit">
                Save changes
            </Button>
        </DialogFooter>
    </DialogContent>
</template>