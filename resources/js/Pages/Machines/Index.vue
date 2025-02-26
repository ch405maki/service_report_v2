<template>
    <Head title="Staff Management" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Machine Record</h2>
        </template>
        <div class="flex flex-col bg-gray-100">
            <main class="flex-grow">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="flex flex-col md:flex-row w-full justify-center">
                        <!-- Content section -->
                        <div class="w-full md:w-2/3 p-2">
                            <div class="flex flex-col">
                                <div class=" overflow-x-auto">
                                    <div class="min-w-full inline-block align-middle">
                                        <div class="overflow-hidden ">
                                            <table class=" min-w-full">
                                                <thead>
                                                    <tr class="bg-gray-50">
                                                        <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize"> #</th>
                                                        <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize"> Machine Code </th>
                                                        <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize"> User </th>
                                                        <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize"> Department </th>
                                                        <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize"> Actions </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="divide-y divide-gray-300 ">
                                                    <!-- Table -->
                                                    <tr  v-for="(machine, index) in machines" :key="machine.id" class="bg-white transition-all duration-500 hover:bg-gray-50">
                                                        <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900 ">{{index}}</td>
                                                        <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900 ">{{ machine.machine_code }}</td>
                                                        <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">{{ machine.staff.department }}</td>
                                                        <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">{{ machine.staff.name }}</td>
                                                        <td class=" p-5 ">
                                                            Action
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

                        <!-- Machine Creation Form -->
                        <div class="w-full md:w-1/3 p-2">
                            <form @submit.prevent="submitForm" class="w-full bg-white p-5 overflow-y-auto">
                                <!-- Title -->
                                <div class="text-left">
                                    <h2 class="text-xl font-bold mb-2">Create Machine</h2>
                                </div>
                                <div class="grid grid-cols-12 gap-2">
                                    <!-- staff_id -->
                                    <div class="col-span-12">
                                        <InputLabel for="staff_id" value="Select Staff" />
                                        <select
                                            id="staff_id"
                                            v-model="form.staff_id"
                                            required
                                            class="mt-1 block w-full border border-gray-300 rounded-lg p-2"
                                        >
                                            <option value="" disabled>Select Staff</option>
                                            <option v-for="staffMember in props.staff" :key="staffMember.id" :value="staffMember.id">
                                                {{ staffMember.name }} ({{ staffMember.department }})
                                            </option>
                                        </select>
                                    </div>
                                    <!-- Job Order Number -->
                                    <div class="col-span-12">
                                        <InputLabel for="machine_code" value="Machine Code" />
                                        <TextInput
                                        id="machine_code"
                                        v-model="form.machine_code"
                                        required
                                        type="text"
                                        class="mt-1 block w-full border border-gray-300 rounded-lg"
                                        placeholder="Enter Machine Code"
                                        />
                                    </div>
                                    <div class="col-span-12">
                                        <InputLabel for="ip" value="IP" />
                                        <TextInput
                                        id="ip"
                                        v-model="form.ip"
                                        required
                                        type="text"
                                        class="mt-1 block w-full border border-gray-300 rounded-lg"
                                        placeholder="Enter IP"
                                        />
                                    </div>
                                    <div class="col-span-12">
                                        <InputLabel for="status" value="Status" />
                                        <select
                                            id="status"
                                            v-model="form.status"
                                            required
                                            class="mt-1 block w-full border border-gray-300 rounded-lg p-2"
                                        >
                                            <option value="" disabled>Select Status</option>
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                            <option value="maintenance">Under Maintenance</option>
                                        </select>
                                    </div>

                                </div>
                                
                                <!-- Submit Button -->
                                <div class="sm:col-span-12 flex justify-center mt-4">
                                    <PrimaryButton :disabled="form.processing">
                                        <i class="fa-solid fa-save mr-[2px]"></i> Save
                                    </PrimaryButton>
                                </div>
                            </form>
                        </div>
                        <!-- End User Creation Form -->
                    </div>
                </div>
            </main>
        </div> 
    </AuthenticatedLayout>
</template>

<script setup>
import { ref, watch, defineProps, computed } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps ({
        staff: {
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
        machine_code: '',
        ip: '',
        status: '',
    });

    
    const submitForm = async () => {
        try {
            const response = await axios.post('/api/machines', form);
            alert('New Machine Created Successfully!');
            form.reset();
        } catch (error) {
            if (error.response?.data?.errors) {
                for (const [field, messages] of Object.entries(error.response.data.errors)) {
                    alert(`Error in ${field}: ${messages.join(', ')}`);
                }
            } else {
                console.error('Error creating New Staff:', error);
            }
        }
    };

</script>

<style scoped>

</style>
