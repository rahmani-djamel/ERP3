      

<div>
    <section class="mt-10">
        <form class="z-1" wire:submit="save">
                    <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                        <!-- Start coding here -->
                      
                    
                    <div class="  grid md:grid-cols-4 md:gap-12 mb-4" >
                    
                        <x-button lime label="حفظ" type="submit" class="font-semibold" />
                        <x-button href="{{route('employee.index')}}" primary label="رجوع" class="font-semibold" />
                                  
                    </div>
    
    
                        
                                <div class="grid md:grid-cols-2 md:gap-6">
                                        <div class="relative z-0 w-full mb-6 group">
                                            <x-native-select label="Select Status" wire:model.live="selected">
                                                @foreach ($employees as $item)
                                                <option value="{{$item->id}}">{{$item->Name}}</option>

                                                @endforeach

                                            </x-native-select>    
                                        </div>
                                        <div class="relative z-0 w-full mb-6 group">
                                            <x-input wire:model="jobNumber" type="text" right-icon="identification" label="الرقم الوظيفي" disabled value="{{$jobNumber}}" />   
                                        </div>
                                </div>
                    </div>
        </form>
    </section>
</div>