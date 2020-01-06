@extends('admin.admin') 

@section('seamless', 'active')
@section('seamless-unit', 'active')

@section('content')



<!-- UpdateSeamlessbanner -->
<div class="box box-primary">
    <div class="box-header with-border">
        
        <div class="row">
            <div class="col-sm-8">
                <h3 class="box-title">Update Unit</h3>
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
							<form id="form-seamless-unit-update" action="{{ asset('/seamless-unit-update/update') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
									
									@csrf	

									<div class="form-group" style="display:none;">
										<label class="col-sm-3 control-label">GUID</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="GUID" id="GUID" value="{{$SeamlessUnitUpdates->GUID}}">
										</div>
									</div>									
									<div class="form-group">
										<label class="col-sm-3 control-label">Kode Brand</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="KODE_BRAND" id="KODE_BRAND" value="{{$SeamlessUnitUpdates->KODE_BRAND}}">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Deskripsi Brand</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="DESC_BRAND" id="DESC_BRAND" value="{{$SeamlessUnitUpdates->DESC_BRAND}}">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Kode Type</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="KODE_TYPE" id="KODE_TYPE" value="{{$SeamlessUnitUpdates->KODE_TYPE}}">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Deskripsi Type</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="DESC_TYPE" id="DESC_TYPE" value="{{$SeamlessUnitUpdates->DESC_TYPE}}">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Kode Model</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="KODE_MODEL" id="KODE_MODEL" value="{{$SeamlessUnitUpdates->KODE_MODEL}}">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Deskripsi Model</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="DESC_MODEL" id="DESC_MODEL" value="{{$SeamlessUnitUpdates->DESC_MODEL}}">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Tahun</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="TAHUN" id="TAHUN" value="{{$SeamlessUnitUpdates->TAHUN}}">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Type Machine</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="TYPE_MACHINE" id="TYPE_MACHINE" value="{{$SeamlessUnitUpdates->TYPE_MACHINE}}">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Machine Capacity</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="MACHINE_CAPACITY" id="MACHINE_CAPACITY" value="{{$SeamlessUnitUpdates->MACHINE_CAPACITY}}">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Transmission</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="TRANSMISSION" id="TRANSMISSION" value="{{$SeamlessUnitUpdates->TRANSMISSION}}">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Is New/Used</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="FLAG_NEWUSED" id="FLAG_NEWUSED" value="{{$SeamlessUnitUpdates->FLAG_NEWUSED}}">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Deskripsi Product</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="DESC_PRODUCT" id="DESC_PRODUCT" value="{{$SeamlessUnitUpdates->DESC_PRODUCT}}">
										</div>
									</div>
									<div class="form-group" style="display:none;">
										<label class="col-sm-3 control-label">Date Added</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="DT_ADDED" id="DT_ADDED" value="{{$SeamlessUnitUpdates->DT_ADDED}}">
										</div>
									</div>
									<div class="form-group" style="display:none;">
										<label class="col-sm-3 control-label">Id User Added</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="ID_USER_ADDED" id="ID_USER_ADDED" value="{{$SeamlessUnitUpdates->ID_USER_ADDED}}">
										</div>
									</div>
									<div class="form-group" style="display:none;">
										<label class="col-sm-3 control-label">Date Updated</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="DT_UPDATED" id="DT_UPDATED" value="{{$SeamlessUnitUpdates->DT_UPDATED}}">
										</div>
									</div>
									<div class="form-group" style="display:none;">
										<label class="col-sm-3 control-label">Id User Updated</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="ID_USER_UPDATED" id="ID_USER_UPDATED" value="{{$SeamlessUnitUpdates->ID_USER_UPDATED}}">
										</div>
									</div>
									<div class="form-group" style="display:none;">
										<label class="col-sm-3 control-label">Flag Active</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="FLAG_ACTIVE" id="FLAG_ACTIVE" value="{{$SeamlessUnitUpdates->FLAG_ACTIVE}}">
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
