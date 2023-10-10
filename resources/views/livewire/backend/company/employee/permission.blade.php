
<div>
    <section class="mt-10">
                    
        <form class="mx-2" wire:submit="save">

          
   
              <div>
                  
          <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">{{__('Employee Permissions')}} - {{$employee->Name}}</h3>
          @php $count = []; @endphp
          <!-- col-span-2 -->
          <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
              @foreach (settings('Permissions') as  $key => $item)
          
              @if  (!in_array($item->class, $count)) 
                <div class="md:col-span-4">
                  <h3 class="font-semibold text-blue-500">{{ __($item->class) }}</h3>
              </div>
              @php array_push($count, $item->class);
              @endphp
            @endif
              
              <div>
                <label class="inline-flex items-center">
                  <input id="laravel-checkbox-list" type="checkbox" wire:model="permissions.{{ $item->id }}" wire:key="permissions.{{ $item->id }}" value="" class="w-4 h-4 text-navigation rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                  <label for="laravel-checkbox-list" class="w-full py-3 mx-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__($item->display_name)}}</label>
                </label>
              </div>

              @endforeach
            </div>
            
          
              </div>
              
          
              <x-button type info label="{{__('Submit')}}" />
            </form>
    </section>
</div>