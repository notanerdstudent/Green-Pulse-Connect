@extends('backend.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : (auth()->user()->type == 1 ? 'All Products' : 'My Products'))
@section('content')
<div class="page-header d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">    
                @if (auth()->user()->type == 1)
                    All Products
                @else
                    My Products
                @endif
            </h2>
        </div>
    </div>
</div>

@livewire('all-products')
@endsection
@push('scripts')
    <script>
        window.addEventListener('deleteProduct', function(event){
            swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete product!",
                showCloseButton:true,
                showCancelButton:true,
                cancelButtonText:'Cancel',
                allowOutsideClick:false,
            }).then(function(result){
                if(result.value){
                    Livewire.emit('deleteProductConfirm', event.detail.id);
                }
            });
        });
    </script>
@endpush