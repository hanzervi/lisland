<div class="modal fade" id="remarksModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Remarks</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:void(0)" method="POST" id="remarksForm">
                <input type="text" name="remarks_id" hidden>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Remarks</label>
                                <input type="text" class="form-control" name="remarks_remarks">
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