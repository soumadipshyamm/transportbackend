<!-- Modal -->
<div class="modal fade" id="addSupervisor" tabindex="-1" role="dialog" aria-labelledby="addClientTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add New
                    Supervisor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body add-modal">
                {{-- <form> --}}
                    <form method="POST" action="{{ route('supervisor.add') }}" data-url="{{ route('supervisor.add') }}"
                        class="formSubmit fileUpload" enctype="multipart/form-data" id="UserForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 my-2">
                                <div class="form-group">
                                    <label for="name">Enter Supervisor Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Supervisor Name"
                                        id="name" name="name">
                                </div>
                            </div>
                            <div class="col-md-6 my-2">
                                <div class="form-group">
                                    <label for="phone">Enter Phone Number</label>
                                    <input type="text" class="form-control" placeholder="Enter Phone Number" id="phone"
                                        name="phone">
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
                                    <label for="password">Enter Password</label>
                                    <input type="password" class="form-control" placeholder="Enter Password"
                                        id="password" name="password">
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
