<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @if (config('app.env') !== 'production')
    <meta name="robots" content="noindex, nofollow">
    @endif
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Transport Service- {{ $pageTitle ?? '' }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600&display=swap"
        rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/css/adminlte.min.css') }}">
    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
    @stack('styles')
</head>
