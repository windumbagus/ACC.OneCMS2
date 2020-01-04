@extends('admin.admin') 

@section('acccash', 'active')
@section('acccash-apply', 'active')

@section('content')



<!-- UploadSeamlessunitPict -->
<div class="box box-primary">
    <div class="box-header with-border">
        
        <div class="row">
            <div class="col-sm-8">
                <h3 class="box-title">Upload Unit Picture</h3>
            </div>
            <div class="col-sm-4">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">
                <a href="{{asset('seamless-unit-detail/'.$SeamlessUnitPictures->ID_UNIT)}}" class="btn btn-block btn-primary">Back</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-header -->
        <div class="box-body">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                    <div class="box-body">
						<div class="row">
							<form id="form-seamless-unit-picture" action="{{ asset('/seamless-unit-picture/uploadpicture') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
								
									@csrf	

									<div class="form-group">
										<label class="col-sm-3 control-label">GUID</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="GUID" id="GUID" value="{{$SeamlessUnitPictures->GUID}}" readonly>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">ID UNIT</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="ID_UNIT" id="ID_UNIT" value="{{$SeamlessUnitPictures->ID_UNIT}}" readonly>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Code Color</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="CD_COLOR" id="CD_COLOR" value="{{$SeamlessUnitPictures->CD_COLOR}}" readonly>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Desc Color</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="DESC_COLOR" id="DESC_COLOR" value="{{$SeamlessUnitPictures->DESC_COLOR}}" readonly>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Flag Primary</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="FLAG_PRIMARY" id="FLAG_PRIMARY" value="{{$SeamlessUnitPictures->FLAG_PRIMARY}}" readonly>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">File Name</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="FILE_NAME" id="FILE_NAME" value="{{$SeamlessUnitPictures->FILE_NAME}}" readonly>
										</div>
									</div>
									<br/>
									<div class="form-group">
										<label class="col-sm-3 control-label">Picture</label><br>
										<div class="col-sm-7">
											<img style="width: 300px; height: 200px;" src="{{$SeamlessUnitPictures->URL}}" alt=""
												id="placeholder_updatepicture"/><br>
											File type : JPEG/PNG<br>
											File name max : 50 char<br>
											<input type="file" class="form-control" name="addPicture_seamlessunit" id="input_update_picture_seamlessunit" required>
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
  <script>
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
	
	
  </script>
@endsection
