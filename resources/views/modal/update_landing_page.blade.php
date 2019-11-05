
<div class="modal fade" id="modal_landingPage_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" 
    aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                @if ((property_exists($Role,'IsUpdate')) && ($Role->IsUpdate == True))
                    <button type="button" class="close button_landingPageModalUpdate_closeModal" data-dismiss="modal" aria-label="Close"
                        onclick="return confirm('Are you sure want to cancel?')">
                        <span aria-hidden="true">&times;</span>
                    </button>
                @else
                    <button type="button" class="close button_landingPageModalUpdate_closeModal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                @endif
                <h4 class="box-title">
                    @if ((property_exists($Role,'IsUpdate')) && ($Role->IsUpdate == True))
                        Update Landing Page
                    @else
                        View Landing Page
                    @endif
                </h4> 
            </div>
            <form id="form_landingPageModalUpdate_update" action="{{asset('landing-page/update')}}" method="post" 
                enctype="multipart/form-data">
                <div class="modal-body"> 
                    @csrf
                    <div class="form-group" hidden>
                        <label>Id:</label><br>
                        <input type="hidden" class="form-control" name="updateLandingPage_MstLandingPage_Id"
                            id='input_landingPageModalUpdate_id'>
                    </div>
                    <div class="form-group" hidden>
                        <label>Type:</label><br>
                        <input type="hidden" class="form-control" name="updateLandingPage_MstLandingPage_Type">
                    </div>
                    <div class="form-group" hidden>
                        <label>DtAdded:</label><br>
                        <input type="hidden" class="form-control" name="updateLandingPage_MstLandingPage_DtAdded">
                    </div>

                    <div class="form-group" hidden>
                        <label>Picture Id:</label><br>
                        <input type="hidden" class="form-control" name="updateLandingPage_MstPicture_Id">
                    </div>
                    <div class="form-group" hidden>
                        <label>Picture DataId:</label><br>
                        <input type="hidden" class="form-control" name="updateLandingPage_MstPicture_DataId">
                    </div>
                    <div class="form-group" hidden>
                        <label>Picture Type:</label><br>
                        <input type="hidden" class="form-control" name="updateLandingPage_MstPicture_Type">
                    </div>

                    <div class="form-group">
                        <label>Category:</label>
                        <select class="form-control select2 dropdown_landingPageModalUpdate_categoryAndSubCategory" 
                            name="updateLandingPage_MstLandingPage_Category" id='dropdown_landingPageModalUpdate_category'
                            style="width:100%;" required>
                            <option selected value="">Silahkan Pilih Category</option>
                            @foreach ($LandingPageCategoryList as $LandingPageCategory)
                                <option value="{{$LandingPageCategory}}">
                                    {{$LandingPageCategory}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group" id="div_landingPageModalUpdate_subCategory">
                        <label>Sub Category:</label>
                        <select class="form-control select2 dropdown_landingPageModalUpdate_categoryAndSubCategory"
                            name="updateLandingPage_MstLandingPage_SubCategory" id='dropdown_landingPageModalUpdate_subCategory'
                            style="width:100%;" required>
                            <option selected value="">Silahkan Pilih Sub-Category</option>
                            @foreach ($LandingPageSubCategoryList as $LandingPageSubCategory)
                                <option value="{{$LandingPageSubCategory}}">
                                    {{$LandingPageSubCategory}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Description:</label><br>
                        <textarea rows="10" cols="60" type="text" class="form-control" required
                            name="updateLandingPage_MstLandingPage_Description" id="textarea_landingPageModalUpdate_description">
                        </textarea>
                    </div>

                    <div class="form-group">
                        <label>Picture:</label><br>
                        <img style="width: 300px; height: 200px;" name="updateLandingPage_MstPicture_Picture" alt=""
                            id="placeholder_landingPageModalUpdate_picture"/><br>
                        File type : JPEG/PNG<br>
                        File name max : 50 char<br>
                        <input type="file" class="form-control" name="updateLandingPage_MstPicture" 
                            id="input_landingPageModalUpdate_picture">
                    </div>
                    <div class="form-group" hidden>
                        <label>Is Update Picture:</label><br>
                        <input type="hidden" class="form-control" name="updateLandingPage_IsUpdatePicture" value="false"
                            id="input_landingPageModalUpdate_isUpdarePicture">
                    </div>
                </div>
                <div class="modal-footer">
                    @if ((property_exists($Role,'IsUpdate')) && ($Role->IsUpdate == True))
                        <button type="submit" class="btn btn-primary"
                            onclick="return confirm('Are you sure want to save this data?')">Save</button>	
                        <button type="button" class="btn btn-warning button_landingPageModalUpdate_closeModal"
                            onclick="return confirm('Are you sure want to cancel?')">Cancel</button>
                    @else	
                        <button type="button" class="btn btn-warning button_landingPageModalUpdate_closeModal">Close</button>
                    @endif		
                </div>
            </form>		
        </div>
    </div>
</div>

<Script>
    $(function() {
        // Update Form
        // Update Modal
        $('.button_landingPageModalUpdate_closeModal').click(function() {
            $('#modal_landingPage_update').modal('hide');
            $('#form_landingPageModalUpdate_update')[0].reset();  
        });      
    
        // Snippet CKEditor
        // Description CKEditor
        CKEDITOR.replace('textarea_landingPageModalUpdate_description')
    });

    // Category Dropdown
    $(document).on('change','#dropdown_landingPageModalUpdate_category',function(){
        var SelectedCategory = $(this).val();
        // console.log(SelectedCategory);
        if(SelectedCategory=="") {
            document.getElementById("div_landingPageModalUpdate_subCategory").setAttribute("hidden", "");
        } else {
            document.getElementById("div_landingPageModalUpdate_subCategory").removeAttribute("hidden");
            $.ajax({
                url:"{{asset('/landing-page/get-sub-category')}}",
                data: {
                    'Category':SelectedCategory,
                    '_token':'{{csrf_token()}}',
                },
                dataType:'JSON', 
                type:'GET',
                success: function (val){
                    // console.log(val);
                    $('[name="updateLandingPage_MstLandingPage_SubCategory"]').val("");
                    $('#dropdown_landingPageModalUpdate_subCategory').empty()
                    $('#dropdown_landingPageModalUpdate_subCategory')
                        .append('<option value="" selected>Silahkan Pilih Sub-Category</option>')
                    val.map(SubCategory=>{
                        $('#dropdown_landingPageModalUpdate_subCategory')
                            .append('<option value="'+SubCategory+'">'+SubCategory+'</option>')
                    })
                },
                error: function(jqXhr, textStatus, errorThrown){
                    console.log(jqXhr);
                    console.log(errorThrown);
                    console.log(textStatus);
                },
            });
        }
    });
    
    // Sub-Category Dropdown
    $(document).on('change','.dropdown_landingPageModalUpdate_categoryAndSubCategory',function(){
        var Id = $('#input_landingPageModalUpdate_id').val();
        var SelectedCategory = $('#dropdown_landingPageModalUpdate_category').val();
        var SelectedSubCategory = $('#dropdown_landingPageModalUpdate_subCategory').val();
        var SelectedFullCategory = SelectedCategory + "/" + SelectedSubCategory;
        // console.log(SelectedFullCategory);
        if ((SelectedSubCategory!="") && (SelectedCategory!="")) {
            $.ajax({
                url:"{{asset('/landing-page/check-category')}}",
                data: {
                    'MstLandingPage_Id':Id,
                    'MstLandingPage_Category':SelectedFullCategory,
                    '_token':'{{csrf_token()}}'
                },
                dataType:'JSON', 
                type:'POST',
                success: function (isNotSameCategory){
                    // console.log(isNotSameCategory);
                    if(!isNotSameCategory) {
                        alert('Category Sudah Diisi!');
                        $('[name="updateLandingPage_MstLandingPage_Category"]').val("");
                        $('[name="updateLandingPage_MstLandingPage_SubCategory"]').val("");
                        document.getElementById("div_landingPageModalUpdate_subCategory").setAttribute("hidden", "");
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

    // Description RequiredValidation
    $("#form_landingPageModalUpdate_update").submit(function(e) {
        var length = CKEDITOR.instances['textarea_landingPageModalUpdate_description'].getData().replace(/<[^>]*>/gi, '').length;
        if(!length) {
            $(".results").html('');
            e.preventDefault();
            alert('Please enter a Description!' );
        }
    });
    
    // Picture Input
    $("#input_landingPageModalUpdate_picture").change(function() {
        readUrlAdd(this);
    });
    function readUrlAdd(input) {
        if (input.files && input.files[0]) {
            var readerPictureAdd = new FileReader();
            
            readerPictureAdd.onload = function(e) {
                $('#placeholder_landingPageModalUpdate_picture').attr('src', e.target.result);
            }
            readerPictureAdd.readAsDataURL(input.files[0]);
        }
    }
    $(document).on('change','#input_landingPageModalUpdate_picture',function(){
        document.getElementById("input_landingPageModalUpdate_isUpdarePicture").setAttribute("required","");
        document.getElementById("input_landingPageModalUpdate_isUpdarePicture").setAttribute("value","true");
    });
</Script>