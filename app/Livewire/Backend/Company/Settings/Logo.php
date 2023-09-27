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


    public function save()
    {
  
        $setting =  Setting::first();
       // dd($proprety);
        if ($this->logo != null) {
            $fileOne = new File();
            // Handle the logo upload
            $logo = $this->logo;
            $logoFileName = "logo.png";
            $logoFilePath = 'settings/';
        
            // Upload the logo image to the desired location
            $logoPath = Storage::disk('local')->putFileAs($logoFilePath, $logo, $logoFileName, 'public');

            
    
        // Set the path of the image in the database
        $fileOne->path = $logoPath;
        $fileOne->type =  "png";
        $setting->files()->save($fileOne);

        $this->dialog()->success(
            $title = 'تم التعديل',
            $description = 'تم التعديل بنجاح'
        );

        } 
        if ($this->seal != null) {

            $fileOne = new File();
            // Handle the logo upload
            $logo = $this->seal;
            $logoFileName = "seal.png";
            $logoFilePath = 'settings/';
        
            // Upload the logo image to the desired location
            $logoPath = Storage::disk('local')->putFileAs($logoFilePath, $logo, $logoFileName, 'public');

            
    
        // Set the path of the image in the database
        $fileOne->path = $logoPath;
        $fileOne->type =  "png";
        $setting->files()->save($fileOne);

        $this->dialog()->success(
            $title = 'تم التعديل',
            $description = 'تم التعديل بنجاح'
        );


        }
        
    }



    public function render()
    {
        return view('livewire.backend.company.settings.logo');
    }
}
