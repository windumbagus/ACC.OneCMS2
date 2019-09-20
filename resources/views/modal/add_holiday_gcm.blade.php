<!-- Modal ADD -->
<div class="modal fade" id="add-holiday-gcm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" 
aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="box-title">Create New Holiday</h4> 
            </div>
            <form id="form-add-holiday-gcm" action="{{ asset('holiday-gcm/add') }}" method="post"> 
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label>Tanggal Holiday</label>
                        <input type="date" class="form-control" name="tanggal_holiday_add" >
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" name="description_holiday_add" >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="close-modal">Close</button>	
                    <button type="submit" class="btn btn-success">Create</button>		
                </div>	
            </form>
        </div>
    </div>
</div>

<Script>
    $(function() {
        $('#close-modal').click(function() {
            $('#add-holiday-gcm').modal('hide');
            $('#form-add-holiday-gcm')[0].reset();  
        });      
    });
</Script>
