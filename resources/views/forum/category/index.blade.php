{{-- $category is passed as NULL to the master layout view to prevent it from showing in the breadcrumbs --}}
@extends ('forum.master', ['category' => null])

@section ('content')
    <div class="d-flex flex-row justify-content-between mb-2">
        <h2 class="flex-grow-1">Forum</h2>
    </div>

    @foreach ($categories as $category)
        @include ('forum.category.partials.list', ['titleClass' => 'lead'])
    @endforeach
@stop
