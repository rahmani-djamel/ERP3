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
                                    <th scope="col" class="px-4 py-3 text-center">{{__('status')}}</th>
                                    <th scope="col" class="px-4 py-3 text-center">{{__('Number of days off in the week')}}</th>
                                    <th scope="col" class="px-4 py-3 text-center">{{__('actions')}}</th>
                                </tr>
                            </thead>                   
                                     <tbody>

                                        @forelse ($employees as $item)
                                        <tr class="border-b dark:border-gray-700 dark:text-white" wire:key="{{$item->id}}">
                                            
                                            <td class="px-4 py-3 text-center">{{$item->Name}}</td>
                                            <td class="px-4 py-3 text-center">{{$item->JobNumber}}</td>
                                            <td class="px-4 py-3 text-center">
                                                @if ($item->worktime->where('is_changed', 1)->count() == 0)
                                                <x-badge positive label=" دوام عادي" />

                                                @else
                                                <x-badge warning  label="توقيت خاص" />

                                                @endif
                                            </td>
                                            <td class="px-4 py-3 text-center">
                                                  {{$item->worktime->where('is_vacation', 1)->count()}}
                                            </td>

                                        

                                        <td class="px-4 py-3 text-center">
                                        
                                            <x-button.circle 
                                             icon="pencil" 
                                             href="{{route('company.dashboard.vacation.worktimeedit',['employee' => $item])}}"
                                            />
                                            <x-button.circle info icon="eye"
                                            data-modal-target="defaultModal"
                                            data-modal-toggle="defaultModal"
                                            wire:click="selection({{$item}})" />


                                        </td>
                                    
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center font-bold dark:text-white">{{__('There is no data to display')}}</td>
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

    <!-- Main modal -->
<div wire:ignore.self id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                     عرض التوقيت الخاص ب {{$selected['Name'] ?? ''}}
                </h3>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">

             @foreach ($selected['worktime'] ?? [] as $item)
              @if ($item['is_vacation'] == 0)
              <h1 class="dark:text-white">
                {{$item['weekday']}} : <strong> {{$item['work_start']}} </strong>  الى <strong>{{$item['work_end']}} </strong>
             </h1>
                  
              @else
              <h1 class="dark:text-white">
                {{$item['weekday']}} : Vacance
              </h1>
                  
              @endif



                 
             @endforeach

            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
            <button data-modal-hide="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">إلغاء</button>
            </div>
        </div>
    </div>
</div>

</main>
