<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, router } from '@inertiajs/vue3';
import { ref, reactive, onMounted, defineProps } from 'vue';
import axios from 'axios';

const props = defineProps<{
    appSettings: Record<string, any>;
    mode?: string;
    person?: Record<string, any>;
    userType: string;
}>();
const CertRequest = reactive({
    id: null,
    first_name: '',
    middle_name: '',
    last_name: '',
    suffix: '',
    email: '',
    contact_number: '',
    request_type: '',
    request_purpose: '',
    request_date: '',
    isValidateInformation: false,
    success: false,
});
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'My Requests',
        href: '/CertRequest',
    },
    {
        title: 'Request Certificate',
        href: '/CertRequest/create',
    },
];
const isValidateInformation = ref(false);
const success = ref(false);

const createCertRequest = () => {

    if (props.mode === 'edit') {
        CertRequest.id = props.person.id;
    }

    axios.post('/CertRequest/store', CertRequest)
        .then(response => {

            alert(response.data.message);
            CertRequest.first_name = '';
            CertRequest.middle_name = '';
            CertRequest.last_name = '';
            CertRequest.suffix = '';
            CertRequest.email = '';
            CertRequest.contact_number = '';
            CertRequest.request_type = '';
            CertRequest.request_purpose = '';

            router.visit('/CertRequest'); // Redirect to the index page after creation
            // Optionally, redirect or show a success message
        })
        .catch(error => {
            console.error('Error creating CertRequest:', error);
            alert('An error occurred while creating CertRequest.');
        });
};

onMounted(() => {
    if (props.mode === 'edit') {
        CertRequest.id = props.person.id;
        CertRequest.first_name = props.person.first_name || '';
        CertRequest.middle_name = props.person.middle_name || '';
        CertRequest.last_name = props.person.last_name || '';
        CertRequest.suffix = props.person.suffix || '';
        CertRequest.email = props.person.email || '';
        CertRequest.contact_number = props.person.contact_number || '';
        CertRequest.request_type = props.person.request_type || '';
        CertRequest.request_purpose = props.person.request_purpose || '';
        CertRequest.request_date = props.person.request_date ||'';
    }
});

const fileInput = ref(null);

const handleFileUpload = (event: Event) => {
    const target = event.target as HTMLInputElement;
    const file = target.files && target.files[0];
    if (file) {
        const formData = new FormData();
        formData.append('file', file);
        // You can now send this formData to your server
        console.log('File uploaded:', file);
    }
};


</script>

<template>

    <Head title="Register" />
    <AppLayout :breadcrumbs="breadcrumbs">

        <form @submit.prevent="createCertRequest" v-if="!CertRequest.success">
            <div class="min-h-screen bg-dark p-8">
                <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-8">
                    <h2 class="text-2xl font-semibold text-gray-800  b-2">Request Form</h2>
                    <p class="text-gray-500 mb-6">Enter your details below for your request certificate. </p>

                  
                        <div class="md:col-span-2 space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">First Name</label>
                                <input type="text" v-model="CertRequest.first_name"
                                    class="mt-1 block w-full border border-gray-300 rounded-md text-black shadow-sm px-3 py-2 focus:ring-blue-500 focus:border-blue-500" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Middle Name</label>
                                <input type="text" v-model="CertRequest.middle_name"
                                    class="mt-1 block w-full border border-gray-300 rounded-md text-black shadow-sm px-3 py-2 focus:ring-blue-500 focus:border-blue-500" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Last Name</label>
                                <input type="text" v-model="CertRequest.last_name"
                                    class="mt-1 block w-full border border-gray-300 rounded-md text-black shadow-sm px-3 py-2 focus:ring-blue-500 focus:border-blue-500" />

                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Suffix</label>
                                <input type="text" v-model="CertRequest.suffix"
                                    class="mt-1 block w-full text-black  border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:ring-blue-500 focus:border-blue-500" />

                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email Address</label>
                                <input type="email" v-model="CertRequest.email" placeholder="email@domain.com"
                                    class="mt-1 block w-full text-black  border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:ring-blue-500 focus:border-blue-500" />
                            </div>

                           
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Contact Number</label>
                                    <input type="text"
                                     v-model="CertRequest.contact_number"
                                     maxlength="11"
                                     minlength="11"
                                        class="mt-1 block w-full text-black  border border-gray-300 rounded-md shadow-sm px-3 py-2" />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Request Type</label>
                                    <select v-model="CertRequest.request_type"
                                        class="mt-1 block w-full text-black  border border-gray-300 rounded-md shadow-sm px-3 py-2">
                                        <option value="0">Certificate</option>
                                        <option value="1">Goodmoral</option>
                                        <option value="2">Clearance</option>
                                        <option value="3">Other</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Request purpose</label>
                                    <input type="text" v-model="CertRequest.request_purpose"
                                        class="mt-1 block w-full text-black  border border-gray-300 rounded-md shadow-sm px-3 py-2" />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Request Date</label>
                                    <input type="date" v-model="CertRequest.request_date"
                                        class="mt-1 text-black  block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2" />
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Attachment</label>
                                <input type="file" ref="fileInput" @change="handleFileUpload"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2" />
                            </div>

                            <div class="flex items-center space-x-2">
                                <input id="billing" v-model="isValidateInformation" type="checkbox"
                                    class="h-4 w-4 text-blue-600 border-gray-300 rounded" />
                                <label for="billing" class="text-sm text-gray-700">All the information that are provided
                                    are
                                    true.</label>
                            </div>
                            <div class="pt-4">
                                <button type="submit" :disabled="!isValidateInformation"
                                    :class="isValidateInformation ? 'bg-blue-600 text-white' : 'bg-gray-400 text-gray-200'"
                                    class="text-white px-6 py-2 rounded-md shadow-md transition">
                                    Submit
                                </button>
                            </div>
                        </div>
                </div>
            </div>
        </form>
    </AppLayout>
</template>
