
<div class="modal fade" id="modal_masterContent_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" 
    aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close-modal-masterContent-add" data-dismiss="modal" aria-label="Close"
                    onclick="return confirm('Are you sure want to cancel?')">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="box-title">Create New Master Content</h4> 
            </div>
            <form id="form_masterContentModalAdd_add" action="" method="post" enctype="multipart/form-data">
            <!-- <form id="form_masterContentModalAdd_add" action="{{ asset('master-content/add') }}" method="post" enctype="multipart/form-data"> -->
                <div class="modal-body"> 
                    @csrf

                    <div class="form-group">
                        <label>Content Type:</label>
                        <select class="form-control select2" style="width:100%;" name="addMasterContent_MstContent_ContentType" required>
                            
                            <option selected="selected" value="">Silahkan Pilih Tipe Konten</option>
                            @foreach ($MstGCM_ContentTypeList as $MstGCM_ContentType)
                                <option value="{{$MstGCM_ContentType}}">
                                    {{$MstGCM_ContentType}}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group">
                        <label>Order:</label><br>
                        <input type="number" class="form-control" name="addMasterContent_MstContent_Order" min="0" step="1" required>
                    </div>

                    <div class="form-group">
                        <label>Title:</label><br>
                        <input type="text" class="form-control" name="addMasterContent_MstContent_Title" required>
                    </div>

                    <div class="form-group">
                        <label>Snippet:</label><br>
                        <textarea rows="10" cols="60" type="text" class="form-control" name="addMasterContent_MstContent_Snippet"
                        id="textarea_masterContentModalAdd_snippet" >
                        </textarea>
                    </div>

                    <div class="form-group">
                        <label>Description:</label><br>
                        <input type="checkbox" value="True" id="checkbox_masterContentModalAdd_useTextEditor" checked> 
                        Use text editor?<br>
                        <textarea rows="10" cols="60" type="text" class="form-control" name="addMasterContent_MstContent_Description" 
                            id="textarea_masterContentModalAdd_description" required>
                        </textarea>
                    </div>

                    <div class="form-group">
                        <label>Category:</label>
                        <select class="form-control select2" style="width:100%;" name="addMasterContent_MstContent_NewsCategory" required>
                            
                            <option selected="selected" value="">Silahkan Pilih Kategori Konten</option>
                            @foreach ($MstGCM_NewsCategoryList as $MstGCM_NewsCategory)
                                <option value="{{$MstGCM_NewsCategory}}">
                                    {{$MstGCM_NewsCategory}}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group">
                        <label>Picture:</label><br>
                        <img style="width: 300px; height: 200px;" name="addMasterContent_MstPicture_Picture" alt=""
                            id="placeholder_masterContentModalAdd_picture"/><br>
                        File type : JPEG/PNG<br>
                        File name max : 50 char<br>
                        <input type="file" class="form-control" name="addMasterContent_MstPicture" id="input_masterContentModalAdd_picture" required>
                    </div>

                    <div class="form-group">
                        <label>Status:</label>
                        <select class="form-control select2" style="width:100%;" name="addMasterContent_MstContent_ContentStatus" required>
                            
                            <option selected="selected" value="">Silahkan Pilih Status Konten</option>
                            @foreach ($MstGCM_ContentStatusList as $MstGCM_ContentStatus)
                                <option value="{{$MstGCM_ContentStatus}}">
                                    {{$MstGCM_ContentStatus}}
                                </option>
                            @endforeach

                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"
                        onclick="return confirm('Are you sure want to save this data?')">Save</button>	
                    <button type="button" class="btn btn-warning close-modal-masterContent-add"
                        onclick="return confirm('Are you sure want to cancel?')">Cancel</button>		
                </div>
            </form>		
        </div>
    </div>
</div>

<Script>
    $(function() {
        $('.close-modal-masterContent-add').click(function() {
            $('#modal_masterContent_add').modal('hide');
            $('#form_masterContentModalAdd_add')[0].reset();  
        });      
    
        // Snippet & Description CKEditor
        CKEDITOR.replace('textarea_masterContentModalAdd_snippet'),
        CKEDITOR.replace('textarea_masterContentModalAdd_description')
    });

    // Use Text Editor Checkbox
    $(document).on('change','#checkbox_masterContentModalAdd_useTextEditor',function(){
        if ($('#checkbox_masterContentModalAdd_useTextEditor').is(':checked')) {
            CKEDITOR.replace('textarea_masterContentModalAdd_description');
        } else {
            CKEDITOR.instances['textarea_masterContentModalAdd_description'].destroy();
        }
    });

    // Description Required Validation
    $("#form_masterContentModalAdd_add").submit(function(e) {
        var length = CKEDITOR.instances['textarea_masterContentModalAdd_description'].getData().replace(/<[^>]*>/gi, '').length;
        if(!length) {
            $(".results").html('');
            e.preventDefault();
            alert('Please enter a Description!' );
        }
    });
    
    // Content Picture
    $("#input_masterContentModalAdd_picture").change(function() {
        readUrlAdd(this);
    });
    function readUrlAdd(input) {
        if (input.files && input.files[0]) {
            var readerPictureAdd = new FileReader();
            
            readerPictureAdd.onload = function(e) {
                $('#placeholder_masterContentModalAdd_picture').attr('src', e.target.result);
            }
            readerPictureAdd.readAsDataURL(input.files[0]);
        }
    }
</Script>