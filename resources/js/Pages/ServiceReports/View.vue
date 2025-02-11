<template>
  <Head title="View Service Report" />

  <AuthenticatedLayout>
      <template #header>
          <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">View Service Report</h2>
            <button @click="generatePDF" class="bg-gray-800 hover:bg-gray-700 text-white px-[8px] py-[5px] rounded-lg"><i class="fa-solid fa-file-pdf"></i> Download as PDF</button>
          </div>
      </template>
      <div class="flex flex-col min-h-screen bg-gray-100">
          <main class="flex-grow">
              <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row w-full justify-center">
                      <!-- Report Form -->
                      <div class="w-full md:w-1/2 p-2">
                        <div class="w-full bg-white p-2">
                          <div class="flex-grow border border-black">
                            <div class="grid grid-cols-12 p-[4px]">
                              <div class="col-span-2 items-center flex justify-center">
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
                              <div class="bg-gray-700 text-center text-sm text-white p-[4px]">
                                SERVICE REPORT
                              </div>
                            </div>
                            <div class="grid grid-cols-2">
                              <div class="  p-[4px] border text-xs border-black">
                                Job Order Number: {{ report.job_order_no }}
                              </div>
                              <div class="  p-[4px] border text-xs border-black">
                                Date: {{ report.date }}
                              </div>
                            </div>
                            <div class="grid grid-cols-2">
                              <div class="  p-[4px] border text-xs border-black">
                                Department: {{ report.department }}
                              </div>
                              <div class="  p-[4px] border text-xs border-black">
                                Machine Code: {{ report.machine_code }}
                              </div>
                            </div>

                            <!-- Type Checkboxes -->
                            <div class="grid grid-cols-12">
                              <div class="  p-[4px] border text-xs border-black col-span-2">
                                Type
                              </div>
                              <div class="  p-[4px] border text-xs border-black col-span-10">
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4">
                                  <label class="flex items-center space-x-2">
                                    <input 
                                      type="checkbox" 
                                      disabled
                                      value="Under Warranty" 
                                      :checked="report.type === 'Under Warranty'"
                                      class="border border-gray-300"
                                    />
                                    <span>Under Warranty</span>
                                  </label>

                                  <label class="flex items-center space-x-2">
                                    <input 
                                      type="checkbox" 
                                      disabled
                                      value="Out Of Warranty" 
                                      :checked="report.type === 'Out Of Warranty'"
                                      class="border border-gray-300"
                                    />
                                    <span>Out Of Warranty</span>
                                  </label>

                                  <label class="flex items-center space-x-2">
                                    <input 
                                      type="checkbox" 
                                      disabled
                                      value="Not Our Unit" 
                                      :checked="report.type === 'Not Our Unit'"
                                      class="border border-gray-300"
                                    />
                                    <span>Not Our Unit</span>
                                  </label>

                                  <label class="flex items-center space-x-2">
                                    <input 
                                      type="checkbox" 
                                      disabled
                                      value="Back Job" 
                                      :checked="report.type === 'Back Job'"
                                      class="border border-gray-300"
                                    />
                                    <span>Back Job</span>
                                  </label>

                                  <label class="flex items-center space-x-2">
                                    <input 
                                      type="checkbox" 
                                      disabled
                                      value="Check Up" 
                                      :checked="report.type === 'Check Up'"
                                      class="border border-gray-300"
                                    />
                                    <span>Check Up</span>
                                  </label>

                                  <label class="flex items-center space-x-2">
                                    <input 
                                      type="checkbox" 
                                      disabled
                                      value="For Pull Out" 
                                      :checked="report.type === 'For Pull Out'"
                                      class="border border-gray-300"
                                    />
                                    <span>For Pull Out</span>
                                  </label>

                                  <label class="flex items-center space-x-2">
                                    <input 
                                      type="checkbox" 
                                      disabled
                                      value="Change Part" 
                                      class="border border-gray-300"
                                      :checked="report.type === 'Change Part'"
                                    />
                                    <span>Change Part</span>
                                  </label>
                                </div>
                              </div>
                            </div>

                            <div class="grid grid-cols-1">
                              <div class="  p-[4px] h-24 border text-xs border-black">
                                Problem/Concern: <br>
                                <div v-html="report.problem_concern"></div>
                              </div>
                            </div>
                            <div class="grid grid-cols-1">
                              <div class="  p-[4px] h-28 border text-xs border-black">
                                Cause/s: <br>
                                <div v-html="report.causes"></div>
                              </div>
                            </div>
                            <div class="grid grid-cols-1">
                              <div class="  p-[4px] h-28 border text-xs border-black">
                                Action Taken:<br>
                                <div v-html="report.action_taken"></div>
                              </div>
                            </div>
                            <div class="grid grid-cols-1">
                              <div class="  p-[4px] h-28 border text-xs border-black">
                                Remarks & Recommendation: <br>
                                <div v-html="report.remark_recommendation"></div>
                              </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-2">
                              <div class="  p-[4px] border text-xs border-black">
                                REPORTED BY: {{ report.reported_by }}
                              </div>
                              <div class="  p-[4px] border text-xs border-black">
                                DATE/TIME: {{ report.reported_date_time }}
                              </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-2">
                              <div class="  p-[4px] border text-xs border-black">
                                SERVICED BY: {{ report.serviced_by }}
                              </div>
                              <div class="  p-[4px] border text-xs border-black">
                                DATE/TIME: {{ report.serviced_date_time }}
                              </div>
                            </div>

                            <div class="grid grid-cols-1">
                              <div class="  p-[4px] border text-xs border-black">
                                APPROVAL FOR REPLACEMENT/PURCHASE: <br>{{ report.approval }}
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- End Report Form -->

                      <!-- Report Form -->
                      <div class="w-full md:w-1/2 p-2 flex justify-start">
                        <div class="w-full bg-white p-2">
                          <div class="flex-grow border border-black">
                            <div class="grid grid-cols-12 p-[4px]">
                              <div class="col-span-2 items-center flex justify-center">
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
                              <div class="bg-gray-700 text-center text-sm text-white p-[4px]">
                                SERVICE REPORT
                              </div>
                            </div>
                            <div class="grid grid-cols-2">
                              <div class="  p-[4px] border text-xs border-black">
                                Job Order Number: {{ report.job_order_no }}
                              </div>
                              <div class="  p-[4px] border text-xs border-black">
                                Date: {{ report.date }}
                              </div>
                            </div>
                            <div class="grid grid-cols-2">
                              <div class="  p-[4px] border text-xs border-black">
                                Department: {{ report.department }}
                              </div>
                              <div class="  p-[4px] border text-xs border-black">
                                Machine Code: {{ report.machine_code }}
                              </div>
                            </div>

                            <!-- Type Checkboxes -->
                            <div class="grid grid-cols-12">
                              <div class="  p-[4px] border text-xs border-black col-span-2">
                                Type
                              </div>
                              <div class="  p-[4px] border text-xs border-black col-span-10">
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4">
                                  <label class="flex items-center space-x-2">
                                    <input 
                                      type="checkbox" 
                                      disabled
                                      value="Under Warranty" 
                                      :checked="report.type === 'Under Warranty'"
                                      class="border border-gray-300"
                                    />
                                    <span>Under Warranty</span>
                                  </label>

                                  <label class="flex items-center space-x-2">
                                    <input 
                                      type="checkbox" 
                                      disabled
                                      value="Out Of Warranty" 
                                      :checked="report.type === 'Out Of Warranty'"
                                      class="border border-gray-300"
                                    />
                                    <span>Out Of Warranty</span>
                                  </label>

                                  <label class="flex items-center space-x-2">
                                    <input 
                                      type="checkbox" 
                                      disabled
                                      value="Not Our Unit" 
                                      :checked="report.type === 'Not Our Unit'"
                                      class="border border-gray-300"
                                    />
                                    <span>Not Our Unit</span>
                                  </label>

                                  <label class="flex items-center space-x-2">
                                    <input 
                                      type="checkbox" 
                                      disabled
                                      value="Back Job" 
                                      :checked="report.type === 'Back Job'"
                                      class="border border-gray-300"
                                    />
                                    <span>Back Job</span>
                                  </label>

                                  <label class="flex items-center space-x-2">
                                    <input 
                                      type="checkbox" 
                                      disabled
                                      value="Check Up" 
                                      :checked="report.type === 'Check Up'"
                                      class="border border-gray-300"
                                    />
                                    <span>Check Up</span>
                                  </label>

                                  <label class="flex items-center space-x-2">
                                    <input 
                                      type="checkbox" 
                                      disabled
                                      value="For Pull Out" 
                                      :checked="report.type === 'For Pull Out'"
                                      class="border border-gray-300"
                                    />
                                    <span>For Pull Out</span>
                                  </label>

                                  <label class="flex items-center space-x-2">
                                    <input 
                                      type="checkbox" 
                                      disabled
                                      value="Change Part" 
                                      class="border border-gray-300"
                                      :checked="report.type === 'Change Part'"
                                    />
                                    <span>Change Part</span>
                                  </label>
                                </div>
                              </div>
                            </div>

                            <div class="grid grid-cols-1">
                              <div class="  p-[4px] h-24 border text-xs border-black">
                                Problem/Concern: <br>
                                <div v-html="report.problem_concern"></div>
                              </div>
                            </div>
                            <div class="grid grid-cols-1">
                              <div class="  p-[4px] h-28 border text-xs border-black">
                                Cause/s: <br>
                                <div v-html="report.causes"></div>
                              </div>
                            </div>
                            <div class="grid grid-cols-1">
                              <div class="  p-[4px] h-28 border text-xs border-black">
                                Action Taken:<br>
                                <div v-html="report.action_taken"></div>
                              </div>
                            </div>
                            <div class="grid grid-cols-1">
                              <div class="  p-[4px] h-28 border text-xs border-black">
                                Remarks & Recommendation: <br>
                                <div v-html="report.remark_recommendation"></div>
                              </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-2">
                              <div class="  p-[4px] border text-xs border-black">
                                REPORTED BY: {{ report.reported_by }}
                              </div>
                              <div class="  p-[4px] border text-xs border-black">
                                DATE/TIME: {{ report.reported_date_time }}
                              </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-2">
                              <div class="  p-[4px] border text-xs border-black">
                                SERVICED BY: {{ report.serviced_by }}
                              </div>
                              <div class="  p-[4px] border text-xs border-black">
                                DATE/TIME: {{ report.serviced_date_time }}
                              </div>
                            </div>

                            <div class="grid grid-cols-1">
                              <div class="  p-[4px] border text-xs border-black">
                                APPROVAL FOR REPLACEMENT/PURCHASE: <br>{{ report.approval }}
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                  
                  <!-- Print this content -->
                  <div class="hidden">
                    <div class="flex flex-col md:flex-row w-full justify-center content-to-print " ref="contentToPrint">
                      <!-- Report Form -->
                      <div class="w-full md:w-1/2 p-2">
                        <div class="w-full bg-white p-2">
                          <div class="flex-grow border border-black">
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
                              <div class="bg-gray-700 text-center text-sm text-white pb-[8px] px-[4px]">
                                SERVICE REPORT
                              </div>
                            </div>
                            <div class="grid grid-cols-2 ">
                              <div class="  pb-[8px] px-[4px] border text-xs border-black">
                                Job Order Number: {{ report.job_order_no }}
                              </div>
                              <div class="  pb-[8px] px-[4px] border text-xs border-black">
                                Date: {{ report.date }}
                              </div>
                            </div>
                            <div class="grid grid-cols-2">
                              <div class="  pb-[8px] px-[4px] border text-xs border-black">
                                Department: {{ report.department }}
                              </div>
                              <div class="  pb-[8px] px-[4px] border text-xs border-black">
                                Machine Code: {{ report.machine_code }}
                              </div>
                            </div>

                            <!-- Type Checkboxes -->
                            <div class="grid grid-cols-12">
                              <div class="  pb-[8px] px-[4px] border text-xs border-black col-span-2">
                                Type
                              </div>
                              <div class="  pb-[8px] px-[4px] border text-xs border-black col-span-10">
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4">
                                  <label class="flex items-center space-x-2">
                                    <input 
                                      type="checkbox" 
                                      disabled
                                      value="Under Warranty" 
                                      :checked="report.type === 'Under Warranty'"
                                      class="border border-gray-300"
                                    />
                                    <span>Under Warranty</span>
                                  </label>

                                  <label class="flex items-center space-x-2">
                                    <input 
                                      type="checkbox" 
                                      disabled
                                      value="Out Of Warranty" 
                                      :checked="report.type === 'Out Of Warranty'"
                                      class="border border-gray-300"
                                    />
                                    <span>Out Of Warranty</span>
                                  </label>

                                  <label class="flex items-center space-x-2">
                                    <input 
                                      type="checkbox" 
                                      disabled
                                      value="Not Our Unit" 
                                      :checked="report.type === 'Not Our Unit'"
                                      class="border border-gray-300"
                                    />
                                    <span>Not Our Unit</span>
                                  </label>

                                  <label class="flex items-center space-x-2">
                                    <input 
                                      type="checkbox" 
                                      disabled
                                      value="Back Job" 
                                      :checked="report.type === 'Back Job'"
                                      class="border border-gray-300"
                                    />
                                    <span>Back Job</span>
                                  </label>

                                  <label class="flex items-center space-x-2">
                                    <input 
                                      type="checkbox" 
                                      disabled
                                      value="Check Up" 
                                      :checked="report.type === 'Check Up'"
                                      class="border border-gray-300"
                                    />
                                    <span>Check Up</span>
                                  </label>

                                  <label class="flex items-center space-x-2">
                                    <input 
                                      type="checkbox" 
                                      disabled
                                      value="For Pull Out" 
                                      :checked="report.type === 'For Pull Out'"
                                      class="border border-gray-300"
                                    />
                                    <span>For Pull Out</span>
                                  </label>

                                  <label class="flex items-center space-x-2">
                                    <input 
                                      type="checkbox" 
                                      disabled
                                      value="Change Part" 
                                      class="border border-gray-300"
                                      :checked="report.type === 'Change Part'"
                                    />
                                    <span>Change Part</span>
                                  </label>
                                </div>
                              </div>
                            </div>

                            <div class="grid grid-cols-1">
                              <div class="  pb-[8px] px-[4px] h-24 border text-xs border-black">
                                Problem/Concern: <br>
                                <div v-html="report.problem_concern"></div>
                              </div>
                            </div>
                            <div class="grid grid-cols-1">
                              <div class="  pb-[8px] px-[4px] h-28 border text-xs border-black">
                                Cause/s: <br>
                                <div v-html="report.causes"></div>
                              </div>
                            </div>
                            <div class="grid grid-cols-1">
                              <div class="  pb-[8px] px-[4px] h-28 border text-xs border-black">
                                Action Taken:<br>
                                <div v-html="report.action_taken"></div>
                              </div>
                            </div>
                            <div class="grid grid-cols-1">
                              <div class="  pb-[8px] px-[4px] h-28 border text-xs border-black">
                                Remarks & Recommendation: <br>
                                <div v-html="report.remark_recommendation"></div>
                              </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-2">
                              <div class="  pb-[8px] px-[4px] border text-xs border-black">
                                REPORTED BY: {{ report.reported_by }}
                              </div>
                              <div class="  pb-[8px] px-[4px] border text-xs border-black">
                                DATE/TIME: {{ report.reported_date_time }}
                              </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-2">
                              <div class="  pb-[8px] px-[4px] border text-xs border-black">
                                SERVICED BY: {{ report.serviced_by }}
                              </div>
                              <div class="  pb-[8px] px-[4px] border text-xs border-black">
                                DATE/TIME: {{ report.serviced_date_time }}
                              </div>
                            </div>

                            <div class="grid grid-cols-1">
                              <div class="  pb-[8px] px-[4px] border text-xs border-black">
                                APPROVAL FOR REPLACEMENT/PURCHASE: <br>{{ report.approval }}
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- End Report Form -->

                      <!-- Report Form -->
                      <div class="w-full md:w-1/2 p-2 flex justify-start">
                        <div class="w-full bg-white p-2">
                          <div class="flex-grow border border-black">
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
                              <div class="bg-gray-700 text-center text-sm text-white pb-[8px] px-[4px]">
                                SERVICE REPORT
                              </div>
                            </div>
                            <div class="grid grid-cols-2 ">
                              <div class="  pb-[8px] px-[4px] border text-xs border-black">
                                Job Order Number: {{ report.job_order_no }}
                              </div>
                              <div class="  pb-[8px] px-[4px] border text-xs border-black">
                                Date: {{ report.date }}
                              </div>
                            </div>
                            <div class="grid grid-cols-2">
                              <div class="  pb-[8px] px-[4px] border text-xs border-black">
                                Department: {{ report.department }}
                              </div>
                              <div class="  pb-[8px] px-[4px] border text-xs border-black">
                                Machine Code: {{ report.machine_code }}
                              </div>
                            </div>

                            <!-- Type Checkboxes -->
                            <div class="grid grid-cols-12">
                              <div class="  pb-[8px] px-[4px] border text-xs border-black col-span-2">
                                Type
                              </div>
                              <div class="  pb-[8px] px-[4px] border text-xs border-black col-span-10">
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4">
                                  <label class="flex items-center space-x-2">
                                    <input 
                                      type="checkbox" 
                                      disabled
                                      value="Under Warranty" 
                                      :checked="report.type === 'Under Warranty'"
                                      class="border border-gray-300"
                                    />
                                    <span>Under Warranty</span>
                                  </label>

                                  <label class="flex items-center space-x-2">
                                    <input 
                                      type="checkbox" 
                                      disabled
                                      value="Out Of Warranty" 
                                      :checked="report.type === 'Out Of Warranty'"
                                      class="border border-gray-300"
                                    />
                                    <span>Out Of Warranty</span>
                                  </label>

                                  <label class="flex items-center space-x-2">
                                    <input 
                                      type="checkbox" 
                                      disabled
                                      value="Not Our Unit" 
                                      :checked="report.type === 'Not Our Unit'"
                                      class="border border-gray-300"
                                    />
                                    <span>Not Our Unit</span>
                                  </label>

                                  <label class="flex items-center space-x-2">
                                    <input 
                                      type="checkbox" 
                                      disabled
                                      value="Back Job" 
                                      :checked="report.type === 'Back Job'"
                                      class="border border-gray-300"
                                    />
                                    <span>Back Job</span>
                                  </label>

                                  <label class="flex items-center space-x-2">
                                    <input 
                                      type="checkbox" 
                                      disabled
                                      value="Check Up" 
                                      :checked="report.type === 'Check Up'"
                                      class="border border-gray-300"
                                    />
                                    <span>Check Up</span>
                                  </label>

                                  <label class="flex items-center space-x-2">
                                    <input 
                                      type="checkbox" 
                                      disabled
                                      value="For Pull Out" 
                                      :checked="report.type === 'For Pull Out'"
                                      class="border border-gray-300"
                                    />
                                    <span>For Pull Out</span>
                                  </label>

                                  <label class="flex items-center space-x-2">
                                    <input 
                                      type="checkbox" 
                                      disabled
                                      value="Change Part" 
                                      class="border border-gray-300"
                                      :checked="report.type === 'Change Part'"
                                    />
                                    <span>Change Part</span>
                                  </label>
                                </div>
                              </div>
                            </div>

                            <div class="grid grid-cols-1">
                              <div class="  pb-[8px] px-[4px] h-24 border text-xs border-black">
                                Problem/Concern: <br>
                                <div v-html="report.problem_concern"></div>
                              </div>
                            </div>
                            <div class="grid grid-cols-1">
                              <div class="  pb-[8px] px-[4px] h-28 border text-xs border-black">
                                Cause/s: <br>
                                <div v-html="report.causes"></div>
                              </div>
                            </div>
                            <div class="grid grid-cols-1">
                              <div class="  pb-[8px] px-[4px] h-28 border text-xs border-black">
                                Action Taken:<br>
                                <div v-html="report.action_taken"></div>
                              </div>
                            </div>
                            <div class="grid grid-cols-1">
                              <div class="  pb-[8px] px-[4px] h-28 border text-xs border-black">
                                Remarks & Recommendation: <br>
                                <div v-html="report.remark_recommendation"></div>
                              </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-2">
                              <div class="  pb-[8px] px-[4px] border text-xs border-black">
                                REPORTED BY: {{ report.reported_by }}
                              </div>
                              <div class="  pb-[8px] px-[4px] border text-xs border-black">
                                DATE/TIME: {{ report.reported_date_time }}
                              </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-2">
                              <div class="  pb-[8px] px-[4px] border text-xs border-black">
                                SERVICED BY: {{ report.serviced_by }}
                              </div>
                              <div class="  pb-[8px] px-[4px] border text-xs border-black">
                                DATE/TIME: {{ report.serviced_date_time }}
                              </div>
                            </div>

                            <div class="grid grid-cols-1">
                              <div class="  pb-[8px] px-[4px] border text-xs border-black">
                                APPROVAL FOR REPLACEMENT/PURCHASE: <br>{{ report.approval }}
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                  </div>
                  <!-- End Print this content -->
              </div>
          </main>
      </div> 
  </AuthenticatedLayout>
</template>


<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import { defineProps } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import html2pdf from 'html2pdf.js';
import { ref } from 'vue';

// Define the props
const props = defineProps({
  report: {
    type: Object,
    required: true
  }
});

const contentToPrint = ref(null);

const generatePDF = () => {
  const element = contentToPrint.value;

  // Configure html2pdf options
  const options = {
    margin:       5,  // Increase margin to prevent overflow
    filename:     'service-report.pdf',
    image:        { type: 'jpeg', quality: 0.98 },
    html2canvas:  { scale: 2 }, // Reduce scale for better fit
    jsPDF:        { unit: 'mm', format: 'letter', orientation: 'landscape' }
  };

  // Generate the PDF from the content
  html2pdf()
    .from(element)
    .set(options)
    .save();
};

</script>
