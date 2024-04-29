<!-- Modal -->
<div class="modal fade" id="addVehicleAlloction" tabindex="-1" role="dialog" aria-labelledby="addVehicleTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Vehicle Alloction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body add-modal">
                {{-- <form> --}}
                <form method="POST" action="{{ route('vehicle-allocation.addAlloction') }}"
                    data-url="{{ route('vehicle-allocation.addAlloction') }}" class="formSubmit fileUpload"
                    enctype="multipart/form-data" id="UserForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 my-2">
                            <div class="form-group client-select">
                                <label for="vechile">Choose Client</label>
                                <select name="client" id="client" class="form-control">
                                    <option value="">------Select Client--------</option>
                                    {{ getClients('') }}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="vechile">Select Vehical </label>
                                <select name="vehical" id="vehical" class="form-control">
                                    <option value="">------Select Vehical--------</option>
                                    {{ getVehical('') }}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="vechile">Select Monthly/Daily </label>
                                <select name="allocation" id="allocation" class="form-control">
                                    <option value="">------Select Monthly/Daily--------</option>
                                    <option value="0">Monthly</option>
                                    <option value="1">Indent/Daily</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="vechile">Select Working HRS </label>
                                <select name="working_hrs" id="working_hrs" class="form-control">
                                    <option value="">------Select Working HRS--------</option>
                                    <option value="12">12 Hrs</option>
                                    <option value="24">24 Hrs</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="vechile">Allocted Date </label>
                                <input type="date" class="form-control" name="allocation_date" id="allocation_date">
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" min="0.00" step="0.01" name="price" id="price"
                                    class="form-control" placeholder="Enter Price Value">
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="price">Advance Payment</label>
                                <input type="number" min="0.00" step="0.01" name="advance_payment"
                                    id="advance_payment" class="form-control" placeholder="Enter advance payment Value">
                            </div>
                        </div>
                        {{-- <div class="col-md-6 my-2">
                            <div class="form-group">
                                <label for="price">Due Payment</label>
                                <input type="number" min="0.00" step="0.01" readonly class="form-control"
                                    placeholder="Enter Due payment Value" id="due_payment">
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
