<!-- Modal VIEW -->
<div class="modal fade" id="view-acccash-apply-popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" 
aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close-modal-view close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              
                    <h4 class="box-title">View ACCCash Apply</h4> 
               
                    <!-- <h4 class="box-title">View ACCCash Apply</h4>                  -->
               
            </div>
            <form id="form-view-accash-apply" action="#" method="post" class="form-horizontal"> 
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label class="col-sm-4 control-label">GUID</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="GUID" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">No Aggr</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="NO_AGGR" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Id User</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="ID_USER" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Disbursement</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="DISBURSEMENT" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Amt Installment</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="AMT_INSTALLMENT" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Tenor</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="TENOR" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Tujuan Penggunaan</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="TUJUAN_PENGGUNAAN" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Penyedia</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="PENYEDIA" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">BTMY</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="BTMY" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Phone Mobile 1</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="PHONE_MOBILE1" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Phone Mobile 2</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="PHONE_MOBILE2" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Area</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="AREA" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Cabang</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="CABANG" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">No Polisi</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="NO_CAR_POLICE" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Pefindo Score</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="PEFINDO_SCORE" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Pefindo Detail</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="PEFINDO_DETAIL" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <img style="width: 100%; height: 100%;" alt=""
                            id="PATH_FILE0" class="center"/>
                        </div>
                        
                        <div class="col-sm-6">
                            <img style="width: 100%; height: 100%;" alt=""
                            id="PATH_FILE1" class="center"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Status</label>
                        
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="STATUS" readonly>
                        </div>
                    </div>   
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Reason</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="REASON" readonly>
                        </div>
                    </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="close-modal-view btn btn-default" >Close</button>	
                   		
                </div>
            </form>
        </div>
    </div>
</div>

<Script>
    $(function() {
        $('.close-modal-view').click(function() {
            $('#view-acccash-apply-popup').modal('hide');
            $('#form-view-acccash-apply')[0].reset();  
        });      
    });

</Script>
