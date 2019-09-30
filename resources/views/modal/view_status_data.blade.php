<!-- Modal ADD -->
<div class="modal fade" id="view-status-data-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" 
aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document" style=".modal-lg {width: 90%  !important;}">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="box-title">View Transaction History</h4> 
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-8">
                    </div>
                    <div class="col-sm-4">
                        <div class="col-sm-6"></div>
                        <div class="col-sm-6">
                            <form action="{{asset('/status-pengajuan-aplikasi/status-data/download')}}" method="POST"> 
                                @csrf
                                <input type="hidden" class="form-control" name="MstStatusPengajuan_Id" readonly>
                                <button type="submit" class="btn btn-block btn-primary">Download</button>                    
                            </form>
                        </div>
                    </div>
                </div>
                <table id="example2"class="table table-bordered table-hover"  >
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="close-modal-status-data">Back</button>		
            </div>
        </div>
    </div>
</div>

<Script>
    $(function() {
        $('#close-modal-status-data').click(function() {
            $('#view-status-data-modal').modal('hide');
            $('#view-status-data-modal').on('hidden.bs.modal',function(){
                $('body').addClass('modal-open');
            })
            // $('#form-view-survey')[0].reset();  
        });      
    });

    $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false,
            'scrollX': true,
             sDom: 'lrtip', 
            //  "columns": [
            //     {"searchable":false},
            //     {"searchable":false},
            //     {"searchable":false},
            //     {"searchable":false},
            //     {"searchable":false},
            // ]
    })
</Script>