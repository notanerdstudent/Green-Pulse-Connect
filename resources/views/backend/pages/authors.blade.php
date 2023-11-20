@extends('backend.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Authors')
@section('content')
    @livewire('authors')
@endsection

@push('scripts')
    <script>
        $(window).on('hidden.bs.modal', function(){
            Livewire.emit('resetForms');
        });

        window.addEventListener('hide_add_author_modal', function(event){
            $('#add_author_modal').modal('hide');
        });

        window.addEventListener('hide_edit_author_modal', function(event){
            $('#add_author_modal').modal('hide');
        });
        
        window.addEventListener('showEditAuthorModal', function(event){
            $('#edit_author_modal').modal('show');
        });
        
        window.addEventListener('deleteAuthor', function(event){
            swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete author!",
                showCloseButton:true,
                showCancelButton:true,
                cancelButtonText:'Cancel',
                allowOutsideClick:false,
            }).then(function(result){
                if(result.value){
                    Livewire.emit('deleteAuthorization', event.detail.id);
                }
            });
        });
    </script>
@endpush