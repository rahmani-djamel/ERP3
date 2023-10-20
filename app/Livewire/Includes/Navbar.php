<?php

namespace App\Livewire\Includes;

use App\Models\Language;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;
use WireUi\Traits\Actions;

class Navbar extends Component
{
    use Actions;

    public $fixed = true;
    public $flag;
    public $direction;
    public function mount($fixed)
    {
        $this->fixed = $fixed;
        $this->flag = Cookie::get('country') ?: "SA";

    }
    public function changelang($item)
    {
        $language = Language::where('language_code', $item['language_code'])->where('is_active', true)->first();

        // Check if language exists
        if (!$language) {

           

            return;

        }

        // Set default language

        $direction = "rtl";

        if ($language->force_rtl == 0) {
            $direction = "ltr";
        }
        

        
     //   session()->put('locale', $language->language_code);
     Cookie::queue( Cookie::make('lang', $language->language_code, 1051200) );
     Cookie::queue( Cookie::make('direction', $direction, 1051200) );
     Cookie::queue( Cookie::make('country', $language->country_code, 1051200) );



    
     $this->dialog()->success(
        $title = 'تم التعديل',
        $description = 'تم التعديل بنجاح'
    );

        // Refresh the page
        $this->dispatch('refresh');

    }
    public function render()
    {
        return view('livewire.includes.navbar');
    }
}
