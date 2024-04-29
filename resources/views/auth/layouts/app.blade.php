<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('auth.layouts.partials.header')

<body class="hold-transition login-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 com-md-12 col-12">
                <div class="login_logo"> <a href="#" class="brand-link logo-login">
                        <img src="dist/img/logo-icon.png" alt="" class="brand-image elevation-3" style="opacity: .8">
                        <span class="brand-text"><label>Transportation </label> App</span>
                    </a></div>
            </div>
            <div class="col-lg-7 com-md-6 col-12">
                <div class="login-right-img">
                    <img src="{{asset('assets/img/login-leftimg.png')}}" alt="" title="">
                </div>
            </div>

            <div class="col-lg-5 com-md-6 col-12">
                <div class="login-box">

                    <main class="py-4">
                        @yield('content')
                    </main>
                </div>
            </div>
            <!-- /.login-box -->
        </div>
    </div>
    </div>
    @include('auth.layouts.partials._footer')
</body>

</html>
