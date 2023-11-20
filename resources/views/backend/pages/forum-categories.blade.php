@extends('backend.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Forum Categories')
@section('content')

    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">Categories</h2>
        </div>
    </div>

@livewire('forum-categories')

@endsection
@push('scripts')
<script>    
    window.addEventListener('hideForumCategoriesModal', function(e){
            $('#forumcategories_modal').modal('hide');   
        });
    window.addEventListener('showForumCategoriesModal', function(e){
            $('#forumcategories_modal').modal('show');   
        });
</script>
@endpush