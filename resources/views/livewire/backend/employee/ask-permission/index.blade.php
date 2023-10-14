<main>
    <div>
        <section class="pt-10">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                <!-- Start coding here -->
                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                     <x-employee.includes.header-card iconname="clock" title="{{__('Asking Permission')}}" />

                    <div class="overflow-x-auto">
           

                    </div>
    
                    <div class="py-4 px-3">
                        <div class="container mx-auto">

                            <div class="grid grid-cols-1 gap-4 mt-3">
                                <div class="col-span-1">
                                    <x-form.datepicker label="{{__('date')}}" model="date"   />
                                </div>

                                <div class="col-span-1">

                                    <x-native-select label="وقت البداية" wire:model="start_time">
                                        @for ($hour = 0; $hour < 24; $hour++)
                                            @php
                                                $formattedHour = sprintf("%02d:00", $hour); // Format the hour as HH:00
                                            @endphp
                                            <option value="{{ $formattedHour }}">{{ $formattedHour }}</option>
                                        @endfor
                                    </x-native-select>
                             
                                </div>

                                <div class="col-span-1">
                                    <x-native-select label="{{__('Duration')}}" wire:model="duration">
                                            <option value="1">{{__('1 Hour')}}</option>
                                            <option value="2">{{__('2 Hours')}}</option>
                                            <option value="3">{{__('3 Hours')}}</option>
                                            <option value="undefined">{{__('undefined')}}</option>
                                    </x-native-select>
                                </div>
                                <div class="col-span-1">
                                    <x-textarea wire:model="justification" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"  label="{{__('Justification')}}" />

                                </div>
                                <div class="col-span-1">
                                    <x-button info wire:click="save" label="{{__('save')}}" />
                                </div>

                            </div>


                            <h2 class="dark:text-white font-extrabold my-2">
                            </h2>
                            <div class="grid md:grid-cols-1 gap-4">
                                <div class="col-span-1">

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