<?php  if(!isset($title)) $title = 'Page'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    @includeIf('admin.layouts.header-meta')
    <title>@yield('title', "$title")</title>
    @livewireStyles
</head>

<body class="">
    <div class="wrapper ">
        @includeIf('admin.layouts.sidebar')
        <div class="main-panel">
            @includeIf('admin.layouts.navbar')
            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            @includeIf('admin.layouts.footer')
        </div>
    </div>
    @includeIf('admin.layouts.footer-meta')
    @stack('script')
    @livewireScripts
</body>

</html>