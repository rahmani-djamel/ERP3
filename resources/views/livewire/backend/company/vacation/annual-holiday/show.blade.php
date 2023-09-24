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
                                    <th scope="col" class="px-4 py-3 text-center">عدد أيام الإجازة السنوية المستحقة	</th>
                                    <th scope="col" class="px-4 py-3 text-center"> الرصيد الفعلي من عدد ايام الإجازة</th>

                                    <th scope="col" class="px-4 py-3 text-center">الحالة</th>
                                    <th scope="col" class="px-4 py-3 text-center">نوع الإجازة </th>
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
                                                <x-badge positive label="على رأس العمل" />            
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