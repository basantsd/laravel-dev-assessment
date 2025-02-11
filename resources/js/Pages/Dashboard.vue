<script setup lang="ts">
import Hero from '@/Components/Dashboard/Hero.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { defineProps } from 'vue';

// Define a TypeScript interface for job objects
interface Job {
    id: number;
    title: string;
    company_name: string;
    location: string;
    experience?: string;
    salary?: string;
    description: string;
    logo_url?: string;
    time_ago?: string;
    skills?: { id: number; name: string }[];  // Assuming skills is an array of objects
    extra_info?: string;
}

// Define props with explicit types
const props = defineProps<{ jobs: Job[] }>();

// Function to shorten the job description
const shortDescription = (desc: string) => {
    return desc.length > 100 ? desc.substring(0, 100) + "..." : desc;
};
</script>


<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <!-- Hero -->
        <Hero />

        <!-- Job List -->
        <div class="bg-white">
            <div class="container py-5">
                <div v-if="jobs.length" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2">
                    <div v-for="job in jobs" :key="job.id" class="bg-white p-5 rounded">

                        <div class="bg-white rounded-lg shadow-md p-6 mb-4 hover:shadow-lg transition-shadow">
                            <div class="flex justify-between items-start">

                                <div class="flex justify-center items-center">
                                    <img :src="job.logo_url" alt="" />
                                    <div class="ml-2">
                                        <h3 class="text-xl font-semibold text-gray-800">{{ job.title }}</h3>
                                        <p class="text-gray-600 mt-1">{{ job.company_name }}</p>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <span v-for="(extra_info, index) in (job.extra_info || '').split(',')" :key="index" class="px-3 py-1 text-sm rounded-full bg-gray-200 text-black">
                                        {{ extra_info }}
                                    </span>
                                </div>
                            </div>

                            <div class="mt-4 flex items-center gap-6 text-gray-600">
                                <div class="flex items-center gap-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span>{{ job.location }}</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>{{ job.experience }}</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>{{ job.salary }}</span>
                                </div>
                            </div>

                            <p class="mt-4 text-gray-600">{{ shortDescription(job.description) }}</p>

                            <div class="mt-4 flex flex-wrap gap-3">
                                <span v-for="skill in job.skills || []" :key="skill.id"
                                    class="px-2  text-sm rounded-full bg-blue-100 text-blue-700">
                                    {{ skill.name }}
                                </span>
                            </div>

                            <div class="mt-2 flex justify-end items-center">
                                <span class="text-sm text-gray-500">{{ job.time_ago }}</span>
                                <!-- <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                    Apply Now
                                </button> -->
                            </div>
                        </div>
                    </div>
                </div>
                <p v-else class="text-center text-gray-500">No jobs found.</p>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
