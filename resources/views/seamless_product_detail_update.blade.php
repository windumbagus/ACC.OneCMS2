@extends('admin.admin') 

@section('seamless', 'active')
@section('seamless-product', 'active')

@section('content')



<!-- UpdateSeamlessProduct -->
<div class="box box-primary">
    <div class="box-header with-border">
        
        <div class="row">
            <div class="col-sm-8">
                <h3 class="box-title">Update Product Detail</h3>
            </div>
            <div class="col-sm-4">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">
                <a href="{{asset('seamless-product-detail/'.$SeamlessProducts->CD_PRODUCT)}}" class="btn btn-block btn-primary">Back</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-header -->
        <div class="box-body">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                    <div class="box-body">
						<div class="row">
							<form id="form-seamless-product-detail-update" action="{{ asset('/seamless-product-detail-update/update') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
								
									@csrf	

									<div class="form-group">
										<label class="col-sm-3 control-label">Product Code</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="CD_PRODUCT" id="CD_PRODUCT" value="{{$SeamlessProducts->CD_PRODUCT}}" readonly>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Product Name</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="DESC_PRODUCT" id="DESC_PRODUCT" value="{{$SeamlessProducts->DESC_PRODUCT}}" readonly>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Start Date</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="DT_START" id="DT_START" value="{{$SeamlessProducts->DT_START}}">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">End Date</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="DT_END" id="DT_END" value="{{$SeamlessProducts->DT_END}}">
										</div>
									</div>
									<div class="form-group" style="display:none;">
										<label class="col-sm-3 control-label">Is Active</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="FLAG_ACTIVE" id="FLAG_ACTIVE" value="{{$SeamlessProducts->FLAG_ACTIVE}}" readonly>
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
    $("#input_update_picture_seamlessproduct").change(function() {
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
