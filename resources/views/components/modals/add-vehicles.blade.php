<div class="modal fade" id="addVehicle" tabindex="-1" role="dialog" aria-labelledby="addVehicleTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add New
                    Vehicles</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body add-modal">
                <form method="POST" action="{{ route('vehicle.add') }}" data-url="{{ route('vehicle.add') }}"
                    class="formSubmit fileUpload" enctype="multipart/form-data" id="UserForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="type">Enter Vehicle Type</label>
                                <input type="text" class="form-control" placeholder="Enter Vehicle Type"
                                    id="type" name="type">
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="car_number">Enter Vehicle Number</label>
                                <input type="text" class="form-control" placeholder="Enter Vehicle Number"
                                    id="car_number" name="car_number">
                            </div>
                        </div>

                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="vendor_id">Owner of Vehicle</label>
                                <select class="form-control" name="vendor_id" id="vendor_id">
                                    <option value="">------Select Vendor--------</option>
                                    {{ getVendors('') }}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="rc_no">Enter Vehicle RC No.</label>
                                <input type="file" class="form-control" placeholder="Enter Vehicle RC No."
                                    id="rc_no" name="rc_no">
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="car_price">Price/hr</label>
                                <input type="text" class="form-control" placeholder="Enter Price"
                                    id="car_price" name="car_price">
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
