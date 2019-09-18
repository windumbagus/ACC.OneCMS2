<!-- Modal ADD -->
<div class="modal fade" id="push_notification_update_modal" tabindex="-1" role="dialog" 
aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="box-title">Update Push Notification</h4>   
            </div>
            <div class="modal-body">
                <form id="form_push_notification_update" action="{{ asset('push-notification/update') }}" method="post"> 
                    @csrf	
                    
                    <div class="form-group">
                        <label>Message :</label>
                        <textarea type="text" class="form-control" name="push_notification_Message_update_data"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Code Push Notification :</label>
                        <input type="text" class="form-control" name="push_notification_CodePushNotif_update_data" readonly>
                    </div>
                    <div class="form-group">
                        <label>Crated Date :</label>
                        <input type="text" class="form-control" name="push_notification_CreatedDate_update_data" readonly>
                    </div>

                    <div class="form-group">
                        <input type="hidden" class="form-control" name="push_notification_Id_update_data">
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="push_notification_UserId_update_data">
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="push_notification_ProductOwner_update_data">
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="push_notification_InvoiceId_update_data">
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="push_notification_HasNewPushNotif_update_data">
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="push_notification_DataId_update_data">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-warning"
                    onclick="return confirm('Are you sure want to update this data?')">Save</button>	
                <button type="button" class="btn btn-primary" id="close-modal">Close</button>	
            </div>
                </form>		
        </div>
    </div>
</div>

<Script>
    $(function() {
        $('#close-modal').click(function() {
            $('#push_notification_update_modal').modal('hide');
            $('#form_push_notification_update')[0].reset();  
        }); 
    });
</Script>
