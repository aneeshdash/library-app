<?php 
      $array = array(
          "BTECH" => 0,
          "MTECH" => 0,
          "PHD"   => 0,
          "FAC"   => 0,
          "MSC"   => 0
        );
      $cnt = DB::table('students_visiting')->count();
      $userid = DB::table('students_visiting')->get();
      foreach($userid as $user)
      {
        $type = DB::table('users')->where('id',$user->user_id)->pluck('type');
          $array["$type"]++;
      }
        
    ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="{{ asset('font-awesome-4.3.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="{{ asset('ionicons-2.0.1/css/ionicons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{ asset('admin_template/dist/css/AdminLTE.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="{{ asset('admin_template/dist/css/skins/_all-skins.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="{{ asset('admin_template/html5shiv.js') }}"></script>
    <script src="{{ asset('admin_template/respond.min.js') }}"></script>
    <![endif]-->
    @yield('head')
</head>
<body class="skin-black">
<!-- Site wrapper -->
<div class="wrapper">

    <header class="main-header">
        <a href="{{ route('adminhome') }}" class="logo">Admin Panel</a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown tasks-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-flag-o"></i>
                  <span class="label label-danger">{{ $cnt }}</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header"> You have &nbsp  <strong><span style="color:red">{{ $cnt }}</span></strong> &nbsp  members visiting tomorrow</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li><!-- Task item -->
                        <a >
                          <h3>
                           Btech students  
                            <strong class="pull-right">{{$array["BTECH"]}}</strong>
                          </h3>
                          
                        </a>
                      </li><!-- end task item -->
                      <li><!-- Task item -->
                        <a >
                          <h3>
                            Mtech students
                            <strong class="pull-right">{{$array["MTECH"]}}</strong>
                          </h3>
                          
                        </a>
                      </li><!-- end task item -->
                      <li><!-- Task item -->
                        <a >
                          <h3>
                            Faculty 
                            <strong class="pull-right">{{$array["FAC"]}}</strong>
                          </h3>
                          
                        </a>
                      </li><!-- end task item -->
                      <li><!-- Task item -->
                        <a >
                          <h3>
                            PHD
                            <strong class="pull-right">{{$array["PHD"]}}</strong>
                          </h3>
                          
                        </a>
                      </li>
                      <li><!-- Task item -->
                        <a >
                          <h3>
                            MSC
                            <strong class="pull-right">{{$array["MSC"]}}</strong>
                          </h3>
                          
                        </a>
                      </li><!-- end task item -->
                    </ul>
                  </li>
                 
                </ul>
              </li>

                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="hidden-xs">Admin</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="" class="img-circle" alt="User Image" />
                                <p>
                                    Admin
                                    <small>Library</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ route('adminlogout') }}" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    
                </div>
                <div class="pull-left info">
                    <p>Admin</p>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">MAIN NAVIGATION</li>
                <li class="treeview">
                    <a href="{{ route('adminhome') }}">
                        <i class="fa fa-home"></i> <span>Home</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="{{ route('adminuser') }}">
                        <i class="fa fa-user"></i> <span>User Profile</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="{{ route('adminlostbook') }}">
                        <i class="fa fa-exclamation-triangle"></i> <span>Lost Book</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="{{ route('newadditions') }}">
                        <i class="fa fa-book"></i><span>New Additions</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-table"></i> <span>Tables</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('tabusers') }}"><i class="fa fa-circle-o"></i>Users</a></li>
                        <li><a href="{{ route('tabbooks') }}"><i class="fa fa-circle-o"></i>Books</a></li>
                        <li><a href="{{ route('tabadmin') }}"><i class="fa fa-circle-o"></i>Admin</a></li>
                        <li><a href="{{ route('tablost') }}"><i class="fa fa-circle-o"></i>LostBooks</a></li>
                        <li><a href="{{ route('tabcat') }}"><i class="fa fa-circle-o"></i>Category</a></li>
                        <li><a href="{{ route('tabpub') }}"><i class="fa fa-circle-o"></i>Publication</a></li>
                        <li><a href="{{ route('tabrules') }}"><i class="fa fa-circle-o"></i>Rules</a></li>
                        <li><a href="{{ route('tabnewadd') }}"><i class="fa fa-circle-o"></i>New Additions</a></li>
                        <li><a href="{{ route('tabenv') }}"><i class="fa fa-circle-o"></i>Environment Variables</a></li>
                    </ul>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div><!-- /.content-wrapper -->

    <footer class="main-footer">
        <strong>Copyright &copy; 2014-2015 <a href="">Admin Page</a>.</strong> All rights reserved.
    </footer>
</div><!-- ./wrapper -->

<!-- jQuery 2.1.3 -->
<script src="{{ asset('admin_template/plugins/jQuery/jQuery-2.1.3.min.js') }}"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<!-- SlimScroll -->
<script src="{{ asset('admin_template/plugins/slimScroll/jquery.slimScroll.min.js') }}" type="text/javascript"></script>
<!-- FastClick -->
<script src="{{ asset('admin_template/plugins/fastclick/fastclick.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin_template/dist/js/app.min.js') }}" type="text/javascript"></script>
@yield('script')
</body>
</html>