<!DOCTYPE html>
<html lang="en">
<head>
@include('admin.head')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  @include('admin.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('admin.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  @include('admin.alert')
    <!-- Main content -->

    @yield('content')

  </div>

  <!-- Main footer -->
@include('admin.footer')
</body>
</html>
