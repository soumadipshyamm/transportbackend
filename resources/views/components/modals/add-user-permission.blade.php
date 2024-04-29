<div class="modal fade" id="addRole" tabindex="-1" role="dialog" aria-labelledby="addRoleTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add New
                    Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body add-modal">
                <form method="POST" action="{{ route('rolePermission.addUserRole') }}" data-url="{{ route('rolePermission.addUserRole') }}"
                    class="formSubmit fileUpload" enctype="multipart/form-data" id="UserForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="name">User Name</label>
                                <input type="text" class="form-control" placeholder="Enter User Name" id="name" name="name">
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="vendor_id">Role</label>
                                <select class="form-control" name="role_id" id="role_id">
                                    <option value="">------Select User Role--------</option>
                                    {{ getRole('') }}
                                </select>
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
