@props(['label','model'])
<div>
    
    <label class="block text-gray-700 dark:text-white text-sm font-bold mb-1" for="{{$label}}">
        {{$label}}
      </label>

  
<div class="relative">
<div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">

</div>
<x-input type="date"  wire:model.live="{{$model}}" 
{{$attributes}}

class="bg-gray-50 border border-gray-300
 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block
  w-full pl-10 px-2.5 dark:bg-gray-700 dark:border-gray-600
 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
  dark:focus:border-blue-500" />
</div>
<div class="text-red-500">@error('{{$model}}') 
    <p class="mt-2 text-sm text-negative-600">
        {{ $message }} 

    </p>
    @enderror
</div>


</div>