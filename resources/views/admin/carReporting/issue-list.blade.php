@extends('admin.layouts.app', ['isSidebar' => true, 'isNavbar' => true, 'isFooter' => true])
@section('car-issue-active', 'active')
@section('title', __('Car Issue'))
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-multiselect.css') }}">
@endpush
@section('content')
    <!-- Dashboard Content -->
    <div class="dashboard-content">
        <div class="row">
            <!-- DashboardLeft Content -->
            <div class="col-lg-12">
                <div class="tablehead p-0">
                    <h4>List of Issue Car Report</h4>
                    {{-- <div class="tablehead-right">
                    <div class="viewtext mt-0">
                        <button type="button" class="btn qrcode-list-btn mt-0" data-toggle="modal" data-target="#addSupervisor"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New
                            Supervisor</button>
                    </div>
                </div> --}}
                </div>
                <div class="dash-recentused mt-4">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div id="home" class="container tab-pane active p-0">
                            <div class="table-responsive">
                                <table class="table userTable">
                                    <thead>
                                        <tr class="manage-bg-dark">
                                            <th> Id</th>
                                            <th> Name</th>
                                            <th>form_vehicle_id</th>
                                            <th>to_vehicle_id</th>
                                            <th>type</th>
                                            <th>remarks</th>
                                            <th>date</th>
                                            <th>user_id</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @dd($datas); --}}
                                        @if ($datas)
                                            @forelse($datas as $key => $data)
                                                <tr class="manage-enable">
                                                    <td>
                                                        <p>#{{ $key + 1 }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $data->clients?->name }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $data->formVehical?->car_number }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $data->toVehical?->car_number }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $data->type==1?'Damage':'Transfer' }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $data->remarks }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $data->date }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $data->users?->name }}</p>
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
    <x-modals.add-supervisor />
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/ajax/supervisor.js') }}"></script>
    <script src="{{ asset('assets/js/ajax/submit.js') }}"></script>
@endpush
