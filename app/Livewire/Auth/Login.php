<?php

namespace App\Livewire\Auth;


use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    /** @var string */
    public $email = '';

    /** @var string */
    public $password = '';

    /** @var bool */
    public $remember = false;

    protected $rules = [
        'email' => ['required', 'email'],
        'password' => ['required'],
    ];

    public function authenticate()
    {
        $this->validate();

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            $this->addError('email', trans('auth.failed'));

            return;
        }

        // 

        if (auth()->user()->hasRole('owner')) 
        {
            return redirect()->intended(route('owner.dashboard.Index'));
            
        }

        if (auth()->user()->hasRole('manger')) {
            
        }

        if (auth()->user()->hasRole('administrative')) {
            
        }

    /*    if (auth()->user()->employee->is_adminstaror == 0) {
            # code...
            return redirect()->intended(route('employee.dashboard.Index'));

        } 

        return redirect()->intended(route('employee.index'));*/

        

    }

    public function render()
    {
        return view('livewire.auth.login')->extends('layouts.auth');
    }
}
