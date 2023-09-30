      

<div>
    <section class="mt-10">
        <form class="z-1" wire:submit="save">
                    <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                        <!-- Start coding here -->
                      
                    
                    <div class="  grid md:grid-cols-4 md:gap-12 mb-4" >
                    
                        <x-button lime label="حفظ" type="submit" class="font-semibold" />
                        <x-button href="{{route('vacation.annualholiday.index')}}" primary label="رجوع" class="font-semibold" />
                                  
                    </div>
    
    
                        
                                <div class="grid md:grid-cols-2 md:gap-6">
                                        <div class="relative z-0 w-full mb-6 group">
                                            <x-native-select label="إختر موظف" wire:model.live="selected">
                                                @foreach ($employees as $item)
                                                <option value="{{$item->id}}">{{$item->Name}}</option>

                                                @endforeach

                                            </x-native-select>    
                                        </div>
                                        <div class="relative z-0 w-full mb-6 group">
                                            <x-input wire:model="jobNumber" type="text" right-icon="identification" label="الرقم الوظيفي" disabled value="{{$jobNumber}}" />   
                                        </div>
                                </div>
                                <div class="grid md:grid-cols-1 md:gap-6">
                                        <div class="relative z-0 w-full mb-6 group">
                                            <x-native-select label="نوع الإجازة" wire:model.live="type">
                                                @foreach (settings('VacationTypes') as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>

                                                @endforeach
                                            </x-native-select>

                                        </div>
     
                                </div>
                                <div class="grid md:grid-cols-2 md:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <x-form.datepicker label="تاريخ بداية الإجازة" model="start" />

                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <x-form.datepicker label="تاريخ نهاية الإجازة" model="end"   />
                                    </div>
                                </div>
                                <div class="inline-flex items-center justify-center w-full">
                                    <hr class="w-96 h-1 my-8 bg-blue-700 border-0 rounded dark:bg-gray-700">
                                    <div class="absolute px-4 -translate-x-1/2 bg-blue-700 left-1/2 dark:bg-gray-900">
                                        <x-icon name="calculator" class="w-4 h-4 text-white dark:text-gray-300" />


                                    </div>                           
                               </div>
                                <h1 class="font-extrabold text-lg dark:text-white">
                                     رصيد الإجازة
                                </h1>

                                <div class="grid md:grid-cols-2 md:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <x-input wire:model="rest" type="text" right-icon="identification" label="الرصيد الحالي" disabled value="{{$reset}}" />   

                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <x-input  type="text" right-icon="identification" label="الرصيد المتبقي بعد خصم الإجازة الحالية" disabled value="{{$afterReduce}}" />   
                                    </div>
                                </div>

                                <div class="grid md:grid-cols-2 md:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <x-input wire:model="jobNumber" type="text" right-icon="identification" label="الرصيد السنوي المسموح به" disabled value="{{$vacationdays}}" />   
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <x-input disabled  right-icon="identification" label="عدد ايام الإجازة"  value="{{$diffrence}}" />   
                                    </div>
                                </div>
        </form>
    </section>
</div>