@extends('backend.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Add New Business Listing')
@section('content')

    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Add New Business Listing
                </h2>
            </div>
        </div>
    </div>

    <form action="{{route('author.business.create')}}" method="POST" id="addBusinessForm" enctype="multipart/form-data" class="mt-3"> 
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-9">
                        <div class="mb-3">
                            <label class="form-label">Business Title</label>
                            <input type="text" name="listing_title" class="form-control" placeholder="Please Enter Business Title">
                            <span class="text-danger error-text listing_title_error"></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Business Content</label>
                            <textarea name="listing_content" id="listing_content" class="ckeditor form-control" rows="6" placeholder="Business Description...."></textarea>
                            <span class="text-danger error-text listing_content_error"></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Business Location</label>
                            <input type="text" name="listing_location" class="form-control" placeholder="Please Enter Business Location">
                            <span class="text-danger error-text listing_location_error"></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Business Website</label>
                            <input type="url" name="listing_website" class="form-control" placeholder="Please Enter Business Website">
                            <span class="text-danger error-text listing_website_error"></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Business Email</label>
                            <input type="email" name="listing_email" class="form-control" placeholder="Please Enter Business Email">
                            <span class="text-danger error-text listing_email_error"></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Business Phone Number</label>
                            <input type="tel" name="listing_phone" class="form-control" placeholder="Please Enter Business Phone Number">
                            <span class="text-danger error-text listing_phone_error"></span>
                        </div>
                        <div class="mb-3">
                            <div class="form-label">Offline Services</label>
                            <select name="listing_is_offline" class="form-select">
                                <option value="1">Available</option>
                                <option value="0">Not Available</option>
                            </select>
                            <span class="text-danger error-text listing_is_offline_error"></span>
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
        $('form#addBusinessForm').on('submit', function(e){
            e.preventDefault();
            var listingContent = CKEDITOR.instances.listing_content.getData();
            var form = this;
            var formData = new FormData(form);
            formData.append('listing_content', listingContent)
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
                        CKEDITOR.instances.listing_content.setData('');
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
                    $(".error-text").html("");
                    $.each(response.responseJSON.errors, function(prefix,val){
                        $(form).find('span.'+prefix+'_error').text(val[0]);
                    });
                }
            });
        });
    </script>
@endpush