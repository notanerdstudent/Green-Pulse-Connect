@extends('frontend.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Green Business Directory')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="breadcrumbs mb-4">
        <a href="{{route('business')}}">Green Business Directory</a> <span class="mx-1">/</span>
      </div>
    </div>
    <div class="col-lg-12 mb-5 mb-lg-0">
      <div class="row">
        @forelse ($businesses as $item) 
          <div class="col-md-4 mb-4">
            <article class="card article-card article-card-sm h-100">
              <div class="card-body px-0 pb-0">
                <h2>
                  <a class="post-title" href="{{route('business.show', $item->slug)}}"
                    >{{$item->name}}</a
                  >
                </h2>
                <p class="card-text">
                  {!! Str::ucfirst(words($item->details, 25)) !!}
                </p>
                <div class="content">
                  <a class="read-more-btn" href="{{route('business.show', $item->slug)}}"
                    >Read Full Description</a
                  >
                </div>
              </div>
            </article>
          </div>
        @empty
          <span class="text-danger">No Businesses(s) Found For This Category.</span>
        @endforelse
      </div>
      <div class="col-12">
        <div class="row">
          <div class="col-12">
            {{$businesses->appends(request()->input())->links('custom_pagination')}}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection