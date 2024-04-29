@extends('admin.layouts.app', ['isSidebar' => true, 'isNavbar' => true, 'isFooter' => true])
@section('vendor-active', 'active')
@section('title', __('Vendors'))
@push('styles')
@endpush
@section('content')
    <!-- Dashboard Content -->
    <div class="dashboard-content">
        <div class="row">
            <!-- DashboardLeft Content -->
            <div class="col-lg-12">
                <div class="tablehead p-0">
                    <h4>List of Vendor</h4>
                    <div class="tablehead-right">
                        <div class="viewtext mt-0">
                            <button type="button" class="btn qrcode-list-btn mt-0" data-toggle="modal"
                                data-target="#addVendor"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New
                                Vendor</button>
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
                                            <th>Vendor Id</th>
                                            <th>Vendor Name</th>
                                            <th>Phone No.</th>
                                            <th>Email</th>
                                            <th>Location</th>
                                            <th>holder_name</th>
                                            <th>ac_no</th>
                                            <th>ifc_code</th>
                                            <th>bank_name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($vendors)
                                            @forelse ($vendors as $key=>$vendor)
                                                <tr class="manage-enable">
                                                    <td>
                                                        <p>#{{ $key + 1 }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $vendor->name }}</p>
                                                    </td>
                                                    <td>
                                                        {{ $vendor->phone }}
                                                    </td>
                                                    <td>
                                                        <p>{{ $vendor->email }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $vendor->address }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $vendor->holder_name }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $vendor->ac_no }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $vendor->ifc_code }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $vendor->bank_name }}</p>
                                                    </td>
                                                    <td>
                                                        <div class="board-right">
                                                            {{-- <a href="{{ route('vendor.details', $vendor->uuid) }}"
                                                                class="text-primary"><i class="fa-solid fa-eye"
                                                                    aria-hidden="true"></i></a> --}}

                                                            {{-- <a class="dropdown-item detailsVendor"
                                                                data-uuid="{{ $vendor->uuid }}" href="javascript:void(0)"><i
                                                                    class="fa mr-1" aria-hidden="true"><img
                                                                        src="{{ asset('assets/img/material-edit_icon.png') }}"
                                                                        alt=""></i></a> --}}
                                                            <a class="dropdown-item editVendor"
                                                                data-uuid="{{ $vendor->uuid }}" href="javascript:void(0)"><i
                                                                    class="fa mr-1" aria-hidden="true"><img
                                                                        src="{{ asset('assets/img/material-edit_icon.png') }}"
                                                                        alt=""></i></a>
                                                            <a class="dropdown-item deleteData"
                                                                data-uuid="{{ $vendor->uuid }}" data-table="vendors"
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
    <x-modals.add-vendor />
    {{-- <x-modals.vendor-details-list :userData='$doctor->users' /> --}}
@endsection
@push('scripts')
    @push('scripts')

            <script src = "{{ asset('assets/js/ajax/vendor.js') }}" >
        </script>
        <script src="{{ asset('assets/js/ajax/submit.js') }}"></script>
    @endpush


    {{-- <x-doctor.list :userData='$doctor->users' :key='$key'/> --}}
