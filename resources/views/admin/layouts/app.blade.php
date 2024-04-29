<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('admin.layouts.partials.header')

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        {{-- @include('layouts.partials.flash') --}}
        @include('admin.layouts.partials.navbar')
        @include('admin.layouts.partials.sidebar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content pt-4">
                <div class="container-fluid">
                    @yield('content')
                    <x-modals.password-update />
                </div>
            </div>
        </div>
        @include('admin.layouts.partials.footer')
    </div>
</body>
@include('admin.layouts.partials._footer')

</html>
