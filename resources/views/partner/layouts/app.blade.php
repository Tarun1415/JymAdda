<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->
<head>

  <title>Home | Mantis Bootstrap 5 Admin Template</title>

  <!-- [Meta] -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Mantis is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.">
  <meta name="keywords" content="Mantis, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template">
  <meta name="author" content="CodedThemes">

  <!-- [Favicon] icon -->
  <link rel="icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">

  <!-- [Google Font] Family -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
        id="main-font-link">

  <!-- [Tabler Icons] -->
  <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}">

  <!-- [Feather Icons] -->
  <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}">

  <!-- [Font Awesome Icons] -->
  <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">

  <!-- [Material Icons] -->
  <link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}">

  <!-- [Template CSS Files] -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link">
  <link rel="stylesheet" href="{{ asset('assets/css/style-preset.css') }}">

  <!-- Summernote CSS -->
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.css" rel="stylesheet">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  
  {{-- Page-specific CSS (push from child views) --}}
  @stack('styles')

</head>
<!-- [Head] end -->

<!-- [Body] Start -->
<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">

  <!-- [ Pre-loader ] start -->
  <div class="loader-bg">
    <div class="loader-track">
      <div class="loader-fill"></div>
    </div>
  </div>
  <!-- [ Pre-loader ] End -->

  <!-- [ Sidebar Menu ] start -->
  @include('partner.layouts.sidebar')
  <!-- [ Sidebar Menu ] end -->

  <!-- [ Header ] start -->
  @include('partner.layouts.header')
  <!-- [ Header ] end -->

  <div class="pc-container">
    <div class="pc-content">
      @yield('content')
    </div>
  </div>

  <!-- [ Footer ] start -->
  @include('partner.layouts.footer')
  <!-- [ Footer ] end -->

  <!-- jQuery + Summernote JS (Body End) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.js"></script>

  <!-- [Page Specific JS] start -->
  <script src="{{ asset('assets/js/plugins/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/js/pages/dashboard-default.js') }}"></script>
  <!-- [Page Specific JS] end -->

  <!-- Required Js -->
  <script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/simplebar.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/fonts/custom-font.js') }}"></script>
  <script src="{{ asset('assets/js/pcoded.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>

  <script>layout_change('light');</script>
  <script>change_box_container('false');</script>
  <script>layout_rtl_change('false');</script>
  <script>preset_change("preset-1");</script>
  <script>font_change("Public-Sans");</script>

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Global SweetAlert triggers for Session Flashes -->
  @if(session('success'))
  <script>
      Swal.fire({
          icon: 'success',
          title: 'Success!',
          text: "{!! session('success') !!}",
          confirmButtonColor: '#4f46e5'
      });
  </script>
  @endif

  @if(session('error'))
  <script>
      Swal.fire({
          icon: 'error',
          title: 'Action Failed',
          text: "{!! session('error') !!}",
          confirmButtonColor: '#e3342f'
      });
  </script>
  @endif

  @if($errors->any())
  <script>
      Swal.fire({
          icon: 'error',
          title: 'Validation Errors',
          html: `<ul style="text-align: left; margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                 </ul>`,
          confirmButtonColor: '#4f46e5'
      });
  </script>
  @endif

  <script>
      // Add loading state when forms are submitted (optional but useful for Add/Update)
      $(document).ready(function() {
          $('form.needs-loading').on('submit', function() {
              if (this.checkValidity()) {
                  Swal.fire({
                      title: 'Processing...',
                      text: 'Please wait while we save your data.',
                      allowOutsideClick: false,
                      didOpen: () => {
                          Swal.showLoading();
                      }
                  });
              }
          });
      });
  </script>

  {{-- Page-specific JS (push from child views) --}}
  @stack('scripts')

</body>
<!-- [Body] end -->
</html>
