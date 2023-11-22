<div>
    <div class="row mb-2">
        <div class="col-md-6 mb-3">
            <label for="" class="form-label">Search</label>
            <input type="text" class="form-control" placeholder="Search..." wire:model='search'>
        </div>
        @if(auth()->user()->type == 1)
        <div class="col-md-2 mb-3">
            <label for="" class="form-label">Author</label>
            <select name="" class="form-select" wire:model='author'>
                <option value="" selected>None</option>
                @foreach (\App\Models\User::whereHas('businessListings')->get() as $author)
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
        @forelse ($listings as $listing)   
        <div class="col-md-6 col-lg-3">
            <div class="card">
                <div class="card-status-top bg-success"></div>
                <div class="card-header">
                    <h3 class="card-title">{{$listing->name}}</h3>
                </div>
                {{-- <img src="/storage/images/post_images/thumbnails/resized_{{$listing->featured_image}}" alt="" class="card-img-top"> --}}
                <div class="card-body p-2">
                    <p class="text-muted">{{words($listing->details, 25)}}</p>
                    <p class="text-muted"><b>Website:</b> {{$listing->website}}
                        <br><b>Phone:</b> {{$listing->phone}}
                        <br><b>Email:</b> {{$listing->email}}</p>
                </div>
                <div class="card-footer">
                    <div class="d-flex">
                        <a href="{{route('author.business.edit-business', ['listing_id'=>$listing->id])}}" class="card-btn">Edit</a>
                        <a href="" wire:click.prevent='deleteListing({{$listing->id}})' class="card-btn">Delete</a>
                    </div>
                </div>
            </div>
        </div>
        @empty
            <span class="text-danger">No Listing(s) Found</span>
        @endforelse
    </div>

    <div class="d-block mt-2">
        {{$listings->links('livewire::bootstrap')}}
    </div>
</div>
