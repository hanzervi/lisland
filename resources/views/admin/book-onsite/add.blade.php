<div class="modal fade" id="addModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Booking</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:void(0)" method="POST" id="addForm">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Room <span class="text-danger">*</span></label>
                                <select class="form-control select2" name="room_id" required onchange="btnCheckChange()">
                                    <option value="" selected disabled></option>
                                    @if ($room->count() > 0)
                                        @foreach ($room as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    @else
                                        <option value="" disabled>No room found. Please create.</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label>Available Rooms</label>
                            <input type="text" class="form-control" value="--" id="available" readonly>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Adults <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="adults" min="1" step="1" required onchange="btnCheckChange()">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Children</label>
                                <input type="number" class="form-control" name="children" min="0" step="1" onchange="btnCheckChange()">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Infants</label>
                                <input type="number" class="form-control" name="infants" min="0" step="1" onchange="btnCheckChange()">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Additional Person</label>
                                <input type="number" class="form-control" name="add_person" min="0" step="1" onchange="btnCheckChange()">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Check In Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control dateMin" name="check_in" onchange="btnCheckChange()" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Check Out Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control dateMin" name="check_out" onchange="btnCheckChange()" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="button" class="btn btn-outline-success" onclick="checkRoom()" id="btnCheck" disabled>Check Availability</button>
                            <div id="checkRoom">
                                
                            </div>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="firstname" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="lastname" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Address <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="address" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Sex <span class="text-danger">*</span></label>
                                <select class="form-control select2" name="sex" required>
                                    <option value="" selected disabled></option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Contact <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="contact_no" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <hr>
                            <div class="form-group">
                                <label>Remarks</label>
                                <input type="text" class="form-control" name="remarks">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-custom btn-default" data-dismiss="modal" onclick="$('#addForm').trigger('reset'); $('#checkRoom').hide(); $('.select2').select2();">Close</button>
                    <button role="submit" class="btn btn-custom btn-success">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>