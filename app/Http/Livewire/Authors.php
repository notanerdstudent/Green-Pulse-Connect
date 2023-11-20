<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;
use Nette\Utils\Random;

class Authors extends Component
{
    use WithPagination;
    public $name, $email, $username, $author_type, $direct_publisher;
    public $search;
    public $perPage = 8;
    public $selected_author_id;
    public $blocked = 0;

    protected $listeners = [
        'resetForms',
        'deleteAuthorization',
    ];

    public function mount()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function resetForms()
    {
        $this->name = $this->email = $this->username = $this->author_type = $this->direct_publisher = null;
        $this->resetErrorBag();
    }

    public function addAuthor()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users',
            'author_type' => 'required',
            'direct_publisher' => 'required',
        ], [
            'author_type.required' => 'Please select author type',
            'direct_publisher.required' => 'Please select direct publishing access',
        ]);

        if ($this->isOnline()) {
            $default_password = Random::generate(8);
            $author = new User();
            $author->name = $this->name;
            $author->email = $this->email;
            $author->username = $this->username;
            $author->password = Hash::make($default_password);
            $author->type = $this->author_type;
            $author->direct_publish = $this->direct_publisher;
            $saved = $author->save();

            $data = array(
                'name' => $this->name,
                'username' => $this->username,
                'email' => $this->email,
                'password' => $default_password,
                'url' => route('author.profile'),
            );

            $author_email = $this->email;
            $author_name = $this->name;

            if ($saved) {
                Mail::send('new-author-email-template', $data, function ($message) use ($author_email, $author_name) {
                    $message->from('noreply@greenpulseconnect.org', 'Green Pulse Connect');
                    $message->to($author_email, $author_name)->subject('Account Created Successfully!');
                });

                $this->showToast('Author has been added successfully.', 'success');
                $this->name = $this->email = $this->username = $this->author_type = $this->direct_publisher = null;
                $this->dispatchBrowserEvent('hide_add_author_modal');
            } else {
                $this->showToast('Something went wrong. Please try again later.', 'error');
            }
        } else {
            $this->showToast('You are offline. Please check your internet connection.', 'error');
        }
    }

    public function editAuthor($author)
    {
        $this->name = $author['name'];
        $this->email = $author['email'];
        $this->username = $author['username'];
        $this->author_type = $author['type'];
        $this->direct_publisher = $author['direct_publish'];
        $this->blocked = $author['blocked'];
        $this->selected_author_id = $author['id'];

        $this->dispatchBrowserEvent('showEditAuthorModal');
    }

    public function updateAuthor()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->selected_author_id,
            'username' => 'required|unique:users,username,' . $this->selected_author_id,
            'author_type' => 'required',
            'direct_publisher' => 'required',
        ], [
            'author_type.required' => 'Please select author type',
            'direct_publisher.required' => 'Please select direct publishing access',
        ]);

        if ($this->selected_author_id) {
            $author = User::find($this->selected_author_id);
            $author->update([
                'name' => $this->name,
                'email' => $this->email,
                'username' => $this->username,
                'type' => $this->author_type,
                'direct_publish' => $this->direct_publisher,
                'blocked' => $this->blocked,
            ]);
        }

        $this->showToast('Author has been updated successfully.', 'success');
        $this->dispatchBrowserEvent('hide_edit_author_modal');
    }

    public function deleteAuthor($author)
    {
        $this->dispatchBrowserEvent('deleteAuthor', [
            'id' => $author['id']
        ]);
    }

    public function deleteAuthorization($id)
    {
        $author = User::find($id);
        $path = 'backend/dist/img/authors/';
        $author_picture = $author->getAttributes()['picture'];
        $picture_full_path = $path . $author_picture;

        if ($author_picture != null || File::exists(public_path($picture_full_path))) {
            File::delete(public_path($picture_full_path));
        }
        $author->delete();
        $this->showToast('Author has been deleted successfully.', 'info');
    }

    public function showToast($message, $type)
    {
        return $this->dispatchBrowserEvent('showToastr', [
            'type' => $type,
            'message' => $message,
        ]);
    }

    public function isOnline($site = 'https://google.com')
    {
        if (@fopen($site, "r")) {
            return true;
        } else {
            return false;
        }
    }

    public function render()
    {
        return view('livewire.authors', [
            'authors' => User::search(trim($this->search))->where('id', '!=', auth()->id())->paginate(8),
        ]);
    }
}
