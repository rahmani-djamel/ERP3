<main x-data="{ 'showModal': false }">
    <div>
        <section class="mt-10">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                <!-- Start coding here -->
                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 ">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:text-white dark:bg-gray-700">
                                <tr>
                                  
                            
                                    <th scope="col" class="px-4 py-3 text-center">{{__('Employee')}}</th>
                                    <th scope="col" class="px-4 py-3 text-center">{{__('Day')}}</th>
                                    <th scope="col" class="px-4 py-3 text-center">{{__('Start Time')}}</th>
                                    <th scope="col" class="px-4 py-3 text-center">{{__('Duration')}}</th>
                                    <th scope="col" class="px-4 py-3 text-center">{{__('status')}}</th>
                                    <th scope="col" class="px-4 py-3 text-center">{{__('actions')}}</th>
                                        </tr>
                            </thead>                   
                                     <tbody>

                                        @forelse ($permissions as $item)
                                        <tr class="border-b dark:border-gray-700 dark:text-white" wire:key="{{$item->id}}">
                                            <td class="px-4 py-3 text-center">
                                                {{$item->employee->Name}}
                                            </td>
                                            <td class="px-4 py-3 text-center">
                                                {{$item->date}}
                                            </td>
                                            <td class="px-4 py-3 text-center">
                                                {{$item->start_time}}

                                            </td>
                                            <td class="px-4 py-3 text-center">
                                                @if (is_int($item->duration))
                                                {{$item->duration}} {{__('hour')}}
                                            @else
                                                {{$item->duration}}
                                            @endif 
                                           </td>
                                            <td class="px-4 py-3 text-center">
                                                @if ($item->status == 0)
                                                <x-badge warning label="لم يتم الرد" />
                                                @else

                                                @if ($item->status == 1)
                                                <x-badge positive  label="مقبول" />

                                                @else

                                                <x-badge negative   label="مرفوض" />
                                                
                                                @endif
                                                @endif
                                            </td>
                                            <td class="px-4 py-3 text-center">
                                        
                                                <x-button.circle 
                                                 icon="pencil" 
                                                 data-modal-target="defaultModal"
                                                  data-modal-toggle="defaultModal"
                                                  wire:click="selection({{$item}})"
                                                />
    
                                            </td>


                                            
                                        </tr>
                                        @empty 

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
                    استئذان 
                </h3>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">

                <p class="mb-3 text-gray-500 dark:text-gray-400">
                    <h3 class="font-extrabold dark:text-white">
                        اليوم
                    </h3>
                    {{$selected['date'] ?? ''}}

                    <h3 class="font-extrabold dark:text-white">
                        الوقت
                    </h3>
                    {{$selected['start_time'] ?? ''}}

                    <h3 class="font-extrabold dark:text-white">
                        المدة
                    </h3>
                    {{$selected['duration'] ?? ''}}

                    <h3 class="font-extrabold dark:text-white">
                        التبرير
                    </h3>
                    {{$selected['justification'] ?? ''}}
                </p>


  
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button wire:click="save" data-modal-hide="defaultModal" type="button" class="text-white mx-3 bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">قبول</button>
                <button wire:click="cancel" data-modal-hide="defaultModal" type="button" class="text-white mx-3 bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">رفض</button>
                <button data-modal-hide="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-green-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">إلغاء</button>
            </div>
        </div>
    </div>
</div>
</main>
