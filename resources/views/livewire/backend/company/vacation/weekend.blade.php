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
                                    @foreach ($headers as $item)
                            
                                    <th scope="col" class="px-4 py-3 text-center">{{$item}}</th>
                            
                                    @endforeach
                                    <th scope="col" class="px-4 py-3 text-center">الإجراءات</th>
                                </tr>
                            </thead>                   
                                     <tbody>

                                        @forelse ($days as $item)
                                        <tr class="border-b dark:border-gray-700 dark:text-white" wire:key="{{$item->id}}">
                                            @foreach ($keysToDisplay as $cle => $ke)
                                            <td class="px-4 py-3 text-center">
                                                @if ($item->is_vacation === 1 && $cle != 0)
                                                <x-badge info label="عطلة" />

                                                @else
                                                    {{ $item->$ke }}
                                                @endif
                                            </td>
                                        @endforeach

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
                                        <tr>
                                            <td colspan="{{ count($keysToDisplay) }}">No employees found.</td>
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
                    تعديل التوقيت
                </h3>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">

                <x-native-select label="وقت البداية" wire:model="start">
                    @for ($hour = 0; $hour < 24; $hour++)
                        @php
                            $formattedHour = sprintf("%02d:00", $hour); // Format the hour as HH:00
                        @endphp
                        <option value="{{ $formattedHour }}">{{ $formattedHour }}</option>
                    @endfor
                </x-native-select>

                <x-native-select label="وقت النهاية" wire:model="end">
                    @for ($hour = 0; $hour < 24; $hour++)
                        @php
                            $formattedHour = sprintf("%02d:00", $hour); // Format the hour as HH:00
                        @endphp
                        <option value="{{ $formattedHour }}">{{ $formattedHour }}</option>
                    @endfor
                </x-native-select>

                <x-toggle  class="mx-4" label="تحديد كيوم عطلة" wire:model="is_vacation" />


                

            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button wire:click="save" data-modal-hide="defaultModal" type="button" class="text-white mx-3 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">حفظ</button>
                <button data-modal-hide="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">إلغاء</button>
            </div>
        </div>
    </div>
</div>
</main>
