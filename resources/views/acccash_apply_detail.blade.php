@extends('admin.admin') 

@section('acccash', 'active')
@section('acccash-apply', 'active')

@section('content')

<!-- TableACCCashLog -->
<div class="box box-primary">
    <div class="box-header with-border">
        
        <div class="row">
            <div class="col-sm-8">
                <h3 class="box-title">ACCCash Details</h3>
            </div>
            <div class="col-sm-4">
                <div class="col-sm-6">

                       
                </div>
                <div class="col-sm-6">
                <a href="{{asset('/acccash-apply/'.$Statusapply)}}" class="btn btn-block btn-primary">Back</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-header -->
        <div class="box-body">
              <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        Detail and Approval
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="box-body">
						<div class="row">
							<form id="form-update-accash-apply" action="{{asset('acccash-apply-detail/changestatus') }}" method="post" class="form-horizontal"> 
									<div class="modal-body">
										@csrf
										<div class="col-sm-6">
												<div class="form-group">
													<label class="col-sm-3 control-label">GUID</label>
													<div class="col-sm-7">
														<input type="text" class="form-control" name="GUID" value="{{$AccCashApplys[0]->GUID}}" readonly>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label">No Aggr</label>
													<div class="col-sm-7">
														<input type="text" class="form-control" name="NO_AGGR" value="{{$AccCashApplys[0]->NO_AGGR}}" disabled>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label">Id User</label>
													<div class="col-sm-7">
														<input type="text" class="form-control" name="ID_USER" value="{{$AccCashApplys[0]->ID_USER}}"disabled>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label">Disbursement</label>
													<div class="col-sm-7">
														<input type="text" class="form-control" name="DISBURSEMENT" value="{{$AccCashApplys[0]->DISBURSEMENT}}" disabled>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label">Amt Installment</label>
													<div class="col-sm-7">
														<input type="text" class="form-control" name="AMT_INSTALLMENT" value="{{$AccCashApplys[0]->AMT_INSTALLMENT}}" disabled>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label">Tenor</label>
													<div class="col-sm-7">
														<input type="text" class="form-control" name="TENOR" value="{{$AccCashApplys[0]->TENOR}}" disabled>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label">Tujuan Penggunaan</label>
													<div class="col-sm-7">
														<input type="text" class="form-control" name="TUJUAN_PENGGUNAAN" value="{{$AccCashApplys[0]->TUJUAN_PENGGUNAAN}}" disabled>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label">Penyedia</label>
													<div class="col-sm-7">
														<input type="text" class="form-control" name="PENYEDIA" value="{{$AccCashApplys[0]->PENYEDIA}}" disabled>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label">BTMY</label>
													<div class="col-sm-7">
														<input type="text" class="form-control" name="BTMY" value="{{$AccCashApplys[0]->BTMY}}" readonly>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label">Phone Mobile 1</label>
													<div class="col-sm-7">
														<input type="text" class="form-control" name="PHONE_MOBILE1" value="{{$AccCashApplys[0]->PHONE_MOBILE1}}" disabled>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label">Phone Mobile 2</label>
													<div class="col-sm-7">
														<input type="text" class="form-control" name="PHONE_MOBILE2" value="{{$AccCashApplys[0]->PHONE_MOBILE2}}" disabled>
													</div>
												</div>
										</div>
										<div class="col-sm-6">
												<div class="form-group">
													<label class="col-sm-3 control-label">Area</label>
													<div class="col-sm-7">
														<input type="text" class="form-control" name="AREA" value="{{$AccCashApplys[0]->AREA}}" disabled>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label">Cabang</label>
													<div class="col-sm-7">
														<input type="text" class="form-control" name="CABANG" value="{{$AccCashApplys[0]->CABANG}}" disabled>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label">No Polisi</label>
													<div class="col-sm-7">
														<input type="text" class="form-control" name="NO_CAR_POLICE" value="{{$AccCashApplys[0]->NO_CAR_POLICE}}" disabled>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label">Pefindo Score</label>
													<div class="col-sm-7">
														<input type="text" class="form-control" name="PEFINDO_SCORE" value="{{$AccCashApplys[0]->PEFINDO_SCORE}}" disabled>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label">Pefindo Detail</label>
													<div class="col-sm-7">
														<input type="text" class="form-control" name="PEFINDO_DETAIL" value="{{$AccCashApplys[0]->PEFINDO_DETAIL}}" disabled>
													</div>
												</div>
												<div class="form-group">
													<div class="col-sm-6">
														@if(!empty($AccCashApplyPictures[0]->PATH_FILE))
														<a href="{{$AccCashApplyPictures[0]->PATH_FILE}}">
															<img style="width: 50%; height: 50%;" alt="" src="{{$AccCashApplyPictures[0]->PATH_FILE}}" class="center"/>
														</a>
														@endif
													</div>
													
													<div class="col-sm-6">
														@if(!empty($AccCashApplyPictures[1]->PATH_FILE))
														<a href="{{$AccCashApplyPictures[0]->PATH_FILE}}">
															<img style="width: 50%; height: 50%;" alt="" src="{{$AccCashApplyPictures[1]->PATH_FILE}}" class="center"/>
														</a>
														@endif
													</div>
												</div>
												@if ($Statusapply == "PENDING")
												<div class="form-group">
													<label class="col-sm-3 control-label">Status</label>
													
													<div class="col-sm-7">
														<select class="form-control select2" id="STATUS" name="STATUS" style="width:100%;">
															<option value="PENDING" selected>PENDING</option>
															<option value="APPROVED" >APPROVED</option>
															<option value="REJECT ALL" >REJECT ALL</option>
															<option value="REJECT PARTIAL" >REJECT PARTIAL</option>
														</select>
													</div>
												</div>   
											
												<div class="form-group" id="REASONREJECTALLCHOICE">
													<label class="col-sm-3 control-label">Reason Reject</label>
													<div class="col-sm-7">
														<select class="form-control select3" id="REASONREJECTALL" name="REASONREJECTALL" style="width:100%;">
															<option value="REJECT-NOTAPPLY" selected>Customer tidak merasa mengajukan</option>
															<option value="REJECT-UNCONTACTED" >Customer tidak dapat dihubungi dalam waktu 3x24 jam</option>
															<option value="REJECT-WRONGUNIT" >Spesifikasi mobil pada foto tidak sesuai dengan data pada AOL</option>
															<option value="REJECT-UNIT">Kondisi mobil tidak layak untuk dibiayai</option>
														</select>
													</div>
												</div>

												<div class="form-group" id="REASONREJECTPARTIALCHOICE">
													<label class="col-sm-3 control-label">Reason Reject</label>
													<div class="col-sm-7">
														<select class="form-control select3" id="REASONREJECTPARTIAL" name="REASONREJECTPARTIAL" style="width:100%;">
															<option value="REJECT-DATA" >Customer ingin mengubah data pengajuan</option>
															<option value="REJECT-PICT" >Foto mobil tidak sesuai dengan petunjuk</option>
														</select>
													</div>
												</div>

												<div class="form-group" id="REASONPENDINGCHOICE">
													<label class="col-sm-3 control-label">Reason Pending</label>
													<div class="col-sm-7">
														<select class="form-control select3" id="REASONPENDING" name="REASONPENDING" style="width:100%;">
															<option value="PENDING-UNCONTACTED" >Customer tidak dapat dihubungi</option>
															<option value="PENDING-NEXTTIME" >Customer minta dihubungi pada waktu lain</option>
														</select>
													</div>
												</div>

												<div class="form-group" id="REASONAPPROVEDCHOICE">
												
												</div>

												<div class="form-group">
												
												</div>

												<div class="form-group">
													<div class="col-sm-3">

													</div>
													<div class="col-sm-7">
														<button type="submit" class="btn btn-primary" style="width:50%">Verify</button>	
													</div>
												
												</div>
												@else

												<div class="form-group">
													<label class="col-sm-3 control-label">Status</label>
											
													<div class="col-sm-7">
														<input type="text" class="form-control" name="STATUS" value="{{$AccCashApplys[0]->STATUS}}"readonly>
													</div>
												</div>   
												<div class="form-group">
													<label class="col-sm-3 control-label">Reason</label>
													<div class="col-sm-7">
														<input type="text" class="form-control" name="REASON" value="{{$AccCashApplys[0]->REASON}}"readonly>
													</div>
												</div>
												@endif

										</div>

									</div>
									<div class="modal-footer">
									   
						
									</div>	
							</form>

						</div>

                          
                    </div>
                  </div>
                </div>
                <div class="panel box box-success">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                        Activity Log
                      </a>
                    </h4>
                  </div>
                  <div id="collapseTwo" class="panel-collapse collapse">
					<div class="box-body">
                        <div class="row">
							<div class="col-sm-8">
								<input type="text" placeholder="Search by Status or Date Added" class="InputSearch form-control">
							</div>
							<div class="col-sm-3">
								<div class="col-sm-6">
									<a href="#" class="ButtonSearch btn btn-block btn-info">Search</a>    
								</div>
								<div class="col-sm-6">
									<a href="#" class="ResetSearch btn btn-block btn-info">Reset</a>    
								</div>
							</div>
						</div><br>
						<div class="row">
							<div class="col-sm-6">
						   

							</div>
							<div class="col-sm-6">
							
							</div>
                        </div>
                        <div class="row"> 
                            <table id="exampledetail" class="table table-bordered display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Date Added</th>       
                                    </tr>
                                </thead>
                                <tbody>
                                
                                    @foreach ($AccCashApplyDetails as $AccCashApplyDetails)
                                    <tr>  
                                        <td><span>{{$AccCashApplyDetails->STATUS}}</span></td>
										<td><span>{{date('d/m/Y H:i:s', strtotime($AccCashApplyDetails->DT_ADDED))}}</span></td>              
                                    </tr>                              
                                    @endforeach       
                                </tbody>
                            </table>
                        </div>
					</div>
                </div>
                
                
              </div>
        </div>
 </div>

  <!-- page script -->
  <script>
    $(document).ready(function () {
        $('#REASONREJECTALLCHOICE').hide();
        $('#REASONREJECTPARTIALCHOICE').hide();
        $('#REASONPENDINGCHOICE').show();
        $('#REASONAPPROVEDCHOICE').hide();

        $('#exampledetail').DataTable({
          'deferRender': true,
          'paging'      : true,
          'lengthChange': false,
          'searching'   : true,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : true,
          'scrollX': true,
          sDom: 'lrtip', 
          "columns": [
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

        //DROPDOWN STATUS
        $('#STATUS').on('change',function(){
        
            switch($('#STATUS').val()) {
                case "REJECT ALL":
                    $('#REASONREJECTALLCHOICE').show()
                    $('#REASONREJECTPARTIALCHOICE').hide()
                    $('#REASONPENDINGCHOICE').hide()
                    $('#REASONAPPROVEDCHOICE').hide()

                    break;

                case "REJECT PARTIAL":
                    $('#REASONREJECTALLCHOICE').hide()
                    $('#REASONREJECTPARTIALCHOICE').show()
                    $('#REASONPENDINGCHOICE').hide()
                    $('#REASONAPPROVEDCHOICE').hide()

                    break;

                case "PENDING":
                    $('#REASONREJECTALLCHOICE').hide()
                    $('#REASONREJECTPARTIALCHOICE').hide()
                    $('#REASONPENDINGCHOICE').show()
                    $('#REASONAPPROVEDCHOICE').hide()

                    break;

                case "APPROVED":
                    $('#REASONREJECTALLCHOICE').hide()
                    $('#REASONREJECTPARTIALCHOICE').hide()
                    $('#REASONPENDINGCHOICE').hide()
                    $('#REASONAPPROVEDCHOICE').show()

                    break;

                default:
                    $('#REASONREJECTALLCHOICE').hide()
                    $('#REASONREJECTPARTIALCHOICE').hide()
                    $('#REASONPENDINGCHOICE').show()
                    $('#REASONAPPROVEDCHOICE').hide()

                    break;
                }

        // console.log(reasonstatus);

        });

    })
  </script>
@endsection
