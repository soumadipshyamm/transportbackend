@extends('admin.layouts.app', ['isSidebar' => true, 'isNavbar' => true, 'isFooter' => true])
@section('vehicle-active', 'active')
@section('title', __('Vehicle'))
@push('styles')
@endpush
@section('content')
    <!-- Dashboard Content -->
    <div class="dashboard-content">
        <div class="row">
            <!-- DashboardLeft Content -->
            <div class="col-lg-12">
                <div class="tablehead p-0">
                    <h4>List of Vehicles</h4>
                    <div class="tablehead-right">
                        <div class="viewtext mt-0">
                            <button type="button" class="btn qrcode-list-btn mt-0" data-toggle="modal"
                                data-target="#addVehicle"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New
                                Vehicles</button>
                        </div>
                        <!-- Modal -->
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
                                            <th>#</th>
                                            <th>Vehicle No.</th>
                                            <th>Vehicle Type</th>
                                            <th>Vehicle Owner</th>
                                            <th>QR Code</th>
                                            <th>Generate QR</th>
                                            <th>RC No.</th>
                                            {{-- <th>Price/hr</th> --}}
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($vehicales)
                                            @forelse($vehicales as $key => $vehicale)
                                                <tr class="manage-enable">
                                                    <td>
                                                        <p>#{{ $key + 1 }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $vehicale->car_number }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $vehicale->type }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $vehicale->vendors->name }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $vehicale->qr_code }}</p>
                                                    </td>
                                                    <td>
                                                        {{-- <p>{{ $vehicale->qr_code }}</p> --}}
                                                        <a href="#" class="btn btn-qr" data-toggle="modal"
                                                            data-target="#generateQRModal{{ $vehicale->uuid }}">Generate QR
                                                        </a>
                                                    </td>
                                                    <td>
                                                        @if ($vehicale->rc_no)
                                                            <img src="{{ asset('storage/carInOut/' . $vehicale->rc_no) }}"
                                                                alt="intime" height="100px" width="135px">
                                                        @else
                                                            <img src="{{ asset('assets/img/download.jpg') }}" alt="intime"
                                                                height="100px" width="135px">
                                                        @endif
                                                    </td>
                                                    {{-- <td>
                                                        <p>{{ $vehicale->car_price ?? '' }}</p>
                                                    </td> --}}
                                                    <td>
                                                        <div class="board-right">
                                                            <a class="dropdown-item editVehicle"
                                                                data-uuid="{{ $vehicale->uuid }}"
                                                                href="javascript:void(0)"><i class="fa mr-1"
                                                                    aria-hidden="true"><img
                                                                        src="{{ asset('assets/img/material-edit_icon.png') }}"
                                                                        alt=""></i></a>
                                                            {{-- <a class="dropdown-item qrgenerate"
                                                    data-uuid="{{ $vehicale->uuid }}" href="javascript:void(0)"><i class="fa mr-1" aria-hidden="true"><img src="{{asset('assets/img/material-edit_icon.png')}}" alt=""></i></a> --}}
                                                            <a class="dropdown-item deleteData"
                                                                data-uuid="{{ $vehicale->uuid }}" data-table="vehicles"
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

            @foreach ($vehicales as $key => $vehicale)
                <div class="modal fade" id="generateQRModal{{ $vehicale->uuid }}" tabindex="-1" role="dialog"
                    aria-labelledby="generateQRModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Generate QR </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @php
                                // $qrcode=$vehicale->qr_code;
                                // $routeUrl = url('get-show-car-in-out-time', [$vehicale->uuid]);
                            @endphp
                            <div class="modal-body generate-qr">
                                <div class="qrcode_box" id="generate-qr">
                                    <div class="qr_code">
                                        <h3 id="qr_type">
                                            {{ $vehicale->type }}
                                        </h3>
                                        {!! DNS2D::getBarcodeHTML($vehicale->uuid, 'QRCODE', 6, 6, 'black', true) !!}
                                        {{-- <img
                                    src="data:image/png;base64, {!! DNS2D::getBarcodePNG($qrcode, 'QRCODE', 10, 10, 'black', true) !!}">
                                --}}
                                        <p id="qr_number">QR Number:- {{ $vehicale->qr_code }}</p>
                                    </div>
                                    <p id="qr_car_number">Car Number:- {{ $vehicale->car_number }}</p>
                                </div>
                                <div class="qr_download">
                                    <button type="button" class="btn btn-qr" id="download">Download QR</button>
                                    <button type="button" onclick="window.print()" class="btn btn-qrprint">Print
                                        QR</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div><!-- Dashboard Content End -->
    <x-modals.add-vehicles />
    {{--
<x-modals.qr-generate /> --}}
@endsection
@push('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js">
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.esm.js">
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.js"></script>

    <script src="{{ asset('assets/js/ajax/vehicles.js') }}"></script>
    <script src="{{ asset('assets/js/ajax/submit.js') }}"></script>
@endpush
