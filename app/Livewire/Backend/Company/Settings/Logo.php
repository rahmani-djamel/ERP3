<?php

namespace App\Livewire\Backend\Company\Settings;

use App\Models\File;
use App\Models\Setting;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use WireUi\Traits\Actions;

class Logo extends Component
{
    use WithFileUploads,Actions;

    #[Rule('required|mimes:png|max:2048')] // 1MB Max
    public $logo;

    #[Rule('required|mimes:png|max:2048')] // 1MB Max
    public $seal;


    public function updating($proprety,$value)
    {
       // dd($proprety);
        if ($proprety == 'logo') {
                    // Create a new setting model

            
            # code...
        } else {
            # code...
            dd("hello world 2");

        }
        
    }



    public function render()
    {
        return view('livewire.backend.company.settings.logo');
    }
}
