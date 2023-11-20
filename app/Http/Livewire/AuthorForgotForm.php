<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthorForgotForm extends Component
{
    public $email;
    public function ForgotHandler()
    {
        $this->validate([
            'email' => 'required|email|exists:users,email'
        ], [
            'email.required' => "Email Address is required",
            'email.email' => "Invalid Email Address",
            'email.exists' => "Email Address Not Registered",
        ]);

        $token = base64_encode(Str::random(64));
        DB::table('password_resets')->insert([
            'email' => $this->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        $user = User::where('email', $this->email)->first();
        $link = route('author.reset-form', ['token' => $token, 'email' => $this->email]);

        $data = array(
            'name' => $user->name,
            'link' => $link,
        );
        Mail::send('forgot-email-template', $data, function ($message) use ($user) {
            $message->from('akshutgoyal2301@gmail.com', 'GreenPulseConnect');
            $message->to($user->email, $user->name)->subject('Reset Password');
        });

        $this->email = null;
        session()->flash('success', 'Reset Password Link has been sent to your email address.');
    }
    public function render()
    {
        return view('livewire.author-forgot-form');
    }
}
