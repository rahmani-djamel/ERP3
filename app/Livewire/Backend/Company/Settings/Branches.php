<?php

namespace App\Livewire\Backend\Company\Settings;

use App\Models\Branche;
use Livewire\Component;
use WireUi\Traits\Actions;

class Branches extends Component
{
    use Actions;
    public $selected;
    public $Bname;
    public $address;
    public $map;
    public $id;
    public $display;

    //for new
    public $NBname;
    public $Naddress;
    public $Nmap;

    public function rules()
    {
        return [
            'Bname' => 'required|min:5|max:40',
            'address' => 'required|min:5|max:100',
            'map' => 'required|url:https'

        ];
    }

    public function selection($item)
    {
        $this->selected = $item;
        $this->display = $item['name'];
        $this->id = $item['id'];
    }
    public function save()
    {
        $this->validate();
       // dd('hello world');


        $branche = Branche::findorfail($this->id);
        $branche->name = $this->Bname;
        $branche->place = $this->address;
        $branche->map = $this->map;

        $branche->save();


        settings('branches',true);

        $this->dialog()->success(
            $title = 'تم التعديل',
            $description = 'تم التعديل بنجاح'
        );

        $this->dispatch('refresh');


    }
    public function deleting()
    {
        $branche = Branche::findorfail($this->id);

        $branche->delete();

        settings('branches',true);

        $this->dialog()->success(
            $title = 'تم الحذف',
            $description = 'تم الحذف بنجاح'
        );

        $this->dispatch('refresh');

        
    }
    public function saveTWO()
    {
        $validated = $this->validate([ 
            'NBname' => 'required|min:5|max:40',
            'Naddress' => 'required|min:5|max:100',
            'Nmap' => 'required|url:https'
        ]);

        $branche = new Branche();
        $branche->name = $this->NBname;
        $branche->place = $this->Naddress;
        $branche->map = $this->Nmap;

        $branche->save();


        settings('branches',true);

        $this->dialog()->success(
            $title = 'تمت الاضافة',
            $description = 'تمت اضافة الفرع بنجاح'
        );
    }
    
    public function render()
    {
        return view('livewire.backend.company.settings.branches');
    }
}
