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
            <form id="form-view-accash-apply" action="#" method="post"> 
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label>GUID</label>
                        <input type="text" class="form-control" name="GUID" readonly>
                    </div>
                    <div class="form-group">
                        <label>No Aggr</label>
                        <input type="text" class="form-control" name="NO_AGGR" disabled>
                    </div>
                    <div class="form-group">
                        <label>Disbursement</label>
                        <input type="text" class="form-control" name="DISBURSEMENT" disabled>
                    </div>
                    <div class="form-group">
                        <label>Amt Installment</label>
                        <input type="text" class="form-control" name="AMT_INSTALLMENT" disabled>
                    </div>
                    <div class="form-group">
                        <label>Tujuan Penggunaan </label>
                        <input type="text" class="form-control" name="TUJUAN_PENGGUNAAN" disabled>
                    </div>
                    <div class="form-group">
                        <label>Penyedia </label>
                        <input type="text" class="form-control" name="PENYEDIA" disabled>
                    </div>
                    <div class="form-group">
                        <label>BTMY </label>
                        <input type="text" class="form-control" name="BTMY" readonly>
                    </div>
                    <div class="form-group">
                        <label>Phone Mobile 1 </label>
                        <input type="text" class="form-control" name="PHONE_MOBILE1" disabled>
                    </div>
                    <div class="form-group">
                        <label>Phone Mobile 2 </label>
                        <input type="text" class="form-control" name="PHONE_MOBILE2" disabled>
                    </div>
                    <div class="form-group">
                        <label>Area </label>
                        <input type="text" class="form-control" name="AREA" disabled>
                    </div>
                    <div class="form-group">
                        <label>Cabang </label>
                        <input type="text" class="form-control" name="CABANG" disabled>
                    </div>
                    <div class="form-group">
                        <label>No Polisi </label>
                        <input type="text" class="form-control" name="NO_CAR_POLICE" disabled>
                    </div>
                    <div class="form-group">
                        <label>Pefindo Score </label>
                        <input type="text" class="form-control" name="PEFINDO_SCORE" disabled>
                    </div>
                    <div class="form-group">
                        <label>Pefindo Detail </label>
                        <input type="text" class="form-control" name="PEFINDO_DETAIL" disabled>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                            
                            <img style="width: 250px; height: 200px;" alt=""
                            id="PATH_FILE0" />
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                            
                            <img style="width: 250px; height: 200px;" alt=""
                                    id="PATH_FILE1" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Status </label>
                        <input type="text" class="form-control" name="STATUS" disabled>
                      
                    </div>   
                    <div class="form-group">
                        <label>Reason </label>
                        <input type="text" class="form-control" name="REASON" disabled>
                    </div>
                    
                    <div class="modal-footer">
                    <button type="button" class="close-modal-view btn btn-default" >Close</button>			
                   
                </div>	
                    

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
