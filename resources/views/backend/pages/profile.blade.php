@extends('backend.layouts.pages-layout')
@section('pageTitle',isset($pageTitle) ? $pageTitle : 'Profile')
@section('content')

@livewire('author-profile-header')

<div class="page-wrapper">
  <div class="page-body">
    <div class="container-xl">
      
      <div class="card">
        <div class="card-header">
          <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
            <li class="nav-item">
              <a href="#tabs-details" class="nav-link active" data-bs-toggle="tab">Personal Details</a>
            </li>
            <li class="nav-item">
              <a href="#tabs-password" class="nav-link" data-bs-toggle="tab">Change Password</a>
            </li>
          </ul>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="tab-pane active show" id="tabs-details">
              <h4>Personal Details</h4>
              <div>
                @livewire('author-personal-details')
              </div>
            </div>
            <div class="tab-pane" id="tabs-password">
              <h4>Change Password</h4>
                @livewire('author-change-password')
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> 
</div>

@endsection 
@push('scripts')

<script>
  $('#changeAuthorPictureFile').ijaboCropTool({
     preview : '',
     setRatio:1,
     allowedExtensions: ['jpg', 'jpeg','png'],
     buttonsText:['CROP','QUIT'],
     buttonsColor:['#30bf7d','#ee5155', -15],
     processUrl:'{{ route("author.change-profile-picture") }}',
     withCSRF:['_token','{{ csrf_token() }}'],
     onSuccess:function(message, element, status){
        Livewire.emit('updateAuthorProfileHeader');
        Livewire.emit('updateTopHeader');
        Toastify({
          text: message,
          className: 'success-toast',
        }).showToast();
     },
     onError:function(message, element, status){
        Toastify({
          text: message,
          className: 'error-toast',
        }).showToast();
     }
  });
</script>
@endpush