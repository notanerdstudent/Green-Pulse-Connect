<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;

class AllPosts extends Component
{
    use WithPagination;
    public $perPage = 8;
    public $search = null;
    public $author = null;
    public $category = null;
    public $orderBy = 'desc';

    protected $listeners = [
        'deletePostConfirm',
    ];

    public function mount()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function updatingAuthor()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.all-posts', [
            'posts' => auth()->user()->type == 1 ?
                Post::search(trim($this->search))
                ->when($this->category, function ($query) {
                    $query->where('category_id', $this->category);
                })
                ->when($this->author, function ($query) {
                    $query->where('author_id', $this->author);
                })
                ->when($this->orderBy, function ($query) {
                    $query->orderBy('id', $this->orderBy);
                })
                ->paginate($this->perPage) :
                Post::search(trim($this->search))
                ->where('author_id', auth()->id())
                ->when($this->category, function ($query) {
                    $query->where('category_id', $this->category);
                })
                ->when($this->author, function ($query) {
                    $query->where('author_id', $this->author);
                })
                ->when($this->orderBy, function ($query) {
                    $query->orderBy('id', $this->orderBy);
                })
                ->paginate($this->perPage),
        ]);
    }

    public function deletePost($id)
    {
        $this->dispatchBrowserEvent('deletePost', [
            'id' => $id
        ]);
    }
    public function deletePostConfirm($id)
    {
        $post = Post::find($id);
        $path = 'images/post_images/';
        $featured_image = $post->featured_image;
        if ($featured_image != null || File::exists(public_path($path . $featured_image))) {
            File::delete(public_path($path . $featured_image));

            if (Storage::disk('public')->exists($path . 'thumbnails/resized_' . $featured_image)) {
                Storage::disk('public')->delete($path . 'thumbnails/resized_' . $featured_image);
            }

            if (Storage::disk('public')->exists($path . 'thumbnails/thumb_' . $featured_image)) {
                Storage::disk('public')->delete($path . 'thumbnails/thumb_' . $featured_image);
            }
        }

        $post->delete();
        $this->showToast('Post has been deleted successfully.', 'info');
    }

    public function showToast($message, $type)
    {
        return $this->dispatchBrowserEvent('showToastr', [
            'type' => $type,
            'message' => $message,
        ]);
    }
}
