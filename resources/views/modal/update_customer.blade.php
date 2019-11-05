<!-- Modal ADD -->
<div class="modal fade" id="update-customer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="box-title">
                    @if ((property_exists($Role,'IsUpdate')) && ($Role->IsUpdate == True))
                        Update Customer
                    @else
                        View Customer
                    @endif
                </h4> 
            </div>
        <form id="form-update-customer" action="{{ asset('customer/update') }}" method="post"> 
            <div class="modal-body">
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
                        <input type="hidden" class="form-control" name="customer_UserAdded_update"
                        placeholder="Name">
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="customer_BankCode_update"
                        placeholder="Name">
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="customer_AddedDate_update"
                        placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label>User :</label>
                        <input type="text" class="form-control" name="customer_User_update"
                        placeholder="User" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Bank:</label>
                        <input type="text" class="form-control" name="customer_NamaBank_update"
                        placeholder="Nama Bank" readonly>
                    </div>
                    <div class="form-group">
                        <label>No Rekening:</label>
                        <input type="text" class="form-control" name="customer_NoRekening_update"
                        placeholder="No Rekening" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Rekening:</label>
                        <input type="text" class="form-control" name="customer_NamaRekening_update"
                        placeholder="Nama Rekening" readonly>
                    </div>
                    <div class="form-group">
                        <label>Rekening Utama:</label>
                        <input type="text" class="form-control" name="customer_RekeningUtama_update"
                        placeholder="Rekening Utama" readonly>
                    </div>
                    <div class="form-group">
                        <label>Cabang:</label>
                        <input type="text" class="form-control" name="customer_Cabang_update"
                        placeholder="Cabang" readonly>
                    </div>
                    <div class="form-group">
                        <label>Is_Active:</label><br>
                        <input type="checkbox" class="" name="customer_IsActive_update">
                    </div>	
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="close-modal">Close</button>
                @if ((property_exists($Role,'IsUpdate')) && ($Role->IsUpdate == True))		
                    <button type="submit" class="btn btn-success">OK</button>		
                @endif
            </div>	
        </form>
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
