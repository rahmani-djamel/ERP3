<?php

namespace App\Livewire\Backend\Owner\Companies;

use App\Models\Company;
use Livewire\Attributes\On;
use Livewire\Component;
use WireUi\Traits\Actions;

class Index extends Component
{
    use Actions;
    public $company;

    

    #[On('Company-Edited')] 
    public function updatePostList($id)
    {
        redirect()->route('owner.dashboard.companies.edit',['company' => $id]);
    }

    #[On('Company-Delete')]
    public function deleting($id)
    {
       

        $this->company = Company::findorfail($id);

     
                // use a full syntax
        // use a full syntax
        $this->dialog()->confirm([
            'title'       => __('Are you Sure ?'),
            'description' => __('Delete the Company').'  '.__($this->company->name),
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

    public function cancel()
    {

    }

    public function save()
    {
        $this->company->owner->delete();
        $this->company->delete();


        $this->dialog()->success(
            $title = __('Edited successfully'),
            $description = __('Successfully edited')
        );

        $this->dispatch('refresh');
    }
    
    public function render()
    {
        return view('livewire.backend.owner.companies.index')->layout('layouts.employee');
    }
}
