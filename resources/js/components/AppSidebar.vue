<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link,usePage } from '@inertiajs/vue3';
import { BookOpen, Folder, LayoutGrid } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';
import { onMounted } from 'vue';


const page = usePage();
const rootProps = page.props;

const role = rootProps.auth.user?.role;
const mainNavItems: NavItem[] = [];
if (role === 'admin' || role === 2) {
        mainNavItems.push(
            {
                title: 'Dashboard',
                href: '/dashboard',
                icon: LayoutGrid,
            } as NavItem,
            {
                title: 'User',
                href: '/users',
                icon: LayoutGrid,
            } as NavItem,
            {
                title: 'All Requests',
                href: '/CertRequest',
                icon: LayoutGrid,
            } as NavItem,
            {
                title: 'App Settings',
                href: '/app-settings',
                icon: LayoutGrid,
            } as NavItem,
        );
    } else {
        mainNavItems.push(
            {
                title: 'My Requests',
                href: '/CertRequest',
                icon: LayoutGrid,
            } as NavItem,
        );
    }
onMounted(() => {
    
});



const footerNavItems: NavItem[] = [
    {
        title: 'Help',
        href: 'https://laravel.com/docs/starter-kits',
        icon: BookOpen,
    },
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="route('dashboard')">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
