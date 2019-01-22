<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>LIS, Calcutta High Court</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"> @include('layouts.css_links')

</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="dashboard" class="logo">
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>LIS, Calcutta HC</b></span>
            </a>
            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="{{asset('images/FacelessMan.png')}}" class="user-image" alt="User Image">
                                <span class="hidden-xs">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="{{asset('images/FacelessMan.png')}}" class="img-circle" alt="User Image">
                                    <p>
                                        Hello {{ Auth::user()->name }}
                                    </p>
                                </li>

                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="update_password" class="btn btn-primary btn-flat">Update Password</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{{ route('logout') }}"  class="btn btn-danger btn-flat"  onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">Sign out</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- Control Sidebar Toggle Button -->

                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li><a href="search"><i class="fa fa-circle-o text-violate"></i> <span>Search Book / Journal</span></a></li>
                    <li><a href="entry_new_book"><i class="fa fa-circle-o text-red"></i> <span>Entry New Book / Journal</span></a></li>
                    <li><a href="update_book"><i class="fa fa-circle-o text-yellow"></i> <span>Update Book / Journal</span></a></li>
                    <li><a href="issue_books"><i class="fa fa-circle-o text-aqua"></i> <span>Issue of Book / Journal</span></a></li>
                    <li><a href="receipt_books"><i class="fa fa-circle-o text-violate"></i> <span>Return of Book / Journal</span></a></li>

                    @if(Auth::user()->status == 'S')
                    
                        <li class="header"></li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-edit"></i>
                                <span>Master Maintainance</span>
                                <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="title_master_maintainance"><i class="fa fa-circle-o text-red"></i> <span>Title Master Maintainance</span></a></li>
                                <li><a href="subject_master_maintainance"><i class="fa fa-circle-o text-yellow"></i> <span>Subject Master Maintainance</span></a></li>
                                <li><a href="location_master_maintainance"><i class="fa fa-circle-o text-aqua"></i> <span>Location Master Maintainance</span></a></li>
                                <li><a href="publisher_master_maintainance"><i class="fa fa-circle-o text-violate"></i> <span>Publisher Master Maintainance</span></a></li>
                                <li><a href="member_master_maintenance"><i class="fa fa-circle-o text-red"></i> <span>Member Master Maintainance</span></a></li>
                                <li><a href="user_master_maintenance"><i class="fa fa-circle-o text-green"></i> <span>User Master Maintainance</span></a></li>                                
                                <li><a href="marked_for_discarded_book"><i class="fa fa-circle-o text-purple"></i> <span>Discard Book / Journal</span></a></li>
                            </ul>
                        </li>

                        <li class="header"></li>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-search-minus"></i>
                                <span>Enquiry / Reports</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="upload_koha_report">Upload Koha Report</a></li>
                                <li><a href="upload_catalogue">Upload Catalogue Data</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Main content -->
            <section class="content">
                @yield('content')
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        @include('layouts.js_links')