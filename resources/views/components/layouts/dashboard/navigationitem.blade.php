@props(['url', 'icon', 'text'])

<li>
    <a href="{{ route($url) }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-[#011ab8] hover:text-white dark:hover:bg-blue-700 group">
        <x-icon name="{{$icon}}" class="w-5 h-5 text-gray-500 transition duration-75
         dark:text-gray-400 group-hover:text-white dark:group-hover:text-white" />

        <span class="mr-3">{{ __($text) }}</span>
    </a>
</li>
