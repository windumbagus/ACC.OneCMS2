@extends('admin.admin') 

@section('seamless', 'active')
@section('seamless-unit-detail', 'active')

@section('content')

<style>
	
	body {font-family: Arial, Helvetica, sans-serif;}
	
	#myImg {
	  border-radius: 5px;
	  cursor: pointer;
	  transition: 0.3s;
	}
	
	#myImg :hover {opacity: 0.7;}
	
	/* The Modal (background) */
	.modal {
	  display: none; /* Hidden by default */
	  position: fixed; /* Stay in place */
	  z-index: 1; /* Sit on top */
	  padding-top: 120px; /* Location of the box */
	  left: 0%;
	  top: 0;
	  width: 100%; /* Full width */
	  height: 100%; /* Full height */
	  overflow: auto; /* Enable scroll if needed */
	  background-color: rgb(0,0,0); /* Fallback color */
	  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
	}
	
	/* Modal Content (image) */
	.modal-content {
	  margin: auto;
	  display: block;
	  width: 100%;
	  max-width: 700px;
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
	  position: fixed;
	  top: 55px;
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

<!-- TableSeamlessUnitDetail -->

          <div class="box box-solid">
            <div class="box-header with-border">
                <div class="col-sm-8">
                    <h3 class="box-title">Unit Details</h3>
                </div>
                <div class="col-sm-4">
                    <div class="col-sm-6">
                            
                    </div>
                    <div class="col-sm-6">
                            <a href="{{asset('seamless-unit') }}" class="btn btn-block btn-primary">Back</a>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                <div class="panel box box-danger">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        Simulasi
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="box-body">
                      <table style="width:50%">        
                            <tr>
                                <th>Tenor</th>
                                <td> <span>@if( !empty($SeamlessUnitSims[0]->tenor))
                                    {{$SeamlessUnitSims[0]->tenor}} 
                                    @else
                                    tidak ditemukan
                                    @endif
                                </span></td>
                            </tr>
                            <tr>
                                <th>Amount Installment</th>
                                <td><span> @if( !empty($SeamlessUnitSims[0]->amt_installment))
                                    {{$SeamlessUnitSims[0]->amt_installment}} 
                                    @else
                                    tidak ditemukan
                                    @endif
                                </span></td>
                            </tr>
                            <tr>
                                <th>Total Pay First</th>
                                <td><span> @if( !empty($SeamlessUnitSims[0]->tot_pay_first))
                                    {{$SeamlessUnitSims[0]->tot_pay_first}} 
                                    @else
                                    tidak ditemukan
                                    @endif
                                </span></td>
                            </tr>

                          </table>
                          <br/>
                          <br/>
                          <div class="col-sm-2">
                          <a href="{{asset('/seamless-unit-detail/hitungsimulasi/'.$unitid.'&'.$SeamlessUnitOtrs[0]->CD_AREA)}}" class="btn btn-block btn-primary">Hitung Simulasi</a>
                          </div>
                          
                    </div>
                  </div>
                </div>
                <div class="panel box box-warning">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                        Color and Picture
                      </a>
                    </h4>
                  </div>
                  <div id="collapseTwo" class="panel-collapse collapse">
                  <div class="box-body">
                        <div class="row">
                        
                            <div class="col-sm-7">
                                <input type="text" placeholder="Search by Color Code and Color Description" class="InputSearch2 form-control">
                            </div>
                            <div class="col-sm-5">
                                <div class="col-sm-4">
                                    <a href="#" class="ButtonSearch2 btn btn-block btn-info">Search</a>    
                                </div>
                                <div class="col-sm-4">
                                    <a href="#" class="ResetSearch2 btn btn-block btn-info">Reset</a>    
                                </div>
                                <div class="col-sm-4">
                                <a href="{{asset('/seamless-unit-color/upload-page/'.$unitid)}}" class="btn btn-block btn-primary">Upload</a>    
                                </div>
                                
                            </div>
                        </div><br>

                        <table id="example2" class="table table-bordered display nowrap" style="width:100%">
                        <thead>
                        <tr>
                            <th>Color Code</th>
                            <th>Color Description</th>
                            <th>Is Primary</th>
                            <th>Picture</th>
                            <th>Action</th>     
                            
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($SeamlessUnitColors as $SeamlessUnitColor)
                            <tr>  
                                <td><span>{{$SeamlessUnitColor->CD_COLOR}}</span></td>
                                <td><span>{{$SeamlessUnitColor->DESC_COLOR}}</span></td>
                                <td><span>{{$SeamlessUnitColor->FLAG_PRIMARY}}</span></td>
                                <td><span><img class="myImg" style="width: 30%; height: 30%;" alt="" src="{{$SeamlessUnitColor->URL}}" /></span></td>
                                <td><span>
                                <!-- <a href="#" data-id="{{$SeamlessUnitColor->GUID}}" class="upload-seamless-picture btn btn-warning btn-sm"><i class="fa fa-edit"></i></a> -->
                                <a href="{{asset('/seamless-unit-picture/'.$SeamlessUnitColor->GUID.'&'.$SeamlessUnitColor->ID_UNIT)}}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                </span>
                                </td>
                            </tr>                              
                            @endforeach       
                        </tbody>
                        </table>
                        <!-- The Modal image-->
												<div id="myModal" class="modal">
														<span class="close">&times;</span>
														<img class="modal-content" id="img01">
														
												</div>
                    </div>
                  </div>
                </div>
                <div class="panel box box-success">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                        Detail
                      </a>
                    </h4>
                  </div>
                  <div id="collapseThree" class="panel-collapse collapse">
                    <div class="box-body">
                        <div class="row">
                        
                            <div class="col-sm-7">
                                <input type="text" placeholder="Search by Category, Char Value, Char Desc, etc" class="InputSearch1 form-control">
                            </div>
                            <div class="col-sm-5">
                                <div class="col-sm-4">
                                    <a href="#" class="ButtonSearch1 btn btn-block btn-info">Search</a>    
                                </div>
                                <div class="col-sm-4">
                                    <a href="#" class="ResetSearch1 btn btn-block btn-info">Reset</a>    
                                </div>
                                <div class="col-sm-4">
                                  <a href="{{asset('/seamless-unit-detail/upload-page/'.$unitid)}}" class="btn btn-block btn-primary">Upload</a>
                                </div>
                            </div>
                        </div><br>

                        <table id="example1" class="table table-bordered display nowrap" style="width:100%">
                        <thead>
                        <tr>
                            <th>Category</th>
                            <th>Char Value</th>
                            <th>Char Desc</th>
                            <th>Date Added</th>
                            <th>Id User Added</th>
                            <th>Date Updated</th>
                            <th>Id User Updated</th>
                            <th>Action</th>
                            
                        </tr>
                        </thead>
                        <tbody>
                        
                            @foreach ($SeamlessUnitDetails as $SeamlessUnitDetail)
                            <tr>  
                                <td><span>{{$SeamlessUnitDetail->CATEGORY}}</span></td>
                                <td><span>{{$SeamlessUnitDetail->CHAR_VALUE}}</span></td>
                                <td><span>{{$SeamlessUnitDetail->CHAR_DESC}}</span></td>
                                <td><span>{{date('d M Y H:i:s', strtotime($SeamlessUnitDetail->DT_ADDED))}}</span></td>
                                <td><span>{{$SeamlessUnitDetail->ID_USER_ADDED}}</span></td>
                                <td><span>{{date('d M Y H:i:s', strtotime($SeamlessUnitDetail->DT_UPDATED))}}</span></td>
                                <td><span>{{$SeamlessUnitDetail->ID_USER_UPDATED}}</span></td>
                                <td><span>
                                <a href="{{ asset('/seamless-unit-detail-update/'.$SeamlessUnitDetail->ID_UNIT.'&'.$SeamlessUnitDetail->GUID) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>            
                                </span></td>
                            </tr>                              
                            @endforeach       
                        </tbody>
                        </table>
                    </div>
                  </div>
                </div>
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                        OTR
                      </a>
                    </h4>
                  </div>
                  <div id="collapseFour" class="panel-collapse collapse">
                    <div class="box-body">
                    <div class="row">
                        
                        <div class="col-sm-7">
                            <input type="text" placeholder="Search by Kode Area, OTR" class="InputSearch1 form-control">
                        </div>
                        <div class="col-sm-5">
                            <div class="col-sm-4">
                                <a href="#" class="ButtonSearch1 btn btn-block btn-info">Search</a>    
                            </div>
                            <div class="col-sm-4">
                                <a href="#" class="ResetSearch1 btn btn-block btn-info">Reset</a>    
                            </div>
                            <div class="col-sm-4">
                              <a href="{{asset('/seamless-unit-detail/upload-page/'.$unitid)}}" class="btn btn-block btn-primary">Upload</a>
                            </div>
                        </div>
                    </div><br>

                    <table id="example3" class="table table-bordered display nowrap" style="width:100%">
                    <thead>
                    <tr>
                        <th>Kode Area</th>
                        <th>OTR</th>   
                        
                    </tr>
                    </thead>
                    <tbody>
                    
                        @foreach ($SeamlessUnitOtrs as $SeamlessUnitOtr)
                        <tr>  
                            <td><span>{{$SeamlessUnitOtr->CD_AREA}}</span></td>
                            <td><span>{{$SeamlessUnitOtr->OTR}}</span></td>
                                        
                            
                        </tr>                              
                        @endforeach       
                    </tbody>
                    </table>
                      <br/>
                      <br/>
                      <div class="col-sm-2">
                            <a href="{{asset('/seamless-unit-otr/upload-page/'.$unitid)}}" class="btn btn-block btn-primary">Upload</a>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
     
        <!-- /.col -->



 </div>

  <!-- page script -->
<script>

    // Get the modal image
    var modal = document.getElementById('myModal');

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementsByClassName('myImg');
    
    var i = img.length;
    var j;
    var modalImg = document.getElementById('img01');

    // var captionText = document.getElementById("caption");
    for(j=0;j<i;j++) {
        img[j].onclick = function(){
        modal.style.display = "block";
        modalImg.src = this.src;
      //  captionText.innerHTML = this.alt;
      }
    }
    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName('close')[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() { 
      modal.style.display = "none";
    };

    $(document).ready(function () {
      $('#example1').DataTable({
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
                null,
                null,
                null,
                null,                
                null,
                {"searchable":false},
               
                
            ]
      })

      $('#example2').DataTable({
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
                null,
                {"searchable":false},
                {"searchable":false},
               
            ]
      })


        //Button Search
        $('.ButtonSearch1').on('click', function(){
            var searchData = $('.InputSearch1').val()
            var dtable = $('#example1').DataTable()
            dtable.search(searchData).draw()
        })

    
        $('.ResetSearch1').on('click',function(){
            var tab = $('#example1').DataTable()
            tab.search('').draw()
            $('.InputSearch1').val('')
        })


        $('.ButtonSearch2').on('click', function(){
            var searchData = $('.InputSearch2').val()
            var dtable = $('#example2').DataTable()
            dtable.search(searchData).draw()
        })

        $('.ResetSearch2').on('click',function(){
            var tab = $('#example2').DataTable()
            tab.search('').draw()
            $('.InputSearch2').val('')
        })


        $(document).on('click','.upload-seamless-picture',function(){
            var id = $(this).attr('data-id');
            console.log(id);
            $.ajax({
                url:"{{asset('/seamless-unit-detail/uploadpictureshow')}}",
                data: {'Id':id ,'_token':'{{csrf_token()}}' },
                dataType:'JSON', 
                type:'GET',
                success: function (val){
                    console.log(val);
                    $('[name="GUID"]').val(val.OUT_DATA[0].GUID);
                    $('[name="ID_UNIT"]').val(val.OUT_DATA[0].dataApply[0].ID_UNIT);
                    $('[name="CD_COLOR"]').val(val.OUT_DATA[0].dataApply[0].CD_COLOR);
                    $('[name="DESC_COLOR"]').val(val.OUT_DATA[0].dataApply[0].DESC_COLOR);
                    $('[name="FLAG_PRIMARY"]').val(val.OUT_DATA[0].dataApply[0].FLAG_PRIMARY);
                    $('#URL').attr('src', val.OUT_DATA[0].URL);
                   
                },
                error: function( jqXhr, textStatus, errorThrown ){
                console.log(jqXhr);
                console.log( errorThrown );
                console.log(textStatus);
                },
            });
            $('#upload-seamless-unit-picture').modal();
        });

        
    })
  </script>

@include('modal.upload_seamless_unit_picture')
@endsection
