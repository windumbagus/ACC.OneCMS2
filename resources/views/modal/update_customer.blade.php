<!-- Modal ADD -->
<div class="modal fade" id="update-customer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="box-title">Update Customer</h4> 
            </div>
            <div class="modal-body">
                <form id="form-update-customer" action="#" method="post"> 
                    @csrf
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="customer_Id_update"
                        placeholder="Name">
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="customer_UserId_update"
                        placeholder="Name">
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="customer_GCMId_update"
                        placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label>User :</label>
                        <input type="text" class="form-control" name="customer_User_update"
                        placeholder="User">
                    </div>
                    <div class="form-group">
                        <label>Nama Bank:</label>
                        <input type="text" class="form-control" name="customer_NamaBank_update"
                        placeholder="Nama Bank">
                    </div>
                    <div class="form-group">
                        <label>No Rekening:</label>
                        <input type="text" class="form-control" name="customer_NoRekening_update"
                        placeholder="No Rekening">
                    </div>
                    <div class="form-group">
                        <label>Nama Rekening:</label>
                        <input type="text" class="form-control" name="customer_NamaRekening_update"
                        placeholder="Nama Rekening">
                    </div>
                    <div class="form-group">
                        <label>Rekening Utama:</label>
                        <input type="text" class="form-control" name="customer_RekeningUtama_update"
                        placeholder="Rekening Utama">
                    </div>
                    <div class="form-group">
                        <label>Cabang:</label>
                        <input type="text" class="form-control" name="customer_Cabang_update"
                        placeholder="Cabang">
                    </div>
                    <div class="form-group">
                        <label>Is_Active:</label>
                        <input type="text" class="form-control" name="customer_IsActive_update" id="customer_IsActive_update">
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
        $('#update-customer').modal('hide');
        $('#form-update-customer')[0].reset();  
        });      
    });
</Script>
