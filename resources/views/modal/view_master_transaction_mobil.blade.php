<!-- Modal ADD -->
<div class="modal fade" id="view-master-transaction-mobil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close-modal close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="box-title">View Master Transaction Mobil</h4> 
            </div>
        <form id="form-view-master-transaction-mobil" action="#" method="post"> 
            <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="Nama" readonly>
                    </div>
                    <div class="form-group">
                        <label>No Polisi</label>
                        <input type="text" class="form-control" name="NoPolisi" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Tertanggung</label>
                        <input type="text" class="form-control" name="NamaTertanggung" readonly>
                    </div>
                    <div class="form-group">
                        <label>Kendaraan</label>
                        <input type="text" class="form-control" name="Kendaraan" readonly>
                    </div>
                    <div class="form-group">
                        <label>Pertanggungan</label>
                        <input type="text" class="form-control" name="Pertanggungan" readonly>
                    </div>
                    <div class="form-group">
                        <label>Harga Pertanggungan</label>
                        <input type="text" class="form-control" name="HargaPertanggungan" readonly>
                    </div>
                    <div class="form-group">
                        <label>Warna</label>
                        <input type="text" class="form-control" name="Warna" readonly>
                    </div>
                    <div class="form-group">
                        <label>Warna di STNK</label>
                        <input type="text" class="form-control" name="ColorOnSTNK" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nomor Kontrak</label>
                        <input type="text" class="form-control" name="NoKontrak" readonly>
                    </div>
                    <div class="form-group">
                        <label>DueDate</label>
                        <input type="date" class="form-control" name="DueDate" readonly>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="close-modal btn btn-default" >Close</button>		
            </div>	
        </form>
        </div>
    </div>
</div>

<Script>
    $(function() {
        $('.close-modal').click(function() {
        $('#view-master-transaction-mobil').modal('hide');
        $('#form-view-master-transaction-mobil')[0].reset();  
        });      
    });
</Script>
