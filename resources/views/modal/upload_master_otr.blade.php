<!-- Modal ADD -->
<div class="modal fade" id="upload-master-otr" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="box-title">Upload Master Kota</h4> 
            </div>
            <div class="modal-body">
                <form id="form-upload-master-otr" action="{{asset('/master-otr/upload')}}" method="post" enctype="multipart/form-data"> 
                    @csrf
                    Structure : CD_BRAND, DESC_BRAND, CD_TYPE, DESC_TYPE, CD_MODEL, DESC_MODEL, FLAG_NEW_USED, TAHUN, CD_SP, CD_AREA, OTR, DEVIASI, FLAG_ACTIVE<br>
                    Format &nbsp;&nbsp;&nbsp; : .xlsx file, no double-quotes for text
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="form-group">
                                <input type="file" class="form-control" name="upload_master_otr"  >
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Upload</button>		
                            </div>
                        </div>
                    </div>
                </form>

                <table id="table_modal_upload_otr" class="table table-bordered display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>Brand</th>
                            <th>Type</th>
                            <th>Model</th>
                            <th>New/Used</th>
                            <th>Tahun</th>
                            <th>Area/Cabang</th>
                            <th>OTR</th>
                            <th>Deviasi</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="close-modal-upload">Close</button>		
            </div>
            
        </div>
    </div>
</div>

<Script>
    $(function() {
        $('#close-modal-upload').click(function() {
        $('#upload-master-otr').modal('hide');
        $('#form-upload-master-otr')[0].reset();  
        });      
    });

    $('#table_modal_upload_otr').DataTable({
          'deferRender': true,
          'paging'      : true,
          'lengthChange': false,
          'searching'   : false,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : true,
        //   'scrollX': true,
        //   sDom: 'lrtip', 
        //   "columns": [
        //         null,
        //         null,
        //         null,
        //         {"searchable":false},                
        //         null,
        //         null,
        //         {"searchable":false},                                
        //         {"searchable":false},                                
        //         {"searchable":false},                                
        //     ]
      })

</Script>
