@props(['iconname','title'])

<div>
    <div class="flex items-center justify-between d p-4">
        <div class="flex">
            <span class="inline-flex dark:text-white font-bold">
                <x-icon name="{{$iconname}}" class="w-8 h-8 text-blue-500 mx-2" solid />
                <div class="h-8 border-r border-blue-500 mx-2"></div>
                {{$title}}
            </span>
    
        </div>
        <div class="flex space-x-3">
            <div class="flex space-x-3 items-center">
    
            </div>
        </div>
    
    
    </div>
    <hr class="h-px my-2 mx-2 bg-gray-200 border-0 dark:bg-gray-700">
</div>