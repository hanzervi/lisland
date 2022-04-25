<div class="modal fade" id="updateModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:void(0)" method="POST" id="updateForm">
                <input type="text" name="update_id" hidden>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Adults <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" min="1" step="1" name="update_adults" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Children</label>
                                <input type="number" class="form-control" min="0" step="1" name="update_children">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Infants</label>
                                <input type="number" class="form-control" min="0" step="1" name="update_infants">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Additional Person</label>
                                <input type="number" class="form-control" min="0" step="1" name="update_add_person">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Remarks</label>
                                <input type="text" class="form-control" name="update_remarks">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Paid Thru</label>
                                <input type="text" class="form-control" name="update_payment">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Payment Ref #</label>
                                <input type="text" class="form-control" name="update_payment_ref">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-custom btn-default" data-dismiss="modal">Close</button>
                    <button role="submit" class="btn btn-custom btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>