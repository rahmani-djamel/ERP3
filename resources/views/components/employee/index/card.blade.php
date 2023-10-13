@props(['link', 'iconName', 'title'])


<div class="max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 text-center  md:mt-0 mt-2">
 <a href="{{route($link)}}">
    <div class="flex items-center justify-center mb-3">
        <x-icon name="{{$iconName}}" class="w-7 h-7 text-blue-500 dark:text-blue-400" />
    </div>
   
        <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">{{$title}}</h5>
    </a>
</div>
