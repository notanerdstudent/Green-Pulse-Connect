@extends('backend.layouts.auth-layout')
@section('pageTitle',isset($pageTitle) ? $pageTitle : 'Signup')
@section('content')

<div class="page page-center">
    <div class="container container-normal py-4">
        <div class="row align-items-center g-4">
            <div class="col-lg">
                <div class="container-tight">
                    <div class="text-center mb-4">
                        <a href="." class="navbar-brand navbar-brand-autodark"><img src="{{\App\Models\Setting::find(1)->blog_logo}}" height="36" alt=""></a>
                    </div>
                    <div class="card card-md">
                        <div class="card-body">
                            <h2 class="h2 text-center mb-4">Signup to {{blogInfo()->blog_name}}</h2>
                             @livewire('author-signup-form')
                        </div>
                    </div>
                    <div class="text-center text-muted mt-3">
                        Already have an account? <a href="{{route('author.login')}}" tabindex="-1" class="color-main">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection