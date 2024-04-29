<!-- Modal for adding a new helper -->
<div class="modal fade" id="addHelper" tabindex="-1" role="dialog" aria-labelledby="addHelperTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add New Helper</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body add-modal">
                <form method="POST" action="{{ route('helper.add') }}" data-url="{{ route('helper.add') }}"
                    class="formSubmit fileUpload" enctype="multipart/form-data" id="UserForm">
                    @csrf
                    <input type="hidden" name="uuid" value="{{ request()->uuid }}">
                    <div class="row">
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="name">Enter Name</label>
                                <input type="text" class="form-control" placeholder="Enter Name" id="name"
                                    name="name">
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="phone">Enter Phone Number</label>
                                <input type="text" class="form-control" placeholder="Enter Phone Number"
                                    id="phone" name="phone">
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="email">Enter Email ID</label>
                                <input type="email" class="form-control" placeholder="Enter Email ID" id="email"
                                    name="email">
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="email">Enter Address </label>
                                <textarea name="address" id="address" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="salary">Enter Salary </label>
                                <input type="number" min="0" class="form-control" placeholder="Enter Salary"
                                    id="salary" name="salary">
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="incentive">Enter Incentive </label>
                                <input type="number" class="form-control" placeholder="Enter Incentive" id="incentive"
                                    name="incentive">
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="bank_name">Enter Bank Name </label>
                                <input type="text" class="form-control" placeholder="Enter Bank Name" id="bank_name"
                                    name="bank_name">
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="ifc_code">Enter IFC Code </label>
                                <input type="text" class="form-control" placeholder="Enter IFC Code" id="ifc_code"
                                    name="ifc_code">
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="ac_no">Enter Account No. </label>
                                <input type="text" class="form-control" placeholder="Enter Account No."
                                    id="ac_no" name="ac_no">
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="holder_name">Enter Holder Name </label>
                                <input type="text" class="form-control" placeholder="Enter Holder Name"
                                    id="holder_name" name="holder_name">
                            </div>
                        </div>

                        {{-- <div class="row timing_sec">
                            <!-- Initial location entry -->
                            <div class="col-md-8 my-2 timing_row">
                                <div class="form-group">
                                    <label for="location">Enter Location</label>
                                    <input type="text" class="form-control" placeholder="Enter Location"
                                        name="location[0][name]">
                                </div>
                                <div class="col-md-8 my-2 ml-3 sub_loc">
                                    <div class="form-group break_flex">
                                        <label for="sub_location">Enter Sub-location</label>
                                        <input type="text" class="form-control" placeholder="Enter Sub-location"
                                            name="location[0][sub_locations][0]">
                                        <a href="#" class="add_sub_loc col-md-2" data-length="0">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                                <a href="#" class="add_loc col-md-2" data-length="0">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div> --}}
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="reset" class="btn cancel-btn resetBtn" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn save-btn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
