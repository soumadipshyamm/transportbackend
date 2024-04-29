<div class="modal fade" id="addVendor" tabindex="-1" role="dialog" aria-labelledby="addClientTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add New
                    Vendor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body add-modal">
                <form method="POST" action="{{ route('vendor.add') }}" data-url="{{ route('vendor.add') }}"
                    class="formSubmit fileUpload" enctype="multipart/form-data" id="UserForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="name">Enter Vendor Name</label>
                                <input type="text" class="form-control" placeholder="Enter Vendor Name"
                                    id="name" name="name">
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
                                <label for="location">Enter Location</label>
                                <input type="text" class="form-control" placeholder="Enter Location" id="address"
                                    name="address">
                            </div>
                        </div>
                        <h5 class="col-md-12 my-2 text-center">Bank Details</h5>

                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="bank_name">Bank Name</label>
                                <input type="text" class="form-control" placeholder="Enter Bank Name"
                                    id="bank_name" name="bank_name">
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="ifc_code">IFC Code</label>
                                <input type="text" class="form-control" placeholder="Enter IFC Code" id="ifc_code"
                                    name="ifc_code">
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="ac_no">A/C No.</label>
                                <input type="text" class="form-control" placeholder="Enter A/C No. ID" id="ac_no"
                                    name="ac_no">
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="holder_name">Holder Name</label>
                                <input type="text" class="form-control" placeholder="Enter Holder Name" id="holder_name"
                                    name="holder_name">
                            </div>
                        </div>
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
