    <main>
        <div>
            <section class="mt-10">
                <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                    <!-- Start coding here -->
                    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                        <div class="flex items-center justify-between d p-4">
                            <div class="flex">
                                <x-input icon="search" wire:model.live.debounce.300ms="search"  placeholder="بحث" />

                            </div>
                            <div class="flex space-x-3">
                                <div class="flex space-x-3 items-center">
                                    <x-button
                                    href="{{route('employee.create')}}"
                                    target="_blank"
                                    label="إضافة موظف"
                                    teal
                                />
                                </div>
                            </div>
                        

                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500 ">
                                <x-table.header :items="$headers" />
                                <x-table.body :data="$employees" :keysToDisplay="$keysToDisplay" />
                            </table>

                        </div>
        
                        <div class="py-4 px-3">
                            <div class="flex ">
                                <div class="flex space-x-4 items-center mb-3">
                               
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        
        </div>
  
    </main>
