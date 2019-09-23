<!-- Modal ADD -->
<div class="modal fade" id="update-master-kota" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" 
aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="box-title">Update Master Kota</h4> 
            </div>
            <form id="form-add-master-kota" action="{{ asset('master-kota/update') }}" method="post"> 
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label>CD CITY</label>
                        <input type="text" class="form-control" name="CD_CITY_master_kota_update" >
                    </div>
                    <div class="form-group">
                        <label>CITY</label>
                        <input type="text" class="form-control" name="CITY_master_kota_update" >
                    </div>
                    <div class="form-group">
                        <label>FLAG ACTIVE:</label><br>
                        <input type="checkbox" class="" name="FLAG_ACTIVE_master_kota_update">
                    </div>
                    <div class="form-group">
                        <label>FLAG TRANSFER:</label><br>
                        <input type="checkbox" class="" name="FLAG_TRANSFER_master_kota_update">
                    </div>
                    <div class="form-group">
                        <label>DT TRANSFER</label>
                        <input type="date" class="form-control" name="DT_TRANSFER_master_kota_update" >
                    </div>
                    <div class="form-group">
                        <label>DT UPLOADED</label>
                        <input type="date" class="form-control" name="DT_UPLOADED_master_kota_update" >
                    </div>
                    <div class="form-group">
                        <label>CD SP</label>
                        <input type="text" class="form-control" name="CD_SP_master_kota_update" >
                    </div>
                    <div class="form-group">
                        <label>CD SP COLL</label>
                        <input type="text" class="form-control" name="CD_SP_COLL_master_kota_update" >
                    </div>
                    <div class="form-group">
                        <label>AREA CODE</label>
                        <input type="text" class="form-control" name="AREA_CODE_master_kota_update" >
                    </div>
                    <div class="form-group">
                        <label>FLAG SUB AREA CODE:</label><br>
                        <input type="checkbox" class="" name="FLAG_SUB_AREA_CODE_master_kota_update">
                    </div>
                    <div class="form-group">
                        <label>CD PROVINSI</label>
                        <input type="text" class="form-control" name="CD_PROVINSI_master_kota_update" >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="close-modal-update">Close</button>	
                    <button type="submit" class="btn btn-success">Create</button>		
                </div>	
            </form>
        </div>
    </div>
</div>

<Script>
    $(function() {
        $('#close-modal-update').click(function() {
            $('#update-master-kota').modal('hide');
            $('#form-update-master-kota')[0].reset();  
        });      
    });
</Script>
