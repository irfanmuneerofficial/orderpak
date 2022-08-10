<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>OrderPak | @yield('page-title')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  {{-- Admin Style Css --}}
  <link rel="stylesheet" href="/admin/assets/css/admin-style.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="/admin/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="/admin/plugins/jqvmap/jqvmap.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="/admin/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/admin/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="/admin/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="/admin/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="icon" type="image/png" href="/frontend/assets/img/favicon.png"/>
  <link rel="stylesheet" href="{{ asset('admin/assets/css/admin_custom.css') }}">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">&nbsp;
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <!-- Messages Dropdown Menu -->
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge font-weight-bold"><span id="total_alert">0</span></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
          <!-- <span class="dropdown-item dropdown-header"><span class=".total_alert">0</span> Notifications</span> -->
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="ion ion-bag mr-2 text-danger font-weight-bold"></i> <span id="valert">0</span> New Orders
            <!-- <span class="float-right text-muted text-sm">3 mins</span> -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2 text-success font-weight-bold"></i> <span id="oalert">0</span> New Vendor
            <!-- <span class="float-right text-muted text-sm">12 hours</span> -->
          </a>
          <div class="dropdown-divider"></div>
          <div class="dropdown-divider"></div>
          <a href="/admin/notification" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="brand-link">
      <img src="/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Panel</span>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/admin/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::guard('admin')->user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <?php
        $url = url('');
        $c = url()->current();
      ?>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="/admin/dashboard/" class="nav-link {{($c  == url('/admin/dashboard')) ? 'active' : ''}}">
              <p>
                Dashboard
              </p>
            </a>
          </li>
            <li class="nav-item has-treeview {{($c  == url('/admin/profile')) ? 'menu-open' : ''}} {{($c  == url('/admin/profile/changepassword')) ? 'menu-open' : ''}} {{($c  == url('/admin/profile/edit')) ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{($c  == url('/admin/profile')) ? 'active' : ''}} {{($c  == url('/admin/profile/changepassword')) ? 'active' : ''}} {{($c  == url('/admin/profile/edit')) ? 'active' : ''}}">
              <!--<i class="nav-icon fas fa-chart-pie"></i>-->
              <i class="nav-icon fas fa-user-shield"></i>
              <p>
                Account Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/profile" class="nav-link {{($c  == url('/admin/profile')) ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profile</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/profile/changepassword" class="nav-link {{($c  == url('/admin/profile/changepassword')) ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Change Password</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="/admin/roles/" class="nav-link {{($c  == url('/admin/roles')) ? 'active' : ''}}">
              <i class="nav-icon fas fa-fw fa-network-wired"></i>
              <p>
                Roles
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="/admin/headline/" class="nav-link {{($c  == url('/admin/headline')) ? 'active' : ''}}">
              <i class="nav-icon fas fa-newspaper"></i>
              <p>
                Headline Bar
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="/admin/subscribe" class="nav-link {{($c  == url('/admin/subscribe')) ? 'active' : ''}}">
              <!--<i class="nav-icon fas fa-newspaper"></i>-->
              <i class="nav-icon fas fa-layer-plus"></i>
              <p>
                Subscriber
              </p>
            </a>
          </li>
          {{-- <li class="nav-item has-treeview">
            <a href="/admin/vendors" class="nav-link {{($c  == url('/admin/vendors')) ? 'active' : ''}}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Vendors
              </p>
            </a>
          </li> --}}
          <li class="nav-item has-treeview {{($c  == url('/admin/vendors')) ? 'menu-open' : ''}} {{($c  == url('/admin//venodrspayout')) ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{($c  == url('/admin/vendors')) ? 'active' : ''}} {{($c  == url('/admin/venodrspayout')) ? 'active' : ''}}">
              <!--<i class="nav-icon fas fa-chart-pie"></i>-->
              <i class="nav-icon fas fa-user-shield"></i>
              <p>
                Vendors
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/vendors" class="nav-link {{($c  == url('/admin/vendors')) ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Vendors</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/venodrspayout" class="nav-link {{($c  == url('/admin/venodrspayout')) ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Vendors Payout</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="/admin/users" class="nav-link {{($c  == url('/admin/users')) ? 'active' : ''}}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="/admin/sliders" class="nav-link {{($c  == url('/admin/sliders')) ? 'active' : ''}}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Sliders
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview {{($c  == url('/admin/category')) ? 'menu-open' : ''}} {{($c  == url('/admin/category')) ? 'menu-open' : ''}} {{($c  == url('/admin/subcategory')) ? 'menu-open' : ''}} {{($c  == url('/admin/subcategory')) ? 'menu-open' : ''}} {{($c  == url('/admin/childcategory')) ? 'menu-open' : ''}} {{($c  == url('/admin/childcategory')) ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{($c  == url('/admin/category')) ? 'active' : ''}} {{($c  == url('/admin/subcategory')) ? 'active' : ''}} {{($c  == url('/admin/childcategory')) ? 'active' : ''}}">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Categories
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/category" class="nav-link {{($c  == url('/admin/category')) ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Main</p>
                </a>
              </li>
              {{-- <li class="nav-item">
                <a href="/admin/subcategory" class="nav-link {{($c  == url('/admin/subcategory')) ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Parent</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/childcategory" class="nav-link {{($c  == url('/admin/childcategory')) ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Child</p>
                </a>
              </li> --}}
            </ul>
          </li>

          <li class="nav-item has-treeview {{($c  == url('/admin/products')) ? 'menu-open' : ''}} {{($c  == url('/admin/products')) ? 'menu-open' : ''}} {{($c  == url('/admin/product/approved')) ? 'menu-open' : ''}} {{($c  == url('/admin/product/approved')) ? 'menu-open' : ''}} {{($c  == url('/admin/product/pending')) ? 'menu-open' : ''}} {{($c  == url('/admin/product/pending')) ? 'menu-open' : ''}}  {{($c  == url('/admin/product/latest')) ? 'menu-open' : ''}} {{($c  == url('/admin/product/latest')) ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{($c  == url('/admin/products')) ? 'active' : ''}} {{($c  == url('/admin/product/latest')) ? 'active' : ''}} {{($c  == url('/admin/product/approved')) ? 'active' : ''}} {{($c  == url('/admin/product/pending')) ? 'active' : ''}}">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Products
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/products" class="nav-link {{($c  == url('/admin/products')) ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Products</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/product/latest" class="nav-link {{($c  == url('/admin/product/latest')) ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Latest Products</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/product/approved" class="nav-link {{($c  == url('/admin/product/approved')) ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Approved Products</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/product/pending" class="nav-link {{($c  == url('/admin/product/pending')) ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pending Products</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview {{($c  == url('/admin/options')) ? 'menu-open' : ''}} {{($c  == url('/admin/options')) ? 'menu-open' : ''}} 
          {{($c  == url('/admin/options/create')) ? 'menu-open' : ''}} 
          {{($c  == url('/admin/options/approved')) ? 'menu-open' : ''}} {{($c  == url('/admin/product/pending')) ? 'menu-open' : ''}} {{($c  == url('/admin/product/pending')) ? 'menu-open' : ''}}  {{($c  == url('/admin/product/latest')) ? 'menu-open' : ''}} {{($c  == url('/admin/product/latest')) ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{($c  == url('/admin/options')) ? 'active' : ''}} {{($c  == url('/admin/options/latest')) ? 'active' : ''}} {{($c  == url('/admin/options/approved')) ? 'active' : ''}} {{($c  == url('/admin/options/pending')) ? 'active' : ''}}">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Options
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/options" class="nav-link {{($c  == url('/admin/options')) ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create options</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/options/value" class="nav-link {{($c  == url('/admin/options/value')) ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create options Value</p>
                </a>
              </li>
            </ul>
          </li>          
          <li class="nav-item has-treeview {{($c  == url('/admin/orders')) ? 'menu-open' : ''}} {{($c  == url('/admin/orders')) ? 'menu-open' : ''}} {{($c  == url('/admin/order?status=Pending')) ? 'menu-open' : ''}} {{($c  == url('/admin/order?status=Pending')) ? 'menu-open' : ''}} {{($c  == url('/admin/order?status=In Process')) ? 'menu-open' : ''}} {{($c  == url('/admin/order?status=In Process')) ? 'menu-open' : ''}}  {{($c  == url('/admin/order?status=Ship')) ? 'menu-open' : ''}} {{($c  == url('/admin/order?status=Ship')) ? 'menu-open' : ''}}  {{($c  == url('/admin/order?status=Complete')) ? 'menu-open' : ''}} {{($c  == url('/admin/order?status=Complete')) ? 'menu-open' : ''}}  {{($c  == url('/admin/order?status=Cancel')) ? 'menu-open' : ''}} {{($c  == url('/admin/order?status=Cancel')) ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{($c  == url('/admin/orders')) ? 'active' : ''}} {{($c  == url('/admin/order?status=Pending')) ? 'active' : ''}} {{($c  == url('/admin/order?status=In Process')) ? 'active' : ''}} {{($c  == url('/admin/order?status=Ship')) ? 'active' : ''}} {{($c  == url('/admin/order?status=Complete')) ? 'active' : ''}} {{($c  == url('/admin/order?status=Cancel')) ? 'active' : ''}}">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Orders
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/orders" class="nav-link {{($c  == url('/admin/orders')) ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/order/pending?status=Pending" class="nav-link {{($c  == url('/admin/order?status=Pending')) ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/order/process?status=In Process" class="nav-link {{($c  == url('/admin/order?status=In Process')) ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>In Process Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/order/ship?status=Ship" class="nav-link {{($c  == url('/admin/order?status=Ship')) ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ship Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/order/complete?status=Complete" class="nav-link {{($c  == url('/admin/order?status=Complete')) ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Complete Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/order/cancel?status=Cancel" class="nav-link {{($c  == url('/admin/order/cancel?status=Cancel')) ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cancel Orders</p>
                </a>
              </li>

            </ul>
          </li>
          <!--<li class="nav-item">-->
          <!--  <a href="/admin/orders" class="nav-link {{($c  == url('/admin/orders')) ? 'active' : ''}}">-->
          <!--    <i class="nav-icon fas fa-th"></i>-->
          <!--    <p>-->
          <!--      Orders-->
          <!--    </p>-->
          <!--  </a>-->
          <!--</li>-->
          <li class="nav-item has-treeview {{($c  == url('/admin/order/payment')) ? 'menu-open' : ''}} {{($c  == url('/admin/order/unpaid_list')) ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{($c  == url('/admin/order/payment')) ? 'active' : ''}} {{($c  == url('/admin/order/unpaid_list')) ? 'active' : ''}}">
              <!--<i class="nav-icon fas fa-chart-pie"></i>-->
              <i class="nav-icon fas fa-user-shield"></i>
              <p>
                Payment Info
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="/admin/order/payment" class="nav-link {{($c  == url('/admin/order/payment')) ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Payment Transfer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/order/unpaid_list?status=unpaid" class="nav-link {{($c  == url('/admin/order/unpaid_list?status=unpaid')) ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>UnPaid Order list</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/order/unpaid_list?status=paid" class="nav-link {{($c  == url('/admin/order/unpaid_list?status=paid')) ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Paid Order list</p>
                </a>
              </li>
            </ul>
          </li>
         


          <!-- <li class="nav-item">
            <a href="/admin/order/payment" class="nav-link {{($c  == url('/admin/order/payment')) ? 'active' : ''}}">
              <i class="nav-icon fas fa-money-bill-alt"></i>
              <p>
                Payments Transfers
              </p>
            </a>
          </li> -->
          <li class="nav-item">
            <a href="/admin/brand" class="nav-link {{($c  == url('/admin/brand')) ? 'active' : ''}}">
              <!--<i class="nav-icon fas fa-th"></i>-->
              <i class="nav-icon fab fa-bandcamp"></i>
              <p>Brands</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/admin/colors" class="nav-link {{($c  == url('/admin/colors')) ? 'active' : ''}}">
              <!--<i class="nav-icon fas fa-th"></i>-->
              <i class="nav-icon fas fa-palette"></i>
              <p>Colors</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/admin/commission" class="nav-link {{($c  == url('/admin/commission')) ? 'active' : ''}}">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>Commissions</p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="/admin/shipping" class="nav-link {{($c  == url('/admin/shipping')) ? 'active' : ''}}">
              <!--<i class="nav-icon fas fa-newspaper"></i>-->
              <i class="nav-icon fas fa-shipping-fast"></i>
              <p>
                Shipping
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview {{($c  == url('/admin/home_banner_one')) ? 'menu-open' : ''}} {{($c  == url('/admin/home_banner_one')) ? 'menu-open' : ''}} {{($c  == url('/admin/home_banner_two')) ? 'menu-open' : ''}} {{($c  == url('/admin/home_banner_two')) ? 'menu-open' : ''}} {{($c  == url('/admin/home_banner_three')) ? 'menu-open' : ''}} {{($c  == url('/admin/home_banner_three')) ? 'menu-open' : ''}} {{($c  == url('/admin/home_banner_four')) ? 'menu-open' : ''}} {{($c  == url('/admin/home_banner_four')) ? 'menu-open' : ''}} {{($c  == url('/admin/home_content')) ? 'menu-open' : ''}}     {{($c  == url('/admin/home_content')) ? 'menu-open' : ''}}

          {{($c  == url('/admin/category_banner')) ? 'menu-open' : ''}} {{($c  == url('/admin/category_banner')) ? 'menu-open' : ''}} {{($c  == url('/admin/shop_banner')) ? 'menu-open' : ''}} {{($c  == url('/admin/shop_banner')) ? 'menu-open' : ''}}
          ">
            <a href="#" class="nav-link {{($c  == url('/admin/home_banner_one')) ? 'active' : ''}} {{($c  == url('/admin/home_banner_two')) ? 'active' : ''}} {{($c  == url('/admin/home_banner_three')) ? 'active' : ''}} {{($c  == url('/admin/home_banner_four')) ? 'active' : ''}} {{($c  == url('/admin/category_banner')) ? 'active' : ''}} {{($c  == url('/admin/shop_banner')) ? 'active' : ''}}  ">
              <!--<i class="nav-icon fas fa-circle"></i>-->
              <i class="nav-icon far fa-file-word"></i>
              <p>
                Pages
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview ">
              <li class="nav-item has-treeview {{($c  == url('/admin/home_banner_one')) ? 'menu-open' : ''}} {{($c  == url('/admin/home_banner_one')) ? 'menu-open' : ''}} {{($c  == url('/admin/home_banner_two')) ? 'menu-open' : ''}} {{($c  == url('/admin/home_banner_two')) ? 'menu-open' : ''}} {{($c  == url('/admin/home_banner_three')) ? 'menu-open' : ''}} {{($c  == url('/admin/home_banner_three')) ? 'menu-open' : ''}} {{($c  == url('/admin/home_banner_four')) ? 'menu-open' : ''}} {{($c  == url('/admin/home_banner_four')) ? 'menu-open' : ''}} {{($c  == url('/admin/home_content')) ? 'menu-open' : ''}}     {{($c  == url('/admin/home_content')) ? 'menu-open' : ''}}
              ">
                <a href="#" class="nav-link {{($c  == url('/admin/home_banner_one')) ? 'active' : ''}} {{($c  == url('/admin/home_banner_two')) ? 'active' : ''}} {{($c  == url('/admin/home_banner_three')) ? 'active' : ''}} {{($c  == url('/admin/home_banner_four')) ? 'active' : ''}} {{($c  == url('/admin/home_content')) ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Home
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="/admin/home_banner_one" class="nav-link {{($c  == url('/admin/home_banner_one')) ? 'active' : ''}}">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Banner 1</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/admin/home_banner_two" class="nav-link {{($c  == url('/admin/home_banner_two')) ? 'active' : ''}}">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Banner 2</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/admin/home_banner_three" class="nav-link {{($c  == url('/admin/home_banner_three')) ? 'active' : ''}}">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Banner 3</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/admin/home_banner_four" class="nav-link {{($c  == url('/admin/home_banner_four')) ? 'active' : ''}}">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Banner 4</p>
                    </a>
                  </li>
                   <li class="nav-item">
                    <a href="/admin/home_content" class="nav-link {{($c  == url('/admin/home_content')) ? 'active' : ''}}">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Home Content</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item has-treeview {{($c  == url('/admin/category_banner')) ? 'menu-open' : ''}} {{($c  == url('/admin/category_banner')) ? 'menu-open' : ''}}">
                <a href="#" class="nav-link {{($c  == url('/admin/category_banner')) ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Category
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="/admin/category_banner" class="nav-link {{($c  == url('/admin/category_banner')) ? 'active' : ''}}">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Category Banner</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item has-treeview {{($c  == url('/admin/shop_banner')) ? 'menu-open' : ''}} {{($c  == url('/admin/shop_banner')) ? 'menu-open' : ''}}">
                <a href="#" class="nav-link {{($c  == url('/admin/shop_banner')) ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Shop
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="/admin/shop_banner" class="nav-link {{($c  == url('/admin/shop_banner')) ? 'active' : ''}}">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Shop Banner</p>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="/admin/wishlist" class="nav-link {{($c  == url('/admin/wishlist')) ? 'active' : ''}}">
              <i class="nav-icon fa fa-heart" aria-hidden="true"></i>
              <p>
                Wishlist
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="/admin/blockedips" class="nav-link {{($c  == url('/admin/blockedips')) ? 'active' : ''}}">
              <i class="nav-icon fas fa-ban"></i>
              <p>
                Blocked Ips
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview {{($c  == url('/admin/settings')) ? 'menu-open' : ''}} {{($c  == url('/admin/settings')) ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{($c  == url('/admin/settings')) ? 'active' : ''}}">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/settings" class="nav-link {{($c  == url('/admin/settings')) ? 'active' : ''}}">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>Script Text</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/smsapi" class="nav-link {{($c  == url('/admin/smsapi')) ? 'active' : ''}}">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>Sms Api</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('admin.logout') }}/" method="POST" style="display: none;">
                @csrf
            </form>
          </li>
        </ul>
      </nav>
    </div>
  </aside>
    @yield('mainContent')
  <footer class="main-footer">
    <strong>Copyright &copy; 2020-2021 <a href="https://orderpak.com/">OrderPak</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Beta Version</b>
    </div>
  </footer>

  <aside class="control-sidebar control-sidebar-dark">
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/admin/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="/admin/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="/admin/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="/admin/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="/admin/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="/admin/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/admin/plugins/moment/moment.min.js"></script>
<script src="/admin/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="/admin/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/admin/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{-- <script src="/admin/dist/js/pages/dashboard.js"></script> --}}
<!-- bootstrap color picker -->
<script src="/admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/admin/dist/js/demo.js"></script>
<!-- Select2 -->
<script src="/admin/plugins/select2/js/select2.full.min.js"></script>
<!-- DataTables -->
<script src="/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
{{-- Admin Script.js --}}
  <script src="/admin/assets/js/admin-script.js"></script>

<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>

<script>
$(document).ready(function() {

} );
          // jQuery.noConflict();
//   $(function () {
      jQuery(function ($){
      $.noConflict();
    $('.select2').select2()
    //Initialize Select2 Elements
    $('.select2bs4').select2({
    theme: 'bootstrap4'
    })

    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
      "paging": false,
      "ordering": false,
      "info": false,
    });
    $('#example2').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": true,
      "ordering": false,
      "info": false,
      "autoWidth": false,
      "responsive": true,
    });

    $('#dataexample').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });

    $('#example3').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'print'
        ]
    } );

    $('#vendorlistadmin').DataTable({
      "responsive": true,
      "autoWidth": false,
      "paging": true,
      "ordering": false,
      "info": true,
    });

    $('#commissionList').DataTable({
      "responsive": true,
      "autoWidth": false,
      "ordering": false,
    });
  });

  $("#shipping_list").DataTable({
    "responsive": true,
    "autoWidth": false,
    "ordering": false,
  });
</script>

@stack('ajax_crud')
@stack('page-show')
@stack('vendor-edit-script')
@stack('user-edit-admin-page')
@stack('userlist-page-script')
@stack('deactive-vendor-page-script')
@stack('wishlist-page-script')
@stack('order-edit-page')
@stack('role-create-js')
@stack('role-edit-js')
@stack('category_list-page-script')
@stack('admin_prodcut_index')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script>
setInterval(function(){
  totalNotificationList();
}, 10000);

function totalNotificationList()
{
  $.ajax({
    method: "GET",
    url: '/admin/notify/',
    success: function (response) 
    {
      var total_count = parseInt(response['vendor_count']) + parseInt(response['order_count']);
      $("#valert").html(response['vendor_count']);
      $("#oalert").html(response['order_count']);
      $("#total_alert").html(total_count);
    },                               
  });
}
</script>
</body>
</html>