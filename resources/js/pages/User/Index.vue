<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, router } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
    {
        title: 'Users',
        href: '/users',
    },
];

defineProps({ users: Array });

const onEdit = (id) => {
    // Redirect to the edit page for the selected person
    //inertia visit(`/sample-crud/${id}/edit`);
    // or use window.location.href  
    router.visit(`/users/edit/${id}`);
};

</script>

<template>

    <Head title="Users" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold">User's</h1>
         <Link href="/users/create" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            Create
            </Link>
        </div> 
        
            <hr class="my-4" />
            <!-- create a table list of user make it compact -->
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="overflow-hidden rounded-lg border bg-card shadow-md dark:border-slate-700 dark:bg-slate-800">
                <table class="w-full table-auto text-left text-sm text-gray-500 dark:text-gray-400">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Name</th>
                            <th scope="col" class="px-6 py-3">Email</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">Role</th>
                            <th scope="col" class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Add user rows here -->
                        <tr v-for="user in users" :key="users.id"
                            class="border-b bg-white dark:border-gray-700 dark:bg-gray-800">
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ user.name }}</td>
                            <td class="px-6 py-4">{{ user.email }}</td>
                            <td class="px-6 py-4">
                                <span v-if="user.status === 1" class="text-green-600">Active</span>
                                <span v-else class="text-red-600">Inactive</span>
                            </td>
                            <td class="px-6 py-4">
                                <span v-if="user.role === 2" class="text-blue-600">Admin-user</span>
                                <span v-else-if="user.role === 1" class="text-yellow-600">User</span>
                                <span v-else class="text-gray-600">Guest</span>
                            </td>
                            <td class="px-6 py-4">
                                <button
                                    class="text-blue-600 hover:text-blue-900 dark:text-blue-500 dark:hover:text-blue-400" @click="onEdit(user.id)">Edit</button>
                                &nbsp;|&nbsp;
                                <button
                                    class="text-red-600 hover:text-red-900 dark:text-red-500 dark:hover:text-red-400">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </AppLayout>
</template>
