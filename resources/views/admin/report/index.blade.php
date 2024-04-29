@extends('admin.layouts.app', ['isSidebar' => true, 'isNavbar' => true, 'isFooter' => true])
@push('styles')
<!-- for export -->
{{--
<link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet"> --}}

@endpush
@section('content')
<!-- Dashboard Content -->
<div class="dashboard-content">
    <div class="row">
        <!-- DashboardLeft Content -->
        <div class="col-lg-12">
            <div class="dashboard-head">
                <h3 class="header_title">
                    View Car Report
                </h3>
            </div>
            <div class="tableview-left add-modal" id="searching">
                <div class="form-group">
                    <label for="vechile">Select Vehicle Type</label>
                    <select class="form-control" id="vehicle" name="vehicle">
                        <option value="">select</option>
                        {{ getVehical('') }}
                    </select>
                </div>
                <div class="form-group">
                    <label for="vechile">Select Client</label>
                    <select class="form-control" id="client" name="client">
                        <option value="">select</option>
                        {{ getClients('') }}
                    </select>
                </div>
                <div class="form-group">
                    <label for="vechile">Start Date</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" value="">
                </div>
                <div class="form-group">
                    <label for="vechile">End Date</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" value="">
                </div>
                {{-- <div class="form-group">
                    <label for="vechile">In Time</label>
                    <input type="time" class="form-control" id="start_time" name="start_time" value="00:00:00">
                </div>
                <div class="form-group">
                    <label for="vechile">Out Time</label>
                    <input type="time" class="form-control" id="end_time" name="end_time" value="00:00:00">
                </div> --}}
            </div>
            <form action="{{ route('report.excel','xlsx') }}" method="post">
                @csrf
                <div class="tablehead p-0">
                    <div class="tablehead-right export_btn">

                        <div class="viewtext  text-right mt-0">
                            {{-- <button type="button" </button> --}}
                                {{-- <a href="{{ route('excel') }}" class="btn qrcode-list-btn mt-0"><i
                                        class="fas fa-download"></i>
                                    Export</a> --}}
                                    <button type="submit">Export In Excel</button>
                        </div>
                    </div>
                </div>
                <div class="dash-recentused mt-4">
                    <div class="container active p-0">
                        <div class="table-responsive">
                            <table class="table userTable" id="reportTable">
                                <thead>
                                    <tr class="manage-bg-dark">
                                        <th>#</th>
                                        <th>Vehicle&nbsp;Number</th>
                                        <th>Vehicle&nbsp;Type</th>
                                        <th>Client&nbsp;Name</th>
                                        <th>Contact&nbsp;No.</th>
                                        <th>Date</th>
                                        <th>Car In Time</th>
                                        <th>Car Out Time</th>

                                    </tr>
                                </thead>
                                <tbody id="reportDiv">
                                    @include('admin.report.report')
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- DashboardLeft Content -->
    </div>
</div><!-- Dashboard Content End -->
@endsection
@push('scripts')

<script src="{{ asset('assets/js/ajax/report.js') }}"></script>
<script src="{{ asset('assets/js/ajax/submit.js') }}"></script>

@endpush
