<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Bootstrap CSS --}}
    <link rel="stylesheet" href="/css/bootstrap.css">
    {{-- CSS --}}
    <link rel="stylesheet" href="/css/form.css">
    <title>My Blog | {{ $title }} </title>
</head>
<body>
   @include('layouts.sign.navbar')

    <div class="container mt-4">
        @yield('container')
    </div>

    <script src="/js/bootstrap.js"></script>
</body>
</html>
