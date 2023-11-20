<div>
    <header class="navbar navbar-expand-md d-print-none sticky-top" >
        <div class="container-xl">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="{{route('author.home')}}">
              <img src="{{\App\Models\Setting::find(1)->blog_logo}}"  height="64" alt="Tabler">
            </a>
          </h1>
          <div class="navbar-nav flex-row order-md-last">
            <div class="d-none d-md-flex">
              <a href="{{route('author.profile')}}?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode" data-bs-toggle="tooltip" data-bs-placement="bottom">
                <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" /></svg>
              </a>
              <a href="{{route('author.profile')}}?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode" data-bs-toggle="tooltip" data-bs-placement="bottom">
                <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" /></svg>
              </a>
            </div>
            <div class="nav-item dropdown">
              <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                <span class="avatar avatar-sm" style="background-image: url({{$author->picture}})"></span>
                <div class="d-none d-xl-block ps-2">
                  <div>{{$author->name}}</div>
                  <div class="mt-1 small text-muted"><b>{{$author->username}}</b></div>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <a href="{{route('author.profile')}}" class="dropdown-item">Profile</a>
                @if (auth()->user()->type == 1)
                  <a href="{{route('author.settings')}}" class="dropdown-item">Settings</a>
                @endif
                <a href="{{route('author.logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">Logout</a>
                <form action="{{route('author.logout')}}" id="logout-form" method="POST">@csrf</form>
              </div>
            </div>
          </div>
          <div class="collapse navbar-collapse" id="navbar-menu">
            <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
              <ul class="navbar-nav">
                
                @if (auth()->user()->type == 1)
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('author.categories')}}" >
                      <span class="nav-link-title">
                        Blog Menus & Categories
                      </span>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="{{route('author.forum-categories')}}" >
                      <span class="nav-link-title">
                        Forum Categories
                      </span>
                    </a>
                  </li>
    
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('author.authors')}}" >
                      <span class="nav-link-title">
                        Authors
                      </span>
                    </a>
                  </li>
                @endif

                
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                    <span class="nav-link-title">
                      Posts
                    </span>
                  </a>
                  <div class="dropdown-menu">
                    <div class="dropdown-menu-columns">
                      <div class="dropdown-menu-column">
                        <a class="dropdown-item" href="{{route('author.posts.add-post')}}">
                          Add New
                        </a>
                        <a class="dropdown-item" href="{{route('author.posts.all-posts')}}">
                          @if (auth()->user()->type == 1)
                            All Posts
                          @else
                            My Posts
                          @endif
                          <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">New</span>
                        </a>
                        
                      </div>
                    </div>
                  </div>
                </li>
                {{-- <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#navbar-layout" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                    <span class="nav-link-title">
                      Settings
                    </span>
                  </a>
                  <div class="dropdown-menu">
                    <div class="dropdown-menu-columns">
                      <div class="dropdown-menu-column">
                        <a class="dropdown-item" href="./layout-horizontal.html">
                          General Settings
                        </a>
                      </div>
                    </div>
                  </div>
                </li> --}}
              </ul>
            </div>
          </div>
        </div>
      </header>
</div>
