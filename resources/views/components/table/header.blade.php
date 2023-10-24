@props(['items'])

@php

$except = ['vacation']
    
@endphp

<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:text-white dark:bg-gray-700">
    <tr>
        @foreach ($items as $item)

        <th scope="col" class="px-4 py-3">{{$item}}</th>

        @endforeach
        @if (!in_array($this->key,$except))

        <th scope="col" class="px-4 py-3">{{__('actions')}}</th>
       @endif
    </tr>
</thead>