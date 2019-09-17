<!-- Modal ADD -->
<div class="modal fade" id="view-transaction-history-detail-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" 
aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="box-title">View Transaction History Detail</h4> 
            </div>
            <form id="form-view-transaction-history-detail" action="#" method="post"> 
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label>Contract Number</label>
                        <input type="text" class="form-control" name="transaction_detail_CONTRACT_NO" readonly>
                    </div>
                    <div class="form-group">
                        <label>No Installment</label>
                        <input type="text" class="form-control" name="transaction_detail_NO_INSTALLMENT" readonly>
                    </div>
                    <div class="form-group">
                        <label>Due Date Payment</label>
                        <input type="text" class="form-control" name="transaction_detail_DUEDATE_PAYMENT" readonly>
                    </div>
                    <div class="form-group">
                        <label>Amount Installment</label>
                        <input type="text" class="form-control" name="transaction_detail_AMOUNT_INSTALLMENT" readonly>
                    </div>
                    <div class="form-group">
                        <label>Amount Installment Paid</label>
                        <input type="text" class="form-control" name="transaction_detail_AMOUNT_INSTALLMENT_PAID" readonly>
                    </div>
                    <div class="form-group">
                        <label>Actual Date Payment</label>
                        <input type="text" class="form-control" name="transaction_detail_ACTUALDATE_PAYMENT" readonly>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <input type="text" class="form-control" name="transaction_detail_STATUS" readonly>
                    </div>
                    <div class="form-group">
                        <label>AMT Charge</label>
                        <input type="text" class="form-control" name="transaction_detail_AMT_CHARGE" readonly>
                    </div>
                    <div class="form-group">
                        <label>AMT Penalty</label>
                        <input type="text" class="form-control" name="transaction_detail_AMT_PENALTY" readonly>
                    </div>
                    <div class="form-group">
                        <label>Current Insurance</label>
                        <input type="text" class="form-control" name="transaction_detail_CURRENT_INSURANCE" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="close-modal-transaction-history-detail">Close</button>		
                </div>	
            </form>
        </div>
    </div>
</div>

<Script>
    $(function() {
        $('#close-modal-transaction-history-detail').click(function() {
        $('#view-transaction-history-detail-modal').modal('hide');
        $('#form-view-transaction-history-detail')[0].reset();
        $('#view-transaction-history-detail-modal').on('hidden.bs.modal',function(){
            $('body').addClass('modal-open');
        })  
        });      
    });
</Script>
