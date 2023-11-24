@extends('frontend.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Products')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="breadcrumbs mb-4">
        <a href="{{route('products')}}">Eco-Friendly Product Reviews</a> <span class="mx-1">/</span>
      </div>
    </div>
    <div class="col-lg-12 mb-5 mb-lg-0">
      <div class="row">
        @forelse ($products as $item) 
          <div class="col-md-4 mb-4">
            <article class="card article-card article-card-sm h-100">
              <a href="{{route('product.single',$item->slug)}}">
                <div class="card-image">
                  <div class="post-info">
                    <span class="text-uppercase">{{data_formatter($item->created_at)}}</span>
                  </div>
                  <img
                    loading="lazy"
                    decoding="async"
                    src="/storage/images/product_images/thumbnails/thumb_{{$item->product_image}}"
                    alt="Product Thumbnail"
                    class="w-100"
                    width="420"
                    height="280"
                  />
                </div>
              </a>
              <div class="card-body px-0 pb-0">
                <h2>
                  <a class="post-title" href="{{route('product.single',$item->slug)}}"
                    >{{$item->product_name}}</a
                  >
                </h2>
                <p class="card-text">
                  {!! Str::ucfirst(words($item->review, 25)) !!}
                </p>
                <div class="content">
                  <a class="read-more-btn" href="{{route('product.single',$item->slug)}}"
                    >Read More Details</a
                  >
                </div>
              </div>
            </article>
          </div>
        @empty
          <span class="text-danger">No Product(s) Found For This Category.</span>
        @endforelse
      </div>
      <div class="col-12">
        <div class="row">
          <div class="col-12">
            {{$products->appends(request()->input())->links('custom_pagination')}}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection