@extends('admin.admin') 

@section('seamless', 'active')
@section('seamless-param', 'active')

@section('content')



<!-- UpdateSeamlessdiskon -->
<div class="box box-primary">
    <div class="box-header with-border">
        
        <div class="row">
            <div class="col-sm-8">
                <h3 class="box-title">Update Master Param Simulation</h3>
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
							<form id="form-seamless-param-update" action="{{ asset('/seamless-param-update/update') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
									
									@csrf	
									<div class="form-group">
										<label class="col-sm-3 control-label">Kode Product</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="CD_PRODUCT" id="CD_PRODUCT" value="{{$SeamlessParamUpdates->CD_PRODUCT}}" readonly>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">DP (%)</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="PERC_DP" id="PERC_DP" value="{{$SeamlessParamUpdates->PERC_DP}}">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Tenor</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="TENOR" id="TENOR" value="{{$SeamlessParamUpdates->TENOR}}">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Type Insurance</label>
										<div class="col-sm-7">
                                            <select id="TYPE_INSU" name="TYPE_INSU">
                                                <option 
                                                @if ($SeamlessParamUpdates->TYPE_INSU == 'A' ) 
                                                selected 
                                                @endif 
                                                value="A"> All Risk</option>

                                                <option 
                                                @if ($SeamlessParamUpdates->TYPE_INSU == 'T' ) 
                                                selected 
                                                @endif 
                                                value="T"> TLO</option>
                                               
                                            </select>
                                        </div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Mode Insurance</label>
										<div class="col-sm-7">
                                            <select id="MODE_INSU" name="MODE_INSU">
                                                <option 
                                                @if ($SeamlessParamUpdates->MODE_INSU == 'C' ) 
                                                selected 
                                                @endif 
                                                value="C"> Cash</option>

                                                <option 
                                                @if ($SeamlessParamUpdates->MODE_INSU == 'K' ) 
                                                selected 
                                                @endif 
                                                value="K"> Kredit</option>
                                               
                                            </select>
                                        
                                        </div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Flag ACP</label>
										<div class="col-sm-7">
											
                                            <select id="FLAG_ACP" name="FLAG_ACP">
                                                <option 
                                                @if ($SeamlessParamUpdates->FLAG_ACP == 'Y' ) 
                                                selected 
                                                @endif 
                                                value="Y"> Yes</option>

                                                <option 
                                                @if ($SeamlessParamUpdates->FLAG_ACP == 'N' ) 
                                                selected 
                                                @endif 
                                                value="N"> No</option>
                                               
                                            </select>
                                        </div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Flag ADDM</label>
										<div class="col-sm-7">
											<select id="FLAG_ADDM" name="FLAG_ADDM">
                                                <option 
                                                @if ($SeamlessParamUpdates->FLAG_ADDM == 'ADDM' ) 
                                                selected 
                                                @endif 
                                                value="ADDM"> ADDM</option>

                                                <option 
                                                @if ($SeamlessParamUpdates->FLAG_ADDM == 'ADDB' ) 
                                                selected 
                                                @endif 
                                                value="ADDB"> ADDB</option>
                                               
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
	
	    // Start-End Datepicker
	$('#datepicker_bannerModalUpdate_StartDate').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        startDate: new Date().getFullYear() + '01-01',
        endDate: (new Date().getFullYear() + 1) + '12-31'
    }).on('changeDate', function(selected){
        startDate = new Date(selected.date.valueOf());
        $('#datepicker_bannerModalUpdate_EndDate').datepicker('setStartDate', startDate);
        if (startDate > $('#datepicker_bannerModalUpdate_EndDate').datepicker('getDate')) {
            $('#datepicker_bannerModalUpdate_EndDate').datepicker('setDate', startDate);
        }
    });

    $('#datepicker_bannerModalUpdate_EndDate').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        startDate: new Date(),
        endDate: (new Date().getFullYear() + 1) + '12-31'
    }).on('changeDate', function(selected){
        EndDate = new Date(selected.date.valueOf());
        $('#datepicker_bannerModalUpdate_StartDate').datepicker('setEndDate', EndDate);
    });
	
  </script>
@endsection
