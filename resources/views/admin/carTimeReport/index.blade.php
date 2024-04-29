@extends('admin.layouts.app', ['isSidebar' => true, 'isNavbar' => true, 'isFooter' => true])
@push('styles')
@endpush
@section('content')
    <!-- Dashboard Content -->
    <div class="dashboard-content">
        <div class="row">
            <!-- DashboardLeft Content -->
            <div class="col-lg-12">
                <div class="tablehead p-0">
                    <h4>In / Out Time</h4>
                    <div class="tablehead-right">
                        <div class="viewtext mt-0">
                            <button type="button" class="btn qrcode-list-btn mt-0" data-toggle="modal"
                                data-target="#addCarInOutTime"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add In /
                                Out
                                Time</button>
                        </div>
                    </div>
                </div>
                <div class="dash-recentused mt-4">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div id="home" class="container tab-pane active p-0">
                            <div class="table-responsive">
                                <table class="table table-hover userTable">
                                    <thead>
                                        <tr class="manage-bg-dark">
                                            <th>Sl No.</th>
                                            <th>Client Name</th>
                                            <th>Vehicle Name</th>
                                            <th>Helpers </th>
                                            <th>In Time</th>
                                            <th>Out Time</th>
                                            <th>Day/Hrs</th>
                                            <th>Shift</th>
                                            <th>In Time Img</th>
                                            <th>Out Time Img</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @if ($carInoutTimes)
                                            @forelse($carInoutTimes as $key => $carInoutTime)
                                                <tr class="manage-enable">
                                                    <td>
                                                        {{ $key + 1 }}
                                                    </td>
                                                    <td>
                                                        <p>{{ $carInoutTime->clients->name }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $carInoutTime->vehical->car_number }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $carInoutTime?->helpers?->name ?? 'N/A' }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $carInoutTime->in_time }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $carInoutTime->out_time }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $carInoutTime->total_hours }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $carInoutTime->hours_type }} Hrs</p>
                                                    </td>
                                                    <td>
                                                        @if ($carInoutTime->in_time_img)
                                                            <img src="{{ asset('storage/carInOut/' . $carInoutTime->in_time_img) }}"
                                                                alt="intime" height="100px" width="135px">
                                                        @else
                                                            <img src="{{ asset('assets/img/download.jpg') }}" alt="intime"
                                                                height="100px" width="135px">
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($carInoutTime->out_time_img)
                                                            <img src="{{ asset('storage/carInOut/' . $carInoutTime->out_time_img) }}"
                                                                alt="outime" height="100px" width="135px">
                                                        @else
                                                            <img src="{{ asset('assets/img/download.jpg') }}"
                                                                alt="outime" height="100px" width="135px">
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="board-right">
                                                            <a class="dropdown-item editCarInOutTime"
                                                                data-uuid="{{ $carInoutTime->uuid }}"
                                                                href="javascript:void(0)"><i class="fa mr-1"
                                                                    aria-hidden="true"><img
                                                                        src="{{ asset('assets/img/material-edit_icon.png') }}"
                                                                        alt=""></i></a>
                                                            {{-- <a class="dropdown-item deleteData"
                                                    data-uuid="{{ $carInoutTime->uuid }}" data-table="car_inout_times"
                                                href="javascript:void(0)"><i class="fa mr-1" aria-hidden="true"><img src="{{asset('assets/img/feather-trash_icon.png')}}" alt=""></i></a> --}}
                                                        </div>
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
                </div>
            </div>
            <!-- DashboardLeft Content -->
        </div>
    </div><!-- Dashboard Content End -->
    <x-modals.car-in-out-time />
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/ajax/carInOutTime.js') }}"></script>
    <script src="{{ asset('assets/js/ajax/submit.js') }}"></script>
@endpush
