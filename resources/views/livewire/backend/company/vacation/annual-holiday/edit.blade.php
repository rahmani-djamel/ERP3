<main x-data="{ 'showModal': false }">
    <div>
        <section class="mt-10">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                <!-- Start coding here -->
                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                    <div class="flex items-center justify-between d p-4">
                        <div class="flex">
                            <x-input icon="search" wire:model.live.debounce.300ms="search"  placeholder="بحث" />

                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 ">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:text-white dark:bg-gray-700">
                                <tr>
                            
                                    <th scope="col" class="px-4 py-3 text-center">اسم الموظف</th>
                                    <th scope="col" class="px-4 py-3 text-center">الرقم الوظيفي</th>
                                    <th scope="col" class="px-4 py-3 text-center">نوع الإجازة</th>
                                    <th scope="col" class="px-4 py-3 text-center">تاريخ البداية</th>
                                    <th scope="col" class="px-4 py-3 text-center">تاريخ النهاية</th>
                                    <th scope="col" class="px-4 py-3 text-center">مدة الإجازة</th>



                                    <th scope="col" class="px-4 py-3 text-center">الإجراءات</th>
                                </tr>
                            </thead>                   
                                     <tbody>

                                        @forelse ($holidays as $item)
                                        <tr class="border-b dark:border-gray-700 dark:text-white" wire:key="{{$item->id}}">
                                            
                                            <td class="px-4 py-3 text-center">{{$item->employee->Name}}</td>
                                            <td class="px-4 py-3 text-center">{{$item->employee->JobNumber}}</td>
                                            <td class="px-4 py-3 text-center">
                                                <x-badge blue  label="{{$item->type}}" />
                                            </td>
                                            <td class="px-4 py-3 text-center">
                                                {{$item->start_date}}
                                            </td>
                                            <td class="px-4 py-3 text-center">
                                                {{$item->end_date}}
                                            </td>
                                            <td class="px-4 py-3 text-center">
                                                @if($item->start_date && $item->end_date)
                                                {{ \Carbon\Carbon::parse($item->start_date)->diffInDays($item->end_date) }} يوم
                                            @else
                                                لم يتم تحديد العطلة
                                            @endif
                                            </td>
 


                                            

                                        

                                        <td class="px-4 py-3 text-center">

                                            <x-button.circle 
                                            indigo  
                                            icon="plus" 
                                            data-modal-target="defaultModal3"
                                            data-modal-toggle="defaultModal3"
                                            wire:click="selection({{$item}})"
                                            
                                           />
                                        
                                            <x-button.circle 
                                             icon="pencil" 
                                             data-modal-target="defaultModal2"
                                             data-modal-toggle="defaultModal2"
                                             wire:click="selection({{$item}})"
                                             
                                            />
                                            <x-button.circle info icon="eye"
                                            data-modal-target="defaultModal"
                                            data-modal-toggle="defaultModal"
                                            wire:click="selection({{$item}})" />

                                            <x-button.circle negative 
                                            icon="trash"
                                            data-modal-target="defaultModal4"
                                            data-modal-toggle="defaultModal4"
                                            wire:click="selection({{$item}})" />


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

    <!-- Main modal -->
<div wire:ignore.self id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        الإجازة الخاصة ب {{$selected['employee']['Name'] ?? ''}}
                </h3>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">

                <p>
                    اسم الموظف   <span class="mx-6">{{$selected['employee']['Name'] ?? '' }}</span>
                </p>
                <p>
                     الرقم الوظيفي   <span class="mx-6">{{$selected['employee']['JobNumber'] ?? '' }}</span>
                </p>
                <p>
                     تاريخ بداية الإجازة   <span class="mx-6">{{$selected['start_date'] ?? '' }}</span>
               </p>
               <p>
                تاريخ نهاية الإجازة   <span class="mx-6">{{$selected['end_date'] ?? '' }}</span>
               </p>
               <p>
                   التمديد   <span class="mx-6">{{(($selected['extend'] ?? 0) == 0) ? 'لم يتم التمديد' : 'تم التمديد ' }}</span>
               </p>
               @if (($selected['extend'] ?? 0) == 1)

               <p>
                مدة التمديد   <span class="mx-6">{{$selected['extend_days'] ?? '' }}</span>
                </p>
                   
               @endif


   
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
            <button data-modal-hide="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">إلغاء</button>
            </div>
        </div>
    </div>
</div>


    <!-- Main modal 2-->
    <div wire:ignore.self id="defaultModal2" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            الإجازة الخاصة ب {{$selected['employee']['Name'] ?? ''}}
                    </h3>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <div class="grid md:grid-cols-2 md:gap-6">
                        <div class="relative z-0 w-full mb-6 group">
                            <x-form.datepicker label="تاريخ بداية الإجازة" model="start"  hint="{{$selected['start_date'] ?? ''}}"  />

                        </div>
                        <div class="relative z-0 w-full mb-6 group">
                            <x-form.datepicker label="تاريخ نهاية الإجازة" model="end" hint="{{$selected['end_date'] ?? ''}}"   />
                        </div>
                    </div>




    
       
                </div>
                <!-- Modal footer -->
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button wire:click="saveTime" data-modal-hide="defaultModal" type="button" class="text-white mx-3 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">حفظ</button>
                <button data-modal-hide="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">إلغاء</button>
            </div>
            </div>
        </div>
    </div>

        <!-- Main modal 3-->
        <div wire:ignore.self id="defaultModal3" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                الإجازة الخاصة ب {{$selected['employee']['Name'] ?? ''}}
                        </h3>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6">
                        <h1 class="font-bold dark:text-white">
                             تمديد الإجازة
                        </h1>
                        <div class="grid md:grid-cols-1 md:gap-6">
                            <div class="relative z-0 w-full mb-6 group">
                                <x-input type="number" wire:model.live="extendDays" label="عدد الأيام المضافة"   />
                            </div>
                        </div>
    
    
    
    
        
           
                    </div>
                    <!-- Modal footer -->
                <!-- Modal footer -->
                <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button wire:click="saveExtend" data-modal-hide="defaultModal" type="button" class="text-white mx-3 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">حفظ</button>
                    <button data-modal-hide="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">إلغاء</button>
                </div>
                </div>
            </div>
        </div>

                <!-- Main modal 4-->
                <div wire:ignore.self id="defaultModal4" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative w-full max-w-2xl max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        الإجازة الخاصة ب {{$selected['employee']['Name'] ?? ''}}
                                </h3>
                            </div>
                            <!-- Modal body -->
                            <div class="p-6 space-y-6">
                                <h1 class="font-bold dark:text-white text-center">
                                    هل تريد حذف هذه الإجازة ؟
                                </h1>
                         
                   
                            </div>
                            <!-- Modal footer -->
                        <!-- Modal footer -->
                        <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                            <button wire:click="saveDelete" data-modal-hide="defaultModal" type="button" class="text-white mx-3 bg-red-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">تأكيد</button>
                            <button data-modal-hide="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">إلغاء</button>
                        </div>
                        </div>
                    </div>
                </div>
            
    

</main>