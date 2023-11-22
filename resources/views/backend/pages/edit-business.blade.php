@extends('backend.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Edit Business Listing')
@section('content')

    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Edit Business Listing
                </h2>
            </div>
        </div>
    </div>

    <form action="{{route('author.business.update-business',['listing_id'=>Request('listing_id')])}}" method="POST" id="editListingForm" enctype="multipart/form-data" class="mt-3"> 
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-9">
                        <div class="mb-3">
                            <label class="form-label">Business Title</label>
                            <input type="text" name="listing_title" class="form-control" placeholder="Please Enter Business Title" value="{{$listing->name}}">
                            <span class="text-danger error-text listing_title_error"></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Business Content</label>
                            <textarea name="listing_content" id="listing_content" class="ckeditor form-control" rows="6" placeholder="Business Description....">{!! $listing->details !!}</textarea>
                            <span class="text-danger error-text listing_content_error"></span>
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
                            <label class="form-label">Business Location</label>
                            <input type="text" name="listing_location" class="form-control" placeholder="Please Enter Business Location" value="{{$listing->location}}">
                            <span class="text-danger error-text listing_location_error"></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Business Website</label>
                            <input type="url" name="listing_website" class="form-control" placeholder="Please Enter Business Website" value="{{$listing->website}}">
                            <span class="text-danger error-text listing_website_error"></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Business Email</label>
                            <input type="email" name="listing_email" class="form-control" placeholder="Please Enter Business Email" value="{{$listing->email}}">
                            <span class="text-danger error-text listing_email_error"></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Business Phone Number</label>
                            <input type="tel" name="listing_phone" class="form-control" placeholder="Please Enter Business Phone Number" value="{{$listing->phone}}">
                            <span class="text-danger error-text listing_phone_error"></span>
                        </div>
                        <div class="mb-3">
                            <div class="form-label">Offline Services</label>
                            <select name="listing_is_offline" class="form-select">
                                <option value="1"@if ($listing->is_offline == 1)
                                    selected
                                @endif>Available</option>
                                <option value="0" @if ($listing->is_offline == 0)
                                    selected                                    
                                @endif>Not Available</option>
                            </select>
                            <span class="text-danger error-text listing_is_offline_error"></span>
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
        $('form#editListingForm').on('submit', function(e){
            e.preventDefault();
            var postContent = CKEDITOR.instances.listing_content.getData();
            var form = this;
            var formData = new FormData(form);
            formData.append('listing_content', postContent)
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
                    $(".error-text").html("");
                    $.each(response.responseJSON.errors, function(prefix,val){
                        $(form).find('span.'+prefix+'_error').text(val[0]);
                    });
                }
            });
        });
    </script>
@endpush