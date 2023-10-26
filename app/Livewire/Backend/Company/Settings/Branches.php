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
    public $lat;
    public $long;
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
            'map' => 'required|url:https',
            'lat' => 'required|numeric', // 'lat' should be a numeric value
            'long' => 'required|numeric', // 'long' should be a numeric value
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
        $branche->lat = $this->lat;
        $branche->long = $this->long;

        $branche->save();


        settings('branches',true);


        $this->dialog()->success(
            $title = __('Edited successfully'),
            $description = __('Successfully edited')
        );

        $this->dispatch('refresh');


    }
    public function deleting()
    {
        $branche = Branche::findorfail($this->id);

        $branche->delete();

        settings('branches',true);

        $this->dialog()->success(
            $title = __('Deleted successfully'),
            $description = __('Deleted successfully')
        );
        

        $this->dispatch('refresh');

        
    }
    public function saveTWO()
    {
        $validated = $this->validate([ 
            'NBname' => 'required|min:5|max:40',
            'Naddress' => 'required|min:5|max:100',
            'Nmap' => 'required|url:https',
            'lat' => 'required|numeric', // 'lat' should be a numeric value
            'long' => 'required|numeric', // 'long' should be a numeric value
        ]);

        $branche = new Branche();
        $branche->name = $this->NBname;
        $branche->place = $this->Naddress;
        $branche->map = $this->Nmap;
        $branche->lat = $this->lat;
        $branche->long = $this->long;

        $branche->save();


        settings('branches',true);

        $this->dialog()->success(
            $title = __('Added successfully'),
            $description = __('Branch added successfully')
        );
        
    }

    public function mount()
    {
      /*   $test =  $this->distance(32.9697, -98.53505, 32.9696, -98.53506, "M") . " Meter<br>";

       dd($test);*/
    }

    
    
    public function render()
    {
        return view('livewire.backend.company.settings.branches');
    }
}
