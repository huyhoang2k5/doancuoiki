<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Web Tour</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('resources/css/admin/header.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('resources/css/admin/menu.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('resources/css/admin/index.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('resources/css/admin/footer.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('resources/css/admin/style.css') }}" media="all">
    @Vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/admin/header.css', 'resources/css/admin/menu.css', 'resources/css/admin/index.css', 'resources/css/admin/footer.css', 'resources/css/admin/style.css'])
</head>

<body>
    <!-- Menu -->
    @include('layouts.admin.admin_menu')
    <!-- End menu -->

    <!-- Main Content -->
    <div class="main-content">

        <!-- Header -->
        @include('layouts.admin.admin_header')
        <!-- End Header -->

        <!-- Content -->
        <div class="content">
            @yield('content')
        </div>
        <!-- End Content -->

        <!-- Footer -->
        @include('layouts.admin.admin_footer')
        <!-- End Footer -->

    </div>
    <!-- End Main Content -->
</body>

</html>