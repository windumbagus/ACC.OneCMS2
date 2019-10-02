<div class="modal fade" id="view-data-tertanggung-utama" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close-modal close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="box-title">View Data Tertanggung Utama</h4> 
            </div>
        <form id="form-view-data-tertanggung-utama" action="#" method="post"> 
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
                    <label>No KTP</label>
                    <input type="text" class="form-control" name="NoKTP"
                    placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label>KTP</label><br>
                    <img style="width: 200px; height: 200px;" name="KTP" alt=""
                    id="KTP"/><br>
                </div>
                <div class="form-group">
                    <label>Nama Data Pemegang Polis</label>
                    <input type="text" class="form-control" name="NamaData"
                    placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label>Hubungan</label>
                    <input type="text" class="form-control" name="Hubungan"
                    placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label>Added Date</label>
                    <input type="text" class="form-control" name="AddedDate"
                    placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label>User Added</label>
                    <input type="text" class="form-control" name="UserAdded"
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
        $('#view-data-tertanggung-utama').modal('hide');
        $('#form-view-data-tertanggung-utama')[0].reset();  
        });      
    });
</Script>
