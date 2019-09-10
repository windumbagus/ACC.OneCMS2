<!-- Modal ADD -->
<div class="modal fade" id="view-rejected" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header"></div>
            <div class="modal-body">
                <div class="box box-info">
                    <div class="box-header">
                        <i class="fa fa-database"></i>
                
                        <h3 class="box-title">View Rejected</h3>
                        <!-- tools box -->
                        <!-- /. tools -->
                    </div>
                    <div class="box-body">
                        <form id="form-view-rejected" action="#" method="post"> 
                        @csrf	
                        <div class="form-group">
                            <input type="hidden" name="calender_id_add"/>
                        </div>
                        <div class="form-group">
                            <label>Name :</label>
                            <input type="text" class="form-control" name="rejected_Name_view"
                            placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label>Username :</label>
                            <input type="text" class="form-control" name="rejected_Username_view"
                            placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="text" class="form-control" name="rejected_Email_view"
                            placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label>Mobile Phone:</label>
                            <input type="text" class="form-control" name="rejected_MobilePhone_view"
                            placeholder="Mobile Phone">
                        </div>
                        <div class="form-group">
                            <label>Last Login:</label>
                            <input type="text" class="form-control" name="rejected_Last_Login_view"
                            placeholder="Last Login">
                        </div>
                        <div class="form-group">
                            <label>Is Active:</label>
                            <input type="text" class="form-control" name="rejected_Is_Active_view"
                            placeholder="Is Active">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir:</label>
                            <input type="text" class="form-control" name="rejected_TanggalLahir_view"
                            placeholder="Tanggal Lahir">
                        </div>
                        <div class="form-group">
                            <label>Status:</label>
                            <input type="text" class="form-control" name="rejected_Status_view"
                            placeholder="Status">
                        </div>
                        <div class="form-group">
                            <label>Status No HP:</label>
                            <input type="text" class="form-control" name="rejected_StatusNoHP_view"
                            placeholder="StatusNoHP">
                        </div>
                        <div class="form-group">
                            <label>Subscribe:</label>
                            <input type="text" class="form-control" name="rejected_Subscribe_view"
                            placeholder="Subscribe">
                        </div>
                        <div class="form-group">
                            <label>Foto KTP:</label><br>
                            <img style="width: 150px; height: 200px;" name="rejected_KTP_view" alt=""/><br>
                        </div>
                        <div class="form-group">
                            <label>Foto NPWP:</label><br>
                            <img style="width: 150px; height: 200px;" name="rejected_NPWP_view" alt=""/><br>
                        </div>
                        <div class="form-group">
                            <label>Foto KK:</label><br>
                            <img style="width: 150px; height: 200px;" name="rejected_KK_view" alt=""/><br>
                        </div>
                        <div class="form-group">
                            <label>Reason:</label>
                            <input type="text" class="form-control" name="rejected_Reason_view"
                            placeholder="Reason">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="close-modal">Close</button>		
            </div>
        </form>			
        </div>
    </div>
</div>

<Script>
    $(function() {
        $('#close-modal').click(function() {
        $('#view-rejected').modal('hide');
        $('#form-view-rejected')[0].reset();  
        });      
    });
</Script>
