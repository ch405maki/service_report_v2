<template>
    <Head title="Staff Management" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Manage PC Assignment
                </h2>
                <!-- Export to PDF Button -->
                <div class="relative">
                <a :href="route('machine.create')" class="bg-gray-800 hover:bg-gray-700 text-white px-4 py-[5px] rounded-lg flex items-center gap-2">
                    <i class="fa-solid fa-plus"></i> Add PC 
                </a>
                </div>
            </div>
        </template>
        <div class="flex flex-col bg-gray-100">
            <main class="flex-grow">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="flex flex-col md:flex-row w-full justify-center">
                        <!-- Content section -->
                        <div class="w-full py-2">
                            <div class="flex flex-col">
                                <div class=" overflow-x-auto">
                                    <div class="min-w-full inline-block align-middle">
                                        <div class="overflow-hidden">
                                            <table class="min-w-full">
                                                <thead>
                                                    <tr class="bg-gray-50">
                                                        <th scope="col" class="p-4 text-left text-sm leading-6 font-semibold text-gray-900 capitalize"> Machine Code </th>
                                                        <th scope="col" class="p-4 text-left text-sm leading-6 font-semibold text-gray-900 capitalize"> Department </th>
                                                        <th scope="col" class="p-4 text-left text-sm leading-6 font-semibold text-gray-900 capitalize"> User </th>
                                                        <th scope="col" class="p-4 text-left text-sm leading-6 font-semibold text-gray-900 capitalize"> IP </th>
                                                        <th scope="col" class="p-4 text-left text-sm leading-6 font-semibold text-gray-900 capitalize"> Actions </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="divide-y divide-gray-300 ">
                                                    <!-- Table -->
                                                    <tr  v-for="(machine, index) in machines" :key="machine.id" class="bg-white transition-all duration-500 hover:bg-gray-50">
                                                        <td class="p-4 whitespace-nowrap text-sm leading-6 font-medium text-gray-900 ">{{ machine.machine_code }}</td>
                                                        <td class="p-4 whitespace-nowrap text-sm leading-6 font-medium" :class="{ 'text-red-600': !machine.staff?.department }">{{ machine.staff?.department || 'Not Assigned' }}</td>
                                                        <td class="p-4 whitespace-nowrap text-sm leading-6 font-medium" :class="{ 'text-red-600': !machine.staff?.name }">{{ machine.staff?.name || 'Not Assigned' }}</td>
                                                        <td class="p-4 whitespace-nowrap text-sm leading-6 font-medium text-gray-900 ">{{ machine.ip }}</td>
                                                        <td class="p-4">
                                                        <select v-model="selectedStaff[machine.id]" class="border p-1 rounded">
                                                            <option value="">Select User</option>
                                                            <option v-for="staff in staffList" :key="staff.id" :value="staff.id">{{ staff.name }}</option>
                                                            <option value="null">Unassign</option> <!-- Option to remove user -->
                                                        </select>
                                                        <button @click="assignUser(machine.id)" class="ml-2 bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                                            Assign
                                                        </button>
                                                    </td>
                                                    </tr>
                                                </tbody>
                                            </table>
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
import { useForm } from '@inertiajs/vue3';
import axios from 'axios';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps ({
        staffList: {
            type: Object,
            required: true,
        },
        machines: {
            type: Object,
            required: true,
        }
    })

    // Initialize the form with default values using `staff` data
    const form = useForm({
        staff_id: '',
    });

    const selectedStaff = ref({});

    const assignUser = async (machineId) => {
        let staffId = selectedStaff.value[machineId];

        // Convert 'null' string to actual null value
        if (staffId === "null") {
            staffId = null;
        }

        try {
            const response = await axios.put(route('machines.assignUser', { id: machineId }), {
                staff_id: staffId, // Pass null if unassigning
            });

            alert(response.data.message);
            window.location.reload(); // Refresh the page to update UI
        } catch (error) {
            console.error(error);
            alert('Failed to update user assignment.');
        }
    };

</script>

<style scoped>

</style>
