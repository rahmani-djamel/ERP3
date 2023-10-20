      

<div>
    <section class="mt-10">
        <form class="z-1" wire:submit="save">
                    <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                        <!-- Start coding here -->
                      
                    
                    <div class="  grid md:grid-cols-4 md:gap-12 mb-4" >
                    
                        <x-button lime label="{{__('save')}}" type="submit" class="font-semibold" />
                        <x-button href="{{route('settings.index')}}" primary label="{{__('cancel')}}" class="font-semibold" />
                                  
                    </div>
    
    
                        
                                <div class="grid md:grid-cols-2 md:gap-6">
                                        <div class="relative z-0 w-full mb-6 group">
                                            <x-native-select label="{{__('Number of days in the month')}}" wire:model="DaysMonth">
                                                <option value="1">30 يوم</option>
                                                <option value="2">الفعلية</option>
                                            </x-native-select>    
                                        </div>
                                        <div class="relative z-0 w-full mb-6 group">
                                           <x-input wire:model="MinVacationDays" type="number" right-icon="identification" label="{{__('Minimum leave period (day)')}}"  />
                                        </div>
                                </div>
                                <div class="grid md:grid-cols-2 md:gap-6">
                                        <div class="relative z-0 w-full mb-6 group">
                                             
                                            <x-native-select multiple label="{{__('Nationalities')}}" wire:model="nationalities">
                                                <option>السعودية</option>
                                                <option>مصر</option>
                                                <option>الكويت</option>
                                                <option>الإمارات</option>


                                            </x-native-select>  
                              
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <x-native-select  label="{{__('Automatic approval when creating an identification from an employee account')}}" wire:model="AutomaticApproval">
                                            <option value="1">{{__('yes')}}</option>
                                            <option value="2"> {{__('no')}}, يجب الرجوع للمشرف</option>
                                        </x-native-select>  
  
                          
                                     </div>
                                </div>

                                <div class="grid md:grid-cols-2 md:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                         
                                        <x-input wire:model="ValidityOfAnnualLeave" type="number" right-icon="identification" label="{{__('Validity of annual leave')}}"  />

                          
                                </div>
                                <div class="relative z-0 w-full mb-6 group">
                                         
                                    <x-native-select  label="{{__('Guarantee for the borrower')}}" wire:model="Guarantee">
                                        <option value="1">{{__('yes')}}</option>
                                        <option value="2">{{__('no')}}</option>
                                    </x-native-select>  
                      
                                 </div>
                            </div>
                            <div class="grid md:grid-cols-2 md:gap-6">
                                <div class="relative z-0 w-full mb-6 group">
                                     
                                    <x-native-select  label="{{__('Will employees be paid an advance salary?')}}" wire:model="WillPay">
                                        <option>{{__('yes')}}</option>
                                        <option>{{__('no')}}</option>
                                    </x-native-select>  
                      
                            </div>
                            <div class="relative z-0 w-full mb-6 group">
                                     
                                <x-input wire:model="MaximumVacationEmployees" type="number" right-icon="identification" label="{{__('Maximum number of employees to enjoy vacation at one time')}}"  />
                             </div>
                        </div>
                        <div class="grid md:grid-cols-2 md:gap-6">
                            <div class="relative z-0 w-full mb-6 group">
                                 
                                <x-form.datepicker label="{{__('The date the path was created')}}" model="date"   />

                  
                        </div>
                        <div class="relative z-0 w-full mb-6 group">

                            <x-native-select  label="{{__('Automatic deduction in case of absence and lateness')}}" wire:model="AutomaticDeduction">
                                <option value="1">{{__('yes')}}</option>
                                <option value="2">{{__('no')}}</option>
                            </x-native-select>  
                                 
                         </div>
                    </div>
                    <div class="grid md:grid-cols-2 md:gap-6">
                        <div class="relative z-0 w-full mb-6 group">
                             
                            <x-input wire:model="PeriodBetweenTwoVacations" type="number" right-icon="identification" label="{{__('Duration between two vacations (days)')}}"  />

              
                    </div>
                    <div class="relative z-0 w-full mb-6 group">

                        <x-input wire:model="SubmittingLeave" type="number" right-icon="identification" label="{{__('Submitting leave before it begins (number of days)')}}"  />

                             
                     </div>
                </div>
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 w-full mb-6 group">

                    
                    </div>

                </div>
                                
                    </div>
        </form>
    </section>
</div>