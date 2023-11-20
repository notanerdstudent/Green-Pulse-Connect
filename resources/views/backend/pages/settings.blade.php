@extends('backend.layouts.pages-layout')
@section('pageTitle',isset($pageTitle) ? $pageTitle : 'Settings')
@section('content')

    <div class="container-xl">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">Settings</h2>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                  <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                      <a href="#tabs-home-8" class="nav-link active" data-bs-toggle="tab" aria-selected="true" role="tab">General Settings</a>
                    </li>
                    <li class="nav-item" role="presentation">
                      <a href="#tabs-profile-8" class="nav-link" data-bs-toggle="tab" aria-selected="false" tabindex="-1" role="tab">Logo & Favicon</a>
                    </li>
                    <li class="nav-item" role="presentation">
                      <a href="#tabs-activity-8" class="nav-link" data-bs-toggle="tab" aria-selected="false" tabindex="-1" role="tab">Social Media</a>
                    </li>
                  </ul>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="tab-pane fade active show" id="tabs-home-8" role="tabpanel">
                      <h4>General Settings</h4>
                      <div>
                        @livewire('author-general-settings')
                      </div>
                    </div>
                    <div class="tab-pane fade" id="tabs-profile-8" role="tabpanel">
                      <h4>Logo & Favicon</h4>
                      <div class="row">
                        <div class="col-md-6">
                            <h3>Set Blog Logo</h3>
                            <div class="mb-2" style="max-width: 200px">
                                <img src="{{\App\Models\Setting::find(1)->blog_logo}}" alt="" class="img-thumbnail" id="logo-image-preview">
                            </div>
                            <form action="{{ route('author.change-blog-logo')}}" method="post" id="changeBlogLogoForm">
                                @csrf
                                <div class="mb-2">
                                    <input type="file" name="blog_logo" class="form-control" onchange="previewLogo(this);" accept="image/*" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Change Logo</button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <h3>Set Blog Favicon</h3>
                            <div class="mb-2" style="max-width: 100px">
                                <img src="{{\App\Models\Setting::find(1)->blog_favicon}}" alt="" class="img-thumbnail" id="favicon-image-preview">
                            </div>
                            <form action="{{ route('author.change-blog-favicon')}}" method="post" id="changeBlogFaviconForm">
                                @csrf
                                <div class="mb-2">
                                    <input type="file" name="blog_favicon" class="form-control" onchange="previewFavicon(this)" accept=".ico" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Change Favicon</button>
                            </form>
                        </div>
                    </div>
                    </div>
                    <div class="tab-pane fade" id="tabs-activity-8" role="tabpanel">
                      <h4>Social Media</h4>
                      @livewire('author-blog-social-media-form')
                    </div>
                  </div>
                </div>
            </div>        
        </div>
    </div>
@endsection 

@push('scripts')
  <script>
    function previewLogo(input){
      var file = $("input[type=file]").get(0).files[0];
      if(file){
          var reader = new FileReader();
          reader.onload = function(){
              $("#logo-image-preview").attr("src", reader.result);
          }
          reader.readAsDataURL(file);
      }
    }
    function previewFavicon(input){
      var file = $("input[type=file]").get(1).files[0];
      if(file){
          var reader = new FileReader();
          reader.onload = function(){
              $("#favicon-image-preview").attr("src", reader.result);
          }
          reader.readAsDataURL(file);
      }
    }

    $('#changeBlogLogoForm').submit(function(e){
      e.preventDefault();
      var form = this;
      $.ajax({
        url:$(form).attr('action'),
        method:$(form).attr('method'),
        data:new FormData(form),
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
            $(form)[0].reset();
            Livewire.emit('updateTopHeader');
          }else{
            Toastify({
              text: data.msg,
              className: 'error-toast',
            }).showToast();
          }
        }
      });
    });

    $('#changeBlogFaviconForm').submit(function(e){
      e.preventDefault();
      var form = this;
      $.ajax({
        url:$(form).attr('action'),
        method:$(form).attr('method'),
        data:new FormData(form),
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
            $(form)[0].reset();
            Livewire.emit('updateTopHeader');
          }else{
            Toastify({
              text: data.msg,
              className: 'error-toast',
            }).showToast();
          }
        }
      });
    });
  </script>
@endpush