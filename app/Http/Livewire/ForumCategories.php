<?php

namespace App\Http\Livewire;

use Livewire\Component;
use TeamTeaTime\Forum\Models\Category;
use TeamTeaTime\Forum\Models\Thread;
use TeamTeaTime\Forum\Models\Post;

class ForumCategories extends Component
{
    public $title, $description, $accepts_threads, $is_private, $color;
    public $selected_category_id;
    public $updateCategoryMode = false;

    public function addForumCategory()
    {
        if ($this->accepts_threads == null) {
            $this->accepts_threads = 0;
        }
        if ($this->is_private == null) {
            $this->is_private = 0;
        }
        $category = new Category();
        $category->title = $this->title;
        $category->description = $this->description;
        $category->accepts_threads = $this->accepts_threads;
        $category->is_private = $this->is_private;
        $category->color = $this->color;

        $saved = $category->save();

        if ($saved) {
            $this->dispatchBrowserEvent('hideForumCategoriesModal');
            $this->title = $this->description = $this->color = $this->accepts_threads = $this->is_private = null;
            $this->showToast('Category Added Successfully', 'success');
        } else {
            $this->showToast('Something Went Wrong', 'error');
        }
    }

    public function editForumCategory($id)
    {
        $category = Category::findOrFail($id);
        $this->selected_category_id = $category->id;
        $this->title = $category->title;
        $this->description = $category->description;
        $this->accepts_threads = $category->accepts_threads;
        $this->is_private = $category->is_private;
        $this->color = $category->color;
        $this->updateCategoryMode = true;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showForumCategoriesModal');
    }

    public function updateForumCategory()
    {
        if ($this->selected_category_id) {
            $category = Category::findOrFail($this->selected_category_id);
            $category->title = $this->title;
            $category->description = $this->description;
            $category->accepts_threads = $this->accepts_threads;
            $category->is_private = $this->is_private;
            $category->color = $this->color;
            $updated = $category->save();

            if ($updated) {
                $this->dispatchBrowserEvent('hideForumCategoriesModal');
                $this->title = $this->description = $this->color = $this->accepts_threads = $this->is_private = null;
                $this->updateCategoryMode = false;
                $this->showToast('Category Updated Successfully', 'success');
            } else {
                $this->title = $this->description = $this->color = $this->accepts_threads = $this->is_private = null;
                $this->showToast('Something Went Wrong', 'error');
            }
        }
    }

    public function deleteForumCategory($id)
    {
        $category = Category::where('id', $id)->first();
        $threads = Thread::where('category_id', $category->id)->get();
        if (count($threads) > 0) {
            foreach ($threads as $thread) {
                $post = Post::where('thread_id', $thread->id)->get();
                if (count($post) > 0) {
                    foreach ($post as $p) {
                        $p->delete();
                    }
                }
                $del = $thread->delete();
            }
            $category->delete();
            $this->showToast('Category has been deleted successfully.', 'info');
        } else {
            $category->delete();
            $this->showToast('Category has been deleted successfully.', 'info');
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
        return view('livewire.forum-categories', [
            'categories' => Category::get(),
        ]);
    }
}
