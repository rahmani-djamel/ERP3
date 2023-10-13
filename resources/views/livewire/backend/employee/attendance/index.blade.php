<main>
    <div>
        <section class="pt-10">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                <!-- Start coding here -->
                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                     <x-employee.includes.header-card iconname="clipboard-check" title="{{__('Recording attendance and absence')}}" />

                    <div class="overflow-x-auto">
           

                    </div>
    
                    <div class="py-4 px-3">
                        <div class="container mx-auto">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="col-span-1">
                                    <h3 class="inline-flex dark:text-white">
                                        <span>
                                            <x-icon name="location-marker" class="w-5 h-5 text-blue-500 mx-2" solid />
                                        </span>
                                         {{$employee->branche->name}}
                                    </h3>
                                </div>
                                <div class="col-span-1 grid md:grid-cols-2  justify-items-center">
                                    <!-- Content for the second column -->
                                    <x-button info wire:click="save" class="md:my-0 my-2" label="{{__('Record attendance')}}" />
                                    <x-button rose wire:click="quit" label="{{__('sign out')}}" />
                                </div>
                            </div>
                            <hr class="h-px mt-4 mx-2 bg-gray-200 border-0 dark:bg-gray-700">
                            <div class="grid grid-cols-1 gap-4">
                                <div class="col-span-1">
                                    <x-form.datepicker label="تاريخ الميلاد" model="DateOfBirth"   />
                                </div>
                                <div class="col-span-1">
                                    <x-button info  label="{{__('show')}}" />
                                </div>
                            </div>
                            <hr class="h-px my-3 mx-2 bg-gray-200 border-0 dark:bg-gray-700">

                            <h2 class="dark:text-white font-extrabold my-2">
                                {{__('Attendance record for')}}
                            </h2>

                            <div class="grid md:grid-cols-3 gap-4">
                                <div class="col-span-1">
                                    <x-employee.includes.box text="{{__('Total working days')}}" color="green" number="123" />
                                </div>
                                <div class="col-span-1">
                                    <x-employee.includes.box text="{{__('Days with incomplete records')}}" color="gray" number="123" />
                                </div>

                                <div class="col-span-1">
                                    <x-employee.includes.box text="{{__('Absence')}}" color="red" number="123" />
                                </div>

                                <div class="col-span-1">
                                    <x-employee.includes.box text="{{__('Attendance not required')}}" color="amber" number="123" />
                                </div>

                                <div class="col-span-1">
                                    <x-employee.includes.box text="{{__('Rest days')}}" color="blue" number="123" />
                                </div>

                            
                            </div>
                        </div>




                    </div>
                        
                    </div>
                </div>
            </div>
        </section>
    
    </div>
</main>