<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    {{-- Bootstrap CSS --}}
    <link rel="stylesheet" href="/css/bootstrap.css">
    {{-- Custom CSS3 --}}
    <link rel="stylesheet" href="/css/dashboard.css">
    {{-- Font --}}
    <link rel="font" href="https://fonts.googleapis.com">
    <link rel="font" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    {{-- Icon --}}
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    {{-- Trix Editor --}}
    <link rel="stylesheet" type="text/css" href="/css/trix.css">
    <script type="text/javascript" src="/js/trix.js"></script>
</head>
<body>
    <div class="wrapper">
        <div class="body-overlay"></div>
        {{-- Sidebar --}}
        @include('layouts.dashboard.sidebar')

        <div id="content">
            @include('layouts.dashboard.navbar')

            <div class="main-content">
                @yield('container')
            </div>
        </div>
    </div>

    <script src="/js/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
                $('#content').toggleClass('active');
            });

            $('.more-button,.body-overlay').on('click', function() {
                $('#sidebar,.body-overlay').toggleClass('show-nav');
            });
        });
    </script>
    @yield('script')
    
    @include('sweetalert::alert')
</body>
</html>
