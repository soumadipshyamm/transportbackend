@extends('admin.layouts.app', ['isSidebar' => true, 'isNavbar' => true, 'isFooter' => true])
@section('vehicle-alloction-active', 'active')
@section('title', __('Vehicle Alloction'))
@push('styles')
    <!-- bootstrap multi select -->
    <link rel="stylesheet" href="" {{ asset('assets/css/bootstrap-multiselect.css') }}">
@endpush
@section('content')
    <div class="dashboard-content">
        <div class="row">
            <!-- DashboardLeft Content -->
            <div class="col-lg-12">
                <div class="tablehead p-0">
                    <h4>List of Vehicle Allocation</h4>
                    <div class="tablehead-right">
                        <div class="viewtext mt-0">
                            <button type="button" class="btn qrcode-list-btn mt-0" data-toggle="modal"
                                data-target="#addVehicleAlloction"><i class="fa fa-plus-circle" aria-hidden="true"></i>
                                Vehicle Allocation</button>
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
                                            <th>clients</th>
                                            <th>user</th>
                                            <th>vehicles</th>
                                            <th>vendor</th>
                                            <th>allocation</th>
                                            <th>working_hrs</th>
                                            <th>allocation_date</th>
                                            {{-- <th>price</th> --}}
                                            <th>status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($vehicleAllocations)
                                            @forelse ($vehicleAllocations as $key =>$vehicleAllocation)
                                                <tr class="manage-enable">
                                                    <td>
                                                        <p>#{{ $key + 1 }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $vehicleAllocation->client?->name ?? '' }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $vehicleAllocation->user?->name ?? '' }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $vehicleAllocation->vehicle?->car_number ?? '' }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $vehicleAllocation->vehicle?->vendors?->name ?? '' }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $vehicleAllocation->allocation ?? '' }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $vehicleAllocation->working_hrs ?? '' }} hrs</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $vehicleAllocation->allocation_date ?? '' }}</p>
                                                    </td>
                                                    {{-- <td>
                                                        <p>{{ $vehicleAllocation->price ?? '' }}</p>
                                                    </td> --}}
                                                    <td>
                                                        <p>{{ $vehicleAllocation->is_active == 0 ? 'Allocated' : 'Released' }}
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <div class="board-right">
                                                            <a class="dropdown-item editVehicleAlloction"
                                                                data-uuid="{{ $vehicleAllocation->id }}"
                                                                href="javascript:void(0)"><i class="fa mr-1"
                                                                    aria-hidden="true"><img
                                                                        src="{{ asset('assets/img/material-edit_icon.png') }}"
                                                                        alt=""></i></a>
                                                            <a class="dropdown-item deleteData"
                                                                data-uuid="{{ $vehicleAllocation->id }}" data-table="vehicle_allocations"
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
    {{-- <x-modals.client-alloction /> --}}
    <x-modals.vehicles-allocation />
@endsection
@push('scripts')
    {{-- <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap-multiselect.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#multiselect').multiselect({
                buttonWidth: '160px',
                includeSelectAllOption: true,
                nonSelectedText: 'Select an Option'
            });
        });
        function getSelectedValues() {
            var selectedVal = $("#multiselect").val();
            for (var i = 0; i < selectedVal.length; i++) {
                function innerFunc(i) {
                    setTimeout(function() {
                        location.href = selectedVal[i];
                    }, i * 2000);
                }
                innerFunc(i);
            }
        }
    </script> --}}
    <script src="{{ asset('assets/js/ajax/vehicleAllocation.js') }}"></script>
    <script src="{{ asset('assets/js/ajax/submit.js') }}"></script>
@endpush
