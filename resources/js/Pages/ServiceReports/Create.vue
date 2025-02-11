<template>
    <Head title="User Management" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Service Report</h2>
        </template>
        <div class="flex flex-col min-h-screen bg-gray-100">
            <main class="flex-grow">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="flex flex-col md:flex-row w-full justify-center">
                        <!-- Preview content section -->
                        <div class="w-full md:w-1/2 p-2">
                            <div class="w-full bg-white p-2">
                                <div class="flex-grow border border-black">
                                    <div class="grid grid-cols-1">
                                        <div class="bg-gray-700 text-center text-sm text-white p-[4px]">SERVICE REPORT</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="bg-gray-200 p-[4px] border text-xs border-black">
                                            Job Order Number: {{ form.job_order_no }}
                                        </div>
                                        <div class="bg-gray-200 p-[4px] border text-xs border-black">
                                            Date: {{ form.date }}
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="bg-gray-200 p-[4px] border text-xs border-black">Department: {{ form.department }}</div>
                                        <div class="bg-gray-200 p-[4px] border text-xs border-black">Machine Code: {{ form.machine_code }}</div>
                                    </div>
                                    <!-- Type Checkboxes -->
                                    <div class="grid grid-cols-12">
                                        <div class="bg-gray-200 p-[4px] border text-xs border-black col-span-2">Type</div>
                                        <div class="bg-gray-200 p-[4px] border text-xs border-black col-span-10">
                                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 ">   
                                            <label class="flex items-center space-x-2">
                                            <input 
                                                type="checkbox" 
                                                disabled
                                                value="Under Warranty" 
                                                v-model="form.types" 
                                                class="border border-gray-300 rounded-lg"
                                            />
                                            <span>Under Warranty</span>
                                            </label>
                                            <label class="flex items-center space-x-2">
                                            <input 
                                                type="checkbox" 
                                                disabled
                                                value="Out Of Warranty" 
                                                v-model="form.types" 
                                                class="border border-gray-300 rounded-lg"
                                            />
                                            <span>Out Of Warranty</span>
                                            </label>
                                            <label class="flex items-center space-x-2">
                                            <input 
                                                type="checkbox" 
                                                disabled
                                                value="Not Our Unit" 
                                                v-model="form.types" 
                                                class="border border-gray-300 rounded-lg"
                                            />
                                            <span>Not Our Unit</span>
                                            </label>
                                            <label class="flex items-center space-x-2">
                                            <input 
                                                type="checkbox" 
                                                disabled
                                                value="Back Job" 
                                                v-model="form.types" 
                                                class="border border-gray-300 rounded-lg"
                                            />
                                            <span>Back Job</span>
                                            </label>
                                            <label class="flex items-center space-x-2">
                                            <input 
                                                type="checkbox" 
                                                disabled
                                                value="Check Up" 
                                                v-model="form.types" 
                                                class="border border-gray-300 rounded-lg"
                                            />
                                            <span>Check Up</span>
                                            </label>
                                            <label class="flex items-center space-x-2">
                                            <input 
                                                type="checkbox" 
                                                disabled
                                                value="For Pull Out" 
                                                v-model="form.types" 
                                                class="border border-gray-300 rounded-lg"
                                            />
                                            <span>For Pull Out</span>
                                            </label>
                                            <label class="flex items-center space-x-2">
                                            <input 
                                                type="checkbox" 
                                                disabled
                                                value="Change Part" 
                                                v-model="form.types" 
                                                class="border border-gray-300 rounded-lg"
                                            />
                                            <span>Change Part</span>
                                            </label>
                                        </div>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1">
                                        <div class="bg-gray-200 p-[4px] border text-xs border-black">Problem/Concern: <br>
                                            <div v-html="form.problem_concern"></div>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-1">
                                        <div class="bg-gray-200 p-[4px] border text-xs border-black">Cause/s:</div> <br>
                                        <div v-html="form.causes"></div>
                                    </div>
                                    <div class="grid grid-cols-1">
                                        <div class="bg-gray-200 p-[4px] border text-xs border-black">Action Taken:</div><br>
                                        <div v-html="form.action_taken"></div>
                                    </div>
                                    <div class="grid grid-cols-1">
                                        <div class="bg-gray-200 p-[4px] border text-xs border-black">Remarks & Recommendation:</div><br>
                                        <div v-html="form.remark_recommendation"></div>
                                    </div>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-2">
                                        <div class="bg-gray-200 p-[4px] border text-xs border-black">REPORTED BY: {{ form.reported_by }}</div>
                                        <div class="bg-gray-200 p-[4px] border text-xs border-black">DATE/TIME: {{ form.reported_date_time }}</div>
                                    </div>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-2">
                                        <div class="bg-gray-200 p-[4px] border text-xs border-black">SERVICED BY: {{ form.serviced_by }}</div>
                                        <div class="bg-gray-200 p-[4px] border text-xs border-black">DATE/TIME: {{ form.serviced_date_time }}</div>
                                    </div>
                                    <div class="grid grid-cols-1">
                                        <div class="bg-gray-200 p-[4px] border text-xs border-black">APPROVAL FOR REPLACEMENT/PURCHASE: <br>
                                        {{ form.approval }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End main content section -->

                        <!-- Report Creation Form -->
                        <div class="w-full md:w-1/2 p-2 flex justify-start">
                            <form @submit.prevent="submitForm" class="w-full bg-white p-5 max-h-[80vh] overflow-y-auto">
                                <!-- Title -->
                                <div class="text-left">
                                    <h2 class="text-xl font-bold">Service Report</h2>
                                </div>
                                <div class="grid grid-cols-12 gap-2">
                                    <!-- Job Order Number -->
                                    <div class="col-span-8">
                                        <InputLabel for="job_order_no" value="Job Order No" />
                                        <TextInput
                                        id="job_order_no"
                                        v-model="form.job_order_no"
                                        required
                                        type="text"
                                        class="mt-1 block w-full border border-gray-300 rounded-lg"
                                        placeholder="Enter Job Order Number"
                                        />
                                    </div>

                                    <!-- Date Input -->
                                    <div class="col-span-4">
                                        <InputLabel for="date" value="Date" />
                                        <TextInput
                                        id="date"
                                        v-model="form.date"
                                        required
                                        type="date"
                                        class="mt-1 block w-full border border-gray-300 rounded-lg"
                                        />
                                    </div>
                                </div>

                                <div class="grid grid-cols-12 gap-2 mt-2">
                                    <div class="col-span-8">
                                        <InputLabel for="department" value="Department" />
                                        <TextInput
                                            id="department"
                                            v-model="form.department"
                                            required
                                            type="text"
                                            class="mt-1 block w-full border border-gray-300 rounded-lg"
                                            placeholder="Enter Department"
                                        />
                                    </div>
                                    <div class="col-span-4">
                                        <InputLabel for="machine_code" value="Machine Code" />
                                        <TextInput
                                            id="machine_code"
                                            v-model="form.machine_code"
                                            required
                                            type="text"
                                            class="mt-1 block w-full border border-gray-300 rounded-lg"
                                            placeholder="Machine Code"
                                        />
                                    </div>
                                </div>

                                <div class="grid grid-cols-12 gap-2 mt-2">
                                    <div class="col-span-12">
                                        <div class="sm:col-span-12">
                                        <InputLabel for="type" value="Type" />
                                        <select
                                        id="type"
                                        v-model="form.type"
                                        required
                                        @change="updateCheckboxes"
                                        class="mt-1 block w-full border border-gray-300 rounded-lg focus:border-slate-500 focus:ring-slate-500"
                                        >
                                        <option value="" disabled selected>Select a Type</option>
                                        <option value="Under Warranty">Under Warranty</option>
                                        <option value="Out Of Warranty">Out Of Warranty</option>
                                        <option value="Not Our Unit">Not Our Unit</option>
                                        <option value="Back Job">Back Job</option>
                                        <option value="Check Up">Check Up</option>
                                        <option value="For Pull Out">For Pull Out</option>
                                        <option value="Change Part">Change Part</option>
                                        </select>
                                    </div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-12 gap-2 mt-2">
                                    <div class="col-span-12">
                                        <InputLabel for="problem_concern" value="Problem Concern" />
                                        <ckeditor :editor="editor" v-model="form.problem_concern" :config="editorConfig"></ckeditor>
                                    </div>
                                    <div class="col-span-12 mt-2">
                                        <InputLabel for="causes" value="Causes" />
                                        <ckeditor :editor="editor" v-model="form.causes" :config="editorConfig"></ckeditor>
                                    </div>

                                    <div class="col-span-12 mt-2">
                                        <InputLabel for="action_taken" value="Action Taken" />
                                        <ckeditor :editor="editor" v-model="form.action_taken" :config="editorConfig"></ckeditor>
                                    </div>

                                    <div class="col-span-12 mt-2">
                                        <InputLabel for="remark_recommendation" value="Remark/Recommendation" />
                                        <ckeditor :editor="editor" v-model="form.remark_recommendation" :config="editorConfig"></ckeditor>
                                    </div>
                                </div>

                                <div class="grid grid-cols-12 gap-2 mt-2">
                                    <div class="col-span-8">
                                        <InputLabel for="reported_by" value="Reported By" />
                                        <TextInput
                                            id="reported_by"
                                            v-model="form.reported_by"
                                            required
                                            type="text"
                                            class="mt-1 block w-full border border-gray-300 rounded-lg"
                                            placeholder="Enter Reporter Name"
                                        />
                                    </div>
                                    <div class="col-span-4">
                                        <InputLabel for="reported_date_time" value="Date and Time" />
                                        <TextInput
                                            id="reported_date_time"
                                            v-model="form.reported_date_time"
                                            required
                                            type="datetime-local"
                                            class="mt-1 block w-full border border-gray-300 rounded-lg"
                                        />
                                    </div>
                                </div>

                                <div class="grid grid-cols-12 gap-2 mt-2">
                                    <div class="col-span-8">
                                        <InputLabel for="serviced_by" value="Serviced By" />
                                        <TextInput
                                            id="serviced_by"
                                            v-model="form.serviced_by"
                                            type="text"
                                            class="mt-1 block w-full border border-gray-300 rounded-lg"
                                            placeholder="Serviced By (Optional)"
                                        />
                                    </div>
                                    <div class="col-span-4">
                                        <InputLabel for="serviced_date_time" value="Date and Time" />
                                        <TextInput
                                            id="serviced_date_time"
                                            v-model="form.serviced_date_time"
                                            type="datetime-local"
                                            class="mt-1 block w-full border border-gray-300 rounded-lg"
                                        />
                                    </div>
                                </div>
                                <div class="grid grid-cols-12 gap-2 mt-2">
                                    <div class="col-span-12">
                                        <InputLabel for="approval" value="Approval" />
                                        <TextInput
                                            id="approval"
                                            v-model="form.approval"
                                            type="text"
                                            class="mt-1 block w-full border border-gray-300 rounded-lg"
                                            placeholder="Approval (Optional)"
                                        />
                                    </div>
                                </div>
                                
                                <!-- Submit Button -->
                                <div class="sm:col-span-12 flex justify-center mt-4">
                                    <PrimaryButton :disabled="form.processing">
                                        <i class="fa-solid fa-save"></i> Save
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
import { ref,  watch } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import axios from 'axios';

const form = useForm({
    job_order_no: '',
    date: '',
    type: '',
    types: [],
    department: '',
    machine_code: '',
    problem_concern: '',
    causes: '',
    action_taken: '',
    remark_recommendation: '',
    reported_by: '',
    reported_date_time: '',
    serviced_by: '',
    serviced_date_time: '',
    approval: ''
    });

    
    const submitForm = async () => {
        try {
            const response = await axios.post('/api/service-reports', form);
            alert('Service report created successfully!');
            form.reset();
        } catch (error) {
            if (error.response?.data?.errors) {
                for (const [field, messages] of Object.entries(error.response.data.errors)) {
                    alert(`Error in ${field}: ${messages.join(', ')}`);
                }
            } else {
                console.error('Error creating service report:', error);
            }
        }
    };


    const updateCheckboxes = () => {
        // Clear the checkboxes array and add the selected type to it
        if (form.type) {
            form.types = [form.type]; // Populate checkboxes with the selected type
        } else {
            form.types = []; // If no type selected, clear checkboxes
        }
    };

    // Watcher to detect changes in the dropdown and update checkboxes
    watch(() => form.type, updateCheckboxes);
        const editor = ClassicEditor;
        const editorConfig = {
            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote','insertTable', 'mediaEmbed', ],
    };
</script>

<style scoped>

</style>