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
    public $branches;
    public $counter_branches;

    //for new
    public $NBname;
    public $Naddress;
    public $Nmap;

    //for edit
    public $Elong = '';
    public $Elat = '';

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
    

    public function selection($item,$edit=0)
    {
        //dd($item);
        if ($edit != 0) {
            //dd($item);
            $this->Elong = $item['long'];
            $this->Elat = $item['lat'];
            $this->Bname = $item['name'];
            $this->address = $item['place'];
            $this->map =$item['map'];


        } 
        
        $this->selected = $item;
        $this->display = $item['name'];
        $this->id = $item['id'];
    }
    public function save()
    {
        $this->validate([ 
            'Bname' => 'required|min:5|max:40',
            'address' => 'required|min:5|max:100',
            'map' => 'required|url:https',
            'Elat' => 'required|numeric', // 'lat' should be a numeric value
            'Elong' => 'required|numeric', // 'long' should be a numeric value
        ]);
   


        $branche = Branche::findorfail($this->id);
        $branche->name = $this->Bname;
        $branche->place = $this->address;
        $branche->map = $this->map;
        $branche->lat = $this->Elat;
        $branche->long = $this->Elong;

        $branche->save();




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

        $this->getBranches();


        $this->counter_branches++;



        $this->dialog()->success(
            $title = __('Deleted successfully'),
            $description = __('Deleted successfully')
        );
        
        
    }
    public function saveTWO()
    {
        if ($this->counter_branches > 0) {
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
            
            $branche->company_id = $this->company()->id;
            $branche->save();
    
            $this->dialog()->success(
                $title = __('Added successfully'),
                $description = __('Branch added successfully')
            );

            $this->dispatch('refresh');




            # code...
        } else {

            $this->dialog()->info(
                $title = __('The operation was not completed successfully'),
            );        
        }



        
    }

    public function company()
    {
        $user = auth()->user();

        if ($user->hasRole('manger')) {
           return $user->company;
        } else {
            return $user->employee->company;
        }
    }

    public function mount()
    {
        $id_company = $this->company()->id;

        $this->getBranches();

        $this->counter_branches  =  $this->company()->N_branches - Branche::counter($id_company);


        // Initialize properties with default or retrieved values
        $this->Bname = '';
        $this->address = '';
        $this->map = '';
        $this->Elat = '';
        $this->Elong = '';
               // ...
    }

    public function getBranches()
    {
        $this->branches = Branche::where('company_id',$this->company()->id)->get();

    }

    
    
    public function render()
    {
        return view('livewire.backend.company.settings.branches');
    }
}
