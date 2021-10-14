<div class="modal fade" id="updateModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Room</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:void(0)" method="POST" id="updateForm">
                <input type="text" name="update_id" hidden>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="update_name" required>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label>Description <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="update_description" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>No. of Rooms <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="update_no_rooms" min="1" step="1" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Weekdays <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="update_price_wd" min="1" step="1" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Weekends <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="update_price_we" min="1" step="1" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Capacity Adults <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="update_adults" min="1" step="1" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Capacity Children</label>
                                <input type="number" class="form-control" name="update_children" min="0" step="1">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Capacity Infants</label>
                                <input type="number" class="form-control" name="update_infants" min="0" step="1">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Includes <span class="text-danger">*</span> <br><small><i>Separate item by using comma.</i></small></label>
                                <textarea name="update_includes" class="form-control" rows="3" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Images</label>
                                        <br>
                                        <input type="file" name="update_images[]" id="update_images" accept="image/png, image/jpeg" multiple>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row" id="update_ph-images">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>360 Image </label>
                                        <br>
                                        <input type="file" name="update_image360" accept="image/png, image/jpeg">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row" id="update_ph-image360">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mt-5">
                            <i>Note: Reselect images if you wish to update it.</i>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-custom btn-default" data-dismiss="modal" onclick="$('#updateForm').trigger('reset');">Close</button>
                    <button role="submit" class="btn btn-custom btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
