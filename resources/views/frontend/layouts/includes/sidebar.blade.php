<div class="col-lg-4">
    <div class="widget-blocks">
        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div class="widget">
                <h2 class="section-title mb-3">Recommended</h2>
                <div class="widget-body">
                    <div class="widget-list">
                    <article class="card mb-4">
                        <div class="card-image">
                        <div class="post-info"> <span class="text-uppercase">{{readDuration(oldest_post()->post_title, oldest_post()->post_content)}} @choice('min|mins',readDuration(oldest_post()->post_title, oldest_post()->post_content)) READ</span>
                        </div>
                        <img loading="lazy" decoding="async" src="/storage/images/post_images/thumbnails/resized_{{oldest_post()->featured_image}}" alt="Post Thumbnail" class="w-100">
                        </div>
                        <div class="card-body px-0 pb-1">
                        <h3><a class="post-title post-title-sm"
                            href="{{route('read_post', oldest_post()->post_slug)}}">{{oldest_post()->post_title}}</a></h3>
                        <p class="card-text">{!! Str::ucfirst(words(oldest_post()->post_content, 10)) !!}</p>
                        <div class="content"> <a class="read-more-btn" href="{{route('read_post', oldest_post()->post_slug)}}">Read Full Article</a>
                        </div>
                        </div>
                    </article>
                    @foreach (recommended_posts() as $item)
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