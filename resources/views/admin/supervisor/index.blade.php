@extends('admin.layouts.app', ['isSidebar' => true, 'isNavbar' => true, 'isFooter' => true])
@section('supervisor-active','active')
@section('title',__('Supervisor'))
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
                <h4>List of Supervisor</h4>
                <div class="tablehead-right">
                    <div class="viewtext mt-0">
                        <button type="button" class="btn qrcode-list-btn mt-0" data-toggle="modal" data-target="#addSupervisor"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New
                            Supervisor</button>
                    </div>
                </div>
            </div>
            <div class="dash-recentused mt-4">
                <!-- Tab panes -->
                <div class="tab-content">
                    <div id="home" class="container tab-pane active p-0">
                        <div class="table-responsive">
                            <table class="table userTable">
                                <thead>
                                    <tr class="manage-bg-dark">
                                        <th>Supervisor Id</th>
                                        <th>Supervisor Name</th>
                                        <th>Phone No.</th>
                                        <th>Email</th>
                                        {{-- <th>Password</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- {{ $supervisors }} --}}
                                    @if($supervisors)
                                    @forelse($supervisors as $key => $supervisor)
                                    <tr class="manage-enable">
                                        <td>
                                            <p>#{{ $key + 1 }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $supervisor->name }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $supervisor->phone }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $supervisor->email }}</p>
                                        </td>
                                        {{-- <td>
                                            <p>{{ $supervisor->password }}</p>
                                        </td> --}}
                                        <td>
                                            <div class="board-right">
                                                <a class="dropdown-item editSupervisor" data-uuid="{{$supervisor->uuid }}" href="javascript:void(0)"><i class="fa mr-1" aria-hidden="true"><img src="{{asset('assets/img/material-edit_icon.png')}}" alt=""></i></a>
                                                {{-- <a class="dropdown-item editLock" data-uuid="{{$supervisor->uuid }}" href="javascript:void(0)"><i class="fa-regular fa-lock"></i></a> --}}
                                                <a class="dropdown-item deleteData" data-uuid="{{$supervisor->uuid }}" data-table="users" href="javascript:void(0)"><i class="fa mr-1" aria-hidden="true"><img src="{{asset('assets/img/feather-trash_icon.png')}}" alt=""></i></a>
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
<x-modals.add-supervisor />
@endsection
@push('scripts')
<script src="{{ asset('assets/js/ajax/supervisor.js') }}"></script>
<script src="{{ asset('assets/js/ajax/submit.js') }}"></script>
@endpush
