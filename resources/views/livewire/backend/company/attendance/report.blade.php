<main x-data="{ 'showModal': false }">
    <div>
        <section class="mt-10">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12">

                
                <div class="p-6 mb-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <div class="grid md:grid-cols-3 gap-4">
                        <!-- Select Box -->
                        <div>
                            <x-native-select label="اختر الفرع" wire:model.live="branche">
                                @foreach (settings('branches') as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                        
                            </x-native-select>
                        </div>
                
                        <!-- Date Input -->
                        <div>
                            <x-form.datepicker label="تاريخ" model="Start_work" hint="{{$start}} الى غاية {{$end}}"   />
                        </div>
                        <div>
                            <x-button info wire:click="resetTable" label="إعادة ضبط" class="md:mt-6" />

                        </div>
                    </div>
                </div>
                                <!-- Start coding here -->
                                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                                    <div class="flex items-center justify-between d p-4">
                                        <div class="flex">
                                            <x-input icon="search" wire:model.live.debounce.300ms="search"  placeholder="بحث" />
                
                                        </div>    
                                    </div>
                                    <div class="overflow-x-auto">
                                        <table class="w-full text-sm text-left text-gray-500 ">
                                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:text-white dark:bg-gray-700" >
                                                <tr>
                                                    <th scope="col" class="px-4 py-3 text-center">اسم الموظف</th>
                                                    <th scope="col" class="px-4 py-3 text-center">الرقم الوظيفي</th>
                                                    <th scope="col" class="px-4 py-3 text-center">الفرع</th>
                                                    <th scope="col" class="px-4 py-3 text-center">السبت</th>
                                                    <th scope="col" class="px-4 py-3 text-center">الأحد</th>
                                                    <th scope="col" class="px-4 py-3 text-center">الإثنين</th>
                                                    <th scope="col" class="px-4 py-3 text-center">الثلاثاء</th>
                                                    <th scope="col" class="px-4 py-3 text-center">الأربعاء</th>
                                                    <th scope="col" class="px-4 py-3 text-center">الخميس</th>
                                                    <th scope="col" class="px-4 py-3 text-center">الجمعة</th>
                                                </tr>
                                            </thead>                   
                                                     <tbody>
                
                                                        @forelse ($employees as $cle => $item)
                                                        <tr class="border-b dark:border-gray-700 dark:text-white" wire:key="{{$item['id']}}">
                                                            
                                                            <td class="px-4 py-3 text-center">{{$item['name']}}</td>
                                                            <td class="px-4 py-3 text-center">{{$item['number']}}</td>
                                                            <td class="px-4 py-3 text-center">
                                                                <x-badge positive label="{{$item['branch']}}" />
                                                            </td>
                                                            @forelse ($item['days'] as $key => $val)
                                                            
                                                           
                                                            
                                                            <td class="px-4 py-3 text-center">
                                                                
                                                                <x-native-select
                                                                label=""
                                                                class="
                                                                    {{ $val->status == 'Present' ? 'bg-green-700 text-white' : '' }}
                                                                    {{ $val->status == 'Absent' ? 'bg-rose-700 text-white' : '' }}
                                                                    {{ $val->status == 'Late' ? 'bg-yellow-400 text-black' : '' }}
                                                                    {{ $val->status == 'Vacance' ? 'bg-indigo-900 text-white' : '' }}
                                                                    {{ $val->status == 'لم يحدد' ? 'bg-yellow-950 text-white' : '' }}
                                                                "
                                                                x-on:change="showSelectedInfo($el)">
                                                                <option {{ $val->status == 'Absent' ? 'selected' : '' }} value="Absent" data-id="{{$val->id}}" data-current="{{$val->status}}">Absent</option>
                                                                <option {{ $val->status == 'Present' ? 'selected' : '' }} value="Present" data-id="{{$val->id}}" data-current="{{$val->status}}">Present</option>
                                                                <option {{ $val->status == 'Late' ? 'selected' : '' }} value="Late" data-id="{{$val->id}}" data-current="{{$val->status}}">Late</option>
                                                                <option {{ $val->status == 'Vacance' ? 'selected' : '' }} value="Vacance" data-id="{{$val->id}}" data-current="{{$val->status}}">Vacance</option>
                                                            </x-native-select>
                
                
                                                            </td>
                                                        @empty
                                                        @endforelse
                                                        
                
                                                           
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
                    تعديل الحالة الخاصة ب {{$empName ?? ''}}
                </h3>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <p>
                    يوم {{__($selectedDay) ?? ''}} في الفترة بين {{$start ?? ''}} الى {{$end ?? ''}}
                </p>

                <x-native-select label="اختر الحالة الجديدة" wire:model.live="Newstatus"
            >
                <option value="Absent">Absent</option>
                <option value="Present">Present</option>
                <option value="Late">Late</option>
                <option value="Vacance">Vacance</option>
            </x-native-select>

            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
            <button data-modal-hide="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">إلغاء</button>
            <button wire:click="save" data-modal-hide="defaultModal" type="button" class="text-white mx-3 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">حفظ</button>
   
        </div>
        </div>
    </div>
</div>
<script>
    function showSelectedInfo(selectElement) {
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const status = selectedOption.dataset.current;
        const id = selectedOption.dataset.id;

        
        console.log(`Current Status: ${status}`);
        console.log(`Selected ID: ${id}`);
        console.log(`Selected Option: ${selectedOption.textContent}`);

        Livewire.dispatch('post-created',{
            selectedoption : selectedOption.textContent,
            id:id,
            current: status
        })
    }
</script>
</main>
