
<div class="modal fade" id="update-trade-in" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" 
aria-hidden="true" data-keyboard="false" data-backdrop="static">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close button-close-modal" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="box-title">Trade In Detail</h4> 
        </div>
        <form id="form-update-trade-in" action="{{asset('trade-in/approve')}}" method="get">
            <div class="modal-body"> 
                @csrf
                <h4 class="box-title">User</h4> 
                
                <div class="form-group">
                    <input type="hidden" class="form-control" name="MappingTransaksiId" readonly>
                </div>

                <div class="form-group">
                    <label>Name :</label><br>
                    <input type="text" class="form-control" name="Name" readonly>
                </div>
                <div class="form-group">
                    <label>Username</label><br>
                    <input type="text" class="form-control" name="Username" readonly>
                </div>
                <div class="form-group">
                    <label>Email</label><br>
                    <input type="text" class="form-control" name="Email" readonly>
                </div>
                <div class="form-group">
                    <label>Mobile Phone</label><br>
                    <input type="text" class="form-control" name="MobilePhone" readonly>
                </div>


                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="box-title">Mobil Pribadi</h4> 
                        <div class="form-group">
                            <label>Transaction Date</label><br>
                            <input type="text" class="form-control" name="transaction_date_pribadi" readonly>
                        </div>
                        <div class="form-group">
                            <label>Brand</label><br>
                            <input type="text" class="form-control" name="brand_pribadi" readonly>
                        </div>
                        <div class="form-group">
                            <label>Kode Brand</label><br>
                            <input type="text" class="form-control" name="kode_brand_pribadi" readonly>
                        </div>
                        <div class="form-group">
                            <label>Type</label><br>
                            <input type="text" class="form-control" name="type_pribadi" readonly>
                        </div>
                        <div class="form-group">
                            <label>Kode Type</label><br>
                            <input type="text" class="form-control" name="kode_type_pribadi" readonly>
                        </div>
                        <div class="form-group">
                            <label>Model</label><br>
                            <input type="text" class="form-control" name="model_pribadi" readonly>
                        </div>
                        <div class="form-group">
                            <label>Kode Model</label><br>
                            <input type="text" class="form-control" name="kode_model_pribadi" readonly>
                        </div>
                        <div class="form-group">
                            <label>Tahun</label><br>
                            <input type="text" class="form-control" name="tahun_pribadi" readonly>
                        </div>
                        <div class="form-group">
                            <label>MRP</label><br>
                            <div class="input-group">
                                <span class="input-group-addon">Rp</span>
                                <input type="text" class="form-control" name="MRP_pribadi" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Lokasi</label><br>
                            <input type="text" class="form-control" name="lokasi_pribadi" readonly>
                        </div>
                        <div class="form-group">
                            <label>Unit</label><br>
                            <input type="text" class="form-control" name="unit_pribadi" readonly>
                        </div>
                        <div class="form-group">
                            <label>Flag New Exist</label><br>
                            <input type="checkbox" class="" name="flag_new_exist_pribadi" readonly>
                        </div>
                        <div class="form-group">
                            <label>Flag BPKB</label><br>
                            <input type="text" class="form-control" name="flag_BPKB_pribadi" readonly>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <h4 class="box-title">Mobil Masa Depan</h4> 
                        <div class="form-group">
                            <label>Transaction Date</label><br>
                            <input type="text" class="form-control" name="transaction_date_masa_depan" readonly>
                        </div>
                        <div class="form-group">
                            <label>Brand</label><br>
                            <input type="text" class="form-control" name="brand_masa_depan" readonly>
                        </div>
                        <div class="form-group">
                            <label>Kode Brand</label><br>
                            <input type="text" class="form-control" name="kode_brand_masa_depan" readonly>
                        </div>
                        <div class="form-group">
                            <label>Type</label><br>
                            <input type="text" class="form-control" name="type_masa_depan" readonly>
                        </div>
                        <div class="form-group">
                            <label>Kode Type</label><br>
                            <input type="text" class="form-control" name="kode_type_masa_depan" readonly>
                        </div>
                        <div class="form-group">
                            <label>Model</label><br>
                            <input type="text" class="form-control" name="model_masa_depan" readonly>
                        </div>
                        <div class="form-group">
                            <label>Kode Model</label><br>
                            <input type="text" class="form-control" name="kode_model_masa_depan" readonly>
                        </div>
                        <div class="form-group">
                            <label>Tahun</label><br>
                            <input type="text" class="form-control" name="tahun_masa_depan" readonly>
                        </div>
                        <div class="form-group">
                            <label>MRP</label><br>
                            <div class="input-group">
                                <span class="input-group-addon">Rp</span>
                                <input type="text" class="form-control" name="MRP_masa_depan" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Lokasi</label><br>
                            <input type="text" class="form-control" name="lokasi_masa_depan" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="button_approve_save"
                    onclick="return confirm('Are you sure want to Approve this data?')">
                    Approve
                </button>

                <button type="button" class="btn btn-warning button-close-modal">
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
    $('.button-close-modal').click(function() {
        $('#update-trade-in').modal('hide');
        $('#form-update-trade-in')[0].reset();  
    });
});
</Script>