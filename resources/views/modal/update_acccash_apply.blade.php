<!-- Modal UPDATE -->
<div class="modal fade" id="update-acccash-apply-popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" 
aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close-modal-update close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              
                    <h4 class="box-title">Verify ACCCash Apply</h4> 
               
                    <!-- <h4 class="box-title">View ACCCash Apply</h4>                  -->
               
            </div>
            <form id="form-update-accash-apply" action="{{asset('acccash-apply/'.$Statusapply.'/changestatus') }}" method="post" class="form-horizontal"> 
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
                            <img style="width: 200px; height: 150px;" alt=""
                            id="PATH_FILE0" class="center"/>
                        </div>
                        
                        <div class="col-sm-6">
                            <img style="width: 200px; height: 150px;" alt=""
                            id="PATH_FILE1" class="center"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Status</label>
                        
                        <div class="col-sm-7">
                            <select class="form-control select2" id="STATUS" name="STATUS" style="width:100%;">
                                <option value="PENDING" selected>PENDING</option>
                                <option value="APPROVED" >APPROVED</option>
                                <option value="REJECT" >REJECT</option>
                            </select>
                        </div>
                    </div>   
                   
                    <div class="form-group" id="REASONREJECTCHOICE">
                        <label class="col-sm-4 control-label">Reason Reject</label>
                        <div class="col-sm-7">
                            <select class="form-control select3" id="REASONREJECT" name="REASONREJECT" style="width:100%;">
                                <option value="REJECT-NOTAPPLY" selected>Customer tidak merasa mengajukan</option>
                                <option value="REJECT-UNCONTACTED" >Customer tidak dapat dihubungi dalam waktu 3x24 jam</option>
                                <option value="REJECT-DATA" >Customer berubah pikiran terhadap nominal dan tenor yang diajukan dan ingin mengajukan ulang sendiri</option>
                                <option value="REJECT-DATA2">Customer berubah pikiran terhadap nominal dan tenor yang diajukan dan ingin diproses secara manual oleh cabang</option>
                                <option value="REJECT-PICT" >Foto mobil tidak sesuai dengan petunjuk</option>
                                <option value="REJECT-WRONGUNIT" >Spesifikasi mobil pada foto tidak sesuai dengan data pada AOL</option>
                                <option value="REJECT-UNIT">Kondisi mobil tidak layak untuk dibiayai</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" id="REASONPENDINGCHOICE">
                        <label class="col-sm-4 control-label">Reason Pending</label>
                        <div class="col-sm-7">
                            <select class="form-control select3" id="REASONPENDING" name="REASONPENDING" style="width:100%;">
                                <option value="PENDING-UNCONTACTED" >Customer tidak dapat dihubungi</option>
                                <option value="PENDING-NEXTTIME" >Customer minta dihubungi pada waktu lain</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" id="REASONAPPROVEDCHOICE">
                       
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="close-modal-update btn btn-default" >Close</button>	
                    <button type="submit" class="btn btn-primary">Verify</button>		
                </div>	
            </form>
        </div>
    </div>
</div>

<Script>
    $(document).ready(function () {
        $('#REASONREJECTCHOICE').hide();
        $('#REASONPENDINGCHOICE').show();
        $('#REASONAPPROVEDCHOICE').hide();

        $(function() {
            $('.close-modal-update').click(function() {
                $('#update-acccash-apply-popup').modal('hide');
                $('#form-update-acccash-apply')[0].reset();  
            });      
        });


            //DROPDOWN STATUS
        $('#STATUS').on('change',function(){
        
        switch($('#STATUS').val()) {
                case "REJECT":
                    $('#REASONREJECTCHOICE').show()
                    $('#REASONPENDINGCHOICE').hide()
                    $('#REASONAPPROVEDCHOICE').hide()

                    break;
                case "PENDING":
                    $('#REASONREJECTCHOICE').hide()
                    $('#REASONPENDINGCHOICE').show()
                    $('#REASONAPPROVEDCHOICE').hide()

                    break;

                case "APPROVED":
                    $('#REASONREJECTCHOICE').hide()
                    $('#REASONPENDINGCHOICE').hide()
                    $('#REASONAPPROVEDCHOICE').show()

                    break;

                default:
                    $('#REASONREJECTCHOICE').hide()
                    $('#REASONPENDINGCHOICE').show()
                    $('#REASONAPPROVEDCHOICE').hide()

                    
                }

        // console.log(reasonstatus);

        });
    })
</Script>
