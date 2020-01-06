@extends('admin.admin') 

@section('seamless', 'active')
@section('seamless-unit-detail', 'active')

@section('content')



<!-- UpdateSeamlessbanner -->
<div class="box box-primary">
    <div class="box-header with-border">
        
        <div class="row">
            <div class="col-sm-8">
                <h3 class="box-title">Update Unit Detail</h3>
            </div>
            <div class="col-sm-4">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">
                <a href="{{asset('seamless-unit/')}}" class="btn btn-block btn-primary">Back</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-header -->
        <div class="box-body">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                    <div class="box-body">
						<div class="row">
							<form id="form-seamless-unit-update" action="{{ asset('/seamless-unit-detail-update/update') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
									
									@csrf	

									<div class="form-group" style="display:none;">
										<label class="col-sm-3 control-label">ID UNIT</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="ID_UNIT" id="ID_UNIT" value="{{$SeamlessUnitDetailUpdates->ID_UNIT}}">
										</div>
									</div>			
									<div class="form-group" style="display:none;">
										<label class="col-sm-3 control-label">GUID</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="GUID" id="GUID" value="{{$SeamlessUnitDetailUpdates->GUID}}">
										</div>
									</div>								
									<div class="form-group">
										<label class="col-sm-3 control-label">Kategori</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="CATEGORY" id="CATEGORY" value="{{$SeamlessUnitDetailUpdates->CATEGORY}}">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Char Value</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="CHAR_VALUE" id="CHAR_VALUE" value="{{$SeamlessUnitDetailUpdates->CHAR_VALUE}}">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Char Description</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="CHAR_DESC" id="CHAR_DESC" value="{{$SeamlessUnitDetailUpdates->CHAR_DESC}}">
										</div>
									</div>
									
									<br/>
									
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
        </div>
 </div>

  <!-- page script -->
  <script>
    $("#input_update_picture_seamlessbanner").change(function() {
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
