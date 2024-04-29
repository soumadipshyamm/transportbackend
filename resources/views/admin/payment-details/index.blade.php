@extends('admin.layouts.app', ['isSidebar' => true, 'isNavbar' => true, 'isFooter' => true])
@section('paymentdetails-active', 'active')
@section('title', __('Paymentm Details'))
@push('styles')
@endpush
@section('content')
    <!-- Dashboard Content -->
    <div class="dashboard-content">
        <div class="row">
            <!-- DashboardLeft Content -->
            <div class="col-lg-12">
                <div class="tablehead p-0">
                    <h4>List of Paymentm Details</h4>
                    <div class="tablehead-right">
                        <div class="viewtext mt-0">
                            <button type="button" class="btn qrcode-list-btn mt-0" data-toggle="modal"
                                data-target="#addPaymentmDetails"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add
                                New
                                Paymentm Details</button>
                        </div>
                    </div>
                </div>
                {{-- @php
                   echo \Carbon\Carbon::now()->endOfMonth()->subMonth()->toDateString();
                @endphp --}}
                <div class="dash-recentused mt-4">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div id="home" class="container tab-pane active p-0">
                            <div class="table-responsive">
                                <table class="table userTable">
                                    <thead>
                                        <tr class="manage-bg-dark">
                                            {{-- <th>Paymentm Details Id</th> --}}
                                            <th>#</th>
                                            <th>Vehical Number</th>
                                            <th>Date</th>
                                            <th>Total Price</th>
                                            <th>Advance Pay</th>
                                            <th>Due Pay</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                            {{-- <th>Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($fetchPaymet)
                                            @forelse($fetchPaymet as $key => $data)
                                                <tr class="manage-enable">
                                                    <td>
                                                        <p>#{{ $key + 1 }}</p>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('vehicle.list') }}">
                                                            <p>{{ $data->vehicle?->car_number ?? '' }}</p>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <p>{{ $data->date }}</p>
                                                    </td>
                                                    <td>
                                                        <p>
                                                            {{ $data->total_price }}
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <p>
                                                            {{ $data->advance_payment }}
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <p>
                                                            {{ $data->due_payment }}
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <p>
                                                            {{ $data->type }}
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <p>
                                                            {{ $data->is_active == 0 ? 'Active' : 'Inactive' }}
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <div class="board-right">
                                                            <a class="dropdown-item editPaymentm Details"
                                                                data-uuid="{{ $data->uuid }}" href="javascript:void(0)"><i
                                                                    class="fa mr-1" aria-hidden="true"><img
                                                                        src="{{ asset('assets/img/material-edit_icon.png') }}"
                                                                        alt=""></i></a>
                                                            <a class="dropdown-item deleteData"
                                                                data-uuid="{{ $data->uuid }}"
                                                                data-table="payment_details" href="javascript:void(0)"><i
                                                                    class="fa mr-1" aria-hidden="true"><img
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
    <x-modals.add-payment />
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/ajax/payment_details.js') }}"></script>
    <script src="{{ asset('assets/js/ajax/submit.js') }}"></script>
@endpush
