<script setup lang="ts">
import Card from '@/components/ui/card/Card.vue';
import { usePage } from '@inertiajs/vue3'
import TransactionForm from '@/components/utilities/TransactionForm.vue';

type CategoryData = App.Data.Category.CategoryResponseData;

const page = usePage();

const categories = page.props.categories as CategoryData[];

</script>
<template>
    <Card>
        <TransactionForm :categories="categories" :show-submit-button="true" />
    </Card>
</template>