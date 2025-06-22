<!DOCTYPE html>
<html lang="en">
@include('mainLayout.header')
<body class="hold-transition layout-navbar-fixed layout-footer-fixed sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{url('/public/dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
        </div>
        @include('mainLayout.navbar')
        @include('mainLayout.sidebar')
        @yield('content')
        <footer class="main-footer">
            <strong>Copyright &copy; 2022- <?php echo date('Y')?> <a href="https://tripdesigner.net"> Trip Designer</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    @include('mainLayout.footer')
    @yield('js')
</body>
<?php
if ($message = Session::get('successMessage'))
    echo '<script type="text/javascript">toastr.success("'.$message.'")</script>';
if ($message = Session::get('errorMessage'))
    echo '<script type="text/javascript">toastr.error("'.$message.'")</script>';
?>
</html>
