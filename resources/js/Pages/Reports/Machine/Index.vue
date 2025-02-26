<template>
  <Head title="Reports" />

  <AuthenticatedLayout>
    <template #header>
      <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Machine History</h2>
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
        <!-- Table -->
        <div class="relative overflow-x-auto shadow-md">
          <table class="w-full text-sm text-left rtl:text-right text-gray-500">
          <thead class="text-xs text-gray-700 uppercase bg-gray-200">
            <tr>
              <th scope="col" class="px-6 py-3 w-40">Machine Code</th>
              <th scope="col" class="px-6 py-3 w-40">Staff</th>
              <th scope="col" class="px-6 py-3 w-40">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="report in reports" :key="report.id" class="bg-white border-b border-gray-200">
              <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap w-40">
                  {{ report.machine.machine_code || 'No Machine Assigned' }}
              </th>
              <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap w-40">
                  {{ report.staff?.name || 'No Staff' }}
              </th>
              <td class="px-6 py-4 w-28">
                <a :href="route('machine.show', report.machine?.id)" class="font-medium text-blue-600 hover:underline">
                  <i class="fa-solid fa-clock-rotate-left"></i> History
                </a>
              </td>
            </tr>
          </tbody>
        </table>
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
    reports: { type: Array, required: true }, // Fix: Using 'machines' instead of 'reports'
  });

  const searchQuery = ref(''); // Reactive variable for search input

  // Computed property for filtering machines
  const filteredMachines = computed(() => {
  if (!searchQuery.value.trim()) {
    return props.machines; // Return all machines if search is empty
  }

  const query = searchQuery.value.toLowerCase();

  return props.machines.filter(machine => {
    return machine.machine_code?.toLowerCase().includes(query);
  });
  });
</script>
