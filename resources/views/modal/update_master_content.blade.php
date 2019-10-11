
<div class="modal fade" id="modal_masterContent_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" 
    aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close button_masterContentModalUpdate_closeModal" data-dismiss="modal" aria-label="Close"
                    onclick="return confirm('Are you sure want to cancel?')">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="box-title">Update Master Content</h4> 
            </div>
            <form id="form_masterContentModalUpdate_add" action="{{ asset('master-content/update') }}" method="post" enctype="multipart/form-data">
                <div class="modal-body"> 
                    @csrf
                    

                    <div class="form-group" hidden>
                        <label>Content Id:</label><br>
                        <input type="hidden" class="form-control" name="updateMasterContent_MstContent_Id"
                            id='input_masterContentModalUpdate_Id'>
                    </div>
                    <div class="form-group" hidden>
                        <label>Added Date:</label><br>
                        <input type="hidden" class="form-control" name="updateMasterContent_MstContent_AddedDate">
                    </div>
                    <div class="form-group" hidden>
                        <label>User Added:</label><br>
                        <input type="hidden" class="form-control" name="updateMasterContent_MstContent_UserAdded">
                    </div>
                    <div class="form-group" hidden>
                        <label>User Updated:</label><br>
                        <input type="hidden" class="form-control" name="updateMasterContent_MstContent_UserUpdated" 
                            value="{{ session()->get('Id') }}">
                    </div>
                    <div class="form-group" hidden>
                        <label>Product Owner:</label><br>
                        <input type="hidden" class="form-control" name="updateMasterContent_MstContent_ProductOwner">
                    </div>

                    <div class="form-group" hidden>
                        <label>Picture Id:</label><br>
                        <input type="hidden" class="form-control" name="updateMasterContent_MstPicture_Id" >
                    </div>
                    <div class="form-group" hidden>
                        <label>Data Id:</label><br>
                        <input type="hidden" class="form-control" name="updateMasterContent_MstPicture_DataId" >
                    </div>
                    <div class="form-group" hidden>
                        <label>Picture Type:</label><br>
                        <input type="hidden" class="form-control" name="updateMasterContent_MstPicture_Type" value="Promo">
                    </div>

                    <div class="form-group">
                        <label>Content Type:</label>
                        <select class="input_masterContentModalUpdate_contentTypeAndOrder input_masterContentModalUpdate_contentTypeAndTitle
                            input_masterContentModalUpdate_contentTypeAndStatus form-control select2 " style="width:100%;" required
                            name="updateMasterContent_MstContent_ContentType" id='dropdown_masterContentModalUpdate_contentType'>
                            
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
                        <input type="number" class="form-control input_masterContentModalUpdate_contentTypeAndOrder" 
                            name="updateMasterContent_MstContent_Order" id="input_masterContentModalUpdate_order" 
                            min="0" step="1" required>
                    </div>

                    <div class="form-group">
                        <label>Title:</label><br>
                        <input type="text" class="form-control input_masterContentModalUpdate_contentTypeAndTitle" 
                            name="updateMasterContent_MstContent_Title" id="input_masterContentModalUpdate_title" required>
                    </div>

                    <div class="form-group">
                        <label>Snippet:</label><br>
                        <textarea rows="10" cols="60" type="text" class="form-control" name="updateMasterContent_MstContent_Snippet"
                        id="textarea_masterContentModalUpdate_snippet" >
                        </textarea>
                    </div>

                    <div class="form-group">
                        <label>Description:</label><br>
                        <input type="checkbox" value="True" id="checkbox_masterContentModalUpdate_useTextEditor" checked> 
                        Use text editor?<br>
                        <textarea rows="10" cols="60" type="text" class="form-control" name="updateMasterContent_MstContent_Description" 
                            id="textarea_masterContentModalUpdate_description" required>
                        </textarea>
                    </div>

                    <div class="form-group">
                        <label>Category:</label>
                        <select class="form-control select2" style="width:100%;" name="updateMasterContent_MstContent_Category" required>
                            
                            <option selected="selected" value="">Silahkan Pilih Kategori Konten</option>
                            @foreach ($MstGCM_CategoryList as $MstGCM_Category)
                                <option value="{{$MstGCM_Category}}">
                                    {{$MstGCM_Category}}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group">
                        <label>Picture:</label><br>
                        <img style="width: 300px; height: 200px;" name="updateMasterContent_MstPicture_Picture" alt=""
                            id="placeholder_masterContentModalUpdate_picture"/><br>
                        File type : JPEG/PNG<br>
                        File name max : 50 char<br>
                        <input type="file" class="form-control" name="updateMasterContent_MstPicture" id="input_masterContentModalUpdate_picture">
                    </div>
                    <div class="form-group" hidden>
                        <label>Is Update Picture:</label><br>
                        <input type="hidden" class="form-control" name="updateMasterContent_IsUpdatePicture" value="false"
                            id="input_masterContentModalUpdate_isUpdarePicture">
                    </div>

                    <div class="form-group">
                        <label>Status:</label>
                        <select class="input_masterContentModalUpdate_contentTypeAndStatus form-control select2" 
                            style="width:100%;" name="updateMasterContent_MstContent_Status" required
                            id="dropdown_masterContentModalUpdate_status">
                            
                            <option selected="selected" value="">Silahkan Pilih Status Konten</option>
                            @foreach ($MstGCM_StatusList as $MstGCM_Status)
                                <option value="{{$MstGCM_Status}}">
                                    {{$MstGCM_Status}}
                                </option>
                            @endforeach

                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"
                        onclick="return confirm('Are you sure want to save this data?')">Save</button>	
                    <button type="button" class="btn btn-warning button_masterContentModalUpdate_closeModal"
                        onclick="return confirm('Are you sure want to cancel?')">Cancel</button>		
                </div>
            </form>		
        </div>
    </div>
</div>

<Script>
    $(function() {
        // Add Form
        // Add Modal
        $('.button_masterContentModalUpdate_closeModal').click(function() {
            $('#modal_masterContent_update').modal('hide');
            $('#form_masterContentModalUpdate_add')[0].reset();  
        });      
    
        // Snippet CKEditor
        // Description CKEditor
        CKEDITOR.replace('textarea_masterContentModalUpdate_snippet'),
        CKEDITOR.replace('textarea_masterContentModalUpdate_description')
    });
    
    // Order Input
    // ContentType Dropdown
    $(document).on('change','.input_masterContentModalUpdate_contentTypeAndOrder',function(){
        var MstContent_Id = $('#input_masterContentModalUpdate_Id').val();
        var MstContent_Order = $('#input_masterContentModalUpdate_order').val();
        var MstContent_ContentType = $('#dropdown_masterContentModalUpdate_contentType').val();
        if((MstContent_Order>0) && (MstContent_ContentType!="")) {
            $.ajax({
                url:"{{asset('/master-content/check-content-order')}}",
                data: {
                    'MstContent_Id':MstContent_Id,
                    'MstContent_Order':MstContent_Order,
                    'MstContent_ContentType':MstContent_ContentType,
                    '_token':'{{csrf_token()}}'
                },
                dataType:'JSON', 
                type:'POST',
                success: function (isNotSameOrder){
                    // console.log(isNotSameOrder);
                    if(!isNotSameOrder) {
                        alert('Order Sudah Digunakan!');
                        $('[name="updateMasterContent_MstContent_Order"]').val("");
                    }
                },
                error: function(jqXhr, textStatus, errorThrown){
                    console.log(jqXhr);
                    console.log(errorThrown);
                    console.log(textStatus);
                },
            });
        }
    });

    // Title Input
    $(document).on('change','.input_masterContentModalUpdate_contentTypeAndTitle',function(){
        var MstContent_Id = $('#input_masterContentModalUpdate_Id').val();
        var MstContent_Title = $('#input_masterContentModalUpdate_title').val();
        var MstContent_ContentType = $('#dropdown_masterContentModalUpdate_contentType').val();
        if((MstContent_Title!="") && (MstContent_ContentType!="")) {
            $.ajax({
                url:"{{asset('/master-content/check-content-title')}}",
                data: {
                    'MstContent_Id':MstContent_Id,
                    'MstContent_Title':MstContent_Title,
                    'MstContent_ContentType':MstContent_ContentType,
                    '_token':'{{csrf_token()}}'
                },
                dataType:'JSON', 
                type:'POST',
                success: function (isNotSameTitle){
                    // console.log(isNotSameTitle);
                    if(!isNotSameTitle) {
                        alert('Title Sudah Digunakan!');
                        $('[name="updateMasterContent_MstContent_Title"]').val("");
                    }
                },
                error: function(jqXhr, textStatus, errorThrown){
                    console.log(jqXhr);
                    console.log(errorThrown);
                    console.log(textStatus);
                },
            });
        }
    });

    // Status Dropdown
    $(document).on('change','.input_masterContentModalUpdate_contentTypeAndStatus',function(){
        var MstContent_Id = $('#input_masterContentModalUpdate_Id').val();
        var MstContent_Status = $('#dropdown_masterContentModalUpdate_status').val();
        var MstContent_ContentType = $('#dropdown_masterContentModalUpdate_contentType').val();
        if((MstContent_Status!="") && (MstContent_ContentType!="")) {
            $.ajax({
                url:"{{asset('/master-content/check-content-status')}}",
                data: {
                    'MstContent_Id':MstContent_Id,
                    'MstContent_Status':MstContent_Status,
                    'MstContent_ContentType':MstContent_ContentType,
                    '_token':'{{csrf_token()}}'
                },
                dataType:'JSON', 
                type:'POST',
                success: function (val){
                    // console.log(val);
                    if(val.hasOwnProperty('Error')) {
                        alert('Status Published sudah digunakan! (Tidak boleh lebih dari 1)');
                        $('[name="updateMasterContent_MstContent_Status"]').val("");
                    }
                },
                error: function(jqXhr, textStatus, errorThrown){
                    console.log(jqXhr);
                    console.log(errorThrown);
                    console.log(textStatus);
                },
            });
        }
    });

    // UseTextEditor Checkbox
    $(document).on('change','#checkbox_masterContentModalUpdate_useTextEditor',function(){
        if ($('#checkbox_masterContentModalUpdate_useTextEditor').is(':checked')) {
            CKEDITOR.replace('textarea_masterContentModalUpdate_description');
        } else {
            CKEDITOR.instances['textarea_masterContentModalUpdate_description'].destroy();
        }
    });

    // Description RequiredValidation
    $("#form_masterContentModalUpdate_add").submit(function(e) {
        var length = CKEDITOR.instances['textarea_masterContentModalUpdate_description'].getData().replace(/<[^>]*>/gi, '').length;
        if(!length) {
            $(".results").html('');
            e.preventDefault();
            alert('Please enter a Description!' );
        }
    });
    
    // Picture Input
    $("#input_masterContentModalUpdate_picture").change(function() {
        readUrlAdd(this);
    });
    function readUrlAdd(input) {
        if (input.files && input.files[0]) {
            var readerPictureAdd = new FileReader();
            
            readerPictureAdd.onload = function(e) {
                $('#placeholder_masterContentModalUpdate_picture').attr('src', e.target.result);
            }
            readerPictureAdd.readAsDataURL(input.files[0]);
        }
    }
    $(document).on('change','#input_masterContentModalUpdate_picture',function(){
        document.getElementById("input_masterContentModalUpdate_isUpdarePicture").setAttribute("value","true");
    });
</Script>