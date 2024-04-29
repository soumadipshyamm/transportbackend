<!-- Modal -->
<div class="modal fade" id="addExpense" tabindex="-1" role="dialog" aria-labelledby="addClientTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add New
                    Expense</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body add-modal">
                <form method="POST" action="{{ route('expense.add') }}" data-url="{{ route('expense.add') }}"
                    class="formSubmit fileUpload" enctype="multipart/form-data" id="UserForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="name">Vehicles</label>
                                <select class="form-control" name="vehicles_id" id="vehicles_id">
                                    <option>Select vehicles</option>
                                    {{ getVehical(null) }}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="name">Enter Driver Name</label>
                                <input type="text" class="form-control" placeholder="Enter Driver Name"
                                    id="driver_name" name="driver_name">
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="date">Enter Date</label>
                                <input type="date" class="form-control" placeholder="Enter Date" id="date"
                                    name="date">
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="expense_amount">Enter Expense Amount</label>
                                <input type="number" class="form-control" placeholder="Enter Expense Amount"
                                    id="expense_amount" name="expense_amount">
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="expense_amount">In Time</label>
                                <input type="time" class="form-control" placeholder="Enter Expense Amount"
                                    id="in_time" name="in_time" value="00:00:00" step="1">
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="purposes">Out Time</label>
                                <input type="time" class="form-control" placeholder="Purpose" id="out_time"
                                    name="out_time" value="00:00:00" step="1">
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="purposes">Purpose</label>
                                <input type="text" class="form-control" placeholder="Purpose" id="purposes"
                                    name="purposes">
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="purposes">Meter</label>
                                <input type="number" class="form-control" placeholder="Meter" id="meter"
                                    name="meter">
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
