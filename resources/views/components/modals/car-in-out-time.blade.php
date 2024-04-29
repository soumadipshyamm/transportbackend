<div class="modal fade" id="addCarInOutTime" tabindex="-1" role="dialog" aria-labelledby="addVehicleTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add In / Out Time</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body add-modal">
                <form method="POST" action="{{ route('carTime.add') }}" data-url="{{ route('carTime.add') }}"
                    class="formSubmit fileUpload" enctype="multipart/form-data" id="UserForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="client">Enter Client Name</label>
                                <select class="form-control" name="clients_id" id="clients_id">
                                    <option value="">---Select Client---</option>
                                    {{ getClients(null) }}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="vechile">Enter Vehicle Name</label>
                                <select class="form-control" name="vehicles_id" id="vehicles_id">
                                    <option value="">---Select Vehicle---</option>
                                    {{ getVehical(null) }}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="in_time">In Time </label>
                                <input type="datetime-local" class="form-control" placeholder="In / Out Type" id="in_time"
                                    name="in_time" >
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="out_time">Out Time</label>
                                <input type="datetime-local" class="form-control" placeholder="In / Out Time" id="out_time"
                                    name="out_time" >
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="out_time">Select Helper</label>
                                <select name="helper" id="helper" class="form-control">
                                    <option value="">---Select Helper---</option>
                                    {{ getHelper('') }}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="out_time">Select Hours Type</label>
                                <input type="radio" name="hours_type"  value="12"> 12 Hours
                                <input type="radio" name="hours_type"  value="24"> 24 Hours
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
