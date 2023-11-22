<?php

namespace App\Http\Livewire;

use App\Models\ProductReviews;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class AllProducts extends Component
{
    use WithPagination;
    public $perPage = 8;
    public $search = null;
    public $author = null;
    public $orderBy = 'desc';

    protected $listeners = [
        'deleteProductConfirm',
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
        return view('livewire.all-products', [
            'products' => auth()->user()->type == 1 ?
                ProductReviews::search(trim($this->search))
                ->when($this->author, function ($query) {
                    $query->where('user_id', $this->author);
                })
                ->when($this->orderBy, function ($query) {
                    $query->orderBy('id', $this->orderBy);
                })
                ->paginate($this->perPage) :
                ProductReviews::search(trim($this->search))
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
    public function deleteProduct($id)
    {
        $this->dispatchBrowserEvent('deleteProduct', [
            'id' => $id
        ]);
    }
    public function deleteProductConfirm($id)
    {
        $listing = ProductReviews::find($id);
        $path = 'images/product_images/';
        $product_image = $listing->product_image;
        if ($product_image != null || File::exists(public_path($path . $product_image))) {
            File::delete(public_path($path . $product_image));

            if (Storage::disk('public')->exists($path . 'thumbnails/resized_' . $product_image)) {
                Storage::disk('public')->delete($path . 'thumbnails/resized_' . $product_image);
            }

            if (Storage::disk('public')->exists($path . 'thumbnails/thumb_' . $product_image)) {
                Storage::disk('public')->delete($path . 'thumbnails/thumb_' . $product_image);
            }
        }
        $listing->delete();
        $this->showToast('Product has been deleted successfully.', 'info');
    }

    public function showToast($message, $type)
    {
        return $this->dispatchBrowserEvent('showToastr', [
            'type' => $type,
            'message' => $message,
        ]);
    }
}
