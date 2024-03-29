      

<div>
<section class="mt-10">
    <form class="z-1" wire:submit="save">
                <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                    <!-- Start coding here -->

                    <div class="grid md:grid-cols-2 gap-4 mb-2">
                        <div class="flex items-center p-4 mb-4 text-sm  rounded-lg @if($this->counter_employees >0) text-blue-800 bg-blue-50 dark:text-blue-400 @else text-red-600 bg-red-200 dark:text-red-400 @endif dark:bg-gray-800 " role="alert">
                            <x-icon name="information-circle" class="flex-shrink-0 inline w-4 h-4 ltr:mr-3 rtl:ml-3" />

                            <span class="sr-only">Info</span>
                            <div>
                              <span class="font-medium">
                                {{__('You can add')}} {{$this->counter_employees}} {{__('Employee')}}
                              </span>
                            </div>
                          </div>

                          <div class="flex items-center p-4 mb-4 text-sm  rounded-lg @if($this->counter_admins >0) text-blue-800 bg-blue-50 dark:text-blue-400 @else text-red-600 bg-red-200 dark:text-red-400 @endif dark:bg-gray-800 " role="alert">
                            <x-icon name="information-circle" class="flex-shrink-0 inline w-4 h-4 ltr:mr-3 rtl:ml-3" />

                            <span class="sr-only">Info</span>
                            <div>
                              <span class="font-medium">
                                {{__('You can add')}} {{$this->counter_admins}} {{__('Adminstrators')}}
                              </span>
                            </div>
                          </div>
                          @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}<br>
                                    @endforeach
                                </div>
                          @endif

                          @if($this->branchesCounter)
                          <div class="flex items-center p-4 mb-4 text-sm  rounded-lg  text-red-600 bg-red-200 dark:text-red-400  dark:bg-gray-800 " role="alert">
                            <x-icon name="information-circle" class="flex-shrink-0 inline w-4 h-4 ltr:mr-3 rtl:ml-3" />

                            <span class="sr-only">Info</span>
                            <div>
                              <span class="font-medium">
                                {{__('Please add the company branches first')}}
                              </span>
                            </div>
                          </div>
                          @endif
                          
                    </div>
                  
                
                <div class="  grid md:grid-cols-4 md:gap-12 mb-4" >
                
                    <x-button lime label="{{__('save')}}" type="submit" class="font-semibold" />
                    <x-button href="{{route('company.dashboard.employee.index')}}" primary label="{{__('Back')}}" class="font-semibold" />
                     
                    @if($this->branchesCounter)      
                    <x-button href="{{route('company.dashboard.settings.branches')}}" primary label="{{__('Add New Branch')}}" class="font-semibold" />
                    @endif   
                </div>


                    
                            <div class="grid md:grid-cols-2 md:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <x-input wire:model="Name" right-icon="user" label="{{__('Employee Name')}}"  />

                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <x-input wire:model="CarteNumber" type="number" right-icon="identification" label="{{__('Card Number')}}"  />

                                    </div>
                            </div>
                            <div class="grid md:grid-cols-2 md:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <x-input wire:model="JobNumber" type="number" right-icon="user" label="{{__('Job number')}}"  />
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                            
                                        <x-native-select label="{{__('Nationality')}}" wire:model="Nationality">
                                            <option >{{__('Saudi')}}</option>
                                            <option selected>{{__('Egyptian')}}</option>
                                        </x-native-select>

                                    </div>
                            </div>
                            <div class="grid md:grid-cols-2 md:gap-6">
                                <div class="relative z-0 w-full mb-6 group">
                                    <x-input wire:model="email" right-icon="at-symbol" label="{{__('Email')}}"  />

                                </div>
                                <div class="relative z-0 w-full mb-6 group">
                                        
                                    <x-native-select label="{{__('Gender')}}" wire:model="Gender">
                                        <option value="male">{{('Male')}}</option>
                                        <option value="female">{{__('Female')}}</option>
                                    </x-native-select>

                                </div>
                            </div>
                            <div class="grid md:grid-cols-2 md:gap-6">
                                <div class="z-30 w-full ">
                           
                                    <x-form.datepicker label="{{__('Date of Birth')}}" model="DateOfBirth"   />
                                </div>
                                <div class="relative z-0 w-full mb-6 group">
                                    <x-form.datepicker label="{{__('start date')}}" model="Start_work"   />
                            
                                </div>
                            </div>
                            <div class="grid md:grid-cols-2 md:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <x-input wire:model="Phone" class="text-left" right-icon="device-mobile"  type="number" label="{{__('Phone')}}"  />

                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <x-input wire:model="VacationDays" placeholder="{{__('Number of days due per month')}}"  right-icon="flag"  type="number" label="{{__('Vacation Days')}}"  />
                                    </div>
                            </div>
                            <div class="grid md:grid-cols-2 md:gap-6">
                                <div class="relative z-0 w-full mb-6 group">
                                    <x-native-select label="{{__('Contract Type')}}" wire:model="ContratType">
                                        <option value="designed">{{__('specified')}}</option>
                                        <option value="not designed">{{__('undefined')}}</option>
                                    </x-native-select>
  
                                </div>
                                <div class="relative z-0 w-full mb-6 group">
                                    <x-native-select label="{{__('Rating')}}" wire:model="Rating">
                                        <option value="excellent">{{__('Excellent')}}</option>
                                        <option value="very_good">{{__('Very Good')}}</option>
                                        <option value="good">{{__('Good')}}</option>
                                        <option value="acceptable">{{__('Acceptable')}}</option>
                                        <option value="poor">{{__('Poor')}}</option>
                                        <option value="none">{{__('None')}}</option>
    
                                  </x-native-select>

                                </div>
                            </div>
                            <div class="grid md:grid-cols-2 md:gap-6">
                                <div class="relative z-0 w-full mb-6 group">
                                    <x-form.datepicker label="{{__('Contract end date')}}" model="End"  />

                                </div>
                                <div class="relative z-0 w-full mb-6 group">
                                    <x-native-select label="{{__('status')}}" wire:model="Status">

                                    <option value="On the job">{{__('On the job')}}</option>
                                    <option value="Trial Period">{{ __('Trial Period') }}</option>
                                    <option value="Regular Leave">{{ __('Regular Leave') }}</option>
                                    <option value="Compulsory Leave">{{ __('Compulsory Leave') }}</option>
                                    <option value="Left and Not Returned">{{ __('Left and Not Returned') }}</option>
                                    <option value="Dismissed">{{ __('Dismissed') }}</option>
                                    <option value="Resignation">{{ __('Resignation') }}</option>
                                    <option value="Termination of Service">{{ __('Termination of Service') }}</option>
                                    <option value="Sick Leave Ended and Not Reported">{{ __('Sick Leave Ended and Not Reported') }}</option>
                                    <option value="Regular Leave Ended and Not Reported">{{ __('Regular Leave Ended and Not Reported') }}</option>
                                    <option value="Trainee">{{ __('Trainee') }}</option>
                                </x-native-select>

                                </div>
                            </div>
                            <div class="grid md:grid-cols-2 md:gap-6">
                                <div class="relative z-0 w-full mb-6 group">
                                    <x-input right-icon="users" label="{{__('A friend in emergency')}}" model="FriendName"  />

                                </div>
                                <div class="relative z-0 w-full mb-6 group">
                                    <x-input class="text-left" right-icon="device-mobile"  type="number" label="{{__('Emergency Contact')}}" model="FriendPhone" />

                                </div>
                            </div>
                            <div class="grid md:grid-cols-2 md:gap-6">
                                <div class="relative z-0 w-full mb-6 group">
                                        
                                    <x-native-select label="{{__('Insurance Class')}}" wire:model="InsuranceClass">
                                        <option value="VVIP">{{ __('VVIP') }}</option>
                                        <option value="VIP">{{ __('VIP') }}</option>
                                        <option value="a">{{ __('a') }}</option>
                                        <option value="b">{{ __('b') }}</option>
                                        <option value="c">{{ __('c') }}</option>
                                    </x-native-select>
              
                                  </div>
                                <div class="relative z-0 w-full mb-6 group">
                                    <x-form.datepicker label="{{__('Insurance Expiry Date')}}" model="InsuranceExpiryDate"  />
                                </div>
                                
                            </div>

                            <div class="grid md:grid-cols-2 md:gap-6">
                                <div class="relative z-0 w-full mb-6 group">
                                    <x-input right-icon="library" label="{{__('Bank name')}}" wire:model="BankName"  />

                                </div>
                                <div class="relative z-0 w-full mb-6 group">
                                    <x-input right-icon="credit-card" label="{{__('Bank Number')}}" wire:model="BankNumber" />

                                </div>
                            </div>
                            <div class="grid md:grid-cols-2 md:gap-6">
                                <div class="relative z-0 w-full mb-6 group">
                                    <x-input type="number" right-icon="cash" label="{{__('Basic Salary')}}" wire:model="BasicSalary"  />

                                </div>
                                <div class="relative z-0 w-full mb-6 group">
                                    <x-input type="number" right-icon="cash" label="{{__('Other Allowances')}}" wire:model="OtherAllowances"  />

                                </div>
                            </div>
                            <div class="grid md:grid-cols-2 md:gap-6">
                                <div class="relative z-0 w-full mb-6 group">
                                    <x-input type="number" right-icon="chart-pie" wire:model="InsuranceRatio" label="{{__('Insurance Ratio')}}"  />

                                </div>
                                <div class="relative z-0 w-full mb-6 group">
                                    <x-input type="number" right-icon="cash" wire:model="InsuranceSubscriptionAmount" label="{{__('Insurance Subscription Amount')}}"  />

                                </div>
                            </div>
                            <div class="grid md:grid-cols-2 md:gap-6">
                                <div class="relative z-0 w-full mb-6 group">
                                    <x-input type="number" right-icon="cash" wire:model="HousingAllowance" label="{{__('Housing Allowance')}}"  />

                                </div>
                                <div class="relative z-0 w-full mb-6 group">
                                    <x-input type="number" right-icon="cash" wire:model="transportationAllowance" label="{{__('Transportation Allowance')}}"  />
                                </div>
                            </div>
                            <div class="grid md:grid-cols-2 md:gap-6">
                                <div class="relative z-0 w-full mb-6 group">
                                    <x-input type="number" wire:model="VacationSalary" right-icon="flag" label="{{__('Vacation Salary')}}"  />

                                </div>
                                <div class="relative z-0 w-full mb-6 group">
                                    <x-input type="number" wire:model="DurationOfTheWarningPeriod" right-icon="exclamation" label="{{__('Duration Of The Warning Period')}}"  />

                                </div>
                            </div>
                            <div class="form-group mt-2 mb-3">
                               <x-form.fileupload />
                              
                            </div>

                            <x-textarea wire:model="LoanHistory" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"  label="{{__('Loan History')}}" />

    
                            <x-textarea wire:model="CovenantRecord" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"  label="{{__('Covenant Record')}}" />
                        <div class="grid md:grid-cols-2 md:gap-6">
                            <div class="relative z-0 w-full mb-6 group">


                
                                <x-native-select class="block mb-2" label="{{__('Select the branch')}}" wire:model="branch_id">
                                @foreach ($branches as $item)
                                <option value="{{$item->id}}" >{{$item->name}}</option>

                                @endforeach

                              </x-native-select>
                            </div>
                            <div class="relative z-0 w-full mb-6 group">
                                <x-native-select class="block mb-2" label="{{__('Role')}}" wire:model="is_adminstaror">
                                    <option value="0" >موظف</option>
                                    <option value="1" >إداري</option>

                                </x-native-select>



                            </div>
                        </div>
  
                </div>
            </form>

            </section>
            @push('scripts')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/datepicker.min.js"></script>
            @endpush
</div>
