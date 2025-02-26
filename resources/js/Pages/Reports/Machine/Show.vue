<template>
    <Head title="Reports" />
  
    <AuthenticatedLayout>
      <template #header>
        <div class="flex justify-between items-center">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Machine Code: <span class="underline">{{ machine_code || 'No Machine Assigned' }}</span>
          </h2>
          <!-- Search Bar -->
          <label for="table-search" class="sr-only">Search</label>
          <div class="relative">
              <div class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
              <svg class="w-5 h-5 text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
              </svg>
              </div>
              <input type="text" id="table-search" v-model="searchQuery" class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-gray-300 focus:border-gray-500" placeholder="Search for items">
          </div>
        </div>
      </template>
      
      <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <!-- component -->
          <div class="bg-white">
            <div class="max-w-7xl mx-auto p-8">
              <div class="flow-root">
                <ul class="mb-8">
                  <li  v-for="report in filteredReports" :key="report.id">
                    <div class="relative pb-8">
                      <span class="absolute top-5 left-5 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                      <div class="relative flex items-start space-x-3">
                        <div>
                          <div class="relative px-1">
                            <div class="h-8 w-8 bg-blue-500 rounded-full ring-8 ring-white flex items-center justify-center">
                              <i class="fa-solid fa-clock-rotate-left text-white"></i>
                            </div>
                          </div>
                        </div>
                        <div class="min-w-0 flex-1 py-0">
                          <div class="text-md text-gray-500">
                            <div>
                              <a :href="route('service-reports.show', report.id)" class="font-medium text-gray-900 mr-2 hover:text-blue-800 hover:underline">{{ formatDate(report.date) }}</a>
                              <a href="#"
                                class="my-0.5 relative inline-flex items-center bg-white rounded-full border border-gray-300 px-3 py-0.5 text-sm">
                                <div class="absolute flex-shrink-0 flex items-center justify-center">
                                  <span class="h-1.5 w-1.5 rounded-full bg-green-500" aria-hidden="true"></span>
                                </div>
                                <div class="ml-3.5 font-medium text-gray-900">{{report.type}}</div>
                              </a>
                            </div>
                            <span class="whitespace-nowrap text-sm">Serviced By: {{ report.serviced_by }}</span>
                          </div>
                          <div class="mt-2 text-gray-700 text-sm">
                            <h1 class="font-bold text-gray-500">Problem/Concern</h1>
                            <p v-html="report.problem_concern"></p>
                            <h1 class="font-bold text-gray-500 mt-2">Cause/s</h1>
                            <p v-html="report.causes"></p>
                            <h1 class="font-bold text-gray-500 mt-2">Action Taken</h1>
                            <p v-html="report.action_taken"></p>
                            <h1 class="font-bold text-gray-500 mt-2">Remarks & Recommendation</h1>
                            <p v-html="report.remark_recommendation"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  </template>
  
  <script setup>
  import { Head } from '@inertiajs/vue3';
  import { ref, computed } from 'vue';
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  
  const props = defineProps({
    reports: { type: Array, required: true },
    machine_code: { type: Array, required: true },
  });
  
  // Function to format date
  const formatDate = (dateString) => {
    if (!dateString) return 'Invalid Date';
  
    const date = new Date(dateString);
    
    return new Intl.DateTimeFormat('en-US', {
      month: 'long', 
      day: 'numeric', 
      year: 'numeric'
    }).format(date);
  };
  
  const searchQuery = ref(''); // Reactive variable for search input
  
  // Computed property for filtering reports
  const filteredReports = computed(() => {
  if (!searchQuery.value.trim()) {
    return props.reports; // If no search, return all reports
  }
  
  return props.reports.filter(report => {
    const query = searchQuery.value.toLowerCase();
    
    return (
      report.job_order_no?.toLowerCase().includes(query) ||
      report.type?.toLowerCase().includes(query) ||
      report.department?.toLowerCase().includes(query) ||
      report.reported_by?.toLowerCase().includes(query) ||
      report.serviced_by?.toLowerCase().includes(query)
    );
  });
  });
  </script>
  
  