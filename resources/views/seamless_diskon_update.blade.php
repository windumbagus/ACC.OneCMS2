@extends('admin.admin') 

@section('seamless', 'active')
@section('seamless-diskon', 'active')

@section('content')



<!-- UpdateSeamlessdiskon -->
<div class="box box-primary">
    <div class="box-header with-border">
        
        <div class="row">
            <div class="col-sm-8">
                <h3 class="box-title">Update Discount</h3>
            </div>
            <div class="col-sm-4">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">
                <a href="{{asset('seamless-diskon/')}}" class="btn btn-block btn-primary">Back</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-header -->
        <div class="box-body">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                    <div class="box-body">
						<div class="row">
							<form id="form-seamless-diskon-update" action="{{ asset('/seamless-diskon-update/update') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
									
									@csrf	
									<div class="form-group">
										<label class="col-sm-3 control-label">GUID</label>
										<div class="col-sm-4">
											<input type="text" class="form-control" name="GUID" id="GUID" value="{{$SeamlessDiskonUpdates->GUID}}" readonly>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">ID Unit</label>
										<div class="col-sm-4">
											<input type="text" class="form-control" name="ID_UNIT" id="ID_UNIT" value="{{$SeamlessDiskonUpdates->ID_UNIT}}" readonly>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Discount</label>
										<div class="col-sm-4">
											<input type="text" class="form-control" name="DISCOUNT" id="DISCOUNT" value="{{$SeamlessDiskonUpdates->DISCOUNT}}">
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
