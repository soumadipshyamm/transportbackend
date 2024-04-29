<aside class="main-sidebar sidebar-dark-primary">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard.list') }}" class="brand-link">
        <img src="{{ asset('assets/img/logo-icon.png') }}" alt="Logo" class="brand-image" style="opacity: .8">
        <span class="brand-text"><label>Transportation </label> App</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">

                    <li class="nav-item">
                        <a href="{{ route('dashboard.list') }}" class="nav-link @yield('dashboard-active')">
                            <span class="nav-iconbg"> <img src="{{ asset('assets/img/dashboard.png') }}" alt="">
                            </span>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="{{ route('rolePermission.userAddRole') }}" class="nav-link  @yield('role-active')">
                            <span class="nav-iconbg"> <img src="{{ asset('assets/img/generate.png')}}" alt="">
                            </span>
                            <p>
                                User Management
                            </p>
                        </a>
                    </li> --}}
                    <li class="nav-item">
                        <a href="{{ route('client.list') }}" class="nav-link  @yield('client-active')">
                            <span class="nav-iconbg"> <img src="{{ asset('assets/img/generate.png') }}" alt="">
                            </span>
                            <p>
                                Clients
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('helper.list') }}" class="nav-link  @yield('helper-active')">
                            <span class="nav-iconbg"> <img src="{{ asset('assets/img/generate.png') }}" alt="">
                            </span>
                            <p>
                                Helpers
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('vendor.list') }}" class="nav-link @yield('vendor-active')">
                            <span class="nav-iconbg"> <img src="{{ asset('assets/img/query.png') }}" alt="">
                            </span>
                            <p>Vendors</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('vehicle.list') }}" class="nav-link @yield('vehicle-active')">
                            <span class="nav-iconbg"> <img src="{{ asset('assets/img/reports.png') }}" alt="">
                            </span>
                            <p>Vehicles</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('supervisor.list') }}" class="nav-link @yield('supervisor-active')">
                            <span class="nav-iconbg"> <img src="{{ asset('assets/img/view-web.png') }}" alt="">
                            </span>
                            <p>Supervisors</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('client.alloction') }}" class="nav-link @yield('client-alloction-active')">
                            <span class="nav-iconbg"> <img src="{{ asset('assets/img/view-web.png') }}" alt="">
                            </span>
                            <p>Client Alloction</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('vehicle-allocation.list') }}" class="nav-link @yield('vehicle-alloction-active')">
                            <span class="nav-iconbg"> <img src="{{ asset('assets/img/view-web.png') }}" alt="">
                            </span>
                            <p>Vehicles Alloction</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('expense.list') }}" class="nav-link @yield('expense-active')">
                            <span class="nav-iconbg"> <img src="{{ asset('assets/img/view-qr.png') }}" alt="">
                            </span>
                            <p>Expenses</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('payment_details.list') }}" class="nav-link @yield('paymentdetails-active')">
                            <span class="nav-iconbg"> <img src="{{ asset('assets/img/view-qr.png') }}" alt="">
                            </span>
                            <p>Payment Details</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('carTime.list') }}" class="nav-link">
                            <span class="nav-iconbg"> <img src="{{ asset('assets/img/user-management.png') }}"
                                    alt="">
                            </span>
                            <p>Car Time Report</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('report.carIssueList') }}" class="nav-link @yield('car-issue-active')">
                            <span class="nav-iconbg"> <img src="{{ asset('assets/img/user-management.png') }}"
                                    alt="">
                            </span>
                            <p>Car Issue Report</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('report.list') }}" class="nav-link @yield('car-report-active')">
                            <span class="nav-iconbg"> <img src="{{ asset('assets/img/user-management.png') }}"
                                    alt="">
                            </span>
                            <p>View Car Report</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><span
                                class="nav-iconbg"> <img src="{{ asset('assets/img/logout.png') }}" alt="">
                            </span>
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </div>
    <!-- /.sidebar -->
</aside>
