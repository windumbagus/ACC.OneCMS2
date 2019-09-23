<!-- Modal ADD -->
<div class="modal fade" id="view-registered-contract-detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="box-title">View Registered Contract Detail</h4> 
            </div>
            <div class="modal-body">
                <form id="form-view-registered-contract-detail" action="#" method="post"> 
                    @csrf
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="registered_contract_IdMstRegisteredContract_detail" readonly>
                    </div>	
                    <div class="form-group">
                        <label>Name:</label><br>
                        <input type="text" class="form-control" name="registered_contract_Name_detail" readonly>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="registered_contract_Username_detail" readonly>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <textarea type="text" class="form-control" name="registered_contract_Email_detail" readonly></textarea>
                    </div>
                    <div class="form-group">
                        <label>Mobile Phone</label>
                        <Input type="text" class="form-control" name="registered_contract_MobilePhone_detail" readonly>
                    </div>
                    <div class="form-group">
                        <label>Contract No</label>
                        <input type="text" class="form-control" name="registered_contract_ContractNo_detail" readonly>
                    </div>
                    <div class="form-group">
                        <label>V Account</label>
                        <input type="text" class="form-control" name="registered_contract_VAccount_detail" readonly>
                    </div>
                    <div class="form-group">
                        <label>Police No</label>
                        <input type="text" class="form-control" name="registered_contract_PoliceNo_detail" readonly>
                    </div>
                    <div class="form-group">
                        <label>Total Payment</label>
                        <input type="text" class="form-control" name="registered_contract_TotalPayment_detail" readonly>
                    </div>
                    <div class="form-group">
                        <label>Amount of AR</label>
                        <input type="text" class="form-control" name="registered_contract_AmountOfAR_detail" readonly>
                    </div>
                    <div class="form-group">
                        <label>Polis Insurance</label>
                        <input type="text" class="form-control" name="registered_contract_PolisInsurance_detail" readonly>
                    </div>
                    <div class="form-group">
                        <label>Amount Installment OVD</label>
                        <input type="text" class="form-control" name="registered_contract_AmountInstallmentOVD_detail" readonly>
                    </div>
                    <div class="form-group">
                        <label>Info Plavon</label>
                        <input type="text" class="form-control" name="registered_contract_InfoPlafon_detail" readonly>
                    </div>
                    <div class="form-group">
                        <label>AMT ACP</label>
                        <input type="text" class="form-control" name="registered_contract_AMT_APC_detail" readonly>
                    </div>
                    <div class="form-group">
                        <label>Name INSU CO</label>
                        <input type="text" class="form-control" name="registered_contract_NameInsuCO_detail" readonly>
                    </div>
                    <div class="form-group">
                        <label>AMT Installment Paid</label>
                        <input type="text" class="form-control" name="registered_contract_AMTInstallmentPaid_detail" readonly>
                    </div>
                    <div class="form-group">
                        <label>Flag Bayar</label>
                        <input type="text" class="form-control" name="registered_contract_FlagBayar_detail" readonly>
                    </div>
                    <div class="form-group">
                        <label>Bill No</label>
                        <input type="text" class="form-control" name="registered_contract_BillNo_detail" readonly>
                    </div>
                    <div class="form-group">
                        <label>Bill Date</label>
                        <input type="text" class="form-control" name="registered_contract_BillDate_detail" readonly>
                    </div>
                    <div class="form-group">
                        <label>Bill Exp</label>
                        <input type="text" class="form-control" name="registered_contract_BillExp_detail" readonly>
                    </div>
                    <div class="form-group">
                        <label>Bill Desc</label>
                        <input type="text" class="form-control" name="registered_contract_BillDesc_detail" readonly>
                    </div>
                    <div class="form-group">
                        <label>Bill Amount</label>
                        <input type="text" class="form-control" name="registered_contract_BillAmount_detail" readonly>
                    </div>
                    <div class="form-group">
                        <label>Tenor</label>
                        <input type="text" class="form-control" name="registered_contract_Tenor_detail" readonly>
                    </div>
                    <div class="form-group">
                        <label>Currancy</label>
                        <input type="text" class="form-control" name="registered_contract_Currency_detail" readonly>
                    </div>
                    <div class="form-group">
                        <label>Payment Type</label>
                        <input type="text" class="form-control" name="registered_contract_PaymenType_detail" readonly>
                    </div>
                    <div class="form-group">
                        <label>Payment Type</label>
                        <input type="text" class="form-control" name="registered_contract_PaymenPlan_detail" readonly>
                    </div>
                    <div class="form-group">
                        <label>Payment Method</label>
                        <input type="text" class="form-control" name="registered_contract_PaymenMethod_detail" readonly>
                    </div>
                    <div class="form-group">
                        <label>Payment Detail</label>
                        <input type="text" class="form-control" name="registered_contract_PaymenDetail_detail" readonly>
                    </div>
                    <div class="form-group">
                        <label>Signature Debit</label>
                        <input type="text" class="form-control" name="registered_contract_SignatureDebit_detail" readonly>
                    </div>
                    <div class="form-group">
                        <label>Signature Debit 2</label>
                        <input type="text" class="form-control" name="registered_contract_SignatureDebit2_detail" readonly>
                    </div>
                    <div class="form-group">
                        <label>Signature Credit</label>
                        <input type="text" class="form-control" name="registered_contract_SignatureCredit_detail" readonly>
                    </div>
                    <div class="form-group">
                        <label>Merchant Id</label>
                        <input type="text" class="form-control" name="registered_contract_MerchantId_detail" readonly>
                    </div>
                    <div class="form-group">
                        <label>Merchant Name</label>
                        <input type="text" class="form-control" name="registered_contract_MerchantName_detail" readonly>
                    </div>
                    <div class="form-group">
                        <label>Flag Syariah</label>
                        <input type="text" class="form-control" name="registered_contract_FlagSyariah_detail" readonly>
                    </div>
                    <div class="form-group">
                        <label>User</label>
                        <input type="text" class="form-control" name="registered_contract_UserID_detail" readonly>
                    </div>
                </form>	
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="view-transaction-history">View Transaction History</button>	
                <button type="button" class="btn btn-primary" id="close-modal">Close</button>		
            </div>		
        </div>
    </div>
</div>

<Script>
    $(function() {
        $('#close-modal').click(function() {
        $('#view-registered-contract-detail').modal('hide');
        $('#form-view-registered-contract-detail')[0].reset();  
        });      
    });

    // VIEW all transaction
    $(document).on('click','#view-transaction-history',function(){
        var id = $(this).attr('data-IdMstRegisteredContract');
        var ContractNo = $(this).attr('data-ContractNo');
        var Username = $(this).attr('data-Username');
        console.log(id);
        console.log(ContractNo);
        console.log(Username);

        $.ajax({
            url:"{{asset('/transaction-history/show')}}",
            data: {'Id':id ,'ContractNo':ContractNo,'Username':Username,'_token':'{{csrf_token()}}' },
            dataType:'JSON', 
            type:'GET',
            success: function (val){
                console.log(val);
                var Data = val.Data;
                var MstRegisteredContractId = val.MstRegisteredContractId;
                var ContractNo = val.ContractNo;
                var Username = val.Username;
                var table = $('#example2').DataTable()
                
                //send data id,username,contractno for download
                $('[name="MstRegisteredContractId"]').val(MstRegisteredContractId);
                $('[name="ContractNo"]').val(ContractNo);
                $('[name="Username"]').val(Username);

                // var SendAttrBtn = document.querySelector(".DownloadTransactionHistoryButton")
                // SendAttrBtn.setAttribute('data-IdMstRegisteredContract',MstRegisteredContractId); 
                // SendAttrBtn.setAttribute('data-ContractNo',ContractNo); 
                // SendAttrBtn.setAttribute('data-Username',Username); 
                
                table.clear().draw()
                Data.map(e=>{
                    table.row.add([
                        e.MstTransactionHistory.CONTRACT_NO,
                        e.MstTransactionHistory.NO_INSTALLMENT,
                        e.MstTransactionHistory.DUEDATE_PAYMENT,
                        e.MstTransactionHistory.AMOUNT_INSTALLMENT,
                        `<a href="#" data-MstTransactionHistoryId=${e.MstTransactionHistory.Id} 
                        data-MstRegisteredContractId=${MstRegisteredContractId}
                        data-ContractNo=${ContractNo}
                        data-Username=${Username} 
                        class="transaction-history-detail btn btn-info btn-sm"><i class="fa fa-eye"></i></a>`,
                    ]).draw(false)
                    // $('.conditions').hide()
                })

            },
            error: function( jqXhr, textStatus, errorThrown ){
            console.log(jqXhr);
            console.log( errorThrown );
            console.log(textStatus);
            },
        });
        $('#view-transaction-history-modal').modal();
    });

    // VIEW all transaction
        $(document).on('click','.transaction-history-detail',function(){
        var MstTransactionHistoryId = $(this).attr('data-MstTransactionHistoryId');
        var MstRegisteredContractId = $(this).attr('data-MstRegisteredContractId');
        var ContractNo              = $(this).attr('data-ContractNo');
        var Username                = $(this).attr('data-Username');
        console.log(MstTransactionHistoryId);
        console.log(MstRegisteredContractId);
        console.log(ContractNo);
        console.log(Username);

        $.ajax({
            url:"{{asset('/transaction-detail/show')}}",
            data: {'MstTransactionHistoryId':MstTransactionHistoryId,'MstRegisteredContractId':MstRegisteredContractId ,'ContractNo':ContractNo,'Username':Username,'_token':'{{csrf_token()}}' },
            dataType:'JSON', 
            type:'GET',
            success: function (val){
               var val=val[0];
                console.log(val);
                $('[name="transaction_detail_CONTRACT_NO"]').val(val.MstTransactionHistory.CONTRACT_NO);
                $('[name="transaction_detail_NO_INSTALLMENT"]').val(val.MstTransactionHistory.NO_INSTALLMENT);
                $('[name="transaction_detail_DUEDATE_PAYMENT"]').val(val.MstTransactionHistory.DUEDATE_PAYMENT);
                $('[name="transaction_detail_AMOUNT_INSTALLMENT"]').val(val.MstTransactionHistory.AMOUNT_INSTALLMENT);
                $('[name="transaction_detail_AMOUNT_INSTALLMENT_PAID"]').val(val.MstTransactionHistory.AMOUNT_INSTALLMENT_PAID);
                $('[name="transaction_detail_ACTUALDATE_PAYMENT"]').val(val.MstTransactionHistory.ACTUALDATE_PAYMENT);
                $('[name="transaction_detail_STATUS"]').val(val.MstTransactionHistory.STATUS);
                $('[name="transaction_detail_AMT_CHARGE"]').val(val.MstTransactionHistory.AMT_CHARGE);
                $('[name="transaction_detail_AMT_PENALTY"]').val(val.MstTransactionHistory.AMT_PENALTY);
                $('[name="transaction_detail_CURRENT_INSURANCE"]').val(val.MstTransactionHistory.CURRENT_INSURANCE);
            },
            error: function( jqXhr, textStatus, errorThrown ){
            console.log(jqXhr);
            console.log( errorThrown );
            console.log(textStatus);
            },
        });
        $('#view-transaction-history-detail-modal').modal();
    });

</Script>
