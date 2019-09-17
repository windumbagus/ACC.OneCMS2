
<div class="modal fade" id="view-status-pengajuan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" 
    aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="box-title">View Status Pengajuan Aplikasi</h4> 
            </div>
            <form id="form-view-status-pengajuan" action="#" method="post">
                <div class="modal-body"> 
                    @csrf	
    
                    <div class="form-group">
                        <label>Name:</label><br>
                        <input type="text" class="form-control" name="status_pengajuan_User_name_data" readonly>
                    </div>	
                    <div class="form-group">
                        <label>Registration Number</label><br>
                        <input type="text" class="form-control" name="status_pengajuan_RegistrationNo_data" readonly>
                    </div>	
                    <div class="form-group">
                        <label>Registration Name</label><br>
                        <input type="text" class="form-control" name="status_pengajuan_Name_data" readonly>
                    </div>	
                    <div class="form-group">
                        <label>Brand</label><br>
                        <input type="text" class="form-control" name="status_pengajuan_Brand_data" readonly>
                    </div>	
                    <div class="form-group">
                        <label>Type</label><br>
                        <input type="text" class="form-control" name="status_pengajuan_Type_data" readonly>
                    </div>	
                    <div class="form-group">
                        <label>Model</label><br>
                        <input type="text" class="form-control" name="status_pengajuan_Model_data" readonly>
                    </div>	
                    <div class="form-group">
                        <label>Kind</label><br>
                        <input type="text" class="form-control" name="status_pengajuan_Kind_data" readonly>
                    </div>	
                    <div class="form-group">
                        <label>Branch Name</label><br>
                        <input type="text" class="form-control" name="status_pengajuan_BranchName_data" readonly>
                    </div>	
                    <div class="form-group">
                        <label>So Name</label><br>
                        <input type="text" class="form-control" name="status_pengajuan_SoName_data" readonly>
                    </div>	
                    <div class="form-group">
                        <label>So Phone Number</label><br>
                        <input type="text" class="form-control" name="status_pengajuan_SoPhoneNo_data" readonly>
                    </div>	
                    <div class="form-group">
                        <label>Tenor</label><br>
                        <input type="text" class="form-control" name="status_pengajuan_Tenor_data" readonly>
                    </div>	
                    <div class="form-group">
                        <label>Amount Installment</label><br>
                        <input type="text" class="form-control" name="status_pengajuan_AmountInstallment_data" readonly>
                    </div>	
                    <div class="form-group">
                        <label>Prospect</label><br>
                        <input type="text" class="form-control" name="status_pengajuan_ProspectID_data" readonly>
                    </div>	
                    <div class="form-group">
                        <label>Status</label><br>
                        <input type="text" class="form-control" name="status_pengajuan_Status_data" readonly>
                    </div>
                
                </div>
                <div class="modal-footer">
                    <button type="button" id="view-status-data" class="view-status-data
                        btn btn-info">View Status Data</button>	
                    <button type="button" class="btn btn-primary" id="close-modal-status-pengajuan">Close</button>		
                </div>
            </form>		
        </div>
    </div>
</div>

<Script>
    $(function() {
        $('#close-modal-status-pengajuan').click(function() {
        $('#view-status-pengajuan').modal('hide');
        $('#form-view-status-pengajuan')[0].reset();  
        });      
    });

    $(document).ready(function () {
        $(document).on('click','.view-status-data',function(){
            var id  = $(this).attr('data-id2');
            console.log(id);
            
            $.ajax({
                url:"{{asset('/status-pengajuan-aplikasi/status-data')}}",
                data: {'Id':id ,'_token':'{{csrf_token()}}' },
                dataType:'JSON', 
                type:'GET',
                success: function (Status_Datas){
                    console.log(Status_Datas);

                    $('[name="status_data_Id_data"]').val(Status_Datas.Id);
                    $('[name="status_data_Status_data"]').val(Status_Datas.Status);
                    $('[name="status_data_Date_data"]').val(Status_Datas.Date);
                    $('[name="status_data_MstStatusPengajuanID_data"]').val(Status_Datas.MstStatusPengajuanID);
                    
                    // if (Status_Datas.MstCustomerDetail.hasOwnProperty('Subscribe')) {
                    //     $('[name="pendinglist_Subscribe_update_data"]').val(Status_Datas.MstCustomerDetail.Subscribe);   
                    // }else{
                    //     $('[name="pendinglist_Subscribe_update_data"]').val("N");        
                    // }
                },
                error: function( jqXhr, textStatus, errorThrown ){
                console.log(jqXhr);
                console.log( errorThrown );
                console.log(textStatus);
                },
            });
            $('#view-status-data').modal();
        });
    })
</Script>


@include('modal.view_status_data')