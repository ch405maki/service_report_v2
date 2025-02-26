<template>
  <Head title="Reports" />

  <AuthenticatedLayout>
    <template #header>
      <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Machine Code: <span class="underline">{{ machine_code || 'No Machine Assigned' }}</span>
        </h2>
        <!-- Export to PDF Button -->
        <div class="relative">
          <button @click="generatePDF" class="bg-gray-800 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center gap-2">
            <i class="fa-solid fa-file-pdf"></i> Export
          </button>
        </div>
      </div>
    </template>
    
    <div class="py-5">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white">
          <div class="max-w-7xl mx-auto p-8">
              <div class="flow-root">
                <ul class="mb-8">
                  <li v-for="report in filteredReports" :key="report.id">
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
                              <a :href="route('service-reports.show', report.id)" class="font-medium text-gray-900 mr-2 hover:text-blue-800 hover:underline">
                                {{ formatDate(report.date) }}
                              </a>
                              <a href="#" class="my-0.5 relative inline-flex items-center bg-white rounded-full border border-gray-300 px-3 py-0.5 text-sm">
                                <div class="absolute flex-shrink-0 flex items-center justify-center">
                                  <span class="h-1.5 w-1.5 rounded-full bg-green-500" aria-hidden="true"></span>
                                </div>
                                <div class="ml-3.5 font-medium text-gray-900">{{ report.type }}</div>
                              </a>
                            </div>
                            <span class="whitespace-nowrap text-sm">Reported By: <span class="uppercase text-gray-800">{{ report.reported_by }}</span></span>
                            <br>
                            <span class="whitespace-nowrap text-sm">Serviced By: <span class="uppercase text-gray-800">{{ report.serviced_by }}</span></span>
                          </div>
                          <div class="mt-2 text-gray-700 text-xs">
                            <h1 class="border-b font-bold text-gray-800 mb-2">Problem/Concern</h1>
                            <p v-html="report.problem_concern"></p>
                            <h1 class="border-b font-bold text-gray-800 mt-2 mb-2">Cause/s</h1>
                            <p v-html="report.causes"></p>
                            <h1 class="border-b font-bold text-gray-800 mt-2 mb-2">Action Taken</h1>
                            <p v-html="report.action_taken"></p>
                            <h1 class="border-b font-bold text-gray-800 mt-2 mb-2">Remarks & Recommendation</h1>
                            <p v-html="report.remark_recommendation"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>

            <!-- PDF Content -->
            <div class="hidden">
            <div ref="pdfContent">
              <div class="flow-root">
                <div class="grid grid-cols-12 pb-[8px] px-[4px]">
                  <div class="col-span-2 items-center flex justify-center mb-2">
                    <img src="/images/alf.png" class="w-[60px] h-[60px]" alt="alf logo">
                  </div>
                  <div class="col-span-8 text-center">
                    <h1 class="text-sm font-bold">ARELLANO LAW FOUNDATION</h1>
                    <h1 class="text-sm font-bold">INFORMATION TECHNOLOGY CENTER</h1>
                    <h1 class="text-sm font-normal">TECHNICAL SUPPORT TEAM</h1>
                  </div>
                  <div class="col-span-2">
                    <img src="/images/itc.png" class="w-[60px] h-[60px]" alt="itc logo">
                  </div>
                </div>
                <div class="grid grid-cols-1">
                  <div class="bg-gray-700 text-center text-sm text-white pb-[10px] px-[4px]">
                    Machine Code: <span class="font-bold">{{ machine_code || 'No Machine Assigned' }}</span>
                  </div>
                </div>
                <ul class="mb-8">
                  <li v-for="report in filteredReports" :key="report.id">
                    <div class="relative pb-8">
                      <div class="relative flex items-start space-x-3">
                        <div class="min-w-0 flex-1 py-0">
                          <div class="text-md text-gray-500">
                            <div>
                              <a :href="route('service-reports.show', report.id)" class="font-medium text-gray-900 mr-2 hover:text-blue-800 hover:underline">
                                {{ formatDate(report.date) }} | {{ report.type }}
                              </a>
                            </div>
                            <span class="whitespace-nowrap text-xs">Reported By: <span class="uppercase text-gray-800">{{ report.reported_by }}</span></span>
                            <br>
                            <span class="whitespace-nowrap text-xs">Serviced By: <span class="uppercase text-gray-800">{{ report.serviced_by }}</span></span>
                          </div>
                          <div class="mt-2 text-gray-700 text-xs">
                            <h1 class="font-bold text-gray-800 mb-2">Problem/Concern</h1>
                            <p v-html="report.problem_concern"></p>
                            <h1 class="font-bold text-gray-800 mt-2 mb-2">Cause/s</h1>
                            <p v-html="report.causes"></p>
                            <h1 class="font-bold text-gray-800 mt-2 mb-2">Action Taken</h1>
                            <p v-html="report.action_taken"></p>
                            <h1 class="font-bold text-gray-800 mt-2 mb-2">Remarks & Recommendation</h1>
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
            <!-- End of PDF Content -->
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
import html2pdf from 'html2pdf.js';
import { onMounted } from 'vue';

// Props
const props = defineProps({
  reports: { type: Array, required: true },
  machine_code: { type: String, required: true },
});

// Format Date Function
const formatDate = (dateString) => {
  if (!dateString) return 'Invalid Date';
  const date = new Date(dateString);
  return new Intl.DateTimeFormat('en-US', {
    month: 'long',
    day: 'numeric',
    year: 'numeric'
  }).format(date);
};

// Search Functionality
const searchQuery = ref('');
const filteredReports = computed(() => {
  if (!searchQuery.value.trim()) {
    return props.reports;
  }
  const query = searchQuery.value.toLowerCase();
  return props.reports.filter(report =>
    report.job_order_no?.toLowerCase().includes(query) ||
    report.type?.toLowerCase().includes(query) ||
    report.department?.toLowerCase().includes(query) ||
    report.reported_by?.toLowerCase().includes(query) ||
    report.serviced_by?.toLowerCase().includes(query)
  );
});

// PDF Export Function
const pdfContent = ref(null);
const generatePDF = () => {
  html2pdf(pdfContent.value, {
    margin: 10,
    filename: `Machine_History_${props.machine_code}.pdf`,
    image: { type: 'jpeg', quality: 0.98 },
    html2canvas: { scale: 2 },
    jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
  });
};
</script>
