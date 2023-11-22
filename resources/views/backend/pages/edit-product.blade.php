@extends('backend.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Edit Product')
@section('content')

    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Edit Product
                </h2>
            </div>
        </div>
    </div>

    <form action="{{route('author.products.update-product',['product_id'=>Request('product_id')])}}" method="POST" id="editProductForm" enctype="multipart/form-data" class="mt-3"> 
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-9">
                        <div class="mb-3">
                            <label class="form-label">Product Name</label>
                            <input type="text" name="product_name" class="form-control" placeholder="Please Enter Product Name" value="{{$product->product_name}}">
                            <span class="text-danger error-text product_name_error"></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Review</label>
                            <textarea name="post_content" id="post_content" class="ckeditor form-control" rows="6" placeholder="Product Review....">{!! $product->review !!}</textarea>
                            <span class="text-danger error-text post_content_error"></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Product Brand</label>
                            <input type="text" name="brand" class="form-control" placeholder="Please Enter Product Brand" value="{{$product->brand}}">
                            <span class="text-danger error-text brand_error"></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Product Purchase URL</label>
                            <input type="text" name="purchase_url" class="form-control" placeholder="Please Enter Product Purchase URL" value="{{$product->purchase_url}}">
                            <span class="text-danger error-text purchase_url_error"></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <div class="form-label">Review</label>
                            <select name="product_rating" class="form-select">
                                <option value="5" @if ($product->product_rating == 5) selected @endif>5</option>
                                <option value="4" @if ($product->product_rating == 4) selected @endif>4</option>
                                <option value="3" @if ($product->product_rating == 3) selected @endif>3</option>
                                <option value="2" @if ($product->product_rating == 2) selected @endif>2</option>
                                <option value="1" @if ($product->product_rating == 1) selected @endif>1</option>
                            </select>
                            <span class="text-danger error-text product_rating_error"></span>
                        </div>
                        <div class="mb-3">
                            <div class="form-label">Featured Image</div>
                            <input type="file" name="product_image" class="form-control" accept="image/*" onchange="previewImg(this)" >
                            <span class="text-danger error-text product_image_error"></span>
                        </div>
                        <div class="image_holder mb-2">
                            <img  alt="" class="img-thumbnail" id="image-previewer" src="/storage/images/product_images/thumbnails/resized_{{$product->product_image}}">
                        </div>
                        <button type="submit" class="btn btn-primary">Update Post</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
@push('scripts')
    <script src="/ckeditor\ckeditor.js"></script>
    <script>    
        function previewImg(input){
            var file = $("input[type=file]").get(0).files[0];
            if(file){
                var reader = new FileReader();
                reader.onload = function(){
                    $("#image-previewer").attr("src", reader.result);
                }
                reader.readAsDataURL(file);
            }
        }

        $('form#editProductForm').on('submit', function(e){
            e.preventDefault();
            var postContent = CKEDITOR.instances.post_content.getData();
            var form = this;
            var formData = new FormData(form);
            formData.append('post_content', postContent)
            $.ajax({
                url:$(form).attr('action'),
                method:$(form).attr('method'),
                data: formData,
                processData:false,
                dataType:'json',
                contentType:false,
                beforeSend:function(){},
                success:function(data){
                    if(data.status==1){
                        Toastify({
                        text: data.msg,
                        className: 'success-toast',
                        }).showToast();
                    }else{
                        Toastify({
                        text: data.msg,
                        className: 'error-toast',
                        }).showToast();
                    }
                },
                error:function(response){
                    $.each(response.responseJSON.errors, function(prefix,val){
                        $(form).find('span.'+prefix+'_error').text(val[0]);
                    });
                }
            });
        });
    </script>
@endpush