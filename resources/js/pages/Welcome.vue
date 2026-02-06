<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';

const page = usePage();
</script>

<template>

    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <div> 
        <header class="bg-white w-full ">
            <nav class="flex items-center justify-end gap-4 p-2">
                <Link v-if="page.props?.auth?.user" :href="route('dashboard')"
                    class="inline-block rounded-sm border border-transparent px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#19140035] dark:text-[#EDEDEC] dark:hover:border-[#3E3E3A]">
                </Link>
                <template v-else>
                    <Link :href="route('login')"
                    class=" bg-black text-white solid-block square-m border border-[#28140035] px-5 py-1.5 leading-normal text-black hover:border-[#1915014a] dark:border-[#3E3E3A] dark:hover:border-[#62605b]">
                  Login</Link>
                </template>
                <Link :href="route('register')"
                    class=" bg-black text-white solid-block square-m border border-[#28140035] px-5 py-1.5 leading-normal text-black hover:border-[#1915014a] dark:border-[#3E3E3A] dark:hover:border-[#62605b]">
                Register</Link>
            </nav>
            </header>
               
 
        <!-- Hero Section -->
        <section class="bg-gradient-to-t from-blue-500 via-red-400 to-orange-400 text-white">
            <div class="container mx-auto py-20 flex flex-col-reverse md:flex-row items-center justify-between">
                <div class="flex items-center justify-between mt-4">
                <div class="flex items-center">
                    <!-- <img src="/images/DL.jpeg" alt="logo" class=" h-25 mr-7 rounded-full"/> -->
                </div>
            </div>
                <!-- Left Content -->
                <div class="w-full md:w-1/2 text-center md:text-left">
                    <h4 class="uppercase text-sm tracking-widest mb-2">Request Certification Form</h4>
                    <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-4">Student Certificate Online Request
                        System</h1>
                </div>
                <!-- Right Image -->
                <div class="w-full md:w-1/2 mb-20 md:mb-60">
                    <img src="/images/uni.png" alt="Illustration" class="w-full max-w-md mx-auto rounded-full" />
                </div>
            </div>

        <!-- Info Section -->
        <section class="py-13 px-6 text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Certificate Online-Request System</h2>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Request your certificate online</h3>
            <p class="text-xl font-semibold text-gray-800 mb-2">For future development and enhancing the student's need.</p>
            <p>All rights reserved S.Y 2026-2027</p>
        </section>
     </section>
    </div>
</template>