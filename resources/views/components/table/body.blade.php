@props(['data','keysToDisplay'])
<tbody>

    @forelse ($data as $item)
    <tr class="border-b dark:border-gray-700 dark:text-white">
        @foreach ($keysToDisplay as $key)
            <td class="px-4 py-3">{{ $item->$key }}</td>
        @endforeach
        <td class="px-4 py-3 flex items-center justify-end">
            <x-button.circle                           
            href="{{route('employee.edit',[$this->key => $item])}}"
            icon="pencil" class="mx-2" />
            <x-button.circle negative icon="trash" wire:click="delete({{$item}})" data-modal-target="popup-modal" data-modal-toggle="popup-modal" />

        </td>
    </tr>
@empty
    <tr>
        <td colspan="{{ count($keysToDisplay) }}">No employees found.</td>
    </tr>

    

@endforelse

</tbody>