<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Responsive Web UI Kit &amp; Dashboard Template based on Bootstrap">
  <meta name="author" content="AdminKit">
  <meta name="keywords" content="adminkit, bootstrap, web ui kit, dashboard template, admin template">
  <title>AdminKit Demo - Web UI Kit &amp; Dashboard Template</title>

  @routes()
  @include('admin.head')
</head>

<body>
  <div class="wrapper">
  @include('admin.menu_left')

    <div class="main">
        @include('admin.menu_top')

      <main class="content">
          @yield('content')
      </main>

        @include('admin.footer')
    </div>
  </div>

  @include('admin.script')
</body>

</html>