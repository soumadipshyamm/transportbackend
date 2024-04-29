  <!-- Modal -->
  <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="passwordModalLabel">Update Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <form id="adminProfilePasswordUpdate">
                        {{-- @csrf --}}
                        <div class="form-group">
                            <label for="old_password" class="col-form-label">Old Password:</label>
                            <input type="text" class="form-control" name="old_password" id="old_password" value="">
                        </div>
                        <div class="form-group">
                            <label for="new_password" class="col-form-label">New Password:</label>
                            <input type="text" class="form-control" id="new_password" name="new_password">
                        </div>
                        <div class="form-group">
                            <label for="new_password" class="col-form-label">Confirm New Password:</label>
                            <input type="text" class="form-control" id="new_confirm_password" name="new_confirm_password">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn updatebtn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
