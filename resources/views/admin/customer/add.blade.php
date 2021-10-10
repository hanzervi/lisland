<div class="modal fade" id="addModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Customer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:void(0)" method="POST" id="addForm">
                <div class="modal-body">
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
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Birthdate <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="birthdate" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Sex <span class="text-danger">*</span></label>
                                <select name="sex" class="form-control select2">
                                    <option value="" selected disabled></option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Address <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="address" required>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                            <div class="form-group">
                                <label>ID Card</label><br>
                                <img class="img-fluid" id="id-card-preview" src="{{ asset('public/storage/idcard/noimage.png') }}"
                                    style="cursor: pointer" onclick="$('[name=id-card]').trigger('click');">
                                    <input type="file" class="form-control-file" name="id-card" accept="image/png, image/jpeg" hidden>
                                    <br>
                                    <small>Click image to change . . .</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-custom btn-default" data-dismiss="modal" onclick="$('#addForm').trigger('reset'); $('#food-drink-preview').prop('src', '{{ asset('public/storage/fooddrink/noimage.png') }}')">Close</button>
                    <button role="submit" class="btn btn-custom btn-success">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
