<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { type BreadcrumbItem } from '@/types';
const breadcrumbs = [
     
    { title: 'All Request', 
    href: '/CertRequest'
    },   
];

// Define the type for a CertRequest item
interface CertRequestItem {
    id: number;
    first_name: string;
    middle_name: string;
    last_name: string;
    purok: string;
    barangay: string;
    city: string;
    province: string;
    contact_number: string;
    email: string;
    request_type: string;
    request_purpose: string;
    request_date: string;
    status: string;
}

defineProps<{ CertRequest: CertRequestItem[] }>();

const onEdit = (id) => {
    // Redirect to the edit page for the selected person
    //inertia visit(`/CertRequest/${id}/edit`);
    // or use window.location.href  
    router.visit(`/CertRequest/edit/${id}`);
};
</script> 

<template>

    <Head title="My Requests" />

   <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-2xl font-bold">Request</h1>
            <Link href="/CertRequest/create" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Create Request
            </Link>
        </div>
        <div class="overflow-hidden rounded-lg border bg-card shadow-md dark:border-slate-700 dark:bg-slate-800">
            <table class="w-full table-auto text-left text-sm text-gray-500 dark:text-gray-400">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="px-6 py-3">First Name</th>
                        <th class="px-6 py-3">Middle Name</th>
                        <th class="px-6 py-3">Last Name</th>
                        <th class="px-6 py-3">Purok</th>
                        <th class="px-6 py-3">Barangay</th>
                        <th class="px-6 py-3">City</th>
                        <th class="px-6 py-3">Province</th>
                        <th class="px-6 py-3">Contact Number</th>
                        <th class="px-6 py-3">Email</th>
                        <th class="px-6 py-3">Request Type</th>
                        <th class="px-6 py-3">Request Purpose</th>
                        <th class="px-6 py-3">Request Date</th>
                        <th class="px-6 py-3">Status</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="row in CertRequest" :key="row.id" class="border-b bg-white dark:border-gray-700 dark:bg-gray-800">
                        <td class="px-6 py-4">{{ row.first_name }}</td>
                        <td class="px-6 py-4">{{ row.middle_name }}</td>
                        <td class="px-6 py-4">{{ row.last_name }}</td>
                        <td class="px-6 py-4">{{ row.purok }}</td>
                         <td class="px-6 py-4">{{ row.barangay }}</td>
                          <td class="px-6 py-4">{{ row.city }}</td>
                          <td class="px-6 py-4">{{ row.province }}</td>
                          <td class="px-6 py-4">{{ row.contact_number }}</td>
                        <td class="px-6 py-4">{{ row.email }}</td>
                        <td class="px-6 py-4">{{ row.request_type }}</td>
                        <td class="px-6 py-4">{{ row.request_purpose }}</td>
                        <td class="px-6 py-4">{{ row.request_date }}</td>
                        
                        <td class="px-6 py-4">
                            <span v-if="row.status === 'approved'" class="text-green-600">Approved</span>
                            <span v-else-if="row.status === 'pending'" class="text-yellow-600">Pending</span>
                            <span v-else class="text-red-600">Rejected</span>
                        </td>
                         <td class="px-6 py-4">
                                <button class="text-blue-600 hover:text-blue-900 dark:text-blue-500 dark:hover:text-blue-400" @click="onEdit(row.id)">Edit</button>
                                &nbsp;|&nbsp;
                                <button class="text-red-600 hover:text-red-900 dark:text-red-500 dark:hover:text-red-400">Delete</button>
                            </td>

                    </tr>
                </tbody>
            </table>
        </div>
    </AppLayout>
</template>
