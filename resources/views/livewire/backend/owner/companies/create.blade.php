<main>
    <div>
        <section class="pt-10" >
            
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12 shadow-2xl ">
             <!-- Start coding here -->
             <form class="pt-3" wire:submit="save">
                <x-button href="{{route('owner.dashboard.packages.index')}}" info icon="arrow-{{config('direction') == 'ltr' ? 'left' : 'right'}}" label="{{__('Back')}}" class="font-semibold my-2" />
                
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 w-full mb-6 group">
                        <x-input wire:model="Name" right-icon="office-building" label="{{__('Company name')}}"  />
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <x-input wire:model="owner_name" right-icon="user" label="{{__('Company owner')}}"  />
                    </div>
            </div>
            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full mb-6 group">
                    <x-input type="number" wire:model="phone" right-icon="device-mobile" label="{{__('Phone')}}"  />
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <x-input type="email" wire:model="email" right-icon="at-symbol" label="{{__('Email')}}"  />
                </div>
           </div>
           <div class="grid md:grid-cols-2 md:gap-6">
            <div class="relative z-0 w-full mb-6 group">
                <x-native-select label="{{__('Package')}}" wire:model="package">
                    <option value=""></option>
                    @forelse (settings('packages') as $item)
                    <option value="{{$item->id}}">{{__($item->name)}}</option>
                    @empty
                    <option value="undfiend" disabled></option>

                        
                    @endforelse
            </x-native-select>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <div class="flex items-center lg:mt-8">
                    <input  type="checkbox"
                    wire:model.live="is_trial"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500
                     dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700
                      dark:border-gray-600">
                    <label for="default-checkbox" class="ltr:ml-2 rtl:mr-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('Testing period')}}</label>
                </div>
                @error('is_trial')
                  <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>
       </div>
       <div class="grid md:grid-cols-2 md:gap-6"  x-data="{ open: @entangle('is_trial') }">

        @if ($is_trial)

        <div class="relative z-0 w-full mb-6 group">
            <x-input type="number" wire:model="days" right-icon="adjustments" label="{{__('Days')}}"  />
        </div>
            
        @endif

    

        <div class="relative z-0 w-full mb-6 group lg:mt-5">
            <x-button type="submit" positive label="{{__('save')}}" />
        </div>
   </div>
             </form>
            </div>
        </section>
    
    </div>
</main>
