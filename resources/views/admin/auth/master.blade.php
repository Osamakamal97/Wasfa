<head>
  @includeIf('admin.layouts.header-meta')
  <title>@yield('title')</title>
</head>

<body class="off-canvas-sidebar">
  <!-- Extra details for Live View on GitHub Pages -->
  <!-- Navbar -->
  @includeIf('admin.auth.layouts.navbar')
  <!-- End Navbar -->
  <div class="wrapper wrapper-full-page"
    style="height:{{ Str::contains(url()->current(),'login') ? '37.6em' :  '41em;' }}">
    <div class="page-header login-page header-filter" filter-color="black"
      style="background-image: url('../../assets/img/login.jpg'); background-size: cover; background-position: top center;">
      <div class="container">
        @yield('content')
      </div>
    </div>
    @includeIf('admin.auth.layouts.footer')
  </div>
  </div>
  @includeIf('admin.auth.layouts.footer-meta')
  @stack('script')
</body>