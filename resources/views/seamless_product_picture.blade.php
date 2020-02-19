@extends('admin.admin') 

@section('acccash', 'active')
@section('acccash-apply', 'active')

@section('content')



<!-- UpdateSeamlessProduct -->
<div class="box box-primary">
    <div class="box-header with-border">
        
        <div class="row">
            <div class="col-sm-8">
                <h3 class="box-title">Update Product Picture</h3>
            </div>
            <div class="col-sm-4">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">
                <a href="{{asset('seamless-product-detail/'.$SeamlessProductPictures->CD_PRODUCT)}}" class="btn btn-block btn-primary">Back</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-header -->
        <div class="box-body">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                    <div class="box-body">
						<div class="row">
							<form id="form-seamless-product-picture" action="{{ asset('/seamless-product-picture/update') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
								
									@csrf	

									<div class="form-group">
										<label class="col-sm-3 control-label">Kode Produk</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="CD_PRODUCT" id="CD_PRODUCT" value="{{$SeamlessProductPictures->CD_PRODUCT}}" readonly>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Description Detail</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="DESC_DETAIL" id="DESC_DETAIL" value="{{$SeamlessProductPictures->DESC_DETAIL}}">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">TNC</label>
										<div class="col-sm-7">
											<input type="checkbox" value="True" id="checkboxtnc_useTextEditor" checked> 
											Use text editor?<br>
											<textarea rows="12" cols="60" type="text" class="form-control" name="TNC" 
												id="TNC">{{$SeamlessProductPictures->TNC}}
											</textarea>
										</div>
									</div>
									<div class="form-group" style="display:none;">
										<label class="col-sm-3 control-label">File Name</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="FILE_NAME" id="FILE_NAME" value="{{$SeamlessProductPictures->FILE_NAME}}" readonly>
										</div>
									</div>
									<div class="form-group" style="display:none;">
										<label class="col-sm-3 control-label">Path File</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="PATH_FILE" id="PATH_FILE" value="{{$SeamlessProductPictures->PATH_FILE}}" readonly>
										</div>
									</div>

									
									<br/>
									<div class="form-group">
										<label class="col-sm-3 control-label">Picture</label><br>
										<div class="col-sm-7">
											<img style="width: 50%; height: 50%;" src="{{$SeamlessProductPictures->URL}}" alt=""
												id="placeholder_updatepicture"/><br>
											File type : JPEG/PNG<br>
											File name max : 50 char<br>
											<input type="file" class="form-control" name="addPicture_seamlessproduct" id="input_update_picture_seamlessproduct">
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-3">

										</div>
										<div class="col-sm-7">
											<button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure want to save this data?')">Save</button>
			
										</div>
												
									</div>
										
								
							</form>
						</div>

                          
                    </div>
                  <!-- </div> -->
        </div>
 </div>

  <!-- page script -->
  <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
  <script>
    $(function() {
      
        CKEDITOR.replace('TNC')
    });

    $("#input_update_picture_seamlessproduct").change(function() {
        readUrlAdd(this);
    });

	 // UseTextEditor Checkbox
	$(document).on('change','#checkboxtnc_useTextEditor',function(){
        if ($('#checkboxtnc_useTextEditor').is(':checked')) {
            CKEDITOR.replace('TNC');
        } else {
            CKEDITOR.instances['TNC'].destroy();
        }
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
	
	
  </script>
@endsection
