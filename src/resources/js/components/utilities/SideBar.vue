<script setup lang='ts'>
import {
    Sidebar,
    SidebarContent,
    SidebarGroup,
    SidebarGroupLabel,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
    SidebarFooter,
    SidebarHeader
} from '@/components/ui/sidebar';

const menuItems = [
    { title: 'ホーム', url: '/home' },
    { title: '入力', url: '/input' },
    { title: '履歴', url: '/history' },
    { title: 'グラフ', url: '/graph' }
]

</script>
<template>
    <Sidebar>
        <SidebarHeader>
            <div class="flex items-center gap-2 font-bold text-tl text-primary">
                <span>家計簿</span>
            </div>
        </SidebarHeader>
        <SidebarContent>
            <SidebarGroup>
                <SidebarGroupLabel>メニュー</SidebarGroupLabel>
                <SidebarMenu>
                    <SidebarMenuItem v-for="item in menuItems" :key="item.title">
                        <SidebarMenuButton as-child>
                            <a :href="item.url" class="flex items-center gap-3 w-full">
                                <span>{{ item.title }}</span>
                            </a>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                </SidebarMenu>
            </SidebarGroup>
        </SidebarContent>

        <SidebarFooter class="p-4 border-t gap-2">
            <span>2026-07</span>
        </SidebarFooter>
    </Sidebar>
</template>