<!-- Modal ADD -->
<div class="modal fade" id="view-transaction-history-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" 
aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document" style=".modal-lg {width: 90%  !important;}">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="box-title">View Transaction History</h4> 
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-8">
                    </div>
                    <div class="col-sm-4">
                        <div class="col-sm-6"></div>
                        <div class="col-sm-6">
                            <form action="{{asset('/transaction-history/download')}}" method="POST"> 
                                @csrf
                                <input type="hidden" class="form-control" name="MstRegisteredContractId" readonly>
                                <input type="hidden" class="form-control" name="ContractNo" readonly>
                                <input type="hidden" class="form-control" name="Username" readonly>
                                <button type="submit" class="DownloadTransactionHistoryButton btn btn-block btn-primary">Download</button>                    
                            </form>
                        </div>
                    </div>
                </div>
                <table id="example2"class="table table-bordered table-hover"  >
                    <thead>
                        <tr>
                            <th>Contract Number</th>
                            <th>No Installment</th>
                            <th>DueDate Payment </th>
                            <th>Amount Installment</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="close-modal-transaction-history">Back</button>		
            </div>
        </div>
    </div>
</div>

<Script>
    $(function() {
        $('#close-modal-transaction-history').click(function() {
        $('#view-transaction-history-modal').modal('hide');
        $('#view-transaction-history-modal').on('hidden.bs.modal',function(){
            $('body').addClass('modal-open');
        })
        // $('#form-view-survey')[0].reset();  
        });      
    });

    $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false,
            'scrollX': true,
             sDom: 'lrtip', 
    })

    // $(document).on('click','.DownloadTransactionHistoryButton',function(){
    //     var id = $(this).attr('data-IdMstRegisteredContract');
    //     var ContractNo = $(this).attr('data-ContractNo');
    //     var Username = $(this).attr('data-Username');
    //     $.ajax({
    //         url:"{{asset('/transaction-history/download')}}",
    //         data: {'Id':id ,'ContractNo':ContractNo,'Username':Username,'_token':'{{csrf_token()}}' },
    //         dataType:'JSON', 
    //         type:'GET',
    //         success: function (){
    //         },
    //         error: function( jqXhr, textStatus, errorThrown ){
    //         console.log(jqXhr);
    //         console.log( errorThrown );
    //         console.log(textStatus);
    //         },
    //     });
    // });


</Script>
