<!-- Modal ADD -->
<div class="modal fade" id="upload-master-kota" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="box-title">Upload Master Kota</h4> 
            </div>
        <form id="form-upload-master-kota" action="{{asset('/master-kota/upload')}}" method="post" enctype="multipart/form-data"> 
            <div class="modal-body">
                @csrf
                Structure : CD_CITY, CITY, DT_TRANSFER, DT_UPLOADED, CD_SP, CD_SP_COLL, AREA_CODE, CD_PROVINSI, FLAG_ACTIVE (Y/N), FLAG_TRANSFER (Y/N), FLAG_SUB_AREA_CODE (Y/N)<br>
                Format &nbsp;&nbsp;&nbsp;&nbsp;: .xlsx file, no double-quotes for text
                <div class="row">
                    <div class="col-sm-7">
                        <div class="form-group">
                            <input type="file" class="form-control" name="upload_master_kota"  >
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Upload</button>		
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="close-modal-upload">Close</button>		
            </div>	
        </form>
        </div>
    </div>
</div>

<Script>
    $(function() {
        $('#close-modal-upload').click(function() {
        $('#upload-master-kota').modal('hide');
        $('#form-upload-master-kota')[0].reset();  
        });      
    });
</Script>
