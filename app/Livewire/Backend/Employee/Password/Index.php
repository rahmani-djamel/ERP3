<?php

namespace App\Livewire\Backend\Employee\Password;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use WireUi\Traits\Actions;

class Index extends Component
{
    use Actions;

    public $user;
    public $password;
    public $new_password;
    public $confirmation;

    public function mount()
    {
        $this->user = auth()->user();
    } 

    public function updatePassword()
    {
        $this->validate([
            'password' => 'required',
            'new_password' => 'required|min:6',
            'confirmation' => 'required|same:new_password',
        ]);

        if (password_verify($this->password, $this->user->password)) {
            $this->user->update([
                'password' => Hash::make($this->new_password),
            ]);

            $this->password = '';
            $this->new_password = '';
            $this->confirmation = '';

            $this->dialog([
                'title'       => __('sucess'),
                'description' => __('The password has been changed successfully'),
                'icon'        => 'success',
                'close'      => [
                    'label'  => __('Ok')
                ],
            ]);

          //  $this->message = 'Password updated successfully.';
        } else {
           // $this->message = 'Current password is incorrect.';
           $this->dialog([
            'title'       => __('error'),
            'description' => __('current password is incorrect'),
            'icon'        => 'error',
            'close'      => [
                'label'  => __('Ok')
            ],
        ]);
        }
    }

    public function render()
    {
        return view('livewire.backend.employee.password.index')->layout('layouts.employee');
    }
}
