<!-- Modal ADD -->
<div class="modal fade" id="update-holiday-gcm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" 
aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="box-title">
                    @if ((property_exists($Role,'IsUpdate')) && ($Role->IsUpdate == True))
                        Update Holiday GCM
                    @else
                        View Holiday GCM
                    @endif
                </h4> 
            </div>
            <form id="form-update-holiday-gcm" action="{{ asset('holiday-gcm/update') }}" method="post"> 
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="id_holiday_update" >
                    </div>
                    <div class="form-group">
                        <label>Tanggal Holiday</label>
                        <input type="date" class="form-control" name="tanggal_holiday_update" >
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" name="description_holiday_update" >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="close-modal-update">Close</button>	
                    @if ((property_exists($Role,'IsUpdate')) && ($Role->IsUpdate == True))
                        <button type="submit" class="btn btn-warning">Update</button>
                    @endif	
                </div>	
            </form>
        </div>
    </div>
</div>

<Script>
    $(function() {
        $('#close-modal-update').click(function() {
            $('#update-holiday-gcm').modal('hide');
            $('#form-update-holiday-gcm')[0].reset();  
        });      
    });
</Script>
