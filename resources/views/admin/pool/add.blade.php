<div class="modal fade" id="addModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Pool</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:void(0)" method="POST" id="addForm">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Description <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="description" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Images <span class="text-danger">*</span></label>
                                <br>
                                <input type="file" name="images[]" id="images" multiple required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row" id="ph-images">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>360 Image </label>
                                <br>
                                <input type="file" name="image360">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row" id="ph-image360">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-custom btn-default" data-dismiss="modal" onclick="$('#addForm').trigger('reset'); $('#ph-images').empty(); $('#ph-image360').empty();">Close</button>
                    <button role="submit" class="btn btn-custom btn-success">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
