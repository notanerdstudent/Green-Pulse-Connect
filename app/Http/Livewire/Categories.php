<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Post;
use App\Models\Subcategory;
use Livewire\Component;
use Illuminate\Support\Str;

class Categories extends Component
{
    public $category_name;
    public $selected_category_id;
    public $updateCategoryMode = false;

    public $subcategory_name, $parent_category = 0;
    public $selected_subcategory_id;
    public $updateSubcategoryMode = false;

    protected $listeners = [
        'resetModalForm',
        'deleteCategoryConfirm',
        'deleteSubcategoryConfirm',
        'updateCategoryOrdering',
        'updateSubcategoryOrdering',
    ];

    public function resetModalForm()
    {
        $this->resetErrorBag();
        $this->category_name = $this->subcategory_name = $this->parent_category = null;
        $this->updateCategoryMode = $this->updateSubcategoryMode = false;
    }

    public function addCategory()
    {
        $this->validate([
            'category_name' => 'required|unique:categories,category_name',
        ]);

        $category = new Category();
        $category->category_name = $this->category_name;
        $saved = $category->save();

        if ($saved) {
            $this->dispatchBrowserEvent('hideCategoriesModal');
            $this->category_name = null;
            $this->showToast('Category Added Successfully', 'success');
        } else {
            $this->showToast('Something Went Wrong', 'error');
        }
    }

    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        $this->selected_category_id = $category->id;
        $this->category_name = $category->category_name;
        $this->updateCategoryMode = true;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showCategoriesModal');
    }

    public function updateCategory()
    {
        if ($this->selected_category_id) {
            $this->validate([
                'category_name' => 'required|unique:categories,category_name,' . $this->selected_category_id,
            ]);

            $category = Category::findOrFail($this->selected_category_id);
            $category->category_name = $this->category_name;
            $updated = $category->save();

            if ($updated) {
                $this->dispatchBrowserEvent('hideCategoriesModal');
                $this->category_name = $this->selected_category_id = null;
                $this->updateCategoryMode = false;
                $this->showToast('Category Updated Successfully', 'success');
            } else {
                $this->category_name = $this->selected_category_id = null;
                $this->showToast('Something Went Wrong', 'error');
            }
        }
    }

    public function addSubcategory()
    {
        $this->validate([
            'parent_category' => 'required',
            'subcategory_name' => 'required|unique:subcategories,subcategory_name',
        ]);

        $subcategory = new Subcategory();
        $subcategory->subcategory_name = $this->subcategory_name;
        $subcategory->slug = Str::slug($this->subcategory_name);
        $subcategory->parent_category = $this->parent_category;
        $saved = $subcategory->save();

        if ($saved) {
            $this->dispatchBrowserEvent('hideSubcategoriesModal');
            $this->subcategory_name = $this->parent_category = null;
            $this->showToast('Subcategory Added Successfully', 'success');
        } else {
            $this->showToast('Something Went Wrong', 'error');
        }
    }

    public function editSubcategory($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $this->selected_subcategory_id = $subcategory->id;
        $this->parent_category = $subcategory->parent_category;
        $this->subcategory_name = $subcategory->subcategory_name;
        $this->updateSubcategoryMode = true;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showSubcategoriesModal');
    }


    public function updateSubcategory()
    {
        if ($this->selected_subcategory_id) {
            $this->validate([
                'parent_category' => 'required',
                'subcategory_name' => 'required|unique:subcategories,subcategory_name,' . $this->selected_subcategory_id,
            ]);


            $subcategory = Subcategory::findOrFail($this->selected_subcategory_id);
            $subcategory->subcategory_name = $this->subcategory_name;
            $subcategory->slug = Str::slug($this->subcategory_name);
            $subcategory->parent_category = $this->parent_category;
            $updated = $subcategory->save();

            if ($updated) {
                $this->dispatchBrowserEvent('hideSubcategoriesModal');
                $this->subcategory_name = $this->parent_category = $this->selected_subcategory_id = null;
                $this->updateSubcategoryMode = false;
                $this->showToast('Subcategory Updated Successfully', 'success');
            } else {
                $this->subcategory_name = $this->parent_category = $this->selected_subcategory_id = null;
                $this->showToast('Something Went Wrong', 'error');
            }
        }
    }

    public function deleteCategory($id)
    {
        $this->dispatchBrowserEvent('deleteCategory', [
            'id' => $id
        ]);
    }

    public function deleteSubcategory($id)
    {
        $this->dispatchBrowserEvent('deleteSubcategory', [
            'id' => $id
        ]);
    }

    public function deleteCategoryConfirm($id)
    {
        $category = Category::where('id', $id)->first();
        $subcategories = Subcategory::where('parent_category', $category->id)->whereHas('posts')->with('posts')->get();

        if (!empty($subcategories) && count($subcategories) > 0) {
            $totalPosts = 0;
            foreach ($subcategories as $subcategory) {
                $totalPosts += Post::where('category_id', $subcategory->id)->get()->count();
            }
            $this->showToast('This category has (' . $totalPosts . ') posts related to it. It cannot be deleted', 'error');
        } else {
            Subcategory::where('parent_category', $category->id)->delete();
            $category->delete();
            $this->showToast('Category has been deleted successfully.', 'info');
        }
    }

    public function deleteSubcategoryConfirm($id)
    {
        $subcategory = Subcategory::where('id', $id)->first();
        $posts = Post::where('category_id', $subcategory->id)->get()->toArray();

        if (!empty($posts) && count($posts) > 0) {
            $this->showToast('This subcategory has (' . count($posts) . ') posts related to it. It cannot be deleted', 'error');
        } else {
            $subcategory->delete();
            $this->showToast('Subcategory has been deleted successfully.', 'info');
        }
    }

    public function updateCategoryOrdering($positions)
    {
        foreach ($positions as $position) {
            $index = $position[0];
            $newPosition = $position[1];
            Category::where('id', $index)->update([
                'ordering' => $newPosition
            ]);
        }
        $this->showToast('Category Ordering Updated Successfully', 'success');
    }

    public function updateSubcategoryOrdering($positions)
    {
        foreach ($positions as $position) {
            $index = $position[0];
            $newPosition = $position[1];
            Subcategory::where('id', $index)->update([
                'ordering' => $newPosition
            ]);
        }
        $this->showToast('Subcategory Ordering Updated Successfully', 'success');
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
        return view('livewire.categories', [
            'categories' => Category::orderBy('ordering', 'asc')->get(),
            'subcategories' => Subcategory::orderBy('ordering', 'asc')->get(),
        ]);
    }
}
