<div class="modal fade" id="updateModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Pool</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:void(0)" method="POST" id="updateForm">
                <input type="text" name="update_id" hidden>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="update_name" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Description <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="update_description" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Images</label>
                                <br>
                                <input type="file" name="update_images[]" id="update_images" multiple>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row" id="update_ph-images">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>360 Image </label>
                                <br>
                                <input type="file" name="update_image360">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row" id="update_ph-image360">
                            </div>
                        </div>
                        <div class="col-lg-12 mt-5">
                            <i>Note: Reselect images if you wish to update it.</i>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-custom btn-default" data-dismiss="modal" onclick="$('#updateForm').trigger('reset'); $('#update_ph-images').empty(); $('#update_ph-image360').empty();">Close</button>
                    <button role="submit" class="btn btn-custom btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
