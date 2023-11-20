<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthorLoginForm extends Component
{
    public $login_id, $password;
    public $returnURL;

    public function mount()
    {
        $this->returnURL = request()->returnURL;
    }

    public function LoginHandler()
    {

        $fieldType = filter_var($this->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if ($fieldType == "email") {
            $this->validate([
                'login_id' => 'required|email|exists:users,email',
                'password' => 'required|min:6'
            ], [
                'login_id.required' => "Email or Username is required",
                'login_id.email' => "Invalid Email Address",
                'login_id.exists' => "Email Address Not Found",
                'password.required' => "Please Enter Your Password",
            ]);
        } else {
            $this->validate([
                'login_id' => 'required|exists:users,username',
                'password' => 'required|min:6',
            ], [
                'login_id.required' => "Email or Username is required",
                'login_id.exists' => "Username Not Found",
                'password.required' => "Please Enter Your Password",
            ]);
        }

        $creds = array($fieldType => $this->login_id, 'password' => $this->password);
        if (Auth::guard('web')->attempt($creds)) {
            $checkUser = User::where($fieldType, $this->login_id)->first();
            if ($checkUser->blocked == 1) {
                Auth::guard('web')->logout();
                return redirect()->route('author.login')->with('fail', 'Your Account has been Blocked. Please contact support!');
            } else {
                if ($this->returnURL != null) {
                    return redirect()->to($this->returnURL);
                } else {
                    return redirect()->route('author.home');
                }
            }
        } else {
            session()->flash('fail', 'Invalid Credentials');
        }
    }
    public function render()
    {
        return view('livewire.author-login-form');
    }
}
