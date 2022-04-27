<div class="modal fade" id="transactions">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Transactions</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tb" class="table table-bordered table-striped" width="100%">
                        <thead>
                            <tr>
                                <th>Ref #</th>
                                <th>Room</th>
                                <th>Pax</th>
                                <th>Check In</th>
                                <th>Check Out</th>
                                <th>Price Total</th>
                                <th>Status</th>
                                <th>Remarks</th>
                                <th>Paid Thru</th>
                                <th>Payment Ref #</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" onclick="$('#transactions').modal('hide')">Close</button>
            </div>
        </div>
    </div>
</div>
