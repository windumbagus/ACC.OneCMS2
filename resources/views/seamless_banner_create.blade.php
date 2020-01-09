@extends('admin.admin') 

@section('seamless', 'active')
@section('seamless-banner', 'active')

@section('content')



<!-- CreateSeamlessbanner -->
<div class="box box-primary">
    <div class="box-header with-border">
        
        <div class="row">
            <div class="col-sm-8">
                <h3 class="box-title">Create Banner</h3>
            </div>
            <div class="col-sm-4">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">
                <a href="{{asset('seamless-banner/')}}" class="btn btn-block btn-primary">Back</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-header -->
        <div class="box-body">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                    <div class="box-body">
						<div class="row">
							<form id="form-seamless-banner-create" action="{{ asset('/seamless-banner-create/create') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
									
									@csrf	

									<div class="form-group" style="display:none;">
										<label class="col-sm-3 control-label">ID</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="ID" id="ID" value="">
										</div>
									</div>									
									<div class="form-group">
										<label class="col-sm-3 control-label">Kode Product</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="CD_PRODUCT" id="CD_PRODUCT" value="">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Name</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="NAME" id="NAME" value="">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Deskripsi</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="DESCRIPTION" id="DESCRIPTION" value="">
										</div>
									</div>
									<div class="form-group" style="display:none;">
										<label class="col-sm-3 control-label">Date Added</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="DT_ADDED" id="DT_ADDED" value="">
										</div>
									</div>
									<div class="form-group" style="display:none;">
										<label class="col-sm-3 control-label">User Added</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="USER_ADDED" id="USER_ADDED" value="">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Start Date</label>
										<div class=" input-group date col-sm-7">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input type="date" class="form-control" name="START_DATE" id="START_DATE" value="">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">End Date</label>
										<div class=" input-group date col-sm-7">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input type="date" class="form-control" name="END_DATE" id="END_DATE" value="">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Syarat Ketentuan</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="SYARAT_DAN_KETENTUAN" id="SYARAT_DAN_KETENTUAN" value="">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Kode Promo</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="PROMO_CODE" id="PROMO_CODE" value="">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Is Active Promo</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="IS_ACTIVE_PROMO" id="IS_ACTIVE_PROMO" value="">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Jenis Promo</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="JENIS_PROMO" id="JENIS_PROMO" value="">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Periode Promo</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="PERIODE_PROMO" id="PERIODE_PROMO" value="">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Promo Type</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="PROMO_TYPE" id="PROMO_TYPE" value="">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Promo Amount</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="PROMO_AMOUNT" id="PROMO_AMOUNT" value="">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Product Owner</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="PRODUCT_OWNER" id="PRODUCT_OWNER" value="">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Order Name</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="ORDER_NAME" id="ORDER_NAME" value="">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">URL Banner</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="URL_BANNER" id="URL_BANNER" value="">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Is Active Banner</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="IS_ACTIVE_BANNER" id="IS_ACTIVE_BANNER" value="">
										</div>
									</div>
									<div class="form-group" style="display:none;">
										<label class="col-sm-3 control-label">ID File</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="ID_FILE" id="ID_FILE" value="">
										</div>
									</div>
									<div class="form-group" style="display:none;">
										<label class="col-sm-3 control-label">File Name</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="FILE_NAME" id="FILE_NAME" value="">
										</div>
									</div>
									<div class="form-group" style="display:none;">
										<label class="col-sm-3 control-label">Path File</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="PATH_FILE" id="PATH_FILE" value="">
										</div>
									</div>
									
									
									<br/>
									<div class="form-group">
										<label class="col-sm-3 control-label">Picture</label><br>
										<div class="col-sm-7">
											<img style="width: 50%; height: 50%;" src="" alt=""
												id="placeholder_createpicture"/><br>
											File type : JPEG/PNG<br>
											File name max : 50 char<br>
											<input type="file" class="form-control" name="addPicture_seamlessbanner" id="input_create_picture_seamlessbanner">
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
        </div>
 </div>

  <!-- page script -->
  <script>
    $("#input_create_picture_seamlessbanner").change(function() {
        readUrlAdd(this);
    });
    function readUrlAdd(input) {
        if (input.files && input.files[0]) {
            var readerPictureAdd = new FileReader();
            
            readerPictureAdd.onload = function(e) {
                $('#placeholder_createpicture').attr('src', e.target.result);
            }
            readerPictureAdd.readAsDataURL(input.files[0]);
        }
    }
	
	
  </script>
@endsection
