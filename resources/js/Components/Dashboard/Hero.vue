<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

// Reactive filter variables
const keyword = ref('');
const location = ref('');

// Function to emit filters
const applyFilters = () => {
    router.get('/dashboard', { keyword: keyword.value, location: location.value }, { preserveState: true });
};
</script>

<template>
    <div class="bg-slate-100 relative">
        <div class="container py-32 text-center flex flex-col gap-8 relative">
            <div class="space-y-4">
                <h1 class="text-3xl lg:text-6xl font-bold">Find your dream job</h1>
                <p class="text-sm lg:text-base text-slate-600">
                    Looking for jobs? Browse our latest job openings to view & apply to the best jobs today!
                </p>
            </div>

            <!-- Search Filters -->
            <div class="flex items-center justify-center">
                <div class="w-full max-w-4xl">
                    <div class="bg-white w-full border rounded-full overflow-hidden border-gray-200 flex items-center justify-center shadow-sm hover:shadow-md transition-shadow duration-200">
                        <div class="flex-1 flex items-center border-r border-gray-200">
                            <span class="pl-5">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                </svg>
                            </span>
                            <input v-model="keyword" placeholder="Job title or keyword"
                                class="w-full py-4 px-4 shadow-none border-none focus:outline-none focus:ring-0 outline-none ring-0 text-gray-800 placeholder:text-gray-400"
                                type="text" />
                        </div>
                        <div class="flex-1 flex items-center">
                            <span class="pl-5">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                            </span>
                            <input v-model="location" placeholder="Location"
                                class="w-full py-4 px-4 shadow-none border-none focus:outline-none focus:ring-0 outline-none ring-0 text-gray-800 placeholder:text-gray-400"
                                type="text" />
                        </div>
                        <button @click="applyFilters"
                            class="bg-blue-600 hover:bg-blue-700 px-8 py-3 text-sm font-medium rounded-full text-white mr-3 transition-colors duration-200">
                            Find jobs
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
