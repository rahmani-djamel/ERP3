      

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
                                            <x-input wire:model="Name" right-icon="user" label="الاسم الكامل"  />
    
                                        </div>
                                        <div class="relative z-0 w-full mb-6 group">
                                            <x-input wire:model="CarteNumber" type="number" right-icon="identification" label="رقم الهوية"  />
    
                                        </div>
                                </div>
                                <div class="grid md:grid-cols-2 md:gap-6">
                                        <div class="relative z-0 w-full mb-6 group">
                                            <x-input wire:model="JobNumber" type="number" right-icon="user" label="الرقم الوظيفي"  />
                                        </div>
                                        <div class="relative z-0 w-full mb-6 group">
                                                
                                            <x-native-select label="الجنسية" wire:model="Nationality">
                                                <option>سعودي</option>
                                                <option>مصري</option>
                                            </x-native-select>
    
                                        </div>
                                </div>
                                <div class="grid md:grid-cols-2 md:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <x-input wire:model="email" right-icon="at-symbol" label="البريد الإلكتروني"  />
    
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                            
                                        <x-native-select label="النوع" wire:model="Gender">
                                            <option>ذكر</option>
                                            <option>انثى</option>
                                        </x-native-select>
    
                                    </div>
                                </div>
                                <div class="grid md:grid-cols-2 md:gap-6">
                                    <div class="z-30 w-full ">
                               
                                        <x-form.datepicker label="تاريخ الميلاد" model="DateOfBirth"   />
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <x-form.datepicker label="تاريخ المباشرة" model="Start_work"   />
                                
                                    </div>
                                </div>
                                <div class="grid md:grid-cols-2 md:gap-6">
                                        <div class="relative z-0 w-full mb-6 group">
                                            <x-input wire:model="Phone" class="text-left" right-icon="device-mobile"  type="number" label="رقم الهاتف"  />
    
                                        </div>
                                        <div class="relative z-0 w-full mb-6 group">
                                            <x-input wire:model="VacationDays"  right-icon="flag"  type="number" label="عدد ايام الإجازة"  />
    
                                        </div>
                                </div>
                                <div class="grid md:grid-cols-2 md:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <x-native-select label="نوع العقد" wire:model="ContratType">
                                            <option>محدد</option>
                                            <option>محدد</option>
                                        </x-native-select>
      
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <x-native-select label="التقييم" wire:model="Rating">
                                        <option >ممتاز</option>
                                        <option >جيد جداً</option>
                                        <option >جيد</option>
                                        <option >مقبول</option>
                                        <option >ضعيف</option>
                                        <option >لا يوجد</option>
        
                                      </x-native-select>
    
                                    </div>
                                </div>
                                <div class="grid md:grid-cols-2 md:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <x-form.datepicker label="تاريخ نهاية العقد" model="End"  />
    
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <x-native-select label="الحالة" wire:model="Status">
    
                                        <option >على رأس العمل</option>
                                        <option >فترة تجريبية</option>
                                        <option >إجازة عادية</option>
                                        <option >إضطرارية</option>
                                        <option >خرج ولم يعد</option>
                                        <option >مفصول</option>
                                        <option >إستقالة</option>
                                        <option >إنهاء خدمات</option>
                                        <option >إجازة مرضية انتهت ولم يباشر</option>
                                        <option >إجازة عادية انتهت ولم يباشر</option>
                                        <option >متدرب</option>
                                    </x-native-select>
    
                                    </div>
                                </div>
                                <div class="grid md:grid-cols-2 md:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <x-input right-icon="users" label="اسم صديق" model="FriendName"  />
    
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <x-input class="text-left" right-icon="device-mobile"  type="number" label=" رقم هاتف الصديق" model="FriendPhone" />
    
                                    </div>
                                </div>
                                <div class="grid md:grid-cols-2 md:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                            
                                        <x-native-select label="فئة التأمين" wire:model="InsuranceClass">
    
                                          <option  >VVIP</option>
                                          <option  >VIP</option>
                                          <option  >a</option>
                                          <option  >b</option>
                                          <option  >c</option>
                                        </x-native-select>
                  
                                      </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <x-form.datepicker label="تاريخ نهاية التأمين" model="InsuranceExpiryDate"  />
                                    </div>
                                    
                                </div>
    
                                <div class="grid md:grid-cols-2 md:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <x-input right-icon="library" label="اسم البنك" wire:model="BankName"  />
    
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <x-input right-icon="credit-card" label="الحساب البنكي" wire:model="BankNumber" />
    
                                    </div>
                                </div>
                                <div class="grid md:grid-cols-2 md:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <x-input right-icon="cash" label="الراتب الأساسي" wire:model="BasicSalary"  />
    
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <x-input right-icon="cash" label="بدلات أخرى" wire:model="OtherAllowances"  />
    
                                    </div>
                                </div>
                                <div class="grid md:grid-cols-2 md:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <x-input type="number" right-icon="chart-pie" wire:model="InsuranceRatio" label="نسبة التأمينات"  />
    
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <x-input type="number" right-icon="cash" wire:model="InsuranceSubscriptionAmount" label="مبلغ اشتراك التأمينات"  />
    
                                    </div>
                                </div>
                                <div class="grid md:grid-cols-2 md:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <x-input right-icon="cash" wire:model="HousingAllowance" label="بدل السكن"  />
    
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <x-input right-icon="cash" wire:model="transportationAllowance" label="بدل المواصلات"  />
                                    </div>
                                </div>
                                <div class="grid md:grid-cols-2 md:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <x-input type="number" wire:model="VacationSalary" right-icon="currency-dollar" label="رصيد الإجازة"  />
    
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <x-input type="number" wire:model="DurationOfTheWarningPeriod" right-icon="exclamation" label="مدة مهلة الإنذار"  />
    
                                    </div>
                                </div>
                                <div class="form-group mt-2 mb-3">
                                   <x-form.fileupload />
                                  
                                </div>
    
                                <x-textarea wire:model="LoanHistory" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"  label="سجل  القروض" />
    
        
                                <x-textarea wire:model="CovenantRecord" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"  label="سجل  العهد" />
    
                    
                                <x-native-select class="block mb-2" label="الفرع" wire:model="branch_id">
                                  @foreach (settings('branches') as $item)
                                  <option value="{{$item->id}}" >{{$item->name}}</option>
    
                                  @endforeach
    
                                  </x-native-select>
      
                    </div>
                </form>
    
                </section>
                @push('scripts')
                <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/datepicker.min.js"></script>
                @endpush
    </div>
    