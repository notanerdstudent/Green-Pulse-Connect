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
                @foreach (\App\Models\User::whereHas('productReviews')->get() as $author)
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
        @forelse ($products as $product)   
        <div class="col-md-6 col-lg-3">
            <div class="card">
                <div class="card-status-top bg-success"></div>
                <div class="card-header">
                    <img src="/storage/images/product_images/thumbnails/resized_{{$product->product_image}}" alt="" class="card-img-top">
                </div>
                <div class="card-body p-2">
                    <h3 class="card-title">{{$product->product_name}}</h3>
                    <p class="text-muted">{{words($product->review, 25)}}</p>
                    <p class="text-muted"><b>Brand:</b> {{$product->brand}}
                        <br><b>Buy:</b> {{$product->purchase_url}}
                        <br><b>Rating:</b> 
                        <span class="gl-star-rating gl-star-rating--ltr" data-star-rating="">
                            <span class="gl-star-rating--stars" data-rating="{{$product->rating}}">
                                @for ($i = 0; $i < $product->rating; $i++)
                                    <span data-index="{{$i-1}}" data-value="{{$i}}" class="gl-active">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon gl-star-full icon-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" style="pointer-events: none;"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" stroke-width="0" fill="currentColor"></path></svg>
                                    </span>
                                @endfor
                            </span>
                        </span>
                    </p>
                </div>
                <div class="card-footer">
                    <div class="d-flex">
                        <a href="{{route('author.products.edit-product', ['product_id'=>$product->id])}}" class="card-btn">Edit</a>
                        <a href="" wire:click.prevent='deleteProduct({{$product->id}})' class="card-btn">Delete</a>
                    </div>
                </div>
            </div>
        </div>
        @empty
            <span class="text-danger">No Product(s) Found</span>
        @endforelse
    </div>

    <div class="d-block mt-2">
        {{$products->links('livewire::bootstrap')}}
    </div>
</div>
