
<div class="modal fade" id="modal_lease_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" 
    aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close button_leaseModalUpdate_closeModal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="box-title">Update Lease</h4> 
            </div>
            <form id="form_leaseModalUpdate_update" action="{{asset('lease/update')}}" method="post">
                <div class="modal-body"> 
                    @csrf
                    <div class="form-group" hidden>
                        <label>Id:</label><br>
                        <input type="hidden" class="form-control" name="updateLease_MstTransaksi_Id"
                            id='input_leaseModalUpdate_id'>
                    </div>

                    <div class="form-group">
                        <label>User:</label><br>
                        <input class="form-control" name="updateLease_User_UserName" readonly>
                    </div>
                    <div class="form-group">
                        <label>Transaction Date:</label><br>
                        <input class="form-control" name="updateLease_MstTransaksi_TransactionDate" readonly>
                    </div>
                    <div class="form-group">
                        <label>Brand:</label><br>
                        <input class="form-control" name="updateLease_MstTransaksi_Brand" readonly>
                    </div>
                    <div class="form-group">
                        <label>Kode Brand:</label><br>
                        <input class="form-control" name="updateLease_MstTransaksi_KodeBrand" readonly>
                    </div>
                    <div class="form-group">
                        <label>Type:</label><br>
                        <input class="form-control" name="updateLease_MstTransaksi_Type" readonly>
                    </div>
                    <div class="form-group">
                        <label>Kode Type:</label><br>
                        <input class="form-control" name="updateLease_MstTransaksi_KodeType" readonly>
                    </div>
                    <div class="form-group">
                        <label>Model:</label><br>
                        <input class="form-control" name="updateLease_MstTransaksi_Model" readonly>
                    </div>
                    <div class="form-group">
                        <label>Kode Model:</label><br>
                        <input class="form-control" name="updateLease_MstTransaksi_KodeModel" readonly>
                    </div>
                    <div class="form-group">
                        <label>Tahun:</label><br>
                        <input class="form-control" name="updateLease_MstTransaksi_Tahun" readonly>
                    </div>
                    <div class="form-group">
                        <label>Tenor:</label><br>
                        <input class="form-control" name="updateLease_MstTransaksi_Tenors" readonly>
                    </div>
                    <div class="form-group">
                        <label>Flag New/Used:</label><br>
                        <input class="form-control" name="updateLease_MstTransaksi_FlagNewUsed" readonly>
                    </div>
                    <div class="form-group">
                        <label>Area:</label><br>
                        <input class="form-control" name="updateLease_MstTransaksi_Area" readonly>
                    </div>
                    <div class="form-group">
                        <label>Cabang:</label><br>
                        <input class="form-control" name="updateLease_MstTransaksi_Cabang" readonly>
                    </div>
                    <div class="form-group">
                        <label>Tujuan:</label><br>
                        <input class="form-control" name="updateLease_MstTransaksi_Tujuan" readonly>
                    </div>
                    <div class="form-group">
                        <label>Tipe Customer:</label><br>
                        <input class="form-control" name="updateLease_MstTransaksi_TipeCustomer" readonly>
                    </div>
                    <div class="form-group">
                        <label>Bidang Usaha:</label><br>
                        <input class="form-control" name="updateLease_MstTransaksi_BidangUsaha" readonly>
                    </div>
                    <div class="form-group">
                        <label>Warna:</label><br>
                        <input class="form-control" name="updateLease_MstTransaksi_Warna" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label>Status:</label><br>
                        <input class="form-control" name="updateLease_MstTransaksi_Status" readonly>
                    </div>
                    <div class="form-group">
                        <label>Notes:</label><br>
                        <textarea name="updateLease_MstTransaksi_Notes" id="textarea_leaseModalUpdate_notes" 
                            type="text" class="form-control" cols="30" rows="5" readonly>
                        </textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="button_leaseModalUpdate_save"
                        onclick="return confirm('Are you sure want to Follow Up this data?')">
                        Follow Up
                    </button>

                    <button type="button" class="btn btn-warning button_leaseModalUpdate_closeModal">
                        Back
                    </button>		
                </div>
            </form>		
        </div>
    </div>
</div>

<Script>
    $(function() {
        // Update Form
        // Update Modal
        $('.button_leaseModalUpdate_closeModal').click(function() {
            $('#modal_lease_update').modal('hide');
            $('#form_leaseModalUpdate_update')[0].reset();  
        });
    });
</Script>