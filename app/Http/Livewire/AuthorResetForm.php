<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Support\Str;

class AuthorResetForm extends Component
{

    public $email, $new_password, $confirm_password, $token;

    public function mount()
    {
        $this->email = request()->email;
        $this->token = request()->token;
    }

    public function ResetHandler()
    {
        $this->validate([
            'email' => 'required|email|exists:users,email',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:new_password',
        ], [
            'email.required' => 'Email Address is required',
            'email.email' => 'Invalid Email Address',
            'email.exists' => 'Email Address Not Registered',
            'new_password.required' => 'Please Enter Your New Password',
            'new_password.min' => 'Password must be atleast 6 characters',
            'confirm_password.required' => 'Please Confirm Your New Password',
            'confirm_password.same' => 'Password does not match',
        ]);

        $check_token = DB::table('password_resets')->where([
            'email' => $this->email,
            'token' => $this->token,
        ])->first();

        if (!$check_token) {
            session()->flash('fail', 'Token Expired');
        } else {
            User::where('email', $this->email)->update([
                'password' => Hash::make($this->new_password),
            ]);

            DB::table('password_resets')->where(
                'email',
                $this->email
            )->delete();

            $success_token = Str::random(64);
            session()->flash('success', 'Your Password has been updated successfully. Please login with your email (' . $this->email . ') and your new password.');

            $this->redirectRoute('author.login', [
                'token' => $success_token,
                'email' => $this->email,
            ]);
        }
    }

    public function render()
    {
        return view('livewire.author-reset-form');
    }
}
