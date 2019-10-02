<!-- Modal ADD -->
<div class="modal fade" id="view-history-pembayaran-asuransi-jiwa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close-modal close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="box-title">View History Pembayaran Asuransi Jiwa</h4> 
            </div>
        <form id="form-view-history-pembayaran-asuransi-jiwa" action="#" method="post"> 
            <div class="modal-body">
                @csrf
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="Nama"
                    placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="date" class="form-control" name="TanggalLahir"
                    placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <input type="text" class="form-control" name="JenisKelamin"
                    placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label>Handphone</label>
                    <input type="text" class="form-control" name="Handphone"
                    placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label>No KTP</label>
                    <input type="text" class="form-control" name="NoKTP"
                    placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" name="Email"
                    placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" class="form-control" name="Alamat"
                    placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label>KodePos</label>
                    <input type="text" class="form-control" name="KodePos"
                    placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label>Nama Rekening</label>
                    <input type="text" class="form-control" name="NamaRekening"
                    placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label>Nomer Rekening</label>
                    <input type="text" class="form-control" name="NomorRekening"
                    placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label>Nama Bank</label>
                    <input type="text" class="form-control" name="NamaBank"
                    placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label>Trans Id Merchant</label>
                    <input type="text" class="form-control" name="TransIdMerchant"
                    placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label>Product</label>
                    <input type="text" class="form-control" name="Product"
                    placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label>Total Biaya Premi</label>
                    <input type="text" class="form-control" name="TotalBiayaPremi"
                    placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label>Status Pembayaran</label>
                    <input type="text" class="form-control" name="StatusPembayaran"
                    placeholder="" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="close-modal btn btn-default">Close</button>		
            </div>	
        </form>
        </div>
    </div>
</div>

<Script>
    $(function() {
        $('.close-modal').click(function() {
        $('#view-history-pembayaran-asuransi-jiwa').modal('hide');
        $('#form-view-history-pembayaran-asuransi-jiwa')[0].reset();  
        });      
    });
</Script>
