@extends('admin.layouts.app', ['isSidebar' => true, 'isNavbar' => true, 'isFooter' => true])
@section('expense-active','active')
@section('title',__('Expense'))
@push('styles')
@endpush
@section('content')
<!-- Dashboard Content -->
<div class="dashboard-content">
    <div class="row">
        <!-- DashboardLeft Content -->
        <div class="col-lg-12">
            <div class="tablehead p-0">
                <h4>List of Expense</h4>
                <div class="tablehead-right">
                    <div class="viewtext mt-0">
                        <button type="button" class="btn qrcode-list-btn mt-0" data-toggle="modal" data-target="#addExpense"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New
                            Expense</button>
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
                                        <th>Expense Id</th>
                                        <th>Driver Name</th>
                                        <th>Vehical Number</th>
                                        <th>Date</th>
                                        <th>Expense Amount</th>
                                        <th>Purpose</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($expenses)
                                    @forelse($expenses as $key => $expens)
                                    <tr class="manage-enable">
                                        <td>
                                            <p>#{{ $key + 1 }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $expens->driver_name }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $expens->vehicles->car_number??'' }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $expens->date }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $expens->expense_amount }}</p>
                                        </td>
                                        <td>
                                            <p>
                                                {{ $expens->purposes }}
                                            </p>
                                        </td>
                                        <td>
                                            <div class="board-right">
                                                <a class="dropdown-item editExpense" data-uuid="{{ $expens->uuid }}" href="javascript:void(0)"><i class="fa mr-1" aria-hidden="true"><img src="{{asset('assets/img/material-edit_icon.png')}}" alt=""></i></a>
                                                <a class="dropdown-item deleteData" data-uuid="{{ $expens->uuid }}" data-table="expenses" href="javascript:void(0)"><i class="fa mr-1" aria-hidden="true"><img src="{{asset('assets/img/feather-trash_icon.png')}}" alt=""></i></a>
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
<x-modals.add-expense />
@endsection
@push('scripts')
<script src="{{ asset('assets/js/ajax/expense.js') }}"></script>
<script src="{{ asset('assets/js/ajax/submit.js') }}"></script>
@endpush
