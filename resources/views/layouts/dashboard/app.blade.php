<!DOCTYPE html>
<html dir="{{LaravelLocalization::getCurrentLocaleDirection()}}" lang="{{LaravelLocalization::getCurrentLocale()}}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  @yield('title')
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{asset('public/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('public/dashboard/css/icheck-bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('public/css/all.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('public/dashboard/css/jqvmap.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('public/dashboard/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('public/dashboard/css/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('public/dashboard/css/summernote-bs4.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- sweetalert -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet" />
  {{-- tages plugin --}}
  <link rel="stylesheet" href="{{asset('public/css/fm.tagator.jquery.css')}}">

  {{-- tages plugin --}}
  <link rel="stylesheet" href="{{asset('public/css/Chart.min.css')}}">

  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">


  @if (app()->getLocale() == 'ar')

  {{-- font awsome --}}
  <link rel="stylesheet" href="{{asset('public/css/font.rtl.min.css')}}">

  {{-- admin rtl --}}
  <link rel="stylesheet" href="{{asset('public/css/admin.rtl.min.css')}}">

  {{-- bootstrap rtl --}}
  <link rel="stylesheet" href="{{asset('public/css/bootstrap.rtl.min.css')}}">

  {{-- rtl --}}
  <link rel="stylesheet" href="{{asset('public/css/rtl.css')}}">

  {{-- google font --}}
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300&display=swap" rel="stylesheet">

  <style>
    * {
      font-family: 'Cairo', sans-serif;
    }
  </style>

  @else

  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('public/dashboard/css/adminlte.min.css')}}">

  @endif

  {{-- selector country css --}}
  <link rel="stylesheet" href="{{asset('public/css/countrySelect.min.css')}}">

  {{-- select2 css --}}
  <link rel="stylesheet" href="{{asset('public/css/select2.min.css')}}">

  {{-- custome css file --}}
  <link rel="stylesheet" href="{{asset('public/dashboard/css/custom.dashboard.css')}}">

</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="contauner">
    <div class="wrapper">

      <!-- Navbar -->
      @include('layouts.dashboard._nav')
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      @include('layouts.dashboard._aside')


      <!-- Content Wrapper. Contains page content -->
      @yield('content')
      <!-- /.content-wrapper -->
      {{-- sweet alert --}}

      @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])


      <footer class="main-footer text-center">
        <strong>Copyright &copy; 2014-2019.</strong>
        All rights reserved for engrio.
        <div class="d-none d-sm-inline-block">

        </div>
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark" @if (app()->getLocale() == 'ar')
        style="left: 7px;
        right: auto;"
        @endif>
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
  </div>

  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{asset('public/js/jquery.min.js')}}"></script>
  <script>
    $(document).ready(function(){
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content'),
        }
      });
  });
  </script>

  <!-- counrty select js -->
  <script src="{{asset('public/js/countrySelect.min.js')}}"></script>
  <script>
    $(".country_selector").countrySelect({
      responsiveDropdown:true

    });
  
  </script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{asset('public/js/jquery-ui.min.js')}}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('public/js/bootstrap.bundle.min.js')}}"></script>
  <!-- ChartJS -->
  <script src="{{asset('public/dashboard/js/Chart.min.js')}}"></script>
  <!-- Sparkline -->
  <script src="{{asset('public/dashboard/js/sparkline.js')}}"></script>
  <!-- JQVMap -->
  <script src="{{asset('public/dashboard/js/jquery.vmap.min.js')}}"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{asset('public/dashboard/js/jquery.knob.min.js')}}"></script>
  {{-- sweetalert2 --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <!-- daterangepicker -->
  <script src="{{asset('public/dashboard/js/moment.min.js')}}"></script>
  {{-- <script src="plugins/daterangepicker/daterangepicker.js"></script> --}}
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{asset('public/dashboard/js/tempusdominus-bootstrap-4.min.js')}}"></script>
  <!-- Summernote -->
  <script src="{{asset('public/dashboard/js/summernote-bs4.min.js')}}"></script>
  <!-- overlayScrollbars -->
  <script src="{{asset('public/dashboard/js/jquery.overlayScrollbars.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('public/dashboard/js/adminlte.min.js')}}"></script>
  <!-- select2 -->
  <script src="{{asset('public/js/select2.min.js')}}"></script>
  <!-- number js -->
  <script src="{{asset('public/dashboard/js/number.js')}}"></script>
  <!-- order js -->
  <script src="{{asset('public/dashboard/js/order.js')}}"></script>


  <script>
    //Initialize Select2 Elements
    $(document).ready(function() {
      $('.select2').select2();
    });
  </script>


  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>

  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

  {{-- chart js --}}
  @stack('script')


  {{-- tages plugin--}}
  <script src="{{asset('public/js/fm.tagator.jquery.js')}}">
  </script>

  <script>
    $('.custom_tag').tagator({
autocomplete: ['first', 'second', 'third']
});
  </script>

  {{-- print this js --}}
  <script src="{{asset('public/js/printThis.js')}}">
  </script>

  {{-- custom dashboard js --}}
  <script src="{{asset('public/dashboard/js/custom.js')}}">
  </script>

  <script>
    $(document).on('click', '.print-btn', function(){
   $('#print-area').printThis();
  });
  </script>

  <script>
    $(document).ready(function(){
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content'),
        }
      });
    });
  </script>

  {{-- delete btn--}}
  <script>
    $('.delete_user_btn').on('click', function(e){
      e.preventDefault();

      var url = $(this).data('url');
      var $this = $(this);
    
      Swal.fire({
      title: "{{__('site.delete_title')}}",
      text: "{{__('site.delete_text_1')}}",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: "{{__('site.confirm_delete')}}",
     
    }).then((result) => {
      if (result.value) {
        Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                  );
        
        $.ajax({
            method: 'delete',
            url: url,
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                if (data.status == 'success') {
            
                  $this.closest('tr').remove();
                }
            }, //-- end success
            error: function (error) {
                console.log(error.responseText);
            }

       });//-- end ajax 

      }
    })
        });
  </script>

  {{-- <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes --> --}}
  <script src="{{asset('public/dashboard/js/demo.js')}}"></script>

</body>

</html>