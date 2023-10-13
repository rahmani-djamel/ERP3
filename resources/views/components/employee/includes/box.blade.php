@props(['text','number','color'])
<div class="border border-gray-300 rounded-md p-4 flex justify-between items-center dark:text-white">
    <div class="text-left">
        <!-- Your text content on the left -->
        {{$text}}
    </div>
    <div class="text-right font-bold">
        <!-- Your number content on the right -->
        <span class="inline-flex items-center rounded-md
         bg-{{$color}}-500 px-2 py-1 text-xs font-medium text-white ring-1
         ring-inset ring-yellow-600/20">{{$number}}</span>
    </div>
</div>
