@extends('admin.layouts.app', ['isSidebar' => true, 'isNavbar' => true, 'isFooter' => true])
@section('dashboard-active','active')
@section('title',__('Dashboard'))
@push('styles')
@endpush
@section('content')
<!-- Dashboard Content -->
<div class="dashboard-content">
    <div class="row">
        <div class="dashboard-head">
            <h3 class="header_title">
                Today's
            </h3>
        </div>
        <!-- DashboardLeft Content -->
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-3 com-md-3 col-12">
                    <div class="dashcard">
                        <p>No of Clients</p>
                        <h2>
                            {{ count($clients) }}
                        </h2>
                        <div class="dashcard-footer">
                            <div class="dashcard-footer-arrow"><a href="#"><img
                                        src="{{asset('assets/img/dashcard-footer-arrow.png')}}" class="" alt=""></a>
                            </div>
                            <div class="metro-qrcode"><a href="#"><img src="{{asset('assets/img/metro-qrcode.png')}}"
                                        class="" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 com-md-3 col-12">
                    <div class="dashcard">
                        <p>No of Vehicles</p>
                        <h2 class="text-primary">{{ count($vehical) }}</h2>
                        <div class="dashcard-footer">
                            <div class="dashcard-footer-arrow"><a href="#"><img
                                        src="{{asset('assets/img/dashcard-footer-arrow.png')}}" class="" alt=""></a>
                            </div>
                            <div class="metro-qrcode"><a href="#"><img src="{{asset('assets/img/metro-qrcode.png')}}"
                                        class="" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 com-md-3 col-12">
                    <div class="dashcard">
                        <p>No of Vendor</p>
                        <h2 class="text-warning">{{ count($vendors) }}</h2>
                        <div class="dashcard-footer">
                            <div class="dashcard-footer-arrow"><a href="#"><img
                                        src="{{asset('assets/img/dashcard-footer-arrow.png')}}" class="" alt=""></a>
                            </div>
                            <div class="metro-qrcode"><a href="#"><img src="{{asset('assets/img/metro-qrcode.png')}}"
                                        class="" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 com-md-3 col-12">
                    <div class="dashcard">
                        <p>No of Users</p>
                        <h2 class="text-purple">{{ count($supervisor) }}</h2>
                        <div class="dashcard-footer">
                            <div class="dashcard-footer-arrow"><a href="#"><img
                                        src="{{asset('assets/img/dashcard-footer-arrow.png')}}" class="" alt=""></a>
                            </div>
                            <div class="metro-qrcode"><a href="#"><img src="{{asset('assets/img/metro-qrcode.png')}}"
                                        class="" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dash-recentused mt-4">
                <div class="tablehead">
                    <h3>Vehicle In / Out</h3>
                    <div class="viewtext"><a href="{{ route('carTime.list') }}">View All <i class="fa ml-1" aria-hidden="true"><img
                                    src="{{asset('assets/img/Iconfeather-arrow-down-left.png')}}" alt=""></i></a></div>
                </div>
                <div class="table-responsive dastable">
                    <table class="table table-striped table-hover userTable">
                        <thead>
                            <tr class="manage-bg-dark">
                                <th>#</th>
                                <th>Vehicle&nbsp;Number</th>
                                <th>Vehicle&nbsp;Type</th>
                                <th>Date</th>
                                <th>In Time</th>
                                <th>Out Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($carInOutReports)
                            @forelse ($carInOutReports as $key=> $carInOutReport )

                            <tr class="manage-enable">
                                <td>
                                    <p>#{{ $key + 1 }}</p>
                                </td>
                                <td>
                                    <p>{{ $carInOutReport->vehical->car_number }}</p>
                                </td>
                                <td>
                                    <p>{{ $carInOutReport->vehical->type }}</p>
                                </td>
                                <td>
                                    <p>{{ $carInOutReport->car_date }}</p>
                                </td>
                                <td>
                                    <p class="in-time"><span><i class="fas fa-dot-circle"></i></span>{{ $carInOutReport->in_time }}</p>
                                </td>
                                <td>
                                    <p class="out-time"><span><i class="fas fa-dot-circle"></i></span>{{ $carInOutReport->out_time }}</p>
                                </td>
                            </tr>
                            @empty

                            @endforelse
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- DashboardLeft Content -->
    </div>
</div><!-- Dashboard Content End -->
@endsection
@push('scripts')
@endpush
