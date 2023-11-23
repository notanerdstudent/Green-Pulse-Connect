@extends('frontend.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Home')
@section('meta')
    <meta name="robots" content="index,follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <meta name="title" content="{{blogInfo()->blog_name}} - {{$business->name}}">
    <meta name="author" content="{{$business->author->username}}">
    <meta name="description" content="{{Str::ucfirst(words($business->details, 120))}}">
    <link rel="canonical" href="{{route('business.show',$business->slug)}}">
    <meta property="og:title" content="{{blogInfo()->blog_name}} - {{$business->name}}">
    <meta property="og:type" content="article">
    <meta property="og:description" content="{{Str::ucfirst(words($business->details, 120))}}">
    <meta property="og:url" content="{{route('business.show',$business->slug)}}">
@endsection
@section('content')
<div class="row">
    <div class="col-lg-8 mb-5 mb-lg-0">
      <article>
        <ul class="post-meta mb-2 mt-4">
          <li>
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="16"
              height="16"
              fill="currentColor"
              style="margin-right: 5px; margin-top: -4px"
              class="text-dark"
              viewBox="0 0 16 16"
            >
              <path
                d="M5.5 10.5A.5.5 0 0 1 6 10h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z"
              />
              <path
                d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z"
              />
              <path
                d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z"
              />
            </svg>
            <span>{{data_formatter($business->created_at)}}</span>
          </li>
        </ul>
        <h1 class="my-3">{{$business->name}}</h1>
        <div class="content text-left">
          <p>{!! $business->details !!}</p>
          <p>Website:- <a href="{{$business->website}}">{!! $business->website !!}</a></p>
          <p>Location:- {!! $business->location !!}</p>
            @if ($business->is_offline == 1)
                <p><b><i>Is Available Offline:- <span class="text-success">Yes</span></i></b></p>
            @else
                <p><b><i>Is Available Offline:- <span class="text-danger">No</span></i></b></p>
            @endif
          <h2 id="emphasis">Contact Now</h2>
          {{-- write mailto href --}}
            <p>Phone:- {!! $business->phone !!}</p>
            <p>Email:- 
                <a href="mailto:{!! $business->email !!}">{!! $business->email !!}</a>
            </p>
        </div>
      </article>

      <div class="mt-5">
        <div id="disqus_thread"></div>
<script>
    var disqus_config = function () {
      this.page.url = "{{route('business.show', $business->slug)}}";  // Replace PAGE_URL with your page's canonical URL variable
      this.page.identifier = "{{$business->id}}"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };
    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://greenpulseconnect.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
      </div>
    </div>
    <div class="col-lg-4">
        <div class="widget-blocks">
            <div class="row">
                <div class="col-lg-12 col-md-6">
                    <div class="widget">
                        <h2 class="section-title mb-3">Latest Posts</h2>
                        <div class="widget-body">
                            <div class="widget-list">
                            @foreach (latest_sidebar_posts() as $item)
                                <a class="media align-items-center" href="{{route('read_post', $item->post_slug)}}">
                                    <img loading="lazy" decoding="async" src="/storage/images/post_images/thumbnails/thumb_{{$item->featured_image}}" alt="Post Thumbnail" class="w-100">
                                    <div class="media-body ml-3">
                                    <h3 style="margin-top:-5px">{{$item->post_title}}</h3>
                                    <p class="mb-0 small">{!! Str::ucfirst(words($item->post_content, 7)) !!}</p>
                                    </div>
                                </a>
                            @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="widget">
                        <h2 class="section-title mb-3">Latest Businesses</h2>
                        <div class="widget-body">
                            <div class="widget-list">
                                @foreach (latest_sidebar_businesses($business->id) as $item)
                                    <a class="media align-items-center" href="{{route('business.show', $item->slug)}}">
                                        <div class="media-body ml-3">
                                        <h3 style="margin-top:-5px">{{$item->name}}</h3>
                                        <p class="mb-0 small">{!! Str::ucfirst(words($item->details, 7)) !!}</p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @if (categories())
                <div class="col-lg-12 col-md-6">
                    <div class="widget">
                        <h2 class="section-title mb-3">Categories</h2>
                        <div class="widget-body">
                            <ul class="widget-list">
                                @foreach (categories() as $item)   
                                    <li><a href="{{route('category_posts', $item->slug)}}">{{Str::ucfirst($item->subcategory_name)}} <span class="ml-auto">({{$item->posts->count()}})</span></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endif
                @if (tags() != null)
                    @php
                        $allTagsString = tags();
                        $allTagsArray = explode(',', $allTagsString);
                    @endphp
                    <div class="col-lg-12 col-md-6">
                        <div class="widget">
                            <h2 class="section-title mb-3">Tags</h2>
                            <div class="widget-body">
                                <ul class="widget-list">
                                    @foreach (array_unique($allTagsArray) as $tag)   
                                        <li><a href="{{route('tag_posts', $tag)}}">#{{$tag}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
  </div>
@endsection
@push('stylesheets')
    <link rel="stylesheet" href="/share_buttons/jquery.floating-social-share.min.css">
@endpush
@push('scripts')
    <script src="/share_buttons/jquery.floating-social-share.min.js"></script>
    <script>
        $("body").floatingSocialShare({
            buttons:[
                "facebook","linkedin","pinterest","reddit","telegram","twitter","whatsapp"
            ],
            text:"Share with: ",
            url:"{{route('business.show', $business->slug)}}"
        })
    </script>
@endpush