<div>
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Authors
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="d-flex">
                        <input type="search" class="form-control d-inline-block w-9 me-3" placeholder="Search Author...." wire:model="search">
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_author_modal">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
                            New Author
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row row-cards">

        @forelse ($authors as $author)
        <div class="col-md-6 col-lg-3">
          <div class="card">
            <div class="card-body p-4 text-center">
              <span class="avatar avatar-xl mb-3 avatar-rounded" style="background-image: url({{$author->picture}})"></span>
              <h3 class="m-0 mb-1"><a href="#">{{$author->name}}</a></h3>
              <div class="text-muted">{{$author->email}}</div>
              <div class="mt-3">
                <span class="badge bg-purple-lt">{{$author->authorType->name}}</span>
              </div>
            </div>
            <div class="d-flex">
              <a href="#" wire:click.prevent="editAuthor({{$author}})" class="card-btn">Edit</a>
              <a href="#" class="card-btn" wire:click.prevent='deleteAuthor({{$author}})'>Delete</a>
            </div>
          </div>
        </div>
        
            
        @empty
            <span class="text-danger">No Author Found</span>
        @endforelse
    </div>

    <div class="row mt-4">
        {{$authors->links('livewire::bootstrap')}}
    </div>


    {{-- Modals --}}
    <div wire:ignore.self class="modal modal-blur fade" id="add_author_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Author</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" wire:submit.prevent="addAuthor()">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="example-text-input" placeholder="Author Name" wire:model="name">
                            <span class="text-danger">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" name="example-text-input" placeholder="Author Email" wire:model="email">
                            <span class="text-danger">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="example-text-input" placeholder="Author Username" wire:model="username">
                            <span class="text-danger">
                                @error('username')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <div class="form-label">Author Type</div>
                            <select class="form-select" wire:model="author_type">
                            <option value="">Not Selected</option>
                            @foreach (\App\Models\Type::all() as $type)
                                <option value="{{$type->id}}">{{$type->name}}</option>
                            @endforeach
                            </select>
                        </div>
                        <span class="text-danger">
                            @error('author_type')
                                {{ $message }}
                            @enderror
                        </span>
                        <div class="mb-3">
                            <div class="form-label">Can Publish Directly?</div>
                            <div>
                            <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="direct_publisher" value="1" wire:model="direct_publisher">
                                <span class="form-check-label">Yes</span>
                            </label>
                            <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="direct_publisher" value="0" checked wire:model="direct_publisher">
                                <span class="form-check-label">No</span>
                            </label>
                            </div>
                            <span class="text-danger">
                                @error('direct_publisher')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal modal-blur fade" id="edit_author_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Author</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" wire:submit.prevent="updateAuthor()">
                        <div class="mb-3">
                            <label class="form-label">ID</label>
                            <input type="text" class="form-control" name="example-text-input" placeholder="Author ID" wire:model="selected_author_id" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="example-text-input" placeholder="Author Name" wire:model="name">
                            <span class="text-danger">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" name="example-text-input" placeholder="Author Email" wire:model="email">
                            <span class="text-danger">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="example-text-input" placeholder="Author Username" wire:model="username">
                            <span class="text-danger">
                                @error('username')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <div class="form-label">Author Type</div>
                            <select class="form-select" wire:model="author_type">
                            @foreach (\App\Models\Type::all() as $type)
                                <option value="{{$type->id}}">{{$type->name}}</option>
                            @endforeach
                            </select>
                        </div>
                        <span class="text-danger">
                            @error('author_type')
                                {{ $message }}
                            @enderror
                        </span>
                        <div class="mb-3">
                            <div class="form-label">Can Publish Directly?</div>
                            <div>
                            <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="direct_publisher" value="1" wire:model="direct_publisher">
                                <span class="form-check-label">Yes</span>
                            </label>
                            <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="direct_publisher" value="0" checked wire:model="direct_publisher">
                                <span class="form-check-label">No</span>
                            </label>
                            </div>
                            <span class="text-danger">
                                @error('direct_publisher')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <div class="form-label">Blocked</div>
                            <label class="form-check form-switch">
                              {{-- <input class="form-check-input" type="" wire:model='blocked' checked="false"> --}}
                              <input class="form-check-input" type="checkbox" wire:model='blocked'>
                            </label>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>