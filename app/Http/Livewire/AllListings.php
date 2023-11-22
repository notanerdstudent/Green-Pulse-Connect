<?php

namespace App\Http\Livewire;

use App\Models\BusinessListing;
use Livewire\Component;
use Livewire\WithPagination;

class AllListings extends Component
{
    use WithPagination;
    public $perPage = 8;
    public $search = null;
    public $author = null;
    public $orderBy = 'desc';

    protected $listeners = [
        'deleteListingConfirm',
    ];

    public function mount()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingAuthor()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.all-listings', [
            'listings' => auth()->user()->type == 1 ?
                BusinessListing::search(trim($this->search))
                ->when($this->author, function ($query) {
                    $query->where('user_id', $this->author);
                })
                ->when($this->orderBy, function ($query) {
                    $query->orderBy('id', $this->orderBy);
                })
                ->paginate($this->perPage) :
                BusinessListing::search(trim($this->search))
                ->where('user_id', auth()->id())
                ->when($this->author, function ($query) {
                    $query->where('user_id', $this->author);
                })
                ->when($this->orderBy, function ($query) {
                    $query->orderBy('id', $this->orderBy);
                })
                ->paginate($this->perPage),
        ]);
    }
    public function deleteListing($id)
    {
        $this->dispatchBrowserEvent('deleteListing', [
            'id' => $id
        ]);
    }
    public function deleteListingConfirm($id)
    {
        $listing = BusinessListing::find($id);

        $listing->delete();
        $this->showToast('Listing has been deleted successfully.', 'info');
    }

    public function showToast($message, $type)
    {
        return $this->dispatchBrowserEvent('showToastr', [
            'type' => $type,
            'message' => $message,
        ]);
    }
}
