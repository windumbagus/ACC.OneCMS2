<!-- Modal ADD -->
<div class="modal fade" id="view-approve" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="box-title">View Approve List</h4> 
            </div>
            <div class="modal-body">
                <form id="form-view-approve" action="#" method="post"> 
                    @csrf	
                    <div class="form-group">
                        <label>Foto Profile:</label><br>
                        <img style="width: 150px; height: 200px;" name="approve_Profile_view" alt=""/><br>
                    </div>
                    <div class="form-group">
                        <label>Name :</label>
                        <input type="text" class="form-control" name="approve_Name_view"
                        placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label>Username :</label>
                        <input type="text" class="form-control" name="approve_Username_view"
                        placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="text" class="form-control" name="approve_Email_view"
                        placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label>Mobile Phone:</label>
                        <input type="text" class="form-control" name="approve_MobilePhone_view"
                        placeholder="Mobile Phone">
                    </div>
                    <div class="form-group">
                        <label>Last Login:</label>
                        <input type="text" class="form-control" name="approve_Last_Login_view"
                        placeholder="Last Login">
                    </div>
                    <div class="form-group">
                        <label>Is Active:</label>
                        <input type="text" class="form-control" name="approve_Is_Active_view"
                        placeholder="Is Active">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir:</label>
                        <input type="text" class="form-control" name="approve_TanggalLahir_view"
                        placeholder="Tanggal Lahir">
                    </div>
                    <div class="form-group">
                        <label>Status:</label>
                        <input type="text" class="form-control" name="approve_Status_view"
                        placeholder="Status">
                    </div>
                    <div class="form-group">
                        <label>Status No HP:</label>
                        <input type="text" class="form-control" name="approve_StatusNoHP_view"
                        placeholder="StatusNoHP">
                    </div>
                    <div class="form-group">
                        <label>Subscribe:</label>
                        <input type="text" class="form-control" name="approve_Subscribe_view"
                        placeholder="Subscribe">
                    </div>
                    <div class="form-group">
                        <label>Foto KTP:</label><br>
                        <img style="width: 150px; height: 200px;" name="approve_KTP_view" alt=""/><br>
                    </div>
                    <div class="form-group">
                        <label>Foto NPWP:</label><br>
                        <img style="width: 150px; height: 200px;" name="approve_NPWP_view" alt=""/><br>
                    </div>
                    <div class="form-group">
                        <label>Foto KK:</label><br>
                        <img style="width: 150px; height: 200px;" name="approve_KK_view" alt=""/><br>
                    </div>
                </form>	
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="close-modal">Close</button>		
            </div>	
        </div>
    </div>
</div>

<Script>
    $(function() {
        $('#close-modal').click(function() {
        $('#view-approve').modal('hide');
        $('#form-view-approve')[0].reset();  
        });      
    });
</Script>
