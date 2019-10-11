<div class="modal fade" id="modal_landingPage_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" 
    aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close button_landingPageModalAdd_closeModal" data-dismiss="modal" aria-label="Close"
                    onclick="return confirm('Are you sure want to cancel?')">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="box-title">Create New Landing Page</h4> 
            </div>
            <form id="form_landingPageModalAdd_add" action="{{asset('landing-page/add')}}" method="post" 
                enctype="multipart/form-data">
                <div class="modal-body"> 
                    @csrf

                    <div class="form-group">
                        <label>Category:</label>
                        <select class="form-control select2 dropdown_landingPageModalAdd_categoryAndSubCategory"
                            name="addLandingPage_MstLandingPage_Category" id='dropdown_landingPageModalAdd_category'
                            style="width:100%;" required>
                            <option selected value="">Silahkan Pilih Category</option>
                            @foreach ($LandingPageCategoryList as $LandingPageCategory)
                                <option value="{{$LandingPageCategory}}">
                                    {{$LandingPageCategory}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group" id="div_landingPageModalAdd_subCategory" 
                        hidden>
                        <label>Sub Category:</label>
                        <select class="form-control select2 dropdown_landingPageModalAdd_categoryAndSubCategory"
                            name="addLandingPage_MstLandingPage_SubCategory" id='dropdown_landingPageModalAdd_subCategory'
                            style="width:100%;" required>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Description:</label><br>
                        <textarea rows="10" cols="60" type="text" class="form-control" required
                            name="addLandingPage_MstLandingPage_Description" id="textarea_landingPageModalAdd_description">
                        </textarea>
                    </div>

                    <div class="form-group">
                        <label>Picture:</label><br>
                        <img style="width: 300px; height: 200px;" name="addLandingPage_MstPicture_Picture" alt=""
                            id="placeholder_landingPageModalAdd_picture"/><br>
                        File type : JPEG/PNG<br>
                        File name max : 50 char<br>
                        <input type="file" class="form-control" name="addLandingPage_MstPicture" 
                            id="input_landingPageModalAdd_picture" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"
                        onclick="return confirm('Are you sure want to save this data?')">Save</button>	
                    <button type="button" class="btn btn-warning button_landingPageModalAdd_closeModal"
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
        $('.button_landingPageModalAdd_closeModal').click(function() {
            $('#modal_landingPage_add').modal('hide');
            $('#form_landingPageModalAdd_add')[0].reset();  
        });      
    
        // Snippet CKEditor
        // Description CKEditor
        CKEDITOR.replace('textarea_landingPageModalAdd_description')
    });

    // Category Dropdown
    $(document).on('change','#dropdown_landingPageModalAdd_category',function(){
        var SelectedCategory = $(this).val();
        // console.log(SelectedCategory);
        if(SelectedCategory=="") {
            document.getElementById("div_landingPageModalAdd_subCategory").setAttribute("hidden", "");
        } else {
            document.getElementById("div_landingPageModalAdd_subCategory").removeAttribute("hidden");
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
                    $('[name="addLandingPage_MstLandingPage_SubCategory"]').val("");
                    $('#dropdown_landingPageModalAdd_subCategory').empty();
                    $('#dropdown_landingPageModalAdd_subCategory')
                        .append('<option value="" selected>Silahkan Pilih Sub-Category</option>');
                    val.map(SubCategory=>{
                        $('#dropdown_landingPageModalAdd_subCategory')
                            .append('<option value="'+SubCategory+'">'+SubCategory+'</option>');
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
    $(document).on('change','.dropdown_landingPageModalAdd_categoryAndSubCategory',function(){
        var SelectedCategory = $('#dropdown_landingPageModalAdd_category').val();
        var SelectedSubCategory = $('#dropdown_landingPageModalAdd_subCategory').val();
        var SelectedFullCategory = SelectedCategory + "/" + SelectedSubCategory;
        // console.log(SelectedFullCategory);
        if ((SelectedSubCategory!="") && (SelectedCategory!="")) {
            $.ajax({
                url:"{{asset('/landing-page/check-category')}}",
                data: {
                    'MstLandingPage_Id':0,
                    'MstLandingPage_Category':SelectedFullCategory,
                    '_token':'{{csrf_token()}}'
                },
                dataType:'JSON', 
                type:'POST',
                success: function (isNotSameCategory){
                    // console.log(isNotSameCategory);
                    if(!isNotSameCategory) {
                        alert('Category Sudah Diisi!');
                        $('[name="addLandingPage_MstLandingPage_Category"]').val("");
                        $('[name="addLandingPage_MstLandingPage_SubCategory"]').val("");
                        document.getElementById("div_landingPageModalAdd_subCategory").setAttribute("hidden", "");
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
    $("#form_landingPageModalAdd_add").submit(function(e) {
        var length = CKEDITOR.instances['textarea_landingPageModalAdd_description'].getData().replace(/<[^>]*>/gi, '').length;
        if(!length) {
            $(".results").html('');
            e.preventDefault();
            alert('Please enter a Description!' );
        }
    });
    
    // Picture Input
    $("#input_landingPageModalAdd_picture").change(function() {
        readUrlAdd(this);
    });
    function readUrlAdd(input) {
        if (input.files && input.files[0]) {
            var readerPictureAdd = new FileReader();
            
            readerPictureAdd.onload = function(e) {
                $('#placeholder_landingPageModalAdd_picture').attr('src', e.target.result);
            }
            readerPictureAdd.readAsDataURL(input.files[0]);
        }
    }
</Script>