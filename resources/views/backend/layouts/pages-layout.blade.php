<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta19
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>@yield('pageTitle')</title>
    <!-- CSS files -->
    <link rel="shortcut icon" href="{{\App\Models\Setting::find(1)->blog_favicon}}" type="image/x-icon">
    <link href="/backend/dist/css/tabler.min.css" rel="stylesheet"/>
    <link href="/backend/dist/css/tabler-flags.min.css" rel="stylesheet"/>
    <link href="/backend/dist/css/tabler-payments.min.css" rel="stylesheet"/>
    <link href="/backend/dist/css/tabler-vendors.min.css" rel="stylesheet"/>
    <link href="/backend/dist/css/toast.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.min.css" rel="stylesheet">
    <link href="/backend/dist/libs/ijabo/ijaboCropTool.min.css" rel="stylesheet">
    <link href="/jquery-ui-1.13.2/jquery-ui.min.css" rel="stylesheet">
    <link href="/jquery-ui-1.13.2/jquery-ui.structure.min.css" rel="stylesheet">
    <link href="/jquery-ui-1.13.2/jquery-ui.theme.min.css" rel="stylesheet">
    <link href="/amsify/amsify.suggestags.css" rel="stylesheet">
    <link href="/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" >

    @stack('stylesheets')
    @livewireStyles
    
  </head>
  <body>
    <script src="/backend/dist/js/demo-theme.min.js"></script>
    <div class="page">
      <!-- Navbar -->
      @include('backend.layouts.includes.header')
      <div class="page-wrapper">
        <!-- Page header -->
        @yield('pageHeader')
        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
            @yield('content')
          </div>
        </div>
        @include('backend.layouts.includes.footer')
      </div>
    </div>
    <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">New report</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Name</label>
              <input type="text" class="form-control" name="example-text-input" placeholder="Your report name">
            </div>
            <label class="form-label">Report type</label>
            <div class="form-selectgroup-boxes row mb-3">
              <div class="col-lg-6">
                <label class="form-selectgroup-item">
                  <input type="radio" name="report-type" value="1" class="form-selectgroup-input" checked>
                  <span class="form-selectgroup-label d-flex align-items-center p-3">
                    <span class="me-3">
                      <span class="form-selectgroup-check"></span>
                    </span>
                    <span class="form-selectgroup-label-content">
                      <span class="form-selectgroup-title strong mb-1">Simple</span>
                      <span class="d-block text-muted">Provide only basic data needed for the report</span>
                    </span>
                  </span>
                </label>
              </div>
              <div class="col-lg-6">
                <label class="form-selectgroup-item">
                  <input type="radio" name="report-type" value="1" class="form-selectgroup-input">
                  <span class="form-selectgroup-label d-flex align-items-center p-3">
                    <span class="me-3">
                      <span class="form-selectgroup-check"></span>
                    </span>
                    <span class="form-selectgroup-label-content">
                      <span class="form-selectgroup-title strong mb-1">Advanced</span>
                      <span class="d-block text-muted">Insert charts and additional advanced analyses to be inserted in the report</span>
                    </span>
                  </span>
                </label>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-8">
                <div class="mb-3">
                  <label class="form-label">Report url</label>
                  <div class="input-group input-group-flat">
                    <span class="input-group-text">
                      https://tabler.io/reports/
                    </span>
                    <input type="text" class="form-control ps-0"  value="report-01" autocomplete="off">
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="mb-3">
                  <label class="form-label">Visibility</label>
                  <select class="form-select">
                    <option value="1" selected>Private</option>
                    <option value="2">Public</option>
                    <option value="3">Hidden</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Client name</label>
                  <input type="text" class="form-control">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Reporting period</label>
                  <input type="date" class="form-control">
                </div>
              </div>
              <div class="col-lg-12">
                <div>
                  <label class="form-label">Additional information</label>
                  <textarea class="form-control" rows="3"></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
              Cancel
            </a>
            <a href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
              Create new report
            </a>
          </div>
        </div>
      </div>
    </div>
    {{-- <button onclick="">Click me</button> --}}
    
    <!-- Libs JS -->
    <script>
      window.addEventListener('showToastr', event => {
        $(document).ready(function(){
          if(event.detail.type==="info"){
            Toastify({
              text: event.detail.message,
              className: 'info-toast',
            }).showToast();
          }else if(event.detail.type==="success"){
            Toastify({
              text: event.detail.message,
              className: 'success-toast',
            }).showToast();
          }else if(event.detail.type==="error"){
            Toastify({
              text: event.detail.message,
              className: 'error-toast',
            }).showToast();
          }else if(event.detail.type==="warning"){
            Toastify({
              text: event.detail.message,
              className: 'warning-toast',
            }).showToast();
          }else{
            return false;
          }
        }
        )
      });
    </script>
    <script src="/backend/dist/libs/jquery/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.min.js"></script>
    <script src="/backend/dist/libs/ijabo/ijaboCropTool.min.js"></script>   
    <script src="/backend/dist/libs/apexcharts/dist/apexcharts.min.js" defer></script>
    <script src="/backend/dist/libs/jsvectormap/dist/js/jsvectormap.min.js" defer></script>
    <script src="/backend/dist/libs/jsvectormap/dist/maps/world.js" defer></script>
    <script src="/backend/dist/libs/jsvectormap/dist/maps/world-merc.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/jquery-ui-1.13.2/jquery-ui.min.js"></script>
    <script src="/amsify/jquery.amsify.suggestags.js"></script>
    <!-- Tabler Core -->
    <script src="/backend/dist/js/tabler.min.js" defer></script>
    @stack('scripts')
    @livewireScripts

    <script>
      $('input[name="post_tags"]').amsifySuggestags();
    </script>
    
  </body>
</html>