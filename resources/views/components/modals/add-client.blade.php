<!-- Modal for adding a new client -->
<div class="modal fade" id="addClient" tabindex="-1" role="dialog" aria-labelledby="addClientTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add New Client</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body add-modal">
                <form method="POST" action="{{ route('client.add') }}" data-url="{{ route('client.add') }}" class="formSubmit fileUpload" enctype="multipart/form-data" id="UserForm">
                    @csrf
                    <input type="hidden" name="uuid" value="{{ request()->uuid }}">
                    <div class="row">
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="client_name">Enter Client Name</label>
                                <input type="text" class="form-control" placeholder="Enter Client Name" id="client_name" name="client_name">
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="name">Enter Name</label>
                                <input type="text" class="form-control" placeholder="Enter Name" id="name" name="name">
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="phone">Enter Phone Number</label>
                                <input type="text" class="form-control" placeholder="Enter Phone Number" id="phone" name="phone">
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="email">Enter Email ID</label>
                                <input type="email" class="form-control" placeholder="Enter Email ID" id="email" name="email">
                            </div>
                        </div>

                        <div class="row timing_sec">
                            <!-- Initial location entry -->
                            <div class="col-md-8 my-2 timing_row">
                                <div class="form-group">
                                    <label for="location">Enter Location</label>
                                    <input type="text" class="form-control" placeholder="Enter Location" name="location[0][name]">
                                </div>
                                <div class="col-md-8 my-2 ml-3 sub_loc">
                                    <div class="form-group break_flex">
                                        <label for="sub_location">Enter Sub-location</label>
                                        <input type="text" class="form-control" placeholder="Enter Sub-location" name="location[0][sub_locations][0]">
                                        <a href="#" class="add_sub_loc col-md-2" data-length="0">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                                <a href="#" class="add_loc col-md-2" data-length="0">
                                    <i class="fa fa-plus"></i>
                                </a>
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
