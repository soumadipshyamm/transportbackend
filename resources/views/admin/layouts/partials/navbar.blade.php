<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><img
                    src="{{ asset('assets/img/nav.png')}}" class="" alt=""></a>
        </li>
    </ul>
    <h4>Admin</h4>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->


        <!-- User Profile Dropdown Menu -->
        <li class="nav-item user-pro">
            <div class="dropdown">
                <button class="btn bg-transparent dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ auth()->user()->name ?? ''}}
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" data-toggle="modal"
                    data-target="#passwordModal" href="#">Password</a>
                    {{-- <a class="dropdown-item" href="{{ route('logout') }}">Logout</a> --}}
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </li>

    </ul>
</nav>
<!-- /.navbar -->
