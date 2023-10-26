<?php

namespace App\Livewire\Backend\Company\AskPermission;

use App\Models\AskPermission;
use Livewire\Component;
use WireUi\Traits\Actions;

class Index extends Component
{
    use Actions;

    public $permissions;
    public $selected;


    public function mount()
    {
        $this->permissions = AskPermission::where('status',0)->get();
    }
    public function selection($item)
    {
        $this->selected = $item;
    }
    public function save()
    {
        $permission = AskPermission::findorfail($this->selected['id']);
        $permission->status = 1;
        $permission->save();

        $this->dialog()->success(
            $title = __('Edited successfully'),
            $description = __('Successfully edited')
        );

    }
    public function cancel()
    {

        $permission = AskPermission::findorfail($this->selected['id']);
        $permission->status = 2;
        $permission->save();

        $this->dialog()->success(
            $title = __('Edited successfully'),
            $description = __('Successfully edited')
        );

    }
    public function render()
    {
        return view('livewire.backend.company.ask-permission.index');
    }
}
