      

<div>
    <section class="mt-10">
        <form class="z-1" wire:submit="save">
                    <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                        <!-- Start coding here -->
                      
                    
                    <div class="  grid md:grid-cols-4 md:gap-12 mb-4" >
                    
                        <x-button lime label="حفظ" type="submit" class="font-semibold" />
                        <x-button href="{{route('settings.index')}}" primary label="رجوع" class="font-semibold" />
                                  
                    </div>
    
    
                        
                                <div class="grid md:grid-cols-2 md:gap-6">
                                        <div class="relative z-0 w-full mb-6 group">
                                            <x-native-select label="عدد أيام الشهر" wire:model="DaysMonth">
                                                <option value="1">30 يوم</option>
                                                <option value="2">الفعلية</option>
                                            </x-native-select>    
                                        </div>
                                        <div class="relative z-0 w-full mb-6 group">
                                           <x-input wire:model="MinVacationDays" type="number" right-icon="identification" label="اقل مدة إجازة ( يوم )"  />
                                        </div>
                                </div>
                                <div class="grid md:grid-cols-2 md:gap-6">
                                        <div class="relative z-0 w-full mb-6 group">
                                             
                                            <x-native-select multiple label="الجنسيات" wire:model="nationalities">
                                                <option>السعودية</option>
                                                <option>مصر</option>
                                                <option>الكويت</option>
                                                <option>الإمارات</option>


                                            </x-native-select>  
                              
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                             
                                        <x-native-select multiple label="أيام الإجازة الأسبوعية ( يوم )" wire:model="VacationDay">
                                            <option>السبت</option>
                                            <option>الأحد</option>
                                            <option>الاثنين</option>
                                            <option>الثلاثاء</option>
                                            <option>الأربعاء</option>
                                            <option>الخميس</option>
                                            <option>الجمعة</option>
                                        </x-native-select>  
                          
                                     </div>
                                </div>

                                <div class="grid md:grid-cols-2 md:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                         
                                        <x-input wire:model="ValidityOfAnnualLeave" type="number" right-icon="identification" label="صلاحية الأجازة السنوية"  />

                          
                                </div>
                                <div class="relative z-0 w-full mb-6 group">
                                         
                                    <x-native-select  label="كفالة للمقترض" wire:model="Guarantee">
                                        <option value="1">نعم</option>
                                        <option value="2">لا</option>
                                    </x-native-select>  
                      
                                 </div>
                            </div>
                            <div class="grid md:grid-cols-2 md:gap-6">
                                <div class="relative z-0 w-full mb-6 group">
                                     
                                    <x-native-select  label="هل سيتم دفع راتب مقدم للموظفين؟" wire:model="WillPay">
                                        <option>نعم</option>
                                        <option>لا</option>
                                    </x-native-select>  
                      
                            </div>
                            <div class="relative z-0 w-full mb-6 group">
                                     
                                <x-input wire:model="MaximumVacationEmployees" type="number" right-icon="identification" label="عدد الموظفين في الاقصى للتمتع بالاجازة في وقت واحد"  />
                             </div>
                        </div>
                        <div class="grid md:grid-cols-2 md:gap-6">
                            <div class="relative z-0 w-full mb-6 group">
                                 
                                <x-form.datepicker label="تاريخ إنشاء المسير" model="date"   />

                  
                        </div>
                        <div class="relative z-0 w-full mb-6 group">

                            <x-native-select  label="الخصم التلقائي عند الغياب والتأخير" wire:model="AutomaticDeduction">
                                <option value="1">نعم</option>
                                <option value="2">لا</option>
                            </x-native-select>  
                                 
                         </div>
                    </div>
                    <div class="grid md:grid-cols-2 md:gap-6">
                        <div class="relative z-0 w-full mb-6 group">
                             
                            <x-input wire:model="PeriodBetweenTwoVacations" type="number" right-icon="identification" label="المدة بين إجازتين ( يوم )"  />

              
                    </div>
                    <div class="relative z-0 w-full mb-6 group">

                        <x-input wire:model="SubmittingLeave" type="number" right-icon="identification" label="تقديم الأجازة قبل بدايتها ب (عدد الأيام)"  />

                             
                     </div>
                </div>
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 w-full mb-6 group">
                        <x-native-select  label="موافقة تلقائية عند إنشاء تعريف من حساب موظف" wire:model="AutomaticApproval">
                            <option value="1">نعم</option>
                            <option value="2"> لا, يجب الرجوع للمشرف</option>
                        </x-native-select>  
                    
                    </div>

                </div>
                                
                    </div>
        </form>
    </section>
</div>