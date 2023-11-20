@extends('backend.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Add New Post')
@section('content')

    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Add New Post
                </h2>
            </div>
        </div>
    </div>

    <form action="{{route('author.posts.create')}}" method="POST" id="addPostForm" enctype="multipart/form-data" class="mt-3"> 
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-9">
                        <div class="mb-3">
                            <label class="form-label">Post Title</label>
                            <input type="text" name="post_title" class="form-control" placeholder="Please Enter Post Title">
                            <span class="text-danger error-text post_title_error"></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Post Content</label>
                            <textarea name="post_content" id="post_content" class="ckeditor form-control" rows="6" placeholder="Post Content...."></textarea>
                            <span class="text-danger error-text post_content_error"></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <div class="form-label">Post Category</label>
                            <select name="post_category" class="form-select">
                                <option value="">None</option>
                                @foreach (\App\Models\Subcategory::all() as $category)
                                    <option value="{{$category->id}}">{{$category->subcategory_name}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-text post_category_error"></span>
                        </div>
                        <div class="mb-3">
                            <div class="form-label">Featured Image</div>
                            <input type="file" name="featured_image" class="form-control" accept="image/*" onchange="previewImg(this)" >
                            <span class="text-danger error-text featured_image_error"></span>
                        </div>
                        <div class="image_holder mb-2">
                            <img src="" alt="" class="img-thumbnail" id="image-previewer">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Post Tags</label>
                            <input type="text" class="form-control" name="post_tags">
                        </div>
                        <button type="submit" class="btn btn-primary">Save Post</button>
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

        $('form#addPostForm').on('submit', function(e){
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
                        $(form)[0].reset();
                        $("#image-previewer").attr("src", "");
                        CKEDITOR.instances.post_content.setData('');
                        $('input[name="post_tags"]').amsifySuggestags();
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