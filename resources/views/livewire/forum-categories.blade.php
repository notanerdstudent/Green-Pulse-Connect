<div>
    
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <ul class="nav nav-pills card-header-pills">
                <h4>Categories</h4>
                  <li class="nav-item ms-auto">
                    <a href="" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#forumcategories_modal">Add Category</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table table-striped">
                          <thead>
                            <tr>
                              <th>Category</th>
                              <th>Description</th>
                              <th>Thread Count</th>
                              <th>Post Count</th>
                              <th class="w-1"></th>
                              <th class="w-1"></th>
                            </tr>
                          </thead>
                          <tbody id="sortable_category">
                            @forelse ($categories as $category)
                              <tr data-index="{{$category->id}}">
                                <td>{{$category->title}}</td>
                                <td>{{$category->description}}</td>
                                <td class="text-muted">
                                  {{$category->thread_count}}
                                </td>
                                <td class="text-muted">
                                  {{$category->post_count}}
                                </td>
                                <td class="text-muted">
                                    <input type="color" class="form-control form-control-color" value="{{$category->color}}" disabled>
                                </td>
                                <td>
                                  <div class="btn-group">
                                      <a href="#" class="btn btn-sm btn-primary" wire:click.prevent='editForumCategory({{$category->id}})'>Edit</a> &nbsp;
                                      <a href="#" wire:click.prevent='deleteForumCategory({{$category->id}})' class="btn btn-sm btn-danger">Delete</a>
                                  </div>
                                </td>
                              </tr>
                              
                            @empty
                              <tr>
                                <td colspan="3"><span class="text-danger">No Category Found.</span></td>
                              </tr>
                            @endforelse
                          </tbody>
                        </table>
                      </div>
                </div>
              </div>
            </div>
        </div>
    </div>
    

    <div wire:ignore.self class="modal modal-blur fade" id="forumcategories_modal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <form class="modal-content" method="POST"
            @if ($updateCategoryMode)
              wire:submit.prevent = 'updateForumCategory()'
            @else
              wire:submit.prevent = 'addForumCategory()'
            @endif
          >
            <div class="modal-header">
              <h5 class="modal-title">{{$updateCategoryMode ? 'Update Category' : 'Add Category'}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                @if ($updateCategoryMode)
                    <div class="mb-3">
                        <label class="form-label">Category ID</label>
                        <input type="text" class="form-control" name="example-text-input" placeholder="Please Enter Category ID" wire:model='selected_category_id' disabled>
                    </div>
                @endif
                <div class="mb-3">
                    <label class="form-label">Category Title</label>
                    <input type="text" required class="form-control" name="example-text-input" placeholder="Please Enter Category Title" wire:model='title'>
                    <span class="text-danger">
                      @error('category_title') {{$message}} @enderror
                    </span>
                </div>
                <div class="mb-3">
                    <label class="form-label">Category Description</label>
                    <input type="text" required class="form-control" name="example-text-input" placeholder="Please Enter Category Description" wire:model='description'>
                    <span class="text-danger">
                      @error('category_description') {{$message}} @enderror
                    </span>
                </div>
                <div class="mb-3">
                    <label class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="1" wire:model='accepts_threads'>
                        <span class="form-check-label">Enable Threads</span>
                      </label>
                </div>
                <div class="mb-3">
                    <label class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="1" wire:model='is_private'>
                        <span class="form-check-label">Make Private</span>
                      </label>
                </div>
                <div class="mb-3">
                    <label class="form-label">Color</label>
                    <input type="color" class="form-control form-control-color" wire:model='color' value="#007BFF" title="Choose your color" name="color">
                  </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">{{ $updateCategoryMode ? 'Update' : 'Create'}}</button>
            </div>
        </form>
        </div>
    </div>
</div>
