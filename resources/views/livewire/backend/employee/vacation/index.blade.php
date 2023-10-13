<main>
    <div>
        <section class="pt-10">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                <!-- Start coding here -->
                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                     <x-employee.includes.header-card iconname="flag" title="{{__('Vacation')}}" />

                    <div class="overflow-x-auto">
           

                    </div>
    
                    <div class="py-4 px-3">
                        <div class="container mx-auto">

                            <div class="grid grid-cols-1 gap-4 mt-3">
                                <div class="col-span-1">
                                    @livewire('backend.employee.vacation.modal-create')
                                </div>
                            </div>

                            <hr class="h-px mt-4 mx-2 bg-gray-200 border-0 dark:bg-gray-700">

                            <div class="grid grid-cols-1 gap-4 mt-3">
                                <div class="col-span-1">
                                    <x-form.datepicker label="{{__('date')}}" model="date"   />
                                </div>
                                <div class="col-span-1">
                                    <x-button info  label="{{__('show')}}" />
                                </div>
                            </div>
                            <hr class="h-px my-3 mx-2 bg-gray-200 border-0 dark:bg-gray-700">

                            <h2 class="dark:text-white font-extrabold my-2">
                                {{ trans('messages.vacation_record_for', ['month' => trans('messages.months.'.$month), 'year' => $year]) }}
                            </h2>
                            <div class="grid md:grid-cols-1 gap-4">
                                <div class="col-span-1">
                                    <table class="w-full text-sm text-left text-gray-500 ">
                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:text-white dark:bg-gray-700" >
                                            <tr>
                                                <th scope="col" class="px-4 py-3 text-center">{{__('title')}}</th>
                                                <th scope="col" class="px-4 py-3 text-center">{{__('start date')}}</th>
                                                <th scope="col" class="px-4 py-3 text-center">{{__('end date')}}</th>
                                                <th scope="col" class="px-4 py-3 text-center">{{__('status')}}</th>



   
                                            </tr>
                                        </thead>                   
                                                 <tbody>
            
                                                    @forelse ($vacations as $cle => $item)
                                                    <tr class="border-b dark:border-gray-700 dark:text-white" wire:key="{{$item->id}}">
                                                        
                                                        <td class="px-4 py-3 text-center">
                                                            @if(app()->getLocale() == 'ar')
                                                                {{ \Carbon\Carbon::parse($item->attendance_date)->isoFormat('D MMMM Y', 'Do MMMM Y') }}
                                                            @else
                                                                {{ \Carbon\Carbon::parse($item->attendance_date)->format('F j, Y') }}
                                                            @endif
                                                        </td>
                                                        <td class="px-4 py-3 text-center">
                                                            @if ($item->status == "حاضر")
                                                              <x-badge outline positive label="{{__('present')}}" />
                                                            @else
                                                                 @if ($item->status == "غائب")

                                                                 <x-badge outline negative label="{{__('absent')}}" />
                                                                @else
                                                                <x-badge outline info label="{{__('holiday')}}" />
                                                                @endif
                                                                
                                                            @endif
                                                        </td>
                                                        <td class="px-4 py-3 text-center">{{$item->delay}} {{__('Minute')}}</td>
                                                        <td class="px-4 py-3 text-center">
                                                            @if (!$item->leave)
                                                              <x-badge warning label="{{__('Incomplete')}}" />
                                                            @else
                                                              <x-badge outline sky label="{{ \Carbon\Carbon::parse($item->leave)->format('h:i') }}" />
                                                            @endif
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
                            </div>
                        </div>

                    </div>
                        
                    </div>
                </div>
            </div>
        </section>
    
    </div>
</main>