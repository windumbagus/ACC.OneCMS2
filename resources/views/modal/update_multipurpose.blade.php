
<div class="modal fade" id="update-multipurpose" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" 
aria-hidden="true" data-keyboard="false" data-backdrop="static">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close button-close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="box-title">Multipurpose</h4> 
        </div>
        <form id="form-update-multipurpose" action="{{asset('multipurpose/FollowUp')}}" method="get">
            <div class="modal-body"> 
                @csrf
                <div class="form-group" hidden>
                    <input type="hidden" class="form-control" name="MstTransaksiId">
                </div>

                <div class="form-group">
                    <label>User:</label><br>
                    <input class="form-control" name="Name" readonly>
                </div>
                <div class="form-group">
                    <label>Email:</label><br>
                    <input class="form-control" name="Email" readonly>
                </div>
                <div class="form-group">
                    <label>No. HP:</label><br>
                    <input class="form-control" name="MobilePhone" readonly>
                </div>
                <div class="form-group">
                    <label>Transaction Date:</label><br>
                    <input class="form-control" name="TransactionDate" readonly>
                </div>
                <div class="form-group">
                    <label>Brand:</label><br>
                    <input class="form-control" name="Brand" readonly>
                </div>
                <div class="form-group">
                    <label>Kode Brand:</label><br>
                    <input class="form-control" name="KodeBrand" readonly>
                </div>
                <div class="form-group">
                    <label>Type:</label><br>
                    <input class="form-control" name="Type" readonly>
                </div>
                <div class="form-group">
                    <label>Kode Type:</label><br>
                    <input class="form-control" name="KodeType" readonly>
                </div>
                <div class="form-group">
                    <label>Model:</label><br>
                    <input class="form-control" name="Model" readonly>
                </div>
                <div class="form-group">
                    <label>Kode Model:</label><br>
                    <input class="form-control" name="KodeModel" readonly>
                </div>
                <div class="form-group">
                    <label>Tahun:</label><br>
                    <input class="form-control" name="Tahun" readonly>
                </div>
                <div class="form-group">
                    <label>MRP:</label><br>
                    <div class="input-group">
                        <span class="input-group-addon">Rp</span>
                        <input class="form-control" name="MRP" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label>Dana:</label><br>
                    <div class="input-group">
                        <span class="input-group-addon">Rp</span>
                        <input class="form-control" name="Dana" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label>Tenors:</label><br>
                    <input class="form-control" name="Tenors" readonly>
                </div>
                <div class="form-group">
                    <label>Tujuan:</label><br>
                    <input class="form-control" name="Tujuan" readonly>
                </div>
                <div class="form-group">
                    <label>Installment:</label><br>
                    <div class="input-group">
                        <span class="input-group-addon">Rp</span>
                        <input class="form-control" name="Installment" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label>Area:</label><br>
                    <input class="form-control" name="Area" readonly>
                </div>
                <div class="form-group">
                    <label>Cabang:</label><br>
                    <input class="form-control" name="Cabang" readonly>
                </div>
                <div class="form-group">
                    <label>Foto 1:</label><br>
                    <img style="width: 300px; height: 200px;" name="picture1" alt=""
                    id="foto1"/><br>
                </div>
                <div class="form-group">
                    <label>Foto 2:</label><br>
                    <img style="width: 300px; height: 200px;" name="picture2" alt=""
                    id="foto2"/><br>
                </div>
                <div class="form-group">
                    <label>Foto 3:</label><br>
                    <img style="width: 300px; height: 200px;" name="picture3" alt=""
                    id="foto3"/><br>
                </div>
                <div class="form-group">
                    <label>Foto 4:</label><br>
                    <img style="width: 300px; height: 200px;" name="picture4" alt=""
                    id="foto4"/><br>
                </div>
                <div class="form-group">
                    <label>Foto 5:</label><br>
                    <img style="width: 300px; height: 200px;" name="picture5" alt=""
                    id="foto5"/><br>
                </div>
                <div class="form-group">
                    <label>Foto 6:</label><br>
                    <img style="width: 300px; height: 200px;" name="picture6" alt=""
                    id="foto6"/><br>
                </div>
                <div class="form-group">
                    <label>Foto 7:</label><br>
                    <img style="width: 300px; height: 200px;" name="picture7" alt=""
                    id="foto7"/><br>
                </div>
                <div class="form-group">
                    <label>Foto 8:</label><br>
                    <img style="width: 300px; height: 200px;" name="picture8" alt=""
                    id="foto8"/><br>
                </div>
                <div class="form-group">
                    <label>Flag New Exist:</label><br>
                    <input class="form-control" name="FlagNewExist" readonly>
                </div>
                <div class="form-group">
                    <label>Flag BPKB:</label><br>
                    <input class="form-control" name="FlagBPKB" readonly>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="button_Follow_up"
                    onclick="return confirm('Are you sure want to Follow Up this data?')">
                    Follow Up
                </button>

                <button type="button" class="btn btn-warning button-close">
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
    $('.button-close').click(function() {
        $('#update-multipurpose').modal('hide');
        $('#form-update-multipurpose')[0].reset();
        $('#foto1').attr('src', "");  
        $('#foto2').attr('src', "");  
        $('#foto3').attr('src', "");  
        $('#foto4').attr('src', "");  
        $('#foto5').attr('src', "");  
        $('#foto6').attr('src', "");  
        $('#foto7').attr('src', "");  
        $('#foto8').attr('src', "");  
    });
});
</Script>