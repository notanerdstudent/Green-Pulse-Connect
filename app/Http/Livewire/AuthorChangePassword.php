<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AuthorChangePassword extends Component
{
    public $current_password, $new_password, $confirm_new_password;

    public function changePassword()
    {
        $this->validate([
            'current_password' => [
                'required', function ($attribute, $value, $fail) {
                    if (!Hash::check($value, User::find(auth('web')->id())->password)) {
                        return $fail(__('The current password is incorrect.'));
                    }
                }
            ],
            'new_password' => 'required|min:6|max:25',
            'confirm_new_password' => 'required|min:6|max:25|same:new_password',
        ], [
            'current_password.required' => 'The current password field is required.',
            'new_password.required' => 'The new password field is required.',
            'new_password.min' => 'The new password must be at least 6 characters.',
            'new_password.max' => 'The new password must be less than 25 characters.',
            'confirm_new_password.required' => 'The confirm new password field is required.',
            'confirm_new_password.min' => 'The confirm new password must be at least 6 characters.',
            'confirm_new_password.max' => 'The confirm new password must be less than 25 characters.',
            'confirm_new_password.same' => 'The confirm new password and new password must match.',
        ]);

        $query = User::find(auth('web')->id())->update([
            'password' => Hash::make($this->new_password)
        ]);

        if ($query) {
            $this->showToast('Password changed successfully', 'success');
            $this->current_password = $this->new_password = $this->confirm_new_password = null;
        } else {
            $this->showToast('Something went wrong.', 'error');
        }
    }

    public function showToast($message, $type)
    {
        return $this->dispatchBrowserEvent('showToastr', [
            'type' => $type,
            'message' => $message,
        ]);
    }

    public function render()
    {
        return view('livewire.author-change-password');
    }
}
