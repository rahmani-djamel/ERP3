@props(['data','keysToDisplay'])
@php

$except = ['vacation']
    
@endphp
<tbody>

    @forelse ($data as $item)
    <tr class="border-b dark:border-gray-700 dark:text-white">
        @foreach ($keysToDisplay as $ke)
            <td class="px-4 py-3">{{ $item->$ke }}</td>
        @endforeach
        @if (!in_array($this->key,$except))
        <td class="px-4 py-3 flex items-center justify-end">
            <x-button.circle                           
            href="{{route($this->key.'.edit',[$this->key => $item])}}"
            icon="pencil" class="mx-2" />
            <x-button.circle negative icon="trash" wire:click="delete({{$item}})" data-modal-target="popup-modal" data-modal-toggle="popup-modal" />

        </td>
            
        @endif

    </tr>
@empty
    <tr>
        <td colspan="{{ count($keysToDisplay) }}">No employees found.</td>
    </tr>

    

@endforelse

</tbody>