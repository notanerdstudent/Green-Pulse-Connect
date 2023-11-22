<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AuthorSignupForm extends Component
{
    public $name, $email, $username, $password, $agree;
    public $returnURL;

    public function mount()
    {
        $this->returnURL = request()->returnURL;
    }

    public function SignupHandler()
    {
        $this->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|unique:users,email|email',
            'password' => 'required|min:6',
            'agree' => 'required',
        ], [
            'agree.required' => 'You must agree to our terms and conditions'
        ]);

        $author = new User();
        $author->name = $this->name;
        $author->email = $this->email;
        $author->username = $this->username;
        $author->password = $this->password;
        $author->type = 2;
        $author->direct_publish = 1;
        $saved = $author->save();

        if ($saved) {
            $this->name = $this->email = $this->username = $this->password = null;
            redirect()->to('author/login')->with('success', 'Account created successfully');
        }
    }
    public function render()
    {
        return view('livewire.author-signup-form');
    }
}
