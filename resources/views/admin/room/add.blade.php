<div class="modal fade" id="addModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Room</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:void(0)" method="POST" id="addForm">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label>Description <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="description" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Weekdays <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="price_wd" min="1" step="1" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Weekends <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="price_we" min="1" step="1" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Capacity Adults <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="adults" min="1" step="1" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Capacity Children</label>
                                <input type="number" class="form-control" name="children" min="0" step="1">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Capacity Infants</label>
                                <input type="number" class="form-control" name="infants" min="0" step="1">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Includes <span class="text-danger">*</span> <br><small><i>Separate item by using comma.</i></small></label>
                                <textarea name="includes" class="form-control" rows="3" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Images <span class="text-danger">*</span></label>
                                        <br>
                                        <input type="file" name="images[]" id="images" accept="image/png, image/jpeg" multiple required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row" id="ph-images">
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
                                        <input type="file" name="image360" accept="image/png, image/jpeg">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row" id="ph-image360">
                                    </div>
                                </div>
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
