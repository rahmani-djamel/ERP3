<?php

namespace App\Livewire\Backend\Owner\Packages;

use App\Models\Package;
use Illuminate\Support\Facades\File;
use Livewire\Attributes\On;
use Livewire\Component;
use WireUi\Traits\Actions;

class Index extends Component
{
    use Actions;
    public $package;

    public function mount()
    {
        //settings('packages',true);
    }

    #[On('PackageEdited')] 
    public function updatePostList($id)
    {
        redirect()->route('owner.dashboard.packages.edit',['package' => $id]);
    }
    #[On('Package-Delete')]
    public function deleting($id)
    {
       

        $this->package = Package::findorfail($id);

     
                // use a full syntax
        // use a full syntax
        $this->dialog()->confirm([
            'title'       => __('Are you Sure ?'),
            'description' => __('Delete the Package ').__($this->package->name),
            'icon'        => 'error',
            'accept'      => [
                'label'  => __('Delete'),
                'method' => 'save',
                'color' => 'negative' 
            ],
            'reject' => [
                'label'  => __('cancel'),
                'method' => 'cancel',
            ],
        ]);
    }
    public function save()
    {
        $this->package->delete();


        $this->dialog()->success(
            $title = __('Edited successfully'),
            $description = __('Successfully edited')
        );

        settings('packages',true);

        $this->dispatch('refresh');




    }
    public function cancel()
    {

    }
    public function render()
    {
        return view('livewire.backend.owner.packages.index')->layout('layouts.employee');
    }
}
