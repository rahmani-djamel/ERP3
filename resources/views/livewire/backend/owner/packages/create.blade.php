<main>
    <div>
        <section class="pt-10" wire:submit="save">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12 shadow-2xl ">
             <!-- Start coding here -->
             <form class="pt-3">
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 w-full mb-6 group">
                        <x-input wire:model="Name" right-icon="annotation" label="{{__('Package Name')}}"  />
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <x-input wire:model="Name_English" right-icon="annotation" label="{{__('Package name in English')}}"  />
                    </div>
            </div>
            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full mb-6 group">
                    <x-input type="number" wire:model="price" right-icon="currency-dollar" label="{{__('Price')}}"  />
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <x-input type="number" wire:model="days" right-icon="adjustments" label="{{__('Days')}}"  />
                </div>
           </div>
           <div class="grid md:grid-cols-2 md:gap-6">
            <div class="relative z-0 w-full mb-6 group">
                <x-input type="number" wire:model="N_Employee" right-icon="adjustments" label="{{__('Number Of Employees')}}"  />
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <x-input type="number" wire:model="N_Adminstrators" right-icon="adjustments" label="{{__('Number of administrators')}}"  />
            </div>
       </div>
       <div class="grid md:grid-cols-2 md:gap-6">
        <div class="relative z-0 w-full mb-6 group">
            <x-input type="number" wire:model="N_Branches" right-icon="adjustments" label="{{__('Number of branches')}}"  />
        </div>
        <div class="relative z-0 w-full mb-6 group lg:mt-5">
            <x-button type="submit" positive label="{{__('save')}}" />
        </div>
   </div>
             </form>
            </div>
        </section>
    
    </div>
</main>
