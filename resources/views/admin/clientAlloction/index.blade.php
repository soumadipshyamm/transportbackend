@extends('admin.layouts.app', ['isSidebar' => true, 'isNavbar' => true, 'isFooter' => true])
@section('client-alloction-active','active')
@section('title',__('Client Alloction'))
@push('styles')
<!-- bootstrap multi select -->
<link rel="stylesheet" href="" {{ asset('assets/css/bootstrap-multiselect.css')}}">
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
                        <button type="button" class="btn qrcode-list-btn mt-0" data-toggle="modal" data-target="#addClientAlloction"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add
                            New
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
                            <table class="table userTable">
                                <thead>
                                    <tr class="manage-bg-dark">
                                        <th>Client Id</th>
                                        <th>Supervisor Name</th>
                                        <th>Client Name</th>
                                        {{-- <th>Phone No.</th>
                                        <th>Email</th> --}}
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- {{ $clientsAlloctions }} --}}
                                    @php
                                    // dd($clientsAlloctions[1]->clientsAlloction[0]->name);
                                    @endphp
                                    @if($clientsAlloctions)
                                    @forelse ($clientsAlloctions as $key =>$clientsAlloction )
                                    {{-- @dd($clientsAlloction->toArray()); --}}
                                    <tr class="manage-enable">
                                        <td>
                                            <p>#{{ $key + 1 }}</p>
                                        </td>
                                        <td>
                                            {{-- @if($clientsAlloctions->type == 1) --}}
                                            <p>{{ $clientsAlloction->name }}</p>
                                            {{-- @endif --}}

                                        </td>
                                        <td>
                                            @forelse($clientsAlloction->clientsAlloction as $key => $clientAlloction)
                                            <p> {{$key.".". $clientAlloction->name }}</p>
                                            @empty
                                            <p>Not Found Permission Data.</p>
                                            @endforelse
                                        </td>

                                        <td>
                                            <div class="board-right">
                                                <a class="dropdown-item editClientAlloction" data-uuid="{{$clientsAlloction->uuid}}" href="javascript:void(0)"><i class="fa mr-1" aria-hidden="true"><img src="{{asset('assets/img/material-edit_icon.png')}}" alt=""></i></a>
                                                {{-- <a class="dropdown-item deleteData" data-uuid="" data-table="clients" href="javascript:void(0)"><i class="fa mr-1" aria-hidden="true"><img src="{{asset('assets/img/feather-trash_icon.png')}}" alt=""></i></a> --}}
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
<x-modals.client-alloction />
@endsection
@push('scripts')
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap-multiselect.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#multiselect').multiselect({
            buttonWidth: '160px'
            , includeSelectAllOption: true
            , nonSelectedText: 'Select an Option'
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

</script>
<script src="{{ asset('assets/js/ajax/clientAlloction.js') }}"></script>
<script src="{{ asset('assets/js/ajax/submit.js') }}"></script>
@endpush
