<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Shamdi - Admin</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/iconweb.jpg') }}" type="image/x-icon">

    {{-- thông báo --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('assetsadmin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assetsadmin/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assetsadmin/css/sb-admin-2.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <style>
        #collapseTwo {
            display:block;
        }
        .sidebar .nav-item .nav-link[data-toggle="collapse"].collapsed::after {
            transform:rotate(90deg);
        }
        .heading_admin {
            color:black;
            width: 100%;
            text-align:center;
            margin:20px 0;
        }
        .container {
            border-radius:10px;
        }
        .table {
            color:black;
            text-align:center;
            font-size:16px;
            line-height:32px;
            border-radius:2px;
        }
        .info__product-gr {
            line-height:120px;
        }
        .link_admin {
            display:block;
            color:white;
            padding:8px;
            margin:6px 0;
            border-radius:10px;
            transition:background-color ease-in .2s;
        }
        .link_admin-fix {
            background-color: #ffb702;
        }
        .link_admin-delete {
            background-color: #ff623d;
        }
        .link_admin-footer {
            width: 100%;
            text-align: center;
            padding-bottom:20px;
            margin-top: 14px;
        }
        a.link_admin-btn {
            color:white;
            text-decoration:none;
            background-color: #71be34;
            padding:12px 16px;
            border-radius:10px;
            margin-top:5px;
            transition:background-color ease-in .2s;
        }
        .link_admin:hover,
        a.link_admin-btn:hover {
          
            color:white;
            background-image:linear-gradient(65deg,orange,blueviolet);
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/admin') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                <i class="fa-solid fa-dragon"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Admin<sup></sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            
            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}">
                    <i class="fa-solid fa-synagogue"></i>
                    <span>Trang người dùng</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/admin') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Thống kê</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
                    aria-controls="collapsePages">
                    <i class="fa-solid fa-users"></i>
                    <span>Mục tài khoản</span>
                </a>
                <div id="collapsePages" class="collapse show" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Tài khoản:</h6>
                        <a class="collapse-item" href="{{ url('/admin/account') }}">Danh sách tài khoản</a>
                        <a class="collapse-item" href="{{ url('/admin/supplier') }}">Ứng tuyển supplier</a>
                        <!-- <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item active" href="blank.html">Blank Page</a> -->
                    </div>
                </div>
            </li>


            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fa-brands fa-product-hunt"></i>
                    <span>Mục sản phẩm</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Sản Phẩm:</h6>
                        <a class="collapse-item" href="{{url('/admin/products')}}">Danh sách sản phẩm</a>
                        <a class="collapse-item" href="{{url('/admin/groupproducts')}}">Nhóm sản phẩm</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fa-solid fa-cart-plus"></i>
                    <span>Mục đơn hàng</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Đơn hàng:</h6>
                        <!-- <a class="collapse-item" href="chitiethoadon.php">Giỏ hàng</a> -->
                        <a class="collapse-item" href="{{ url('/admin/bills') }}">Hóa đơn</a>
                    </div>
                </div>
            </li>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assetsadmin/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('assetsadmin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assetsadmin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assetsadmin/js/sb-admin-2.min.js')}}"></script>


    @include('alert')