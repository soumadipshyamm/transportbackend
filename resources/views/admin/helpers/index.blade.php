@extends('admin.layouts.app', ['isSidebar' => true, 'isNavbar' => true, 'isFooter' => true])
@section('helper-active', 'active')
@section('title', __('Helper'))
@push('styles')
@endpush
@section('content')
    <div class="dashboard-content">
        <div class="row">
            <!-- DashboardLeft Content -->
            <div class="col-lg-12">
                <div class="tablehead p-0">
                    <h4>List of Helper</h4>
                    <div class="tablehead-right">
                        <div class="viewtext mt-0">
                            <button type="button" class="btn qrcode-list-btn mt-0" data-toggle="modal"
                                data-target="#addHelper"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New
                                Helper</button>
                        </div>
                        <!-- Modal -->
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
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Salary</th>
                                            <th>Incentive</th>
                                            <th>Bank Name</th>
                                            <th>IFC Code</th>
                                            <th>AC No.</th>
                                            <th>Hholder Name</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($helpers)
                                            @forelse($helpers as $key => $helper)
                                                <tr class="manage-enable">
                                                    <td>
                                                        <p>#{{ $key + 1 }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $helper->name ?? 'N/A' }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $helper->phone ?? 'N/A' }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $helper->email ?? 'N/A' }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $helper->address ?? 'N/A' }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $helper->salary ?? 'N/A' }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $helper->incentive ?? 'N/A' }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $helper->bank_name ?? 'N/A' }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $helper->ifc_code ?? 'N/A' }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $helper->ac_no ?? 'N/A' }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $helper->holder_name ?? 'N/A' }}</p>
                                                    </td>

                                                    <td>
                                                        <div class="board-right">
                                                            <a class="dropdown-item editHelper"
                                                                data-uuid="{{ $helper->uuid }}"
                                                                href="javascript:void(0)"><i class="fa mr-1"
                                                                    aria-hidden="true"><img
                                                                        src="{{ asset('assets/img/material-edit_icon.png') }}"
                                                                        alt=""></i></a>
                                                            <a class="dropdown-item deleteData"
                                                                data-uuid="{{ $helper->uuid }}" data-table="helpers"
                                                                href="javascript:void(0)"><i class="fa mr-1"
                                                                    aria-hidden="true"><img
                                                                        src="{{ asset('assets/img/feather-trash_icon.png') }}"
                                                                        alt=""></i></a>
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
    <x-modals.add-helper />
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/ajax/helper.js') }}"></script>
    <script src="{{ asset('assets/js/ajax/submit.js') }}"></script>
@endpush
