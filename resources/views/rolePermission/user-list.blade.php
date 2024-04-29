@extends('admin.layouts.app', ['isSidebar' => true, 'isNavbar' => true, 'isFooter' => true])
@section('role-active','active')
@section('title',__('User Role'))
@push('styles')
@endpush
@section('content')
<div class="dashboard-content">
    <div class="row">
        <!-- DashboardLeft Content -->
        <div class="col-lg-12">
            <div class="tablehead p-0">
                <h4>List of Cients</h4>
                <div class="tablehead-right">
                    <div class="viewtext mt-0">
                        <button type="button" class="btn qrcode-list-btn mt-0" data-toggle="modal" data-target="#addRole"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New
                            Client</button>
                    </div>
                    <!-- Modal -->
                </div>
            </div>
            <div class="dash-recentused mt-4">
                <!-- Tab panes -->
                <div class="tab-content">
                    <div id="home" class="container tab-pane active p-0">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr class="manage-bg-dark">
                                        <th>Client Id</th>
                                        <th>Client Name</th>
                                        <th>Phone No.</th>
                                        <th>Email</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                {{-- <tbody>
                                    @if($clients)
                                    @forelse($clients as $key => $client)
                                    <tr class="manage-enable">
                                        <td>
                                            <p>#{{ $key + 1 }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $client->name }}</p>
                                        </td>
                                        <td>
                                            <p>{{$client->phone }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $client->email }}</p>
                                        </td>
                                        <td>
                                            <div class="board-right">
                                                <a class="dropdown-item editClient" data-uuid="{{ $client->uuid }}" href="javascript:void(0)"><i class="fa mr-1" aria-hidden="true"><img src="{{asset('assets/img/material-edit_icon.png')}}" alt=""></i></a>
                                                <a class="dropdown-item deleteData" data-uuid="{{ $client->uuid }}" data-table="clients" href="javascript:void(0)"><i class="fa mr-1" aria-hidden="true"><img src="{{asset('assets/img/feather-trash_icon.png')}}" alt=""></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    @endforelse
                                    @endif
                                </tbody> --}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- DashboardLeft Content -->
    </div>
</div><!-- Dashboard Content End -->
<x-modals.add-user-role />
@endsection
@push('scripts')
<script src="{{ asset('assets/js/ajax/client.js') }}"></script>
<script src="{{ asset('assets/js/ajax/submit.js') }}"></script>
@endpush
