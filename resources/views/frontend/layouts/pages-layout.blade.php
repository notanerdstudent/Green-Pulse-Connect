
<!DOCTYPE html>
<html lang="en-us">

<head>
	<meta charset="utf-8">
	<title>{{blogInfo()->blog_name}} - @yield('pageTitle')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    
  {{-- Meta --}}
  @yield('meta')

	<link rel="shortcut icon" href="{{blogInfo()->blog_favicon}}" type="image/x-icon">
	<link rel="icon" href="{{blogInfo()->blog_favicon}}" type="image/x-icon">

	<!-- # Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Neuton:wght@700&family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

	<!-- # CSS Plugins -->
	<link rel="stylesheet" href="/frontend/plugins/bootstrap/bootstrap.min.css">
	@stack('stylesheets')

	<!-- # Main Style Sheet -->
	<link rel="stylesheet" href="/frontend/css/style.css">
</head>

<body>
@include('frontend.layouts.includes.header')

<main>
  <section class="section">
    <div class="container min-100vh">
        @yield('content')
    </div>
  </section>
</main>

@include('frontend.layouts.includes.footer')
<!-- # JS Plugins -->
<script src="/frontend/plugins/jquery/jquery.min.js"></script>
<script src="/frontend/plugins/bootstrap/bootstrap.min.js"></script>
@stack('scripts')
<!-- Main Script -->
<script src="/frontend/js/script.js"></script>

</body>
</html>
