<main x-data="{ 'showModal': false }">
    <div>
        <section class="mt-10">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                <!-- Start coding here -->
                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                    <div class="flex items-center justify-between d p-4">
                        <div class="flex">
                            <x-input icon="search" wire:model.live.debounce.300ms="search"  placeholder="{{__('search')}}" />

                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 ">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:text-white dark:bg-gray-700">
                                <tr>
                            
                                    <th scope="col" class="px-4 py-3 text-center">{{__('Employee Name')}}</th>
                                    <th scope="col" class="px-4 py-3 text-center">{{__('Job number')}}</th>
                                    <th scope="col" class="px-4 py-3 text-center">{{__('Eligible annual leave days')}}</th>
                                    <th scope="col" class="px-4 py-3 text-center">{{__('The actual balance of the number of leave days')}}</th>

                                    <th scope="col" class="px-4 py-3 text-center">{{__('status')}}</th>
                                    <th scope="col" class="px-4 py-3 text-center">{{__('vacation type')}}</th>
                                </tr>
                            </thead>                   
                                     <tbody>

                                        @forelse ($employees as $item)
                                        <tr class="border-b dark:border-gray-700 dark:text-white" wire:key="{{$item->id}}">
                                            
                                            <td class="px-4 py-3 text-center">{{$item->Name}}</td>
                                            <td class="px-4 py-3 text-center">{{$item->JobNumber}}</td>
                                            <td class="px-4 py-3 text-center">
                                                <x-badge blue  label="{{$item->VacationDays}}" />
                                            </td>
                                            <td class="px-4 py-3 text-center">
                                                
                                                {{$item->diffrence()}}
                                            </td>
                                            <td class="px-4 py-3 text-center">
                                                @if ($item->checkIfWorkToday() == 0)
                                                <x-badge positive label="{{__('On the job')}}" />            
                                                @else
                                                <x-badge negative label="إجازة" />
                                                @endif

                                            </td>
                                            <td class="px-4 py-3 text-center">
                                                سنوية

                                            </td>
                                    
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">No employees found.</td>
                                        </tr>
                                    
                                        
                                    
                                    @endforelse
                                    
                                    </tbody>
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