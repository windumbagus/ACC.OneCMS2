@extends('admin.admin') 

@section('acccash', 'active')
@section('acccash-apply', 'active')

@section('content')

{{-- css image --}}
<style>
	
	body {font-family: Arial, Helvetica, sans-serif;}
	
	#myImg, #myImg2 {
	  border-radius: 5px;
	  cursor: pointer;
	  transition: 0.3s;
	}
	
	#myImg, #myImg2:hover {opacity: 0.7;}
	
	/* The Modal (background) */
	.modal {
	  display: none; /* Hidden by default */
	  position: fixed; /* Stay in place */
	  z-index: 1; /* Sit on top */
	  padding-top: 100px; /* Location of the box */
	  left: 22%;
	  top: 0;
	  width: 80%; /* Full width */
	  height: 100%; /* Full height */
	  overflow: auto; /* Enable scroll if needed */
	  background-color: rgb(0,0,0); /* Fallback color */
	  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
	}
	
	/* Modal Content (image) */
	.modal-content {
	  margin: auto;
	  display: block;
	  width: 80%;
	  max-width: 700px;
	}
	
	/* Caption of Modal Image */
	#caption {
	  margin: auto;
	  display: block;
	  width: 80%;
	  max-width: 700px;
	  text-align: center;
	  color: #ccc;
	  padding: 10px 0;
	  height: 150px;
	}
	
	/* Add Animation */
	.modal-content, #caption {  
	  -webkit-animation-name: zoom;
	  -webkit-animation-duration: 0.6s;
	  animation-name: zoom;
	  animation-duration: 0.6s;
	}
	
	@-webkit-keyframes zoom {
	  from {-webkit-transform:scale(0)} 
	  to {-webkit-transform:scale(1)}
	}
	
	@keyframes zoom {
	  from {transform:scale(0)} 
	  to {transform:scale(1)}
	}
	
	/* The Close Button */
	.close {
	  position: absolute;
	  top: 15px;
	  right: 35px;
	  color: #f1f1f1;
	  font-size: 40px;
	  font-weight: bold;
	  transition: 0.3s;
	}
	
	.close:hover,
	.close:focus {
	  color: #bbb;
	  text-decoration: none;
	  cursor: pointer;
	}
	
	/* 100% Image Width on Smaller Screens */
	@media only screen and (max-width: 700px){
	  .modal-content {
		width: 100%;
	  }
	}
	</style>

<!-- TableACCCashLog -->
<div class="box box-primary">
    <div class="box-header with-border">
        
        <div class="row">
            <div class="col-sm-8">
                <h3 class="box-title">acccash Details</h3>
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
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                <div class="panel box">
                  <div class="box-header">
					<div class="col-sm-10">
						<h4 class="box-title">
                        	Detail and Approval
						</h4>
					</div>
					<div class="col-sm-2">
						<a href="{{asset('/acccash-apply-detail/cetakPDF/'.$AccCashApplys[0]->GUID.'&'.$Statusapply) }}" class="btn btn-block btn-primary">Download PDF</a>    
					</div>

                  </div>
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
													<label class="col-sm-3 control-label">No Kontrak Induk</label>
													<div class="col-sm-7">
														<input type="text" class="form-control" name="NO_AGGR" value="{{$AccCashApplys[0]->NO_AGGR}}" readonly>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label">Email</label>
													<div class="col-sm-7">
														<input type="text" class="form-control" name="EMAIL" value="{{$AccCashApplys[0]->ID_USER}}"readonly>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label">Nominal</label>
													<div class="col-sm-7">
														<input type="text" class="form-control" name="DISBURSEMENT" value="{{$AccCashApplys[0]->DISBURSEMENT}}" readonly>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label">Angsuran</label>
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
													<label class="col-sm-3 control-label">No Handphone 1</label>
													<div class="col-sm-7">
														<input type="text" class="form-control" name="PHONE_MOBILE1" value="{{$AccCashApplys[0]->PHONE_MOBILE1}}" disabled>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label">No Handphone 2</label>
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
													<label class="col-sm-3 control-label">Skor Pefindo</label>
													<div class="col-sm-7">
														<input type="text" class="form-control" name="PEFINDO_SCORE" value="{{$AccCashApplys[0]->PEFINDO_SCORE}}" disabled>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label">Detail Pefindo</label>
													<div class="col-sm-7">
														<input type="text" class="form-control" name="PEFINDO_DETAIL" value="{{$AccCashApplys[0]->PEFINDO_DETAIL}}" disabled>
													</div>
												</div>
												<div class="form-group">
													<div class="col-sm-6">
														@if(!empty($AccCashApplyPictures[0]->PATH_FILE))
															<img id="myImg" style="width: 50%; height: 50%;" alt="" src="{{$AccCashApplyPictures[0]->PATH_FILE}}" class="center"/>
														@endif
													</div>
													
													<div class="col-sm-6">
														@if(!empty($AccCashApplyPictures[1]->PATH_FILE))
															<img id="myImg2" style="width: 50%; height: 50%;" alt="" src="{{$AccCashApplyPictures[1]->PATH_FILE}}" class="center"/>
														@endif
													</div>

													<!-- The Modal image-->
													<div id="myModal" class="modal">
														<span class="close">&times;</span>
														<img class="modal-content" id="img01">
														<div id="caption"></div>
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
														<button type="submit" class="btn btn-primary" onclick="return confirm('Apakah yakin ingin mengubah status pengajuan?')" style="width:50%">Verify</button>	
			
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
                  <!-- </div> -->
                </div>
                <div class="panel box">
                  <div class="box-header">
                    <h4 class="box-title">
                      
                        Activity Log
                     
                    </h4>
                  </div>
                  <!-- <div id="collapseTwo" class="panel-collapse collapse"> -->
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

	// Get the modal image
	var modal = document.getElementById("myModal");

	// Get the image and insert it inside the modal - use its "alt" text as a caption
	var img = document.getElementById("myImg");
	var modalImg = document.getElementById("img01");
	var captionText = document.getElementById("caption");
	img.onclick = function(){
	modal.style.display = "block";
	modalImg.src = this.src;
	captionText.innerHTML = this.alt;
	}

	// Get the image and insert it inside the modal - use its "alt" text as a caption
	var img2 = document.getElementById("myImg2");
	var modalImg2 = document.getElementById("img01");
	var captionText2 = document.getElementById("caption");
	img2.onclick = function(){
	modal.style.display = "block";
	modalImg2.src = this.src;
	captionText2.innerHTML = this.alt;
	}

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];

	// When the user clicks on <span> (x), close the modal
	span.onclick = function() { 
	modal.style.display = "none";
	}

  </script>
@endsection
