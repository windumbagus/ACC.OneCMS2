
<div class="modal fade" id="modal_newCar_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" 
    aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close button_newCarModalUpdate_closeModal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="box-title">Update New Car</h4> 
            </div>
            <form id="form_newCarModalUpdate_update" action="{{asset('new-car/update')}}" method="post">
                <div class="modal-body"> 
                    @csrf
                    <div class="form-group" hidden>
                        <label>Id:</label><br>
                        <input type="hidden" class="form-control" name="updateNewCar_MstTransaksi_Id"
                            id='input_newCarModalUpdate_id'>
                    </div>

                    <div class="form-group">
                        <label>User:</label><br>
                        <input class="form-control" name="updateNewCar_User_UserName" readonly>
                    </div>
                    <div class="form-group">
                        <label>Transaction Date:</label><br>
                        <input class="form-control" name="updateNewCar_MstTransaksi_TransactionDate" readonly>
                    </div>
                    <div class="form-group">
                        <label>Brand:</label><br>
                        <input class="form-control" name="updateNewCar_MstTransaksi_Brand" readonly>
                    </div>
                    <div class="form-group">
                        <label>Kode Brand:</label><br>
                        <input class="form-control" name="updateNewCar_MstTransaksi_KodeBrand" readonly>
                    </div>
                    <div class="form-group">
                        <label>Type:</label><br>
                        <input class="form-control" name="updateNewCar_MstTransaksi_Type" readonly>
                    </div>
                    <div class="form-group">
                        <label>Kode Type:</label><br>
                        <input class="form-control" name="updateNewCar_MstTransaksi_KodeType" readonly>
                    </div>
                    <div class="form-group">
                        <label>Model:</label><br>
                        <input class="form-control" name="updateNewCar_MstTransaksi_Model" readonly>
                    </div>
                    <div class="form-group">
                        <label>Kode Model:</label><br>
                        <input class="form-control" name="updateNewCar_MstTransaksi_KodeModel" readonly>
                    </div>
                    <div class="form-group">
                        <label>Tahun:</label><br>
                        <input class="form-control" name="updateNewCar_MstTransaksi_Tahun" readonly>
                    </div>
                    <div class="form-group">
                        <label>Tenor:</label><br>
                        <input class="form-control" name="updateNewCar_MstTransaksi_Tenors" readonly>
                    </div>
                    <div class="form-group">
                        <label>Installment:</label><br>
                        <div class="input-group">
                            <span class="input-group-addon">Rp</span>
                            <input class="form-control" name="updateNewCar_MstTransaksi_Installment" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>OTR:</label><br>
                        <div class="input-group">
                            <span class="input-group-addon">Rp</span>
                            <input class="form-control" name="updateNewCar_MstTransaksi_OTR" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>DP:</label><br>
                        <div class="input-group">
                            <input class="form-control" name="updateNewCar_MstTransaksi_DP" readonly>
                            <span class="input-group-addon">%</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Amount DP:</label><br>
                        <div class="input-group">
                            <span class="input-group-addon">Rp</span>
                            <input class="form-control" name="updateNewCar_MstTransaksi_AmountDP" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Area:</label><br>
                        <input class="form-control" name="updateNewCar_MstTransaksi_Area" readonly>
                    </div>
                    <div class="form-group">
                        <label>Cabang:</label><br>
                        <input class="form-control" name="updateNewCar_MstTransaksi_Cabang" readonly>
                    </div>
                    <div class="form-group">
                        <label>TDP:</label><br>
                        <div class="input-group">
                            <span class="input-group-addon">Rp</span>
                            <input class="form-control" name="updateNewCar_MstTransaksi_TDP" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Flag ACP:</label><br>
                        <input class="form-control" name="updateNewCar_MstTransaksi_FlagACP" readonly>
                    </div>
                    <div class="form-group">
                        <label>Flag Asuransi:</label><br>
                        <input class="form-control" name="updateNewCar_MstTransaksi_FlagAsuransi" readonly>
                    </div>
                    <div class="form-group">
                        <label>Status:</label><br>
                        <input class="form-control" name="updateNewCar_MstTransaksi_Status" readonly>
                    </div>

                    <div class="form-group">
                        <label>Notes:</label><br>
                        <textarea name="updateNewCar_MstTransaksi_Notes" id="textarea_newCarModalUpdate_notes" 
                            type="text" class="form-control" cols="30" rows="5" readonly>
                        </textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="button_newCarModalUpdate_save"
                        onclick="return confirm('Are you sure want to Follow Up this data?')">
                        Follow Up
                    </button>

                    <button type="button" class="btn btn-warning button_newCarModalUpdate_closeModal">
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
        $('.button_newCarModalUpdate_closeModal').click(function() {
            $('#modal_newCar_update').modal('hide');
            $('#form_newCarModalUpdate_update')[0].reset();  
        });
    });
</Script>