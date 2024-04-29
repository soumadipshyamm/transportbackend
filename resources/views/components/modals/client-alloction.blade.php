<!-- Modal -->
<div class="modal fade" id="addClientAlloction" tabindex="-1" role="dialog" aria-labelledby="addClientTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Client Alloction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body add-modal">
                {{-- <form> --}}
                    <form method="POST" action="{{ route('client.addAlloction') }}" data-url="{{ route('client.addAlloction') }}"
                        class="formSubmit fileUpload" enctype="multipart/form-data" id="UserForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 my-2">
                                <div class="form-group">
                                    <label for="vechile">Select Supervisor Name</label>
                                    <select name="supervisor" id="supervisor" class="form-control">
                                        <option value="">------Select Client--------</option>
                                        {{ getSupervisor('') }}
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 my-2">
                                <div class="form-group client-select">
                                    <label for="vechile">Choose Client</label>
                                    <select id="multiselect" multiple="multiple" class="form-control" name="clients[]">
                                        {{ getClients('') }}
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
