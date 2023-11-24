
<footer class="bg-dark mt-5">
    <div class="container section">
      <div class="row">
        <div class="col-lg-10 mx-auto text-center">
          <a class="d-inline-block mb-4 pb-2" href="{{route('home')}}">
            <img loading="prelaod" decoding="async" class="img-fluid" src="{{blogInfo()->blog_logo}}" style="height:72px !important;" alt="Reporter Hugo">
          </a>
          <ul class="p-0 d-flex navbar-footer mb-0 list-unstyled">
            <li class="nav-item my-0"> <a style="padding: 0.5rem 1rem !important;" class="nav-link" href="{{route('home')}}">Home</a></li>
            <li class="nav-item my-0"> <a style="padding: 0.5rem 1rem !important;" class="nav-link" href="{{route('forum.index')}}">Forum</a></li>
            <li class="nav-item my-0"> <a style="padding: 0.5rem 1rem !important;" class="nav-link" href="{{route('blog')}}">Blog</a></li>
            <li class="nav-item my-0"> <a style="padding: 0.5rem 1rem !important;" class="nav-link" href="{{route('business')}}">Businesses</a></li>
            <li class="nav-item my-0"> <a style="padding: 0.5rem 1rem !important;" class="nav-link" href="{{route('products')}}">Products</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="copyright bg-dark content">Copyright &copy; <script>document.write(new Date().getFullYear())</script> <a href="/" class="link-secondary">{{ blogInfo()->blog_name }}</a>.
        All rights reserved.</div>
  </footer>