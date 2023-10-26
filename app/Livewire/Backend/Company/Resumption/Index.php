<?php

namespace App\Livewire\Backend\Company\Resumption;

use App\Models\ResumeWork;
use Livewire\Component;
use WireUi\Traits\Actions;

class Index extends Component
{
    use Actions;
    public $requestes;
    public $selected;

    public function mount()
    {
        $this->requestes = ResumeWork::where('status',0)->get();
    }
    public function selection($item)
    {
        $this->selected = $item;

    }
    public function save()
    {

        $item = ResumeWork::find($this->selected['id']);

        $item->status = 1;

        $item->save();


        $this->dialog()->success(
            $title = __('Edited successfully'),
            $description = __('Successfully edited')
        );

        $this->dispatch('refresh');
    }
    public function render()
    {
        return view('livewire.backend.company.resumption.index');
    }
}
