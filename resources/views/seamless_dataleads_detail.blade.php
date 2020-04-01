@extends('admin.admin') 

@section('seamless', 'active')
@section('seamless-dataleads', 'active')

@section('content')



<!-- TableSeamlessLeadsTracking -->
<div class="box box-primary">
    <div class="box-header with-border">
        
        <div class="row">
            <div class="col-sm-8">
                <h3 class="box-title">Data Leads Tracking {{$leadsid}}</h3>
            </div>
            <div class="col-sm-4">
                <div class="col-sm-6">

                       
                </div>
                <div class="col-sm-6">
                <a href="{{asset('/seamless-dataleads')}}" class="btn btn-block btn-primary">Back</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-header -->
        <div class="box-body">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                <div class="panel box">
					<div class="box-header">
						<h4 class="box-title">
							Description
						</h4>
					</div>
 
					<div class="box-body">
						<div class="row">
							<form id="form-update-accash-apply" action="" method="post" class="form-horizontal"> 
									
										@csrf
								
												<div class="form-group">
													<label class="col-sm-3 control-label">Nama Customer</label>
													<div class="col-sm-7">
														<input type="text" class="form-control" name="NAME_CUSTOMER" value="{{$SeamlessDataLeadsDetail[0]->MainData[0]->NAME_CUSTOMER}}" readonly>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label">Unit</label>
													<div class="col-sm-7">
														<input type="text" class="form-control" name="UNIT" value="{{$SeamlessDataLeadsDetail[0]->MainData[0]->UNIT}}" readonly>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label">Tgl Pengajuan</label>
													<div class="col-sm-7">
														<input type="text" class="form-control" name="TANGGAL_PENGAJUAN" value="{{$SeamlessDataLeadsDetail[0]->MainData[0]->TANGGAL_PENGAJUAN}}"readonly>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label">Status Terakhir</label>
													<div class="col-sm-7">
														<input type="text" class="form-control" name="MAX_STATUS_APLIKASI" value="{{$SeamlessDataLeadsDetail[0]->MainData[0]->MAX_STATUS_APLIKASI}}"readonly>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label">Tenor</label>
													<div class="col-sm-7">
														<input type="text" class="form-control" name="TENOR" value="{{$SeamlessDataLeadsDetail[0]->MainData[0]->TENOR}}" readonly>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label">Nominal</label>
													<div class="col-sm-7">
														<input type="text" class="form-control" name="DISBURSEMENT" value="{{$SeamlessDataLeadsDetail[0]->MainData[0]->DISBURSEMENT}}" readonly>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label">Angsuran</label>
													<div class="col-sm-7">
														<input type="text" class="form-control" name="AMT_INSTALLMENT" value="{{$SeamlessDataLeadsDetail[0]->MainData[0]->AMT_INSTALLMENT}}" readonly>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label">Tujuan</label>
													<div class="col-sm-7">
														<input type="text" class="form-control" name="TUJUAN" value="{{$SeamlessDataLeadsDetail[0]->MainData[0]->TUJUAN}}" readonly>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label">Penyedia</label>
													<div class="col-sm-7">
														<input type="text" class="form-control" name="PENYEDIA" value="{{$SeamlessDataLeadsDetail[0]->MainData[0]->PENYEDIA}}" readonly>
													</div>
												</div>
							</form>

						</div>

							
					</div>
                  <!-- </div> -->
                </div>
                <div class="panel box">
                  <div class="box-header">
                    <h4 class="box-title">
                    Tracking
                    </h4>
                  </div>
                  <!-- <div id="collapseTwo" class="panel-collapse collapse"> -->
					<div class="box-body">
              
                        <div class="row"> 
                            <table id="exampledetail" class="table table-bordered display nowrap" style="width:100%">
                                <thead>
                                    <tr>
										<th>No</th>
										<th>Deskripsi</th>
            							<th>Tanggal</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                    @foreach ($SeamlessDataLeadsDetail[0]->DataDetail as $SeamlessDataLeadsDetail)
                                    <tr>    
										<td><span>{{$SeamlessDataLeadsDetail->NO_SR_GCM}}</span></td>
										<td><span>{{$SeamlessDataLeadsDetail->DESC_GCM}}</span></td>
										<td><span>{{$SeamlessDataLeadsDetail->TANGGAL_PENGAJUAN}}</span></td>
										<td><span>
										@if($SeamlessDataLeadsDetail->STATUS_APLIKASI != null && $SeamlessDataLeadsDetail->STATUS_APLIKASI != '')
										<i class="fa fa-check-square"></i>
										@endif
										</span></td>
                                    </tr>                              
                                    @endforeach       
                                </tbody>
                            </table>
                        </div>
					</div>
                </div>
                
                

        </div>
 </div>

  <!-- page script -->
  <script>


	$(document).ready(function () {
        

        $('#exampledetail').DataTable({
          'deferRender': true,
          'paging'      : true,
          'lengthChange': false,
          'searching'   : true,
		  'order': [[ 0, "asc" ]],
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : true,
          'scrollX': true,
          sDom: 'lrtip', 
          "columns": [
			  	null,
                null,
                null,
				null,
                
            ]
        })



        //Button Search
        $('.ButtonSearch').on('click', function(){
            var searchData = $('.InputSearch').val()
            var dtable = $('#exampledetail').DataTable()
            dtable.search(searchData).draw()
        })

    
        $('.ResetSearch').on('click',function(){
            var tab = $('#exampledetail').DataTable()
            tab.search('').draw()
            $('.InputSearch').val('')
        })
	
    })



	// Get the modal image
	
  </script>
@endsection
