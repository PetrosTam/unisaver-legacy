<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;

#[Title('Register - UniSaver')]
class RegisterPage extends Component
{
    public $name;
    public $student_id;
    public $email;
    public $password;

    // register user
    public function save() {
        $this->validate([
            'name' => 'required|max:255',
            'student_id' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:8|max:255',
        ]);

        // save to database
        $user = User::create([
            'name' => $this->name,
            'student_id' => $this->student_id,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        // log-in user
        auth()->login($user);

        // redirect to Home Page
        return redirect()->intended();
    }

    public function render()
    {
        return view('livewire.auth.register-page');
    }
}
