
<header class="navigation">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light px-0">
        <a class="navbar-brand order-1 py-0" href="/">
          <img loading="prelaod" decoding="async" class="img-fluid" src="{{blogInfo()->blog_logo}}" style="height:56px !important;" alt="{{blogInfo()->blog_name}}">
        </a>
        <div class="navbar-actions order-3 ml-0 ml-md-4">
          <button aria-label="navbar toggler" class="navbar-toggler border-0" type="button" data-toggle="collapse"
            data-target="#navigation"> <span class="navbar-toggler-icon"></span>
          </button>
        </div>
        <form action="{{route('search_posts')}}" class="search order-lg-3 order-md-2 order-3 ml-auto">
          <input id="search-query" name="query" value="{{Request('query')}}" type="search" placeholder="Search..." autocomplete="off">
        </form>
        <div class="collapse navbar-collapse text-center order-lg-2 order-4" id="navigation">
          <ul class="navbar-nav mx-auto mt-3 mt-lg-0">
            <li class="nav-item"> <a class="nav-link" href="{{route('home')}}">Home</a></li>
            <li class="nav-item dropdown"> 
              <a class="nav-link dropdown-toggle" href="{{route('forum.index')}}" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Forum</a>
                <div class="dropdown-menu"> 
                  <a class="dropdown-item" href="{{route('forum.index')}}">Index</a>
                  <a class="dropdown-item" href="{{route('forum.recent')}}">Recent Threads</a>
                </div>
            </li>
            <li class="nav-item dropdown"> 
              <a class="nav-link dropdown-toggle" href="{{route('blog')}}" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Blog</a>
                <div class="dropdown-menu"> 
                    @foreach (\App\Models\Category::whereHas('subcategories', function($q){
                        $q->whereHas('posts');
                    })->orderBy('ordering', 'asc')->get() as $category)
                          <a class="dropdown-item" href="#"><b>{{$category->category_name}}</b></a>
                        @foreach (\App\Models\Subcategory::where('parent_category', $category->id)->whereHas('posts')->orderBy('ordering', 'asc')->get() as $subcategory)
                            <a class="dropdown-item" href="{{route('category_posts', $subcategory->slug)}}">{{$subcategory->subcategory_name}}</a>
                        @endforeach
                    @endforeach
                    @if (\App\Models\Subcategory::where('parent_category', 0)->whereHas('posts')->orderBy('ordering', 'asc')->get() ->count() > 0)
                      <a class="dropdown-item" href="#"><b>Uncategorized</b></a>                      
                    @endif
                    @foreach (\App\Models\Subcategory::where('parent_category', 0)->whereHas('posts')->orderBy('ordering', 'asc')->get() as $subcategory)
                        <a class="dropdown-item" href="">{{$subcategory->subcategory_name}}</a>
                    @endforeach
                </div>
            </li>
            
            @if (Auth::check())
            <li class="nav-item"> <a class="nav-link" href="{{route('author.home')}}">Dashboard</a></li>
            @else
            <li class="nav-item"> <a class="nav-link" href="{{route('author.login')}}">Login</a></li>
            @endif
          </ul>
        </div>
      </nav>
    </div>
  </header>