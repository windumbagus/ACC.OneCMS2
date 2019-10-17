<!-- Modal update -->
<div class="modal fade" id="update-role-management" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" 
aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="lose-modal-update close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="box-title">Update Role</h4> 
            </div>
            <form id="form-update-role-management" action="{{ asset('role-management/update') }}" method="post"> 
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="Id" >
                    </div>
                    <div class="form-group">
                        <label>Role Name</label>
                        <input type="text" class="form-control" name="role_name_update" >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="close-modal-update btn btn-default">Close</button>	
                    <button type="submit" class="btn btn-warning">Update</button>		
                </div>	
            </form>
        </div>
    </div>
</div>

<Script>
    $(function() {
        $('.close-modal-update').click(function() {
            $('#update-role-management').modal('hide');
            $('#form-update-role-management')[0].reset();  
        });      
    });
</Script>
