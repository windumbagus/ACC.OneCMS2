
<div class="modal fade" id="view-status-data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" 
    aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="box-title">Status Data</h4> 
            </div>
            <div class="modal-body"> 
                <table id="example1" class="table table-bordered display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                            <tr>  
                                <td><span></span></td>
                                <td><span></span></td>
                            </tr> 
                            
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="close-modal-status-data">Close</button>		
            </div>	
        </div>
    </div>
</div>

<Script>
    $(function() {
        $('#close-modal-status-data').click(function() {
        $('#view-status-data').modal('hide');
        $('#form-view-status-data')[0].reset();  
        });      
    });

    // $(document).ready(function () {
    //     $('#example1').DataTable({
    //         'deferRender' : true,
    //         'paging'      : true,
    //         'lengthChange': false,
    //         'searching'   : true,
    //         'ordering'    : true,
    //         'info'        : true,
    //         'autoWidth'   : true,
    //         'scrollX': true,
    //         sDom: 'lrtip', 
    //         "columns": [
    //             {"searchable":false},                
    //             {"searchable":false},
    //         ]
    //     })
    // })
</Script>