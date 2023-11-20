<div>
    <div class="row mb-2">
        <div class="col-md-6 mb-3">
            <label for="" class="form-label">Search</label>
            <input type="text" class="form-control" placeholder="Search..." wire:model='search'>
        </div>
        <div class="col-md-2 mb-3">
            <label for="" class="form-label">Category</label>
            <select name="" class="form-select" wire:model='category'>
                <option value="" selected>None</option>
                @foreach (\App\Models\Subcategory::whereHas('posts')->get() as $category)
                <option value="{{$category->id}}">{{$category->subcategory_name}}</option>
                @endforeach
                
            </select>
        </div>
        @if(auth()->user()->type == 1)
        <div class="col-md-2 mb-3">
            <label for="" class="form-label">Author</label>
            <select name="" class="form-select" wire:model='author'>
                <option value="" selected>None</option>
                @foreach (\App\Models\User::whereHas('posts')->get() as $author)
                    <option value="{{$author->id}}">{{$author->name}}</option>
                @endforeach
            </select>
        </div>
        @endif
        <div class="col-md-2 mb-3">
            <label for="" class="form-label">Order By</label>
            <select name="" class="form-select" wire:model='orderBy'>
                <option value="asc">Ascending</option>
                <option value="desc">Descending</option>
            </select>
        </div>
    </div>

    <div class="row row-cards">
        @forelse ($posts as $post)   
        <div class="col-md-6 col-lg-3">
            <div class="card">
                <img src="/storage/images/post_images/thumbnails/resized_{{$post->featured_image}}" alt="" class="card-img-top">
                <div class="card-body p-2">
                    <h3 class="m-0 mb-1">{{$post->post_title}}</h3>
                    <div class="d-flex">
                        <a href="{{route('author.posts.edit-post', ['post_id'=>$post->id])}}" class="card-btn">Edit</a>
                        <a href="" wire:click.prevent='deletePost({{$post->id}})' class="card-btn">Delete</a>
                    </div>
                </div>
            </div>
        </div>
        @empty
            <span class="text-danger">No Post(s) Found</span>
        @endforelse
    </div>

    <div class="d-block mt-2">
        {{$posts->links('livewire::bootstrap')}}
    </div>
</div>
