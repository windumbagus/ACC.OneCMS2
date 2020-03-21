@extends('admin.admin') 

@section('seamless', 'active')
@section('seamless-spbrand', 'active')

@section('content')



<!-- CreateSeamlessSpBrand -->
<div class="box box-primary">
    <div class="box-header with-border">
        
        <div class="row">
            <div class="col-sm-8">
                <h3 class="box-title">Create Master Cabang Brand</h3>
            </div>
            <div class="col-sm-4">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">
                <a href="{{asset('seamless-spbrand/')}}" class="btn btn-block btn-primary">Back</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-header -->
        <div class="box-body">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                    <div class="box-body">
						<div class="row">
							<form id="form-seamless-spbrand-create" action="{{ asset('/seamless-spbranf-create/create') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
									
									@csrf	

									<div class="form-group">
										<label class="col-sm-3 control-label">Kode Brand</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="CD_BRAND" id="CD_BRAND" value="">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Kode Cabang</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="CD_SP" id="CD_SP" value="">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Kode Area</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="CD_AREA" id="CD_AREA" value="">
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
  
	
	
  </script>
@endsection
