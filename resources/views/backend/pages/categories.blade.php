@extends('backend.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Categories')
@section('content')

    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">Categories & Subcategories</h2>
        </div>
    </div>
@livewire('categories')
@endsection
@push('scripts')
    <script>
        window.addEventListener('hideCategoriesModal', function(e){
            $('#categories_modal').modal('hide');   
        });
        window.addEventListener('showCategoriesModal', function(e){
            $('#categories_modal').modal('show');   
        });
        window.addEventListener('hideSubcategoriesModal', function(e){
            $('#subcategories_modal').modal('hide');   
        });
        window.addEventListener('showSubcategoriesModal', function(e){
            $('#subcategories_modal').modal('show');   
        });

        $('#categories_modal, #subcategories_modal').on('hidden.bs.modal', function (e) {
            Livewire.emit('resetModalForm');
        });

        window.addEventListener('deleteCategory', function(event){
            swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete category!",
                showCloseButton:true,
                showCancelButton:true,
                cancelButtonText:'Cancel',
                allowOutsideClick:false,
            }).then(function(result){
                if(result.value){
                    Livewire.emit('deleteCategoryConfirm', event.detail.id);
                }
            });
        });

        window.addEventListener('deleteSubcategory', function(event){
            swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete subcategory!",
                showCloseButton:true,
                showCancelButton:true,
                cancelButtonText:'Cancel',
                allowOutsideClick:false,
            }).then(function(result){
                if(result.value){
                    Livewire.emit('deleteSubcategoryConfirm', event.detail.id);
                }
            });
        });

        $('table tbody#sortable_category').sortable({
            update:function(event,ui){
                $(this).children().each(function(index){
                    if($(this).attr('data-ordering') != (index+1)){
                        $(this).attr('data-ordering', (index+1)).addClass('updated');
                    }
                });
                var positions = [];
                $('.updated').each(function(){
                    positions.push([$(this).attr('data-index'), $(this).attr('data-ordering')]);
                    $(this).removeClass('updated');
                });
                // console.log(positions);
                window.livewire.emit('updateCategoryOrdering', positions);
            }
        });

        $('table tbody#sortable_subcategory').sortable({
            update:function(event,ui){
                $(this).children().each(function(index){
                    if($(this).attr('data-ordering') != (index+1)){
                        $(this).attr('data-ordering', (index+1)).addClass('updated');
                    }
                });
                var positions = [];
                $('.updated').each(function(){
                    positions.push([$(this).attr('data-index'), $(this).attr('data-ordering')]);
                    $(this).removeClass('updated');
                });
                // console.log(positions);
                window.livewire.emit('updateSubcategoryOrdering', positions);
            }
        });
    </script>
@endpush