@extends('admin.admin') 

@section('seamless', 'active')
@section('seamless-param', 'active')

@section('content')



<!-- CreateSeamlessparam -->
<div class="box box-primary">
    <div class="box-header with-border">
        
        <div class="row">
            <div class="col-sm-8">
                <h3 class="box-title">Create Master Param Simulation</h3>
            </div>
            <div class="col-sm-4">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">
                <a href="{{asset('seamless-param/')}}" class="btn btn-block btn-primary">Back</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-header -->
        <div class="box-body">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                    <div class="box-body">
						<div class="row">
							<form id="form-seamless-param-create" action="{{ asset('/seamless-param-create/create') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
									
									@csrf	

									<div class="form-group">
										<label class="col-sm-3 control-label">Kode Product</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="CD_PRODUCT" id="CD_PRODUCT" value="">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">DP (%)</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="PERC_DP" id="PERC_DP" value="">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Tenor</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="TENOR" id="TENOR" value="">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Type Insurance</label>
										<div class="col-sm-7">
                                            <select id="TYPE_INSU" name="TYPE_INSU">
                                                <option value="A"> All Risk</option>
                                                <option value="T"> TLO</option>
                                               
                                            </select>
                                        </div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Mode Insurance</label>
										<div class="col-sm-7">
                                            <select id="MODE_INSU" name="MODE_INSU">
                                                <option value="C"> Cash</option>
                                                <option value="K"> Kredit</option>
                                               
                                            </select>
                                        
                                        </div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Flag ACP</label>
										<div class="col-sm-7">
											
                                            <select id="FLAG_ACP" name="FLAG_ACP">
                                                <option value="Y"> Yes</option>
                                                <option value="N"> No</option>
                                               
                                            </select>
                                        </div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Flag ADDM</label>
										<div class="col-sm-7">
											<select id="FLAG_ADDM" name="FLAG_ADDM">
                                                <option value="ADDM"> ADDM</option>
                                                <option value="ADDB"> ADDB</option>
                                               
                                            </select>
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
