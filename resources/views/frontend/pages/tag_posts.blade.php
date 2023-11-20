@extends('frontend.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Tag Posts')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="breadcrumbs mb-4">
        <a href="{{route('blog')}}">Blog</a> <span class="mx-1">/</span>
        <a href="{{route('tag_posts', $tag)}}">{{$tag}}</a> <span class="mx-1">/</span>
      </div>
      <h1 class="mb-4 border-bottom border-primary d-inline-block">
        {{$pageTitle}}
      </h1>
    </div>
    <div class="col-lg-8 mb-5 mb-lg-0">
      <div class="row">
        @forelse ($posts as $item) 
          <div class="col-md-6 mb-4">
            <article class="card article-card article-card-sm h-100">
              <a href="{{route('read_post',$item->post_slug)}}">
                <div class="card-image">
                  <div class="post-info">
                    <span class="text-uppercase">{{data_formatter($item->created_at)}}</span>
                    <span class="text-uppercase">{{readDuration($item->post_title, $item->post_content)}} @choice('min|mins',readDuration($item->post_title, $item->post_content)) Read</span>
                  </div>
                  <img
                    loading="lazy"
                    decoding="async"
                    src="/storage/images/post_images/thumbnails/thumb_{{$item->featured_image}}"
                    alt="Post Thumbnail"
                    class="w-100"
                    width="420"
                    height="280"
                  />
                </div>
              </a>
              <div class="card-body px-0 pb-0">
                <ul class="post-meta mb-2">
                  <li>
                    @if($item->post_tags)
                      @foreach (explode(',', $item->post_tags) as $tag)
                      <a href="{{route('tag_posts',$tag)}}">#{{$tag}}</a>
                      @endforeach
                    @endif
                  </li>
                </ul>
                <h2>
                  <a class="post-title" href="{{route('read_post',$item->post_slug)}}"
                    >{{$item->post_title}}</a
                  >
                </h2>
                <p class="card-text">
                  {!! Str::ucfirst(words($item->post_content, 25)) !!}
                </p>
                <div class="content">
                  <a class="read-more-btn" href="{{route('read_post',$item->post_slug)}}"
                    >Read Full Article</a
                  >
                </div>
              </div>
            </article>
          </div>
        @empty
          <span class="text-danger">No Post(s) Found For This Tag.</span>
        @endforelse
      </div>
      <div class="col-12">
        <div class="row">
          <div class="col-12">
            {{$posts->appends(request()->input())->links('custom_pagination')}}
          </div>
        </div>
      </div>
    </div>
    @include('frontend.layouts.includes.sidebar')
  </div>
@endsection