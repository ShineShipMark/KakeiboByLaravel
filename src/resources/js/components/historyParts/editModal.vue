<script setup lang="ts">
import {
    DialogClose,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog'
import SetSelectPurpose from '../inputParts/setSelectPurpose.vue';
import { getData } from '@/types/vue-types';

const editData = defineModel<getData>('datas', { required: true });

</script>
<template>
    <DialogContent class="sm:max-w-[425px]">
        <DialogHeader>
            <DialogTitle>Edit profile</DialogTitle>
            <DialogDescription>
                各項目衆力
            </DialogDescription>
        </DialogHeader>
        <div class="grid gap-4">
            <div class="grid gap-3">
                <Label for="name-1">Name</Label>
                <Input id="name-1" name="name" default-value="Pedro Duarte" />
                <SetSelectPurpose v-model:purpose-id="editData.purpose.id" />
            </div>
            <div class="grid gap-3">
                <Label for="username-1">Username</Label>
                <Input id="username-1" name="username" default-value="@peduarte" />
            </div>
        </div>
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