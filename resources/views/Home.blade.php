<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    @include('Template.head')
    <title>Inventori Penjualan</title>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper" id="app">

        <!-- Navbar -->
        @include('Template.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('Template.left-sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Main content -->
            <div class="content">
                <router-view></router-view>
                <vue-progress-bar></vue-progress-bar>
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        @include('Template.footer')
    </div>
    @include('Template.script')
</body>

</html>
