<script setup lang='ts'>
import { router, usePage } from '@inertiajs/vue3';
import { SidebarProvider, SidebarTrigger } from '../ui/sidebar';
import AppSideBar from '../utilities/AppSideBar.vue';
import { computed, ref } from 'vue';
import Card from '@/components/ui/card/Card.vue';

const page = usePage();

const visible = ref<boolean>(false);

const message = computed(() => page.props.flash.message);

let timer: ReturnType<typeof setTimeout> | undefined;

router.on('success', (event) => {
    if (!event.detail.page.props.flash.message) return;
    visible.value = true;
    clearTimeout(timer);
    timer = setTimeout(() => { visible.value = false }, 3000)
})

</script>
<template>
    <SidebarProvider>
        <div class="flex min-h-screen w-full bg-background">
            <AppSideBar />
            <main class="flex-1 p-6 md:p-8">
                <div class="flex items-center gap-4 mb-6">
                    <SidebarTrigger />
                    <h1 class="text-2xl font-bold tracking-tight">
                        <slot name="header" />
                    </h1>
                </div>
                <Card class="bg-green-400" v-if="visible && message">{{ message }}</Card>
                <div class="rounded-xl border bg-card text-card-foreground shadow-sm p-6">
                    <slot />
                </div>

            </main>
        </div>
    </SidebarProvider>
</template>