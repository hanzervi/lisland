<div class="modal fade" id="user">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update User</h4>
            </div>
            <form action="javascript:void(0)" method="POST" id="userForm">
                <input type="text" name="update_id" hidden>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <div class="form-group">
                                <label>First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="update_firstname" required>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div class="form-group">
                                <label>First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="update_lastname" required>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <div class="form-group">
                                <label>Address <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="update_address" required>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label>Sex <span class="text-danger">*</span></label>
                                <select name="update_sex" class="form-control">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label>Contact <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="update_contact" required>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="update_email" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <hr>
                            <div class="form-group">
                                <label>Username <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="update_username" required>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="update_password">
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control" name="update_confirmPw">
                            </div>
                        </div>
                        <div class="col-lg-12 mt-5">
                            <i>Note: Fill up password field if you wish to change it.</i>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" onclick="$('#user').modal('hide'); $('#userForm').trigger('reset');">Close</button>
                    <button role="submit" class="btn btn-custom btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>