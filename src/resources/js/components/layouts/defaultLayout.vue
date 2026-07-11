<script setup lang='ts'>
import { SidebarProvider, SidebarTrigger } from '../ui/sidebar';
import AppSideBar from '../utilities/AppSideBar.vue';

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

                <div class="rounded-xl border bg-card text-card-foreground shadow-sm p-6">
                    <slot />
                </div>
            </main>
        </div>
    </SidebarProvider>
</template>