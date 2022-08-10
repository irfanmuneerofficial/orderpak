<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>OrderPak | @yield('title') </title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('vendor_panel/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('vendor_panel/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('vendor_panel/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('vendor_panel/plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="/vendor_panel/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('vendor_panel/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('vendor_panel/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('vendor_panel/plugins/summernote/summernote-bs4.css') }}">
  <!-- Google Font: Source Sans Pro -->

  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('vendor_panel/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor_panel/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

  {{-- MULTIPLE IMAGE UPLOAD --}}
  <link rel="stylesheet" href="{{ asset('vendor_panel/dist/css/image-uploader.min.css') }}">
  <link href="{{asset('vendor_panel/css/product.css')}}" rel="stylesheet"/>
  <link href="{{asset('vendor_panel/css/tracking.css')}}" rel="stylesheet"/>

  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  {{-- STYLE FOR TAGS START --}}

  {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" /> --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" />

  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('vendor_panel/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor_panel/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="icon" type="image/png" href="{{ asset('frontend/assets/img/favicon.png') }}"/>

  <style type="text/css">
    .label-info {
      background-color: #5bc0de;
  }
    .label {
      display: inline;
      padding: .2em .6em .3em;
      font-size: 75%;
      font-weight: 700;
      line-height: 1;
      color: #fff;
      text-align: center;
      white-space: nowrap;
      vertical-align: baseline;
      border-radius: .25em;
    }
    .vendor-side-color
    {
     background-color: #fff;
    }
    .vendor-side-color li a
    {
        color: #000 !important;
    }
    .name-info a
    {
    color: #000 !important;
    }
    
   .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active, .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active{
       background-color: #34c699 !important;
   }
   .content-wrapper {
    background: #fff !important;
   }
   
   .nav-pills .nav-link.active, .nav-pills .show>.nav-link{
       background-color: #34c699 !important;
   }
   
   .btn-primary{
       background-color: #34c699 !important;
       border-color: #34c699 !important;
   }
   
   .card-primary:not(.card-outline)>.card-header{
       background-color: #34c699 !important;
   }
   .card-primary.card-outline {
    border-top: 3px solid #34c699 !important;
}
  </style>
  
  {{-- STYLE FOR TAGS END --}}

  {{-- SCRIPT FOR TAGS START --}}
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
  {{-- SCRIPT FOR TAGS END --}}
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4 vendor-side-color">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      {{-- <img src="/frontend/assets/img/frontnedlogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" --}}
           {{-- style="opacity: .8"> --}}
      <img src="/frontend/assets/img/frontnedlogo.png" width="230" alt="OrderPak Logo">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <?php $image = \App\Models\Shopinfo::where('vendor_id', Auth::guard('vendor')->user()->id)->first(); ?>
            @if(!$image)
            <img src="/admin/dist/img/noimage.png" class="img-circle elevation-2" width="20px" height="20px" alt="User Image">
            @else
            <img src="/uploads/vendor/shop/{{$image->shop_img}}" class="img-circle elevation-2" width="20px" height="20px" alt="User Image">
            @endif
        </div>
        <div class="info name-info">
          <a href="#" class="d-block"><?php echo Auth::guard('vendor')->user()->business_name ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         <?php 
        
            $id = Auth::guard('vendor')->user()->id;
            $shop = App\Models\Shopinfo::where('vendor_id', $id)->first();

          ?>
          {{-- @if(!$shop)
          <li class="nav-item">
            <a href="/vendor/profile" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Profile & Shop
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('vendor.logout') }}" class="nav-link" onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>{{ __('Logout') }}</p>
            </a>
            <form id="logout-form" action="{{ route('vendor.logout') }}/" method="POST" style="display: none;">
                @csrf
            </form>
          </li>
          @else --}}
          <?php 
          $url = url('');
          $c = url()->current();
          ?>
          <li class="nav-item has-treeview {{($c  == url('/vendor/dashboard')) ? 'menu-open' : ''}} {{($c  == url('/vendor/dashboard')) ? 'menu-open' : ''}}">
            <a href="/vendor/dashboard" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/vendor/dashboard" class="nav-link {{($c  == url('/vendor/dashboard')) ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="/vendor/profile" class="nav-link {{($c == url('/vendor/profile')) ? 'active' : ''}}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Profile & Shop
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview {{($c  == url('/vendor/product')) ? 'menu-open' : ''}} {{($c  == url('/vendor/product/create')) ? 'menu-open' : ''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Products
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('product.create') }}" class="nav-link {{($c  == url('/vendor/product/create')) ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Product</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('product.index') }}" class="nav-link {{($c  == url('/vendor/product')) ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Products</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="/vendor/orders" class="nav-link {{($c  == url('/vendor/orders')) ? 'active' : ''}}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Orders
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/vendor/commission" class="nav-link {{($c  == url('/vendor/commission')) ? 'active' : ''}}">
              <i class="nav-icon fas fa-credit-card"></i>
              <p>
                Commission
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/vendor/payout" class="nav-link {{($c  == url('/vendor/payout')) ? 'active' : ''}}">
              <i class="nav-icon fas fa-credit-card"></i>
              <p>
                Bank Info
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/vendor/wallet" class="nav-link {{($c  == url('/vendor/wallet')) ? 'active' : ''}}">
              <i class="nav-icon fas fa-credit-card"></i>
              <p>
                My Wallet
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{ route('vendor.logout') }}" class="nav-link" onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>{{ __('Logout') }}</p>
            </a>
            <form id="logout-form" action="{{ route('vendor.logout') }}/" method="POST" style="display: none;">
                @csrf
            </form>
          </li>
          {{-- @endif --}}
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('mainContent')
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright © 2021 Orderpak. All Rights Reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> Beta
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('vendor_panel/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('vendor_panel/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('vendor_panel/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('vendor_panel/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('vendor_panel/plugins/sparklines/sparkline.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- JQVMap -->
<script src="{{ asset('vendor_panel/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('vendor_panel/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('vendor_panel/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('vendor_panel/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('vendor_panel/plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
<script src="{{ asset('vendor_panel/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('vendor_panel/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('vendor_panel/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('vendor_panel/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('vendor_panel/dist/js/adminlte.js') }}"></script>
<script src="{{ asset('vendor_panel/dist/js/adminlte.min.js') }}"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('vendor_panel/dist/js/pages/dashboard.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('vendor_panel/dist/js/demo.js') }}"></script>

<!-- Select2 -->
<script src="{{ asset('vendor_panel/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{ asset('vendor_panel/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
<!-- Bootstrap Switch -->
<script src="{{ asset('vendor_panel/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
<!-- bootstrap color picker -->
<script src="{{ asset('vendor_panel/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{asset('vendor_panel/js/product.js')}}"></script>
<!-- DataTables -->
<script src="{{ asset('vendor_panel/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor_panel/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor_panel/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('vendor_panel/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>


{{-- MULTIPLE IMAGE UPLOAD --}}
{{-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script> --}}
<script type="text/javascript" src="{{ asset('vendor_panel/dist/js/image-uploader.min.js') }}"></script>


<script>
    $(function () {

        $('.input-images-1').imageUploader();
    });
</script>



<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>



<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    // //Date range picker
    // $('#reservation').daterangepicker()
    // //Date range picker with time picker
    // $('#reservationtime').daterangepicker({
    //   timePicker: true,
    //   timePickerIncrement: 30,
    //   locale: {
    //     format: 'MM/DD/YYYY hh:mm A'
    //   }
    // })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })
    
    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

  })
</script>

<script>
  $(function () {
    // Summernote
    $('#textarea-product-desc-edit').summernote();
    $('#textarea-product-addition-edit').summernote();
    
    $('#textarea-product-desc').summernote();
    $('#textarea-product-desc').summernote('code', ''); 

    $('#textarea-product-addition').summernote();
    $('#textarea-product-addition').summernote('code', '');
  });
  
  $('#textarea-product-desc-edit,#textarea-product-addition-edit,#textarea-product-desc,#textarea-product-addition').summernote({
toolbar: [
  ['style', ['style']],
  ['font', ['bold', 'underline', 'clear']],
  ['fontname', ['fontname']],
  ['color', ['color']],
  ['para', ['ul', 'ol', 'paragraph']],
  ['table', ['table']],
  ['insert', ['link', 'picture']],
  ['view', ['fullscreen', 'codeview', 'help']],
],
});
</script>
</body>
</html>