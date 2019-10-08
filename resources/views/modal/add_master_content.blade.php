
<div class="modal fade" id="modal_masterContent_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" 
    aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close button_masterContentModalAdd_closeModal" data-dismiss="modal" aria-label="Close"
                    onclick="return confirm('Are you sure want to cancel?')">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="box-title">Create New Master Content</h4> 
            </div>
            <form id="form_masterContentModalAdd_add" action="{{ asset('master-content/add') }}" method="post" enctype="multipart/form-data">
                <div class="modal-body"> 
                    @csrf

                    <div class="form-group" hidden>
                        <label>User Added:</label><br>
                        <input type="hidden" class="form-control" name="addMasterContent_MstContent_UserAdded" 
                            value="{{ session()->get('Id') }}">
                    </div>
                    <div class="form-group" hidden>
                        <label>Product Owner:</label><br>
                        <input type="hidden" class="form-control" name="addMasterContent_MstContent_ProductOwner" value="acc.one">
                    </div>

                    <div class="form-group">
                        <label>Content Type:</label>
                        <select class="input_masterContentModalAdd_contentTypeAndOrder input_masterContentModalAdd_contentTypeAndTitle
                            input_masterContentModalAdd_contentTypeAndStatus form-control select2 " style="width:100%;" required
                            name="addMasterContent_MstContent_ContentType" id='dropdown_masterContentModalAdd_contentType'>
                            
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
                        <input type="number" class="form-control input_masterContentModalAdd_contentTypeAndOrder" 
                            name="addMasterContent_MstContent_Order" id="input_masterContentModalAdd_order" 
                            min="0" step="1" required>
                    </div>

                    <div class="form-group">
                        <label>Title:</label><br>
                        <input type="text" class="form-control input_masterContentModalAdd_contentTypeAndTitle" 
                            name="addMasterContent_MstContent_Title" id="input_masterContentModalAdd_title" required>
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
                        <input type="file" class="form-control" name="addMasterContent_MstPicture" id="input_masterContentModalAdd_picture">
                    </div>

                    <div class="form-group">
                        <label>Status:</label>
                        <select class="input_masterContentModalAdd_contentTypeAndStatus form-control select2" 
                            style="width:100%;" name="addMasterContent_MstContent_ContentStatus" required
                            id="dropdown_masterContentModalAdd_status">
                            
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
                    <button type="button" class="btn btn-warning button_masterContentModalAdd_closeModal"
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
        $('.button_masterContentModalAdd_closeModal').click(function() {
            $('#modal_masterContent_add').modal('hide');
            $('#form_masterContentModalAdd_add')[0].reset();  
        });      
    
        // Snippet CKEditor
        // Description CKEditor
        CKEDITOR.replace('textarea_masterContentModalAdd_snippet'),
        CKEDITOR.replace('textarea_masterContentModalAdd_description')
    });
    
    // Order Input
    // ContentType Dropdown
    $(document).on('change','.input_masterContentModalAdd_contentTypeAndOrder',function(){
        var MstContent_Order = $('#input_masterContentModalAdd_order').val();
        var MstContent_ContentType = $('#dropdown_masterContentModalAdd_contentType').val();
        // console.log(MstContent_Order);
        // console.log(MstContent_ContentType);
        if((MstContent_Order>0) && (MstContent_ContentType!="")) {
            $.ajax({
                url:"{{asset('/master-content/check-content-order')}}",
                data: {
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
                        $('[name="addMasterContent_MstContent_Order"]').val("");
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
    $(document).on('change','.input_masterContentModalAdd_contentTypeAndTitle',function(){
        var MstContent_Title = $('#input_masterContentModalAdd_title').val();
        var MstContent_ContentType = $('#dropdown_masterContentModalAdd_contentType').val();
        // console.log(MstContent_Title);
        // console.log(MstContent_ContentType);
        if((MstContent_Title!="") && (MstContent_ContentType!="")) {
            $.ajax({
                url:"{{asset('/master-content/check-content-title')}}",
                data: {
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
                        $('[name="addMasterContent_MstContent_Title"]').val("");
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
    $(document).on('change','.input_masterContentModalAdd_contentTypeAndStatus',function(){
        var MstContent_Status = $('#dropdown_masterContentModalAdd_status').val();
        var MstContent_ContentType = $('#dropdown_masterContentModalAdd_contentType').val();
        // console.log(MstContent_Status);
        // console.log(MstContent_ContentType);
        if((MstContent_Status!="") && (MstContent_ContentType!="")) {
            $.ajax({
                url:"{{asset('/master-content/check-content-status')}}",
                data: {
                    'MstContent_Status':MstContent_Status,
                    'MstContent_ContentType':MstContent_ContentType,
                    '_token':'{{csrf_token()}}'
                },
                dataType:'JSON', 
                type:'POST',
                success: function (val){
                    // console.log(val);
                    if(val.hasOwnProperty('Error')) {
                        alert('Status Sudah Digunakan!');
                        $('[name="addMasterContent_MstContent_ContentStatus"]').val("");
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
    $(document).on('change','#checkbox_masterContentModalAdd_useTextEditor',function(){
        if ($('#checkbox_masterContentModalAdd_useTextEditor').is(':checked')) {
            CKEDITOR.replace('textarea_masterContentModalAdd_description');
        } else {
            CKEDITOR.instances['textarea_masterContentModalAdd_description'].destroy();
        }
    });

    // Description RequiredValidation
    $("#form_masterContentModalAdd_add").submit(function(e) {
        var length = CKEDITOR.instances['textarea_masterContentModalAdd_description'].getData().replace(/<[^>]*>/gi, '').length;
        if(!length) {
            $(".results").html('');
            e.preventDefault();
            alert('Please enter a Description!' );
        }
    });
    
    // Picture Input
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