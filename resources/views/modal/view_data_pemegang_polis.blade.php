<!-- Modal ADD -->
<div class="modal fade" id="view-data-pemegang-polis" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close-modal close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="box-title">View Data Pemegang Polis</h4> 
                </div>
            <form id="form-view-data-pemegang-polis" action="#" method="post"> 
                <div class="modal-body">
                        @csrf
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="Nama" readonly>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="text" class="form-control" name="TanggalLahir" readonly>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <input type="text" class="form-control" name="JenisKelamin" readonly>
                    </div>
                    <div class="form-group">
                        <label>Handphone</label>
                        <input type="text" class="form-control" name="Handphone" readonly>
                    </div>
                    <div class="form-group">
                        <label>No KTP</label>
                        <input type="text" class="form-control" name="NoKTP" readonly>
                    </div>
                    <div class="form-group">
                        <label>KTP:</label><br>
                        <img style="width: 200px; height: 200px;" id="KTP" name="KTP" alt=""/><br>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="Email" readonly>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control" name="Alamat" readonly>
                    </div>
                    <div class="form-group">
                        <label>Provinsi</label>
                        <input type="text" class="form-control" name="Provinsi" readonly>
                    </div>
                    <div class="form-group">
                        <label>Kode Pos</label>
                        <input type="text" class="form-control" name="KodePos" readonly>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <input type="text" class="form-control" name="Status" readonly>
                    </div>
                    <div class="form-group">
                        <label>Added Date</label>
                        <input type="text" class="form-control" name="AddedDate" readonly>
                    </div>
                    <div class="form-group">
                        <label>User Added</label>
                        <input type="text" class="form-control" name="UserAdded" readonly>
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
            $('#view-data-pemegang-polis').modal('hide');
            $('#form-view-data-pemegang-polis')[0].reset();  
            });      
        });
    </Script>
    