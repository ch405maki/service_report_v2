<template>
    <Head title="Staff Management" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Inventory PC Report
                </h2>
                <!-- Export to PDF Button -->
                <div class="relative">
                    <button @click="exportToPDF" class="bg-gray-800 hover:bg-gray-700 text-white px-4 py-[5px] rounded-lg flex items-center gap-2">
                        <i class="fa-solid fa-file-pdf"></i> Export PDF
                    </button>
                </div>
            </div>
        </template>

        <div class="flex flex-col bg-gray-100">
            <main class="flex-grow">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="flex flex-col md:flex-row w-full justify-center">
                        <!-- Content section -->
                        <div class="w-full py-4">
                            <div class="flex flex-col">
                                <div class="overflow-x-auto">
                                    <div class="min-w-full inline-block align-middle">
                                        <div class="overflow-hidden">
                                                <table class="min-w-full border">
                                                    <thead>
                                                        <tr class="bg-gray-200">
                                                            <th class="p-2 text-left text-xs leading-6 font-semibold text-gray-900 capitalize border"> Machine Code </th>
                                                            <th class="p-2 text-left text-xs leading-6 font-semibold text-gray-900 capitalize border"> Department | User</th>
                                                            <th class="p-2 text-left text-xs leading-6 font-semibold text-gray-900 capitalize border"> IP | MAC Address</th>
                                                            <th class="p-2 text-left text-xs leading-6 font-semibold text-gray-900 capitalize border"> Processor | Motherboard | Memory | Drive | GPU</th>
                                                            <th class="p-2 text-left text-xs leading-6 font-semibold text-gray-900 capitalize border"> Monitor | UPS</th>
                                                            <th class="p-2 text-left text-xs leading-6 font-semibold text-gray-900 capitalize border"> MS Office | Operating System</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="divide-y divide-gray-300">
                                                        <tr v-for="(machine, index) in machines" :key="machine.id" class="bg-white transition-all duration-500 hover:bg-gray-50">
                                                            <td class="p-2 whitespace-nowrap text-xs leading-6 font-medium text-gray-900 border">{{ machine.machine_code }}</td>
                                                            <td class="p-2 whitespace-nowrap text-xs leading-6 font-medium border">
                                                                {{ machine.staff?.department || 'Not Assigned' }} <br>
                                                                <span>{{ machine.staff?.name || 'N/A' }}</span>
                                                            </td>
                                                            <td class="p-2 whitespace-nowrap text-xs leading-6 font-medium text-gray-900 border">{{ machine.ip }} <br> {{ machine.mac_address || 'N/A' }}</td>
                                                            <td class="p-2 whitespace-nowrap text-xs leading-6 font-medium text-gray-900 border">
                                                                {{ machine.processor || 'N/A' }} <br>
                                                                {{ machine.motherboard || 'N/A' }} <br>
                                                                {{ machine.memory || 'N/A' }} <br>
                                                                {{ machine.drive || 'N/A' }} <br>
                                                                {{ machine.video_card || 'N/A' }} - GPU <br>
                                                            </td>
                                                            <td class="p-2 whitespace-nowrap text-xs leading-6 font-medium text-gray-900 border">
                                                                {{ machine.monitor || 'N/A' }} <br>
                                                                {{ machine.ups || 'N/A' }}
                                                            </td>
                                                            <td class="p-2 whitespace-nowrap text-xs leading-6 font-medium text-gray-900 border">
                                                                {{ machine.ms_office || 'N/A' }} <br>
                                                                {{ machine.operating_system || 'N/A' }}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                            <!-- PDF Export Content -->
                                            <div class="hidden">
                                            <div ref="exportContent">
                                                <table class="min-w-full border">
                                                    <thead>
                                                        <tr class="bg-gray-50">
                                                            <th class="p-2 text-left text-xs leading-6 font-semibold text-gray-900 capitalize border"> Machine Code </th>
                                                            <th class="p-2 text-left text-xs leading-6 font-semibold text-gray-900 capitalize border"> Department | User</th>
                                                            <th class="p-2 text-left text-xs leading-6 font-semibold text-gray-900 capitalize border"> IP | MAC Address</th>
                                                            <th class="p-2 text-left text-xs leading-6 font-semibold text-gray-900 capitalize border"> Processor | Motherboard | Memory | Drive | GPU</th>
                                                            <th class="p-2 text-left text-xs leading-6 font-semibold text-gray-900 capitalize border"> Monitor | UPS</th>
                                                            <th class="p-2 text-left text-xs leading-6 font-semibold text-gray-900 capitalize border"> MS Office | Operating System</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="divide-y divide-gray-300">
                                                        <tr v-for="(machine, index) in machines" :key="machine.id" class="bg-white transition-all duration-500 hover:bg-gray-50">
                                                            <td class="p-2 whitespace-nowrap text-xs leading-6 font-medium text-gray-900 border">{{ machine.machine_code }}</td>
                                                            <td class="p-2 whitespace-nowrap text-xs leading-6 font-medium border">
                                                                {{ machine.staff?.department || 'Not Assigned' }} <br>
                                                                <span>{{ machine.staff?.name || 'N/A' }}</span>
                                                            </td>
                                                            <td class="p-2 whitespace-nowrap text-xs leading-6 font-medium text-gray-900 border">{{ machine.ip }} <br> {{ machine.mac_address || 'N/A' }}</td>
                                                            <td class="p-2 whitespace-nowrap text-xs leading-6 font-medium text-gray-900 border">
                                                                {{ machine.processor || 'N/A' }} <br>
                                                                {{ machine.motherboard || 'N/A' }} <br>
                                                                {{ machine.memory || 'N/A' }} <br>
                                                                {{ machine.drive || 'N/A' }} <br>
                                                                {{ machine.video_card || 'N/A' }} - GPU <br>
                                                            </td>
                                                            <td class="p-2 whitespace-nowrap text-xs leading-6 font-medium text-gray-900 border">
                                                                {{ machine.monitor || 'N/A' }} <br>
                                                                {{ machine.ups || 'N/A' }}
                                                            </td>
                                                            <td class="p-2 whitespace-nowrap text-xs leading-6 font-medium text-gray-900 border">
                                                                {{ machine.ms_office || 'N/A' }} <br>
                                                                {{ machine.operating_system || 'N/A' }}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            </div>
                                            <!-- End of PDF Export Content -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End main content section -->
                    </div>
                </div>
            </main>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref, defineProps } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import html2pdf from 'html2pdf.js';

const props = defineProps({
    staffList: {
        type: Object,
        required: true,
    },
    machines: {
        type: Object,
        required: true,
    }
});

// Reference for PDF export
const exportContent = ref(null);

const exportToPDF = () => {
    if (!exportContent.value) return;

    html2pdf()
        .from(exportContent.value)
        .set({
            margin: 10,
            filename: 'PC_Inventory.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'mm', format: 'legal', orientation: 'landscape' }
        })
        .save();
};
</script>

<style scoped>
/* Add some styles if needed */
</style>
