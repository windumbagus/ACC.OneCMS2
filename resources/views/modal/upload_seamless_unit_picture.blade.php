
<div class="modal fade" id="upload-seamless-unit-picture" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" 
    aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close-upload-seamless-unit-picture" data-dismiss="modal" aria-label="Close"
                    onclick="return confirm('Are you sure want to cancel?')">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="box-title">Upload Unit Picture</h4> 
            </div>
            <form id="form-seamless-unit-picture" action="{{ asset('/seamless-unit-detail/uploadpicture') }}" method="post" enctype="multipart/form-data">
                <div class="modal-body"> 
                    @csrf	

                    <div class="form-group">
                        <label>GUID</label><br>
                        <input type="hidden" class="form-control" name="GUID" readonly>
                    </div>
                    <div class="form-group">
                        <label>ID Unit</label><br>
                        <input type="hidden" class="form-control" name="ID_UNIT" readonly>
                    </div>

                    <div class="form-group">
                        <label>File Name</label><br>
                        <input type="hidden" class="form-control" name="FILE_NAME">
                    </div>

                    <div class="form-group">
                        <label>Picture</label><br>
                        <img style="width: 300px; height: 200px;" name="URL" alt=""
                            id="placeholder_updatepicture"/><br>
                        File type : JPEG/PNG<br>
                        File name max : 50 char<br>
                        <input type="file" class="form-control" name="addPicture_seamlessunit" id="input_update_picture_seamlessunit" required>
                    </div>

                  
                
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"
                        onclick="return confirm('Are you sure want to save this data?')">Save</button>	
                    <button type="button" class="btn btn-warning close-modal-promo-add"
                        onclick="return confirm('Are you sure want to cancel?')">Cancel</button>		
                </div>
            </form>		
        </div>
    </div>
</div>

<Script>
    $(function() {
        $('.close-upload-seamless-unit-picture').click(function() {
            $('#upload-seamless-unit-picture').modal('hide');
            $('#form-seamless-unit-picture')[0].reset();  
        });           
    
      
    });

    
    


    // Promo Picture
    $("#input_update_picture_seamlessunit").change(function() {
        readUrlAdd(this);
    });
    function readUrlAdd(input) {
        if (input.files && input.files[0]) {
            var readerPictureAdd = new FileReader();
            
            readerPictureAdd.onload = function(e) {
                $('#placeholder_updatepicture').attr('src', e.target.result);
            }
            readerPictureAdd.readAsDataURL(input.files[0]);
        }
    }

</Script>