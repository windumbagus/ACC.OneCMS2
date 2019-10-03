<!-- Modal UPDATE -->
<div class="modal fade" id="update-master-pernyataan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" 
aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close-modal-update close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="box-title">Update Master Pernyataan</h4> 
            </div>
            <form id="form-update-master-pernyataan" action="{{ asset('master-pernyataan/update') }}" method="post"> 
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="Id_update" >
                    </div>
                    <div class="form-group">
                        <label>Perlindungan Untuk</label>
                        <select name="perlindungan_untuk_update" id="perlindungan_untuk_update" class="form-control">
                            <option selected disabled value="">--Silahkan Pilih--</option>
                            @foreach ($Perlindungans as $Perlindungan)
                                <option value="{{$Perlindungan->CharValue2}}">{{$Perlindungan->CharValue2}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jenis Proteksi</label>
                        <select name="jenis_proteksi_update" id="jenis_proteksi_update" class="form-control">
                            <option selected disabled value="">--Silahkan Pilih--</option>
                            @foreach ($Proteksis as $Proteksi)
                                <option value="{{$Proteksi->CharValue2}}">{{$Proteksi->CharValue2}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Product</label>
                        <select name="nama_product_update" id="nama_product_update" class="form-control">
                            <option selected disabled value="">--Silahkan Pilih--</option>
                            @foreach ($Products as $Product)
                                <option value="{{$Product->ProductName}}">{{$Product->ProductName}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Is Pemegang Polis Tertanggung Utama</label><br>
                        <input type="checkbox" class="" name="pemegang_polis_tertanggung_utama_update">
                    </div>
                    <div class="form-group">
                        <label>Isi Data Tertanggung Utama</label>
                        <select name="data_tertanggung_utama_update" id="data_tertanggung_utama_update" class="form-control">
                            <option selected disabled value="">--Silahkan Pilih--</option>
                            @foreach ($Hubungans as $Hubungan)
                                <option value="{{$Hubungan->CharDesc1}}">{{$Hubungan->CharDesc1}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Is Asuransi tambahan</label><br>
                        <input type="checkbox" class="" name="asuransi_tambahan_update">
                    </div>
                    <div class="form-group">
                        <label>Pernyataan</label>
                        <textarea type="text" class="form-control" name="pernyataan_update" ></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="close-modal-update btn btn-default" >Close</button>	
                    <button type="submit" class="btn btn-warning">Update</button>		
                </div>	
            </form>
        </div>
    </div>
</div>

<Script>
    $(function() {
        $('.close-modal-update').click(function() {
            $('#update-master-pernyataan').modal('hide');
            $('#form-update-master-pernyataan')[0].reset();  
        });      
    });

  
</Script>
